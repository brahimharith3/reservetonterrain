<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">

    <style>
        .login-head{
            text-align:center;
            margin-bottom:28px;
        }

        .login-icon{
            width:78px;
            height:78px;
            border-radius:24px;
            background:linear-gradient(135deg,#2563eb,#06b6d4);
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:36px;
            margin:0 auto 18px;
            box-shadow:0 14px 35px rgba(37,99,235,0.35);
        }

        .guest-title{
            font-size:36px;
            font-weight:950;
            color:#0f172a;
            margin-bottom:6px;
        }

        .guest-subtitle{
            color:#64748b;
            font-weight:700;
            font-size:17px;
        }

        .form-field{
            margin-bottom:20px;
        }

        .form-label{
            font-weight:850;
            color:#0f172a;
            margin-bottom:8px;
        }

        .input-wrap{
            position:relative;
        }

        .input-wrap i{
            position:absolute;
            top:50%;
            left:18px;
            transform:translateY(-50%);
            color:#2563eb;
            font-size:19px;
        }

        .input-wrap .form-control{
            height:58px;
            border-radius:18px;
            padding-left:52px;
            font-weight:700;
            border:1px solid #dbe2ea;
            background:#f8fafc;
        }

        .input-wrap .form-control:focus{
            border-color:#2563eb;
            background:white;
            box-shadow:0 0 0 4px rgba(37,99,235,0.12);
        }

        .remember-row{
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:15px;
            flex-wrap:wrap;
            margin:8px 0 22px;
        }

        .form-check-label{
            color:#475569;
            font-weight:700;
        }

        .btn-main{
            height:60px;
            border-radius:18px;
            background:linear-gradient(135deg,#2563eb,#06b6d4);
            border:none;
            font-weight:950;
            font-size:18px;
            box-shadow:0 14px 30px rgba(37,99,235,0.28);
            display:flex;
            align-items:center;
            justify-content:center;
            gap:10px;
        }

        .btn-main:hover{
            transform:translateY(-2px);
            box-shadow:0 18px 38px rgba(37,99,235,0.36);
        }

        .small-link{
            color:#2563eb;
            text-decoration:none;
            font-weight:850;
        }

        .small-link:hover{
            color:#0f172a;
            text-decoration:underline;
        }

        .auth-footer{
            margin-top:22px;
            padding-top:20px;
            border-top:1px solid #e2e8f0;
            display:flex;
            justify-content:space-between;
            align-items:center;
            flex-wrap:wrap;
            gap:12px;
        }

        .alert{
            border-radius:16px;
            font-weight:700;
        }

        @media(max-width:576px){
            .guest-title{
                font-size:30px;
            }

            .auth-footer{
                justify-content:center;
                text-align:center;
            }
        }

       .input-wrap{
            position:relative;
        }

        .input-wrap .form-control{
            padding-left:52px !important;
            padding-right:58px !important;
        }

        .input-wrap > i{
            position:absolute;
            top:50%;
            left:18px;
            transform:translateY(-50%);
            color:#2563eb;
            font-size:20px;
            z-index:3;
        }

        .toggle-password{
            position:absolute;
            top:50%;
            right:14px;
            transform:translateY(-50%);
            width:34px;
            height:34px;
            border-radius:50%;
            background:transparent;
            border:none;
            color:#64748b;
            display:flex;
            align-items:center;
            justify-content:center;
            cursor:pointer;
            z-index:4;
        }

        .toggle-password i{
            position:static !important;
            transform:none !important;
            color:inherit !important;
            font-size:22px;
        }

        .toggle-password:hover{
            color:#2563eb;
            background:#eff6ff;
        }
    </style>

    <div class="login-head">
        <div class="login-icon">
            <i class="bi bi-person-circle"></i>
        </div>

        <div class="guest-title">
            Connexion
        </div>

        <div class="guest-subtitle">
            Connectez-vous pour réserver votre terrain
        </div>
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="form-field">
            <label class="form-label">Email</label>

            <div class="input-wrap">
                <i class="bi bi-envelope-at-fill"></i>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    class="form-control"
                    placeholder="exemple@email.com"
                >
            </div>
        </div>


        <div class="form-field">
            <label class="form-label">Mot de passe</label>

            <div class="input-wrap">
                <i class="bi bi-lock-fill left-icon"></i>
                <input
                    type="password"
                    name="password"
                    id="password"
                    required
                    class="form-control password-input"
                    placeholder="Votre mot de passe">

                <span class="toggle-password" onclick="togglePassword('password', this)">
                    <i class="bi bi-eye-fill"></i>
                </span>

            </div>
        </div>

        <div class="remember-row">
            <div class="form-check">
                <input type="checkbox" name="remember" class="form-check-input" id="remember_me">

                <label class="form-check-label" for="remember_me">
                    Se souvenir de moi
                </label>
            </div>

            @if (Route::has('password.request'))
                <a class="small-link" href="{{ route('password.request') }}">
                    Mot de passe oublié ?
                </a>
            @endif
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-main text-white">
                Se connecter
                <i class="bi bi-box-arrow-in-right"></i>
            </button>
        </div>

        <div class="auth-footer">
            <span class="text-muted fw-bold">
                Vous n’avez pas de compte ?
            </span>

            <a class="small-link" href="{{ route('register') }}">
                <i class="bi bi-person-plus-fill me-1"></i>
                Créer un compte
            </a>
        </div>
    </form>

<script>
    function togglePassword(inputId, element) {

        let input = document.getElementById(inputId);
        let icon = element.querySelector('i');

        if(input.type === "password"){
            input.type = "text";
            icon.classList.remove('bi-eye-fill');
            icon.classList.add('bi-eye-slash-fill');
        }else{
            input.type = "password";
            icon.classList.remove('bi-eye-slash-fill');
            icon.classList.add('bi-eye-fill');
        }
    }
</script>
</x-guest-layout>