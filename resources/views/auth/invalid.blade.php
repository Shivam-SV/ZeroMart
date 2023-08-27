@extends('layout.auth')

@section('title',$title)

@section('content')
    <h2 class="card-title">{{ $title ?? null }}</h2>
    <p>{{ $content ?? null }}</p>
@endsection
