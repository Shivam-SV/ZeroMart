@extends('emails.layout')

@section('title', 'Verify Your Email')

@section('content')
    <h1>Hey {{ $user->name }}</h1>

    <p>Glad to see you here, Please verify you email to continue</p>

    <a href="{{ $url }}">Verify Email</a>
@endsection
