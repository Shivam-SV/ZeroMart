@extends('layout.auth')

@section('title','Forgot password')

@section('after-navbar')
<div class="flex w-full justify-center items-center">
    <ul class="steps">
        <li class="step step-primary">Find your account</li>
        <li class="step">OTP</li>
        <li class="step">Change Password</li>
    </ul>
</div>
@endsection

@section('content')
<form action="{{ route('find-user') }}" auto-submit="true">
    <div class="form-control w-full max-w-xs">
        <label for="email" class="label">Find your account</label>
        <input type="email" id="email" name="email" placeholder="example@domain.com" class="input input-bordered w-full max-w-xs" />
    </div>
    <button type="submit" class="btn btn-primary my-2">Find Account</button>
</form>
@endsection
