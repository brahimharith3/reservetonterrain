<x-layouts.main>

<style>
    .page-hero {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 30px;
        color: white;
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 42px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .page-subtitle {
        color: #e2e8f0;
        margin-bottom: 0;
    }

    .search-box {
        background: white;
        border-radius: 18px;
        padding: 18px;
        margin-bottom: 30px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
    }

    .search-input {
        height: 54px;
        border-radius: 14px;
        font-weight: 700;
        font-size: 16px;
    }

    .terrain-section {
        margin-bottom: 38px;
    }

    .terrain-header {
        background: rgba(255,255,255,0.18);
        backdrop-filter: blur(12px);
        border-radius: 18px;
        padding: 18px 24px;
        color: white;
        margin-bottom: 18px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }

    .terrain-title {
        font-size: 26px;
        font-weight: 900;
        margin: 0;
    }

    .terrain-count {
        background: white;
        color: #1e293b;
        padding: 8px 14px;
        border-radius: 999px;
        font-weight: 800;
        font-size: 14px;
    }

    .horaire-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        background: white;
        height: 100%;
        transition: 0.3s;
    }

    .horaire-card:hover {
        transform: translateY(-4px);
    }

    .horaire-time {
        font-size: 22px;
        font-weight: 900;
        color: #0f172a;
        margin-bottom: 14px;
    }

    .horaire-date {
        color: #64748b;
        font-weight: 700;
        margin-bottom: 12px;
    }

    .date-header{
        background: white;
        color: #1e293b;
        border-radius: 16px;
        padding: 14px 20px;
        font-size: 22px;
        font-weight: 900;
        box-shadow: 0 8px 20px rgba(0,0,0,0.12);
        margin-top: 10px;
    }

    .btn-admin {
        border-radius: 12px;
        font-weight: 700;
        padding: 10px 16px;
    }

    .status-badge {
        padding: 8px 14px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 700;
    }
</style>

<div class="page-hero">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1 class="page-title">{{ __('messages.gestion_horaires') }}</h1>
            <p class="page-subtitle">{{ __('messages.liste_creneaux_horaires') }}</p>
        </div>

        <a href="{{ route('horaire.create') }}" class="btn btn-primary btn-admin">
            <i class="bi bi-plus-square-fill"></i>
            {{ __('messages.ajouter_horaire') }}
        </a>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <i class="bi bi-info-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="search-box">
    <label class="form-label fw-bold"> {{ __('messages.Rechercher_terrain') }} </label>
    <input type="text"id="searchTerrain"class="form-control search-input"placeholder="{{ __('messages.Tapez') }}">
</div>

@php
    $horairesParTerrain = $horaires->groupBy(function ($horaire) {
        return optional($horaire->terrain)->nom_terrain ?? 'Terrain supprimé';
    });
@endphp

<div id="horairesContainer">

        @forelse($horairesParTerrain as $nomTerrain => $listeHoraires)

            <div class="terrain-section" data-terrain="{{ strtolower($nomTerrain) }}">

                <div class="terrain-header">
                    <h2 class="terrain-title">
                        ⚽ {{ $nomTerrain }}
                    </h2>

                    <span class="terrain-count">
                        {{ $listeHoraires->count() }} 
                        <i class="bi bi-clock-fill"></i>
                    </span>
                </div>

                <div class="row g-4">

                @foreach($listeHoraires->sortBy('date_horaire')->groupBy('date_horaire') as $date => $horairesDate)

            <div class="col-12">
                <div class="date-header">
                    <i class="bi bi-calendar3"></i>
                    {{ $date }}
                </div>
            </div>

            @foreach($horairesDate->sortBy('heure_debut') as $horaire)

                @php
                    $estReserve = $horaire->reservations
                        ->whereIn('statut', ['en_attente', 'confirmee'])
                        ->count() > 0;
                @endphp

                <div class="col-md-6 col-lg-4">
                    <div class="card horaire-card">
                        <div class="card-body p-4">

                            <div class="horaire-time">
                                {{ $horaire->heure_debut }} → {{ $horaire->heure_fin }}
                            </div>

                            <p class="mb-3">
                                <strong>{{ __('messages.statut') }} :</strong>

                                @if($estReserve)
                                    <span class="badge bg-danger status-badge">
                                        {{ __('messages.reserve') }}
                                    </span>
                                @else
                                    <span class="badge bg-success status-badge">
                                        {{ __('messages.libre') }}
                                    </span>
                                @endif
                            </p>

                            <form
                                action="{{ route('horaires.destroy', $horaire->id_horaire) }}"
                                method="POST"
                                onsubmit="return confirm('{{ __('messages.confirmer_suppression_horaire') }}')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger btn-sm btn-admin">
                                    {{ __('messages.supprimer') }}
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

            @endforeach

        @endforeach

        </div>

    </div>

@empty

    <div class="alert alert-light">
        {{ __('messages.aucune_horaire_trouvee') }}
    </div>

@endforelse

</div>

<div id="noResult" class="alert alert-warning d-none">
    {{ __('messages.aucune_horaire_trouvee') }}
</div>

<script>
    const searchInput = document.getElementById('searchTerrain');
    const terrainSections = document.querySelectorAll('.terrain-section');
    const noResult = document.getElementById('noResult');

    searchInput.addEventListener('input', function () {
        const value = this.value.toLowerCase().trim();
        let visibleCount = 0;

        terrainSections.forEach(section => {
            const terrainName = section.dataset.terrain;

            if (terrainName.includes(value)) {
                section.style.display = 'block';
                visibleCount++;
            } else {
                section.style.display = 'none';
            }
        });

        if (visibleCount === 0) {
            noResult.classList.remove('d-none');
        } else {
            noResult.classList.add('d-none');
        }
    });
</script>

</x-layouts.main>