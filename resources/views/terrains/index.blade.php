<x-layouts.main>

<style>
    .page-title{font-weight:800;color:white;font-size:42px;}
    .page-subtitle{color:#e2e8f0;}

    .hero-box{
        background:rgba(255,255,255,0.15);
        backdrop-filter:blur(12px);
        border-radius:20px;
        padding:30px;
        color:white;
        margin-bottom:35px;
    }

    .search-box{
        background:white;
        border-radius:18px;
        padding:18px;
        margin-bottom:30px;
        box-shadow:0 10px 25px rgba(0,0,0,0.12);
    }

    .search-input{
        height:54px;
        border-radius:14px;
        font-weight:700;
    }

    .terrain-card{
        border:none;
        border-radius:18px;
        box-shadow:0 8px 20px rgba(0,0,0,0.08);
        transition:0.3s;
        min-height:560px;
    }

    .terrain-card .card-body{
        display:flex;
        flex-direction:column;
    }

    .terrain-actions{margin-top:auto;}

    .terrain-card:hover{transform:translateY(-4px);}

    .type-section{margin-bottom:40px;}

    .type-header{
        background:rgba(255,255,255,0.18);
        backdrop-filter:blur(12px);
        border-radius:18px;
        padding:18px 24px;
        color:white;
        margin-bottom:20px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        flex-wrap:wrap;
        gap:12px;
    }

    .type-title{
        font-size:28px;
        font-weight:900;
        margin:0;
    }

    .type-count{
        background:white;
        color:#1e293b;
        padding:8px 14px;
        border-radius:999px;
        font-weight:800;
        font-size:14px;
    }

    .terrain-img{
        height:200px;
        width:100%;
        object-fit:cover;
        border-radius:14px;
        margin-bottom:15px;
    }

    .no-image-box{
        height:200px;
        width:100%;
        border-radius:14px;
        margin-bottom:15px;
        background:linear-gradient(135deg,#e2e8f0,#f8fafc);
        display:flex;
        align-items:center;
        justify-content:center;
        flex-direction:column;
        color:#64748b;
        font-weight:800;
        border:2px dashed #cbd5e1;
    }

    .btn-admin{
        border-radius:12px;
        font-weight:700;
    }
</style>

<div class="hero-box">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h1 class="page-title mb-1">
                {{ __('messages.gestion_terrains') }}
            </h1>

            <p class="page-subtitle mb-0">
                {{ __('messages.liste_complete_terrains') }}
            </p>
        </div>

        <a href="{{ route('terrain.create') }}" class="btn btn-primary btn-admin">
            <i class="bi bi-plus-square-fill"></i>
            {{ __('messages.ajouter_terrain') }}
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
    <label class="form-label fw-bold">
        {{ __('messages.Rechercher_terrain') }}
    </label>

    <input
        type="text"
        id="searchTerrain"
        class="form-control search-input"
        placeholder="{{ __('messages.Tapez') }}"
    >
</div>

@php
    $terrainsParType = $terrains->groupBy('type_terrain');
@endphp

<div id="terrainsContainer">

@forelse($terrainsParType as $typeTerrain => $listeTerrains)

    <div class="type-section">

        <div class="type-header">
            <h2 class="type-title">
                🏟️ {{ $typeTerrain ?: 'Type non défini' }}
            </h2>

            <span class="type-count">
                {{ $listeTerrains->count() }} {{ __('messages.terrains') }}
            </span>
        </div>

        <div class="row g-4">

            @foreach($listeTerrains as $terrain)

                <div class="col-md-6 col-lg-4 terrain-item"
                     data-name="{{ strtolower($terrain->nom_terrain) }}">

                    <div class="card terrain-card h-100">
                        <div class="card-body">

                            <p class="text-muted mb-2">
                                {{ __('messages.id') }} : {{ $terrain->id_terrain }}
                            </p>

                            <h4 class="fw-bold mb-3">
                                {{ $terrain->nom_terrain }}
                            </h4>

                            @if($terrain->image)
                                <img
                                    src="{{ asset('terrain_images/' . $terrain->image) }}"
                                    class="terrain-img"
                                    alt="{{ $terrain->nom_terrain }}"
                                >
                            @else
                                <div class="no-image-box">
                                    <div style="font-size:42px;">🏟️</div>
                                    <div>Aucune image</div>
                                </div>
                            @endif

                            <p>
                                <strong>{{ __('messages.type') }} :</strong>
                                {{ $terrain->type_terrain }}
                            </p>

                            <p>
                                <strong>{{ __('messages.localisation') }} :</strong>
                                {{ $terrain->localisation }}
                            </p>

                            <p>
                                <strong>{{ __('messages.prix') }} :</strong>
                                {{ $terrain->prix_heure }} DH
                            </p>

                            @if($terrain->google_maps_link)
                                <p>
                                    <a
                                        href="{{ $terrain->google_maps_link }}"
                                        target="_blank"
                                        class="btn btn-sm btn-outline-primary btn-admin">
                                        <i class="bi bi-geo-alt-fill"></i>
                                        {{ __('messages.voir_google_maps') }}
                                    </a>
                                </p>
                            @endif

                            <div class="d-flex gap-2 flex-wrap terrain-actions">
                                <a
                                    href="{{ route('terrain.edit', $terrain->id_terrain) }}"
                                    class="btn btn-warning btn-sm btn-admin"
                                >
                                    {{ __('messages.modifier') }}
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <a
                                    href="{{ route('terrain.delete', $terrain->id_terrain) }}"
                                    class="btn btn-danger btn-sm btn-admin"
                                    onclick="return confirm('{{ __('messages.confirmer_suppression_terrain') }}')"
                                >

                                    {{ __('messages.supprimer') }}
                                    <i class="bi bi-trash-fill"></i>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

            @endforeach

        </div>
    </div>

@empty
    <div class="alert alert-light">
        Aucun terrain trouvé.
    </div>
@endforelse

</div>

<div id="noResult" class="alert alert-warning d-none">
    Aucun terrain trouvé.
</div>

<script>
    const searchInput = document.getElementById('searchTerrain');
    const terrainItems = document.querySelectorAll('.terrain-item');
    const typeSections = document.querySelectorAll('.type-section');
    const noResult = document.getElementById('noResult');

    searchInput.addEventListener('input', function () {
        const value = this.value.toLowerCase().trim();
        let visibleCount = 0;

        terrainItems.forEach(item => {
            const name = item.dataset.name;

            if (name.includes(value)) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        typeSections.forEach(section => {
            const visibleItems = section.querySelectorAll('.terrain-item[style="display: block;"], .terrain-item:not([style])');

            let hasVisible = false;

            section.querySelectorAll('.terrain-item').forEach(item => {
                if (item.style.display !== 'none') {
                    hasVisible = true;
                }
            });

            section.style.display = hasVisible ? 'block' : 'none';
        });

        noResult.classList.toggle('d-none', visibleCount > 0);
    });
</script>

</x-layouts.main>