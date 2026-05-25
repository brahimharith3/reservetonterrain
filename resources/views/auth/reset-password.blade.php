<x-guest-layout>

    <div class="guest-title">Réinitialiser le mot de passe</div>
    <div class="guest-subtitle">
        Entrez votre nouveau mot de passe
    </div>

    @if($errors->any())
        <div class="alert alert-danger text-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="mb-3">
            <i class="bi bi-envelope-at-fill"></i>
            <label class="form-label">Email</label>
            <input type="email" name="email" value="{{ old('email', $request->email) }}" required class="form-control">
        </div>

        <div class="mb-3">
            <i class="bi bi-eye-slash"></i>
            <label class="form-label">Nouveau mot de passe</label>
            <input type="password" name="password" required class="form-control">
        </div>

        <div class="mb-3">
            <i class="bi bi-check2-circle"></i>
            <label class="form-label">Confirmer le mot de passe</label>
            <input type="password" name="password_confirmation" required class="form-control">
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-main text-white">
                <i class="bi bi-arrow-clockwise"></i>
                Réinitialiser le mot de passe
            </button>
        </div>
    </form>

</x-guest-layout>