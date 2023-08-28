<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - ZeroMart</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <div class="navbar bg-base-100">
            <div class="flex-1">
                <a class="text-xl normal-case btn btn-ghost"><i class='text-3xl bx bx-cart text-primary'></i> ZeroMart</a>
            </div>
            <div class="flex-none tabs">
                <a class="tab tab-bordered {{ Route::is('home') ? 'tab-active' : '' }}" href="/home"><i class='bx bx-home'></i> Home</a>
                <a class="tab tab-bordered {{ Route::is('profile') ? 'tab-active' : '' }}" href="/profile/{{ encrypt(auth()->id()) }}"><i class='bx bx-user'></i> Profile</a>
                <a class="tab tab-bordered" href="/logout"><i class='bx bx-exit'></i> Logout</a>
            </div>
        </div>
        @yield('content')
    </div>
    <script src="{{ asset('assets/functions.js') }}" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>
