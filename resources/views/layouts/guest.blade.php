<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'RéserveTonTerrain') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <style>
        body{
            background: linear-gradient(135deg,#0f172a 0%,#1e3a8a 40%,#38bdf8 100%);
            min-height: 100vh;
            font-family: Arial, sans-serif;
            
        }

        .guest-wrapper{
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 15px;
        }

        .guest-box{
            width: 100%;
            max-width: 440px;
        }

    
        .brand-link{
            text-decoration: none;
            color: white;
            font-size: 32px;
            font-weight: 800;
            display: inline-flex; 
            align-items: center;  
            justify-content: center; 
            gap: 12px; 
            margin-bottom: 25px;
            width: 100%;
        }

        .guest-card{
            background: white;
            border-radius: 22px;
            padding: 28px;
            box-shadow: 0 12px 30px rgba(0,0,0,0.18);
        }

        .guest-title{
            font-size: 30px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .guest-subtitle{
            color: #64748b;
            margin-bottom: 22px;
        }

        .form-label{
            font-weight: 600;
            color: #0f172a;
        }

        .form-control{
            border-radius: 12px;
            min-height: 46px;
        }

        .btn-main{
            background: #1d4ed8;
            border: none;
            border-radius: 12px;
            min-height: 46px;
            font-weight: 700;
        }

        .btn-main:hover{
            background: #1e40af;
        }

        .small-link{
            text-decoration: none;
            font-weight: 600;
        }

        .navbar-logo {
            height: 50px; 
            width: auto;
            object-fit: contain;
        }

        .text-danger ul{
            margin-bottom: 0;
            padding-left: 18px;
        }
        
    </style>
</head>
<body>

    <div class="guest-wrapper">
        <div class="guest-box text-center">
            
            <a href="{{ route('home') }}" class="brand-link">
                <img src="{{ asset('image/logo.png') }}" alt="Logo" class="navbar-logo">
                <span>RéserveTonTerrain</span>
            </a>
            
            <div class="guest-card text-start">
                {{ $slot }}
            </div>
        </div>
    </div>

</body>
</html>