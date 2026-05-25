<x-guest-layout>

    <div class="guest-title">Vérification de l'email</div>
    <p class="guest-subtitle">
    Merci de vérifier votre adresse email</p>
    <div class="alert alert-danger fw-bold text-center">
        {{ auth()->user()->email }}
    </div>
    <p class="guest-subtitle">
        <i class="bi bi-hand-index-fill"></i>
        Cliquez sur le lien que nous venons de vous envoyer.
        Si vous n'avez pas reçu l'email, vous pouvez demander un nouveau lien.
    </p>
    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success">
            Un nouveau lien de vérification a été envoyé à votre adresse email.
        </div>
    @endif

    <div class="d-grid gap-3">

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-main text-white w-100">
                Renvoyer l'email de vérification
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger w-100" style="border-radius:12px; min-height:46px; font-weight:700;">
                <i class="bi bi-box-arrow-left"></i>
                Déconnexion
            </button>
        </form>

    </div>

</x-guest-layout>