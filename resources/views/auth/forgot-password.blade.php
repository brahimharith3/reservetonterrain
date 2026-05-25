<x-guest-layout>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-icons/bootstrap-icons.css') }}">


    <div class="guest-title">Mot de passe oublié</div>
    <div class="guest-subtitle">
        Entrez votre email pour recevoir un lien de réinitialisation
    </div>

    @if (session('status'))
        <div class="alert alert-success">
            <i class="bi bi-check-circle-fill"></i>
            Un lien de réinitialisation a été envoyé à votre email.
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger text-danger">
            <i class="bi bi-x-circle-fill"></i> 
            Impossible d’envoyer le lien. Vérifiez votre adresse email.
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <i class="bi bi-envelope-at-fill"></i>
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control">
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-main text-white">
                <i class="bi bi-arrow-right-circle-fill"></i>
                Envoyer le lien de réinitialisation
            </button>
        </div>

        <div class="text-center">
            <a class="small-link" href="{{ route('login') }}">
                Retour à la connexion
                <i class="bi bi-door-open"></i>
            </a>
        </div>
    </form>

</x-guest-layout>