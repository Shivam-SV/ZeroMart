<!DOCTYPE html>
<html lang="en" data-theme="cupcake">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') - ZeroMart</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="container">
        <div class="navbar bg-base-100">
            <a class="btn btn-ghost normal-case text-xl"><i class='bx bx-cart text-primary text-3xl'></i> ZeroMart</a>
        </div>
        @yield('after-navbar')
        <div class="flex justify-center items-center h-[80vh]">
            <div class="card shadow-xl w-96">
                <div class="card-body">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/functions.js') }}" defer></script>
    <script type="module">
        $(document).on('submit','form[auto-submit="true"]',function(){
            event.preventDefault();
            $(this).find("button[type='submit']").prop('disabled',true).prepend('<span class="loading loading-spinner"></span>');
            axios.post(this.action,this)
            .then(res => {
                if(res.data?.redirect) window.location.href = res.data.redirect;
                $(this).find("button[type='submit']").prop('disabled',false).children('.loading').remove();
            }).catch(err => {
                if(err.response?.data?.errors) inputErrors(err.response?.data?.errors)
                $(this).find("button[type='submit']").prop('disabled',false).children('.loading').remove();
                toastr.error(err.response.data.message);
            })
        })
    </script>
    @stack('scripts')
</body>
</html>
