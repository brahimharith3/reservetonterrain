<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Terrain Booking') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
</head>
<body style="background: linear-gradient(135deg,#0f172a 0%,#1e3a8a 40%,#38bdf8 100%); min-height:100vh;">

    <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center p-4">
        
        <a href="{{ route('home') }}" class="text-white text-decoration-none fw-bold fs-3 mb-4">
            ⚽ RéserveTonTerrain
        </a>

        <div class="bg-white shadow rounded-4 p-4" style="width:100%; max-width:430px;">
            {{ $slot }}
        </div>
    </div>

</body>
</html>