<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.RéserveTonTerrain') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">

    <style>
        body{
            min-height:100vh;
            font-family: Arial, sans-serif;
            background:
                linear-gradient(135deg, rgba(2,6,23,0.88), rgba(15,23,42,0.70), rgba(14,165,233,0.35)),
                url("{{ asset('image/reserverterrain.png') }}");
            background-size:cover;
            background-position:center;
            background-attachment:fixed;
            overflow-x:hidden;
        }

        .welcome-nav{
            width:92%;
            margin:22px auto 0;
            padding:14px 22px;
            border-radius:24px;
            background:rgba(2,6,23,0.72);
            backdrop-filter:blur(18px);
            border:1px solid rgba(255,255,255,0.14);
            box-shadow:0 18px 45px rgba(0,0,0,0.30);
            display:flex;
            align-items:center;
            justify-content:space-between;
        }

        .brand{
            color:white;
            text-decoration:none;
            font-size:28px;
            font-weight:950;
            display:flex;
            align-items:center;
            gap:12px;
        }

        .navbar-logo{
            height:58px;
        }

        .lang-box{
            display:flex;
            gap:10px;
        }

        .lang-btn{
            width:52px;
            height:44px;
            border-radius:14px;
            font-weight:900;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .welcome-wrapper{
            min-height:calc(100vh - 105px);
            display:flex;
            align-items:center;
            padding:50px 0;
        }

        .sport-badge{
            display:inline-flex;
            align-items:center;
            gap:10px;
            background:rgba(255,255,255,0.14);
            color:white;
            padding:12px 20px;
            border-radius:999px;
            font-weight:800;
            backdrop-filter:blur(12px);
            margin-bottom:24px;
        }

        .hero-title{
            color:white;
            font-size:70px;
            font-weight:950;
            line-height:1.05;
            letter-spacing:-2px;
            text-shadow:0 14px 35px rgba(0,0,0,0.45);
        }

        .hero-subtitle{
            color:#dbeafe;
            font-size:22px;
            line-height:1.7;
            margin-top:24px;
            max-width:650px;
            font-weight:600;
        }

        .features{
            display:flex;
            flex-wrap:wrap;
            gap:14px;
            margin-top:30px;
        }

        .feature-pill{
            background:rgba(255,255,255,0.12);
            color:white;
            border:1px solid rgba(255,255,255,0.16);
            padding:12px 16px;
            border-radius:16px;
            font-weight:800;
            backdrop-filter:blur(12px);
        }

        .auth-card{
            background:rgba(255,255,255,0.96);
            border-radius:34px;
            padding:42px;
            box-shadow:0 28px 70px rgba(0,0,0,0.35);
            border:1px solid rgba(255,255,255,0.60);
            position:relative;
            overflow:hidden;
        }

        .auth-card::before{
            content:"";
            position:absolute;
            width:220px;
            height:220px;
            border-radius:50%;
            background:rgba(37,99,235,0.12);
            top:-80px;
            right:-80px;
        }

        .auth-card-content{
            position:relative;
            z-index:2;
        }

        .auth-icon{
            width:74px;
            height:74px;
            border-radius:22px;
            background:linear-gradient(135deg,#2563eb,#06b6d4);
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:34px;
            margin:0 auto 20px;
            box-shadow:0 14px 30px rgba(37,99,235,0.35);
        }

        .auth-card h2{
            color:#0f172a;
            font-weight:950;
            font-size:42px;
            margin-bottom:12px;
        }

        .auth-card p{
            color:#64748b;
            font-size:18px;
            line-height:1.7;
            margin-bottom:30px;
            font-weight:600;
        }

        .btn-auth{
            height:60px;
            border-radius:18px;
            font-weight:950;
            font-size:18px;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:10px;
        }

        .welcome-note{
            color:#64748b;
            margin-top:22px;
            font-weight:700;
            line-height:1.6;
        }

        @media(max-width:991px){
            .welcome-nav{
                width:94%;
                padding:12px 16px;
            }

            .brand{
                font-size:20px;
            }

            .navbar-logo{
                height:46px;
            }

            .hero-title{
                font-size:42px;
                text-align:center;
            }

            .hero-subtitle{
                text-align:center;
                font-size:18px;
            }

            .sport-badge{
                display:flex;
                justify-content:center;
                width:max-content;
                margin-inline:auto;
            }

            .features{
                justify-content:center;
            }

            .auth-card{
                margin-top:35px;
                padding:30px;
            }
        }
    </style>
</head>

<body>

<header class="welcome-nav">
    <a href="{{ url('/') }}" class="brand">
        <img src="{{ asset('image/logo.png') }}" alt="Logo" class="navbar-logo">
        <span>{{ __('messages.RéserveTonTerrain') }}</span>
    </a>

    <div class="lang-box">
        <a href="{{ route('lang.switch', 'fr') }}" class="btn btn-outline-light btn-sm lang-btn">FR</a>
        <a href="{{ route('lang.switch', 'ar') }}" class="btn btn-outline-light btn-sm lang-btn">AR</a>
    </div>
</header>

<main class="welcome-wrapper">
    <div class="container">
        <div class="row align-items-center g-5">

            <div class="col-lg-7">
                <div class="sport-badge">
                    <i class="bi bi-trophy-fill"></i>
                    {{ __('messages.Bienvenue-Monde') }}
                </div>

                <h1 class="hero-title">
                    {{ __('messages.welcome_title') }}
                </h1>

                <p class="hero-subtitle">
                    {{ __('messages.welcome_subtitle') }}
                </p>

                <div class="features">
                    <div class="feature-pill">
                        <i class="bi bi-calendar-check-fill me-2"></i>
                        {{ __('messages.Réservation-rapide') }}
                    </div>

                    <div class="feature-pill">
                        <i class="bi bi-shield-check me-2"></i>
                        {{ __('messages.platforme-sécurisée') }}
                    </div>

                    <div class="feature-pill">
                        <i class="bi bi-geo-alt-fill me-2"></i>
                        {{ __('messages.Terrains-proches') }}
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="auth-card text-center">
                    <div class="auth-card-content">

                        <div class="auth-icon">
                            <i class="bi bi-dribbble"></i>
                        </div>

                        <h2>{{ __('messages.bienvenue') }}</h2>

                        <p>
                            {{ __('messages.welcome_auth_text') }}
                        </p>

                        <div class="d-grid gap-3">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-auth">
                                {{ __('messages.connexion') }}
                                <i class="bi bi-box-arrow-in-right"></i>
                            </a>

                            <a href="{{ route('register') }}" class="btn btn-outline-danger btn-auth">
                                {{ __('messages.inscription') }}
                                <i class="bi bi-person-plus-fill"></i>
                            </a>
                        </div>

                        <div class="welcome-note">
                            {{ __('messages.welcome_note') }}
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</main>

<script src="{{ asset('assets/bootstrap/bootstrap.bundle.min.js') }}"></script>
</body>
</html>