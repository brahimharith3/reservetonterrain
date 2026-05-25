<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">

    <style>
        .register-head{
            text-align:center;
            margin-bottom:28px;
        }

        .register-icon{
            width:82px;
            height:82px;
            border-radius:24px;
            background:linear-gradient(135deg,#dc2626,#f97316);
            color:white;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:38px;
            margin:0 auto 18px;
            box-shadow:0 14px 35px rgba(220,38,38,0.30);
        }

        .guest-title{
            font-size:36px;
            font-weight:950;
            color:#0f172a;
            margin-bottom:6px;
        }

        .guest-subtitle{
            color:#64748b;
            font-size:17px;
            font-weight:700;
        }

        .form-field{
            margin-bottom:20px;
        }

        .form-label{
            color:#0f172a;
            font-weight:850;
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
            font-size:18px;
        }

        .input-wrap .form-control{
            height:58px;
            border-radius:18px;
            padding-left:52px;
            border:1px solid #dbe2ea;
            background:#f8fafc;
            font-weight:700;
        }

        .input-wrap .form-control:focus{
            border-color:#2563eb;
            background:white;
            box-shadow:0 0 0 4px rgba(37,99,235,0.12);
        }

        .btn-main{
            height:60px;
            border:none;
            border-radius:18px;
            background:linear-gradient(135deg,#dc2626,#f97316);
            font-size:18px;
            font-weight:950;
            box-shadow:0 14px 30px rgba(220,38,38,0.28);
            display:flex;
            align-items:center;
            justify-content:center;
            gap:10px;
        }

        .btn-main:hover{
            transform:translateY(-2px);
            box-shadow:0 18px 38px rgba(220,38,38,0.35);
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
            text-align:center;
        }

        .alert{
            border-radius:16px;
            font-weight:700;
        }

        @media(max-width:576px){
            .guest-title{
                font-size:30px;
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

    <div class="register-head">

        <div class="register-icon">
            <i class="bi bi-person-plus-fill"></i>
        </div>

        <div class="guest-title">
            Inscription
        </div>

        <div class="guest-subtitle">
            Créez votre compte utilisateur
        </div>

    </div>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-field">
            <label class="form-label">Nom complet</label>

            <div class="input-wrap">
                <i class="bi bi-person-fill"></i>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="form-control"
                    placeholder="Votre nom"
                >
            </div>
        </div>

        <div class="form-field">
            <label class="form-label">Email</label>

            <div class="input-wrap">
                <i class="bi bi-envelope-at-fill"></i>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
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

      <div class="form-field">
            <label class="form-label">Confirmer le mot de passe</label>

            <div class="input-wrap">

                <i class="bi bi-shield-lock-fill left-icon"></i>

                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    required
                    class="form-control password-input"
                    placeholder="Confirmation">

                <span class="toggle-password" onclick="togglePassword('password_confirmation', this)">
                    <i class="bi bi-eye-fill"></i>
                </span>

            </div>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-main text-white">
                <i class="bi bi-box-arrow-in-right"></i>
                S'inscrire
            </button>
        </div>

        <div class="auth-footer">
            <a class="small-link" href="{{ route('login') }}">
                <i class="bi bi-box-arrow-in-right me-1"></i>
                Vous avez déjà un compte ? Connexion
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