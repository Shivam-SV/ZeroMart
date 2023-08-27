@extends('layout.auth')

@section('title','Sign up')

@section('content')
    <form action="{{ route('register') }}" auto-submit="true">
        <div class="form-control w-full max-w-xs">
            <label for="name" class="label">Name</label>
            <input type="text" id="name" placeholder="Your full name" name="name" class="input input-bordered w-full max-w-xs" />
            <label class="label text-error p-1"></label>
        </div>
        <div class="form-control w-full max-w-xs">
            <label for="email" class="label">Email</label>
            <input type="email" id="email" placeholder="example@domain.com" name="email" class="input input-bordered w-full max-w-xs" />
            <label class="label text-error p-1"></label>
        </div>
        <div class="form-control w-full max-w-xs">
            <label for="password" class="label">Password</label>
            <input type="password" id="password" placeholder="Some secrets" name="password" class="input input-bordered w-full max-w-xs" />
            <label class="label text-error p-1"></label>
        </div>
        <div class="form-control w-full max-w-xs">
            <label for="password_confirmation" class="label">Confirm Password</label>
            <input type="password" id="password_confirmation" placeholder="Same secrets" name="password_confirmation" class="input input-bordered w-full max-w-xs" />
            <label class="label text-error p-1"></label>
        </div>

        <div class="card-actions justify-between my-2">
            <button type="submit" class="btn btn-primary">Register</button>
            <p class="text-right text-sm mt-4">Already a member? <a href="/login" class="link">Login</a></p>
        </div>
    </form>
@endsection
