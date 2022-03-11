<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Styles -->
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/images/LOGO/favicon.svg')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <title>@yield('title')</title>
</head>

<body>
    @include('../layouts/__partials/header')
    <main>
        @if (\Session::has('success'))
        <script>
            swal({
                title: "Sucesso!",
                text: "{{ \Session::get('success') }}",
                icon: "success",
                button: "Ok",
            });
        </script>
        @endif

        @if (\Session::has('error'))
        <script>
            swal({
                title: "Erro!",
                text: "{{ \Session::get('error') }}",
                icon: "error",
                button: "Ok",
            });
        </script>
        @endif
        @yield('content')
    </main>
</body>


</html>
