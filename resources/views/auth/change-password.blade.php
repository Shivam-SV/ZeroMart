@extends('layout.auth')

@section('title','Forgot password')

@section('after-navbar')
<div class="flex w-full justify-center items-center">
    <ul class="steps">
        <li class="step step-primary">Find your account</li>
        <li class="step step-primary">OTP</li>
        <li class="step step-primary">Change Password</li>
    </ul>
</div>
@endsection

@section('content')
<form action="{{ route('update-password') }}" auto-submit="true">
    <input type="hidden" name="userId" value="{{ $user->id }}">
    <div class="form-control w-full max-w-xs">
        <label for="password" class="label">New password</label>
        <input type="password" name="password" id="password" placeholder="Some secrets" class="input input-bordered w-full max-w-xs" />
    </div>
    <div class="form-control w-full max-w-xs">
        <label for="password_confirmation" class="label">Confirm password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Same secrets" class="input input-bordered w-full max-w-xs" />
    </div>
    <div class="card-actions my-2">
        <button class="btn btn-primary">Update</button>
    </div>
</form>
@endsection
