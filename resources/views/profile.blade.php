@extends('layout.app')

@section('title', 'Profile')

@section('content')
    <div class="container bg-white py-4 px-36">
        <div class="grid grid-cols-12 gap-3">
            <div class="col-span-12 sm:col-span-12 md:col-span-3 lg:col-span-3 xl:col-span-3 2xl:col-span-3">
                <div class="avatar">
                    <div class="w-full rounded-full">
                        <img src="https://img.freepik.com/premium-psd/3d-cartoon-character-avatar-isolated-3d-rendering_235528-548.jpg?w=2000" />
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-12 md:col-span-9 lg:col-span-9 xl:col-span-9 2xl:col-span-9">
                <div class="flex gap-3">
                    <div class="chip p-3">
                        <h3 class="text-lg font-weight-bolder">Name</h3>
                        <p>{{ $user->name }}</p>
                    </div>
                    <div class="chip p-3">
                        <h3 class="text-lg font-weight-bolder">Email</h3>
                        <p>{{ $user->email }}</p>
                    </div>
                    <div class="chip p-3">
                        <h3 class="text-lg font-weight-bolder">Registered At</h3>
                        <p>{{ $user->created_at->format('F j, Y') }}</p>
                    </div>
                </div>
                <div class="chip p-3">
                    <h3 class="text-lg font-weight-bolder">Bio</h3>
                    <p>Passionate about the digital world and driven by a curiosity for all things web-related, I am an experienced web developer with a knack for turning ideas into dynamic and user-friendly online experiences. My journey in the world of web development began [mention how you got started or what sparked your interest], and since then, I have been on an exciting path of continuous learning and innovation.</p>
                </div>
            </div>

        </div>
    </div>
@endsection
