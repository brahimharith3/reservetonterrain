<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'RéserveTonTerrain' }}</title>

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">

    <style>
        body{
            min-height:100vh;
            font-family: Arial, sans-serif;
            background:
                linear-gradient(135deg, rgba(15,23,42,0.10), rgba(30,58,138,0.20), rgba(14,165,233,0.60)),
                url("{{ asset('image/reserverterrain.png') }}");
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding-top: 95px;
        }

        .navbar-custom{
            position: fixed;
            top: 14px;
            left: 50%;
            transform: translateX(-50%);
            width: 94%;
            z-index: 1030;
            background: rgba(2, 6, 23, 0.78);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 22px;
            box-shadow: 0 16px 40px rgba(0,0,0,0.28);
            padding: 8px 0;
        }

        .navbar-logo{
            height: 46px;
            width: auto;
            object-fit: contain;
        }

        .brand-text{
            color:white;
            font-size:20px;
            font-weight:900;
            white-space:nowrap;
        }

        .navbar-brand{
            margin:0 !important;
            padding:0;
        }

        .navbar-nav{
            gap:6px;
            align-items:center;
        }

        .nav-link-custom{
            color:rgba(255,255,255,0.92) !important;
            text-decoration:none;
            font-weight:800;
            white-space:nowrap;
            font-size:14px;
            padding:9px 10px;
            border-radius:13px;
            display:inline-flex;
            align-items:center;
            gap:6px;
            transition:0.25s;
        }

        .nav-link-custom:hover{
            background:rgba(255,255,255,0.12);
            color:white !important;
        }

        .lang-box{
            display:flex;
            gap:7px;
            align-items:center;
        }

        .lang-btn{
            width:42px;
            height:36px;
            border-radius:12px;
            font-weight:900;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .user-box{
            color:white;
            font-size: 13px;
            font-weight:800;
            white-space:nowrap;
            display:flex;
            align-items:center;
            gap:7px;
            padding:8px 8px;
            max-width:150px;
            overflow:hidden;
            text-overflow:ellipsis;
        }

        .btn-logout{
            height:40px;
            border-radius:12px;
            padding:0 13px;
            font-weight:800;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:6px;
            white-space:nowrap;
            border:none;
        }

        .custom-toggler{
            border:1px solid rgba(255,255,255,0.35);
            border-radius:14px;
            padding:8px 11px;
            box-shadow:none !important;
        }

        .reservation-badge{
            position:absolute;
            top:-2px;
            right: -2px;
            min-width:20px;
            height:20px;
            padding:0 6px;
            border-radius:999px;
            background:#ef4444;
            color:white;
            font-size:11px;
            font-weight:900;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        html[dir="rtl"] .reservation-badge{
            right:auto;
            left:-2px;
        }

        .main-wrapper{
            padding:40px 0;
        }

        .hero-box{
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 30px;
            color: white;
            margin-bottom: 30px;
        }

        .page-title{font-weight:800;color:white;}
        .page-subtitle{color:#e2e8f0;}

        .custom-card{
            border:none;
            border-radius:20px;
            box-shadow:0 10px 25px rgba(0,0,0,0.12);
            overflow:hidden;
            transition:0.3s;
        }

        .custom-card:hover{transform:translateY(-4px);}

        .terrain-photo{
            width:100%;
            height:220px;
            object-fit:cover;
        }

        .content-box{
            background:white;
            border-radius:20px;
            padding:20px;
            box-shadow:0 8px 20px rgba(0,0,0,0.10);
        }

        .status-badge{
            padding:8px 14px;
            border-radius:20px;
            font-size:14px;
        }

        .filter-box{
            background:rgba(255,255,255,0.95);
            border-radius:24px;
            padding:22px;
            box-shadow:0 12px 30px rgba(0,0,0,0.10);
        }

        .site-footer{
            background: linear-gradient(135deg,#0f172a 0%,#1e3a8a 40%,#38bdf8 100%);
            color:white;
            padding:50px 0 25px;
            margin-top:60px;
            border-radius:10px 10px 0 0;
        }

        .footer-logo{
            height:55px;
            width:auto;
            object-fit:contain;
        }

        .footer-brand{
            font-weight:900;
            margin-bottom:18px;
            font-size:25px;
        }

        .footer-text{
            color:#fee2e2;
            line-height:1.7;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .footer-text:hover{
            color:#fee2e2;
            line-height:1.7;
            color: #e5a9a9;
            transform: translateY(-4px);
            text-shadow: 0 5px 15px rgba(255, 209, 102, 0.4);
        }

        .footer-title{
            font-weight:800;
            color: bisque;
            margin-bottom:18px;
        }

        .footer-links{
            list-style:none;
            padding:0;
            margin:0;
        }


        html[dir="rtl"] .nav-link-custom{
            margin-right: 10px;
        }

        .footer-links li{
            margin-bottom:10px;
        }

        .footer-links a{
            color: white;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .footer-links a:hover{
            color: red;
            transform: translateY(-4px);
            text-shadow: 0 5px 15px rgba(255, 209, 102, 0.4);
        }

        .footer-bottom{
            display:flex;
            justify-content:space-between;
            align-items:center;
            flex-wrap:wrap;
            gap:15px;
            color:#fee2e2;
        }

        @media(max-width:1200px){
            .brand-text{font-size:18px;}
            .navbar-logo{height:42px;}
            .nav-link-custom{font-size:13px;padding:8px 7px;}
            .user-box{max-width:110px;}
        }

        @media(max-width:991px){
            body{padding-top:100px;}

            .navbar-custom{
                width:93%;
                border-radius:18px;
            }

            .navbar-custom .container-fluid{
                padding-inline:18px;
            }

            .navbar-collapse{
                margin-top:15px;
                padding-top:15px;
                border-top:1px solid rgba(255,255,255,0.10);
            }

            .navbar-nav{
                align-items:stretch !important;
                gap:10px;
            }

            .nav-link-custom{
                width:100%;
                justify-content:center;
                background:rgba(255,255,255,0.07);
            }

            .lang-box{
                justify-content:center;
            }

            .user-box{
                justify-content:center;
                max-width:100%;
            }

            .btn-logout{
                width:100%;
            }
        }
    </style>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid px-4">

        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" class="navbar-logo">
            <span class="brand-text">{{ __('messages.RéserveTonTerrain') }}</span>
        </a>

        <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <div class="navbar-nav ms-auto mt-3 mt-lg-0">

                @auth
                    @if(auth()->user()->role == 'client')
                        <a href="{{ route('home') }}" class="nav-link-custom">
                            <i class="bi bi-dribbble"></i>
                            {{ __('messages.terrains') }}
                        </a>

                        <a href="{{ route('reservations.index') }}" class="nav-link-custom">
                            <i class="bi bi-calendar-check-fill"></i>
                            {{ __('messages.mes_reservations') }}
                        </a>
                    @endif

                    @if(auth()->user()->role == 'admin')
                        <a href="{{ route('dashboard') }}" class="nav-link-custom">
                            <i class="bi bi-speedometer2"></i>
                            {{ __('messages.dashboard') }}
                        </a>

                        <a href="{{ route('terrains.index') }}" class="nav-link-custom">
                            <i class="bi bi-dribbble"></i>
                            {{ __('messages.terrains') }}
                        </a>

                        <a href="{{ route('horaires.index') }}" class="nav-link-custom">
                            <i class="bi bi-clock-fill"></i>
                            {{ __('messages.horaires') }}
                        </a>

                        <a href="{{ route('admin.reservations') }}" class="nav-link-custom position-relative">
                            <i class="bi bi-calendar-check-fill"></i>
                            {{ __('messages.reservations') }}

                            @if($reservationsEnAttente > 0)
                                <span class="reservation-badge">
                                    {{ $reservationsEnAttente }}
                                </span>
                            @endif
                        </a>
                    @endif
                @endauth

                <div class="lang-box">
                    <a href="{{ route('lang.switch', 'fr') }}" class="btn btn-outline-light btn-sm lang-btn">FR</a>
                    <a href="{{ route('lang.switch', 'ar') }}" class="btn btn-outline-light btn-sm lang-btn">AR</a>
                </div>

                @auth
                    <span class="user-box">
                        <i class="bi bi-person-circle"></i>
                        {{ auth()->user()->name }}
                        @if(auth()->user()->role == 'admin')
                            (admin)
                        @endif
                    </span>

                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button class="btn btn-danger btn-sm btn-logout">
                            <i class="bi bi-box-arrow-right"></i>
                            {{ __('messages.deconnexion') }}
                        </button>
                    </form>
                @endauth

            </div>
        </div>

    </div>
</nav>

<div class="main-wrapper">
    <div class="container">
        {{ $slot }}
    </div>
</div>

<footer class="site-footer">
    <div class="container">
        <div class="row g-4 align-items-start">

            <div class="col-md-4">
                <h3 class="footer-brand d-flex align-items-center gap-2">
                    <img src="{{ asset('image/logo.png') }}" alt="Logo" class="footer-logo">
                    <span>{{ __('messages.RéserveTonTerrain') }}</span>
                </h3>
                <p class="footer-text">
                    {{ __('messages.footer_description') }}
                </p>
            </div>

            <div class="col-md-4">
                <h5 class="footer-title">{{ __('messages.acces_rapide') }}</h5>

                <ul class="footer-links">
                    @auth
                        @if(auth()->user()->role == 'client')
                            <li><a href="{{ route('home') }}">{{ __('messages.terrains') }}</a></li>
                            <li><a href="{{ route('reservations.index') }}">{{ __('messages.mes_reservations') }}</a></li>
                        @endif

                        @if(auth()->user()->role == 'admin')
                            <li><a href="{{ route('dashboard') }}">{{ __('messages.dashboard') }}</a></li>
                            <li><a href="{{ route('admin.reservations') }}">{{ __('messages.liste_reservations') }}</a></li>
                        @endif
                    @endauth
                </ul>
            </div>

            <div class="col-md-4">
                <h5 class="footer-title">{{ __('messages.contact') }}</h5>
                <p class="footer-text mb-2">📍 Casablanca, Maroc</p>
                <p class="footer-text mb-2">📞 +212 6 00 00 00 00</p>
                <p class="footer-text mb-2">✉️ terrainreservation3@gmail.com</p>
            </div>

        </div>

        <hr>

        <div class="footer-bottom">
            <span>Copyright © 2026 {{ __('messages.RéserveTonTerrain') }}</span>
        </div>
    </div>
</footer>

<script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>
</html>