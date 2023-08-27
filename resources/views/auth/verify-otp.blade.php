@extends('layout.auth')

@section('title','Forgot password')

@section('after-navbar')
<div class="flex w-full justify-center items-center">
    <ul class="steps">
        <li class="step step-primary">Find your account</li>
        <li class="step step-primary">OTP</li>
        <li class="step">Change Password</li>
    </ul>
</div>
@endsection

@section('content')
<form action="{{ route('verify-otp') }}" auto-submit="true">
    <div class="form-control w-full max-w-xs">
        <label for="otp" class="label">We have sent you an OTP over your email. But be hurry, OTP is only valid for {{ $exactMinutes }} (that is {{ $validTill }}) </label>
        <input type="hidden" name="userId" value="{{ $user->id }}">
        <input type="number" name="otp" id="otp" placeholder="- - - - - -" class="input input-bordered w-full max-w-xs  text-lg text-center" />
    </div>
    <div class="card-actions justify-between my-2">
        <button class="btn btn-primary">Change Password</button>
        <a href="{{ url()->current() ."?resend-otp" }}" class="link my-4">Reserd OTP</a>
    </div>
</form>
@endsection
