@extends('emails.layout')

@section('title', 'Change your Password')

@section('content')
    <h1>Hello {{ $user->name }}</h1>

    <p>Here is your OTP to change the password, but be aware, don't provide the otp to someone else, it may makes your account stollen or affect your privacy, be awared</p>

    <p>Your Otp is {{ $otp }}</p>
@endsection
