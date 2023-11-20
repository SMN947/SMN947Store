<!DOCTYPE html>
<html lang="es" data-theme="dracula">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    @vite(['resources/css/app.css','resources/css/dataTables.css','resources/js/app.js'])
    <title>{{ config('app.name') }}</title>
</head>

<body>
    <x-app.navbar></x-app.navbar>

    @if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul class="list-unstyled mb-0">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    @yield('content')
    <x-app.footer></x-app.footer>
</body>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
@yield('scripts')

</html>