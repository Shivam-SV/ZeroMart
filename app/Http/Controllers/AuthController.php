<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use App\Mail\AppMail;
use RuntimeException;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{

    public function login(Request $request) : Response
    {
        # validating Request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        # verifying that the user is available or not
        $user = User::where('email', $request->email)->first();

        if(!$user && $user->verified()) return response(["errors" => ['email' => "Incorrect email or please verify your email"]], 422);

        if(!Auth::attempt($request->only(['email','password']), $request->has('remember') ? true : false)) return response(["errors" => ['password' => 'Incorrect password, Please verify your password']], 422);

        return response(['message' => "Welcome! {$user->name}", 'status' => true, 'redirect' => route('home')], 200);
    }

    public function register(Request $request) :Response
    {
        # validating request
        $request->validate(User::$validationRules);

        try{
            DB::beginTransaction();

            # Registering User
            if($user = User::create($request->only(array_keys(User::$validationRules)))) {

                # verifying the email
                Mail::to($user->email)->queue(new AppMail(view('emails.verify-email', ['url' => route('verify-email', ['userId' => encrypt($user->id)]), 'user' => $user])->render(), 'verify your email'));
                DB::commit();
                return response(['message' => 'User registered', 'status' => true, 'redirect' => route('registed', ['ue' => base64_encode($user->email)])], 200);
            }
            throw new RuntimeException("can not store the user");
        }catch(Throwable $th){
            return response(['message' => 'something went wrong with the server, please try again later', 'error' => $th->getMessage(), 'status' => false], 500);
        }
    }

    public function verifyEmail(Request $request): RedirectResponse|View
    {
        # is request contain a valid user id
        if($request->has('userId') && is_numeric($userId = normalizeId($request->userId))){
            $user = User::find($userId);
            if($user){
                # does it verfied already or not
                if($user->verified()) return view('auth.invalid', ['title' => 'Verified', 'content' => "{$user->email} is already verified"]);

                # verifying user
                $user->touchVerified();
                return redirect(route('login'));
            }
        }

        return view('auth.invalid', ['title' => 'Not Found', 'content' => 'Requested user not found or not registered']);
    }

    public function findByEmail(Request $request){
        if($request->has('email') && filter_var($request->email, FILTER_VALIDATE_EMAIL)){
            $user = User::where('email',$request->email)->first();
            if($user){
                return response(['redirect' => route('send-otp',['userId' => encrypt($user->id)]), 'message' => 'User found', 'status' => true]);
            }
        }

        return response(["errors" => ['email' => "can't find account for specified email"]], 422);
    }

    public function sendOtp(Request $request){
        # if not a user show an error page
        if(!$request->has('userId') || !is_numeric($userId = normalizeId($request->userId))) return view('auth.invalid',['title' => 'No user', 'content' => 'Can\'t find the user']);
        $user = User::find($userId);
        if(!$user) return view('auth.invalid',['title' => 'No user', 'content' => 'Can\'t find the user']);

        # cache key for OTP
        $cacheKey = "user-{$user->id}";

        # if user request for resend OTP
        if($request->has('resend-otp')){
            Cache::forget($cacheKey);
            return redirect(route('sent-otp',$request->except('resend-otp')));
        }

        # generating and sending OTP
        if(!Cache::has($cacheKey)){
            $otp = generateOtp();
            $validTill = now()->addSeconds(config('auth.otp_duration', 360))->format("H:i");
            try{
                Mail::to($user->email)->queue(new AppMail(view('emails.otp', compact('user', 'otp'))->render(), 'Change your password'));
            }catch(Throwable $th){
                return view('auth.invalid',['title' => 'Something going wrong', 'content' => 'Can\' send the email due to some server problem, please try again later']);
            }
            Cache::put($cacheKey, json_encode(compact('otp','validTill')), config('auth.otp_duration', 360));
        }else{
            [$otp, $validTill] = array_values(json_decode(Cache::get($cacheKey),true));
        }
        $exactMinutes = config('auth.otp_duration', 360) / 60;
        return view('auth.verify-otp', compact('otp', 'validTill','exactMinutes','user'));
    }

    public function verifyOtp(Request $request){
        $request->validate([
            'userId' => 'required',
            'otp' => 'required|min:6|numeric'
        ]);

        $user = User::find($request->userId);
        if(!$user) return response(['errors' => ['otp' => "Not a valid user"]], 422);

        # verifying otp token
        $cacheKey = "user-{$user->id}";
        if(!Cache::has($cacheKey)) return response(['errors' => ['otp' => "OTP has been expired please try again"]], 422);
        [$otp, $validTill] = array_values(json_decode(Cache::get($cacheKey), true));
        if($request->otp != $otp) return response(['errors' => ['otp' => "OTP doesn't match, please check it again"]], 422);

        return response(['message' => 'OTP matched', 'status' => true, 'redirect' => route('change-password', encrypt($user->id))]);
    }

    public function changePassword(Request $request, $userId)
    {
        $user = User::find(normalizeId($userId));
        if(!$user) return view('auth.invalid', ['title' => 'Invalid Url', 'content' => 'Invalid URL or user is not valid']);

        return view('auth.change-password', compact('user'));
    }

    public function updatePassword(Request $request){
        $request->validate([
            'password' => 'required|string|max:20|min:6|confirmed'
        ]);

        $user = User::find($request->userId);
        if(!$user) return response(['errors' => ['password' => "Not a valid user"]], 422);

        # changing password
        $user->password = $request->password;
        $user->save();

        return response(['message' => 'Password has been updated', 'status' => true, 'redirect' => route('login')]);
    }
}
