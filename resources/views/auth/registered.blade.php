@extends('layout.auth')

@section('title','verify your email')

@section('content')
    <h1 class="card-title">Congratulations!</h1>
    <p>You have Been Registered With us, please verify your email by checking your email {{ base64_decode(request('ue')) }}</p>
@endsection
