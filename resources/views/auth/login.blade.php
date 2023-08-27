@extends('layout.auth')

@section('title','Login')

@section('content')
    <form action="{{ route('login') }}" method="post" auto-submit="true">
        <div class="form-control w-full max-w-xs">
            <label for="email" class="label">Email</label>
            <input type="email" id="email" placeholder="example@domain.com" name="email" class="input input-bordered w-full max-w-xs" />
            <label for="email" class="label text-error p-1"></label>
        </div>
        <div class="form-control w-full max-w-xs">
            <label for="password" class="label">Password</label>
            <input type="password" id="password" name="password" placeholder="Secret words" class="input input-bordered w-full max-w-xs" />
            <label for="email" class="label text-error p-1"></label>
            <label class="label">
                <span class="label-text-alt"><input type="checkbox"> Remember me</span>
                <span class="label-text-alt"><a href="/find-account" class="link">Forgot Password?</a></span>
            </label>
        </div>
        <div class="card-actions my-2 justify-between">
            <button type="submit" class="btn btn-primary">Login</button>
            <p class="text-right mt-4 text-sm">New to Zeromart? <a href="/register" class="link">SignUp</a></p>
        </div>
    </form>
@endsection
