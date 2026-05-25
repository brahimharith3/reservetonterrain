<x-layouts.main>

<style>
    .reservation-hero{
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(12px);
        border-radius: 24px;
        padding: 32px;
        color: white;
        margin-bottom: 32px;
    }

    .reservation-hero h1{
        font-size: 42px;
        font-weight: 900;
        margin-bottom: 8px;
    }

    .reservation-hero p{
        color: #e2e8f0;
        margin: 0;
    }

    .reservation-layout{
        display:grid;
        grid-template-columns: 1fr 1fr;
        gap:28px;
        align-items:stretch;
    }

    .terrain-preview,
    .booking-box{
        background: rgba(255,255,255,0.96);
        border-radius: 28px;
        box-shadow: 0 18px 45px rgba(0,0,0,0.18);
        overflow: hidden;
        height: 100%;
    }

    .terrain-preview{
        display:flex;
        flex-direction:column;
    }

    .booking-box{
        padding:34px;
        display:flex;
        flex-direction:column;
        justify-content:center;
    }

    .terrain-preview-img{
        width:100%;
        height:280px;
        object-fit:cover;
        display:block;
    }

    .terrain-preview-placeholder{
        width:100%;
        height:280px;
        display:none;
        align-items:center;
        justify-content:center;
        flex-direction:column;
        background:linear-gradient(135deg,#e2e8f0,#f8fafc);
        color:#64748b;
        font-weight:900;
    }

    .terrain-preview-body{
        padding:28px;
        flex:1;
        display:flex;
        flex-direction:column;
    }

    .terrain-name{
        font-size:38px;
        font-weight:900;
        color:#0f172a;
        margin-bottom:18px;
    }

    .info-line{
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:18px;
        border-bottom:1px solid #e5e7eb;
        padding:14px 0;
        font-size:17px;
    }

    .info-line strong{
        color:#0f172a;
    }

    .info-line span{
        color:#334155;
        font-weight:700;
        text-align:right;
    }

    .maps-btn{
        margin-top:auto;
        width:max-content;
        border-radius:14px;
        font-weight:800;
        padding:10px 18px;
    }

    .booking-title{
        font-size:30px;
        font-weight:900;
        color:#0f172a;
        margin-bottom:8px;
    }

    .booking-subtitle{
        color:#64748b;
        margin-bottom:28px;
        font-weight:600;
    }

    .form-label{
        font-weight:800;
        color:#0f172a;
        margin-bottom:8px;
    }

    .form-select,
    .form-control{
        height:56px;
        border-radius:16px;
        border:1px solid #dbe2ea;
        font-size:16px;
        font-weight:600;
    }

    .form-select:focus,
    .form-control:focus{
        box-shadow:0 0 0 4px rgba(37,99,235,0.15);
        border-color:#2563eb;
    }

    .price-box{
        background:#ecfdf5;
        border:1px solid #bbf7d0;
        border-radius:22px;
        padding:20px;
        margin-top:10px;
        margin-bottom:24px;
    }

    .price-label{
        color:#166534;
        font-weight:800;
        font-size:15px;
        margin-bottom:6px;
    }

    .price-value{
        font-size:40px;
        font-weight:900;
        color:#15803d;
        line-height:1;
    }

    .action-row{
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:16px;
        flex-wrap:wrap;
    }

    .btn-modern{
        height:56px;
        border-radius:18px;
        font-weight:900;
        padding:0 30px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
    }

    .alert{
        border-radius:16px;
    }

    @media(max-width:992px){

        .reservation-layout{
            grid-template-columns:1fr;
        }

        .terrain-preview-img,
        .terrain-preview-placeholder{
            height:240px;
        }

        .terrain-name{
            font-size:30px;
        }
    }
</style>

<div class="reservation-hero">
    <h1>{{ __('messages.nouvelle_reservation') }}</h1>
    <p>{{ __('messages.choisissez_terrain_horaire') }}</p>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <i class="bi bi-info-circle"></i>
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<div class="reservation-layout">

    {{-- Terrain preview --}}
    <div class="terrain-preview">

        <img
            id="terrainImage"
            src=""
            alt="{{ __('messages.photo_terrain') }}"
            class="terrain-preview-img"
        >

        <div id="terrainPlaceholder" class="terrain-preview-placeholder">
            <div style="font-size:48px;">🏟️</div>
            <div>{{ __('messages.photo_terrain') }}</div>
        </div>

        <div class="terrain-preview-body">

            <h2 id="terrainNom" class="terrain-name"></h2>

            <div class="info-line">
                <strong>{{ __('messages.type') }}</strong>
                <span id="terrainType"></span>
            </div>

            <div class="info-line">
                <strong>{{ __('messages.localisation') }}</strong>
                <span id="terrainLocalisation"></span>
            </div>

            <div class="info-line">
                <strong>{{ __('messages.prix_par_heure') }}</strong>
                <span><span id="terrainPrix"></span> DH</span>
            </div>

            <a id="terrainMaps" href="#" target="_blank" class="btn btn-outline-primary maps-btn">
                {{ __('messages.voir_sur_google_maps') }}
            </a>

        </div>
    </div>

    {{-- Reservation form --}}
    <div class="booking-box">

        <h2 class="booking-title">{{ __('messages.reserver') }}</h2>
        <p class="booking-subtitle">{{ __('messages.choisissez_terrain_horaire') }}</p>

        <form action="{{ route('reservation.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">{{ __('messages.terrain') }}</label>

                

                <select name="id_terrain" id="terrainSelect" class="form-select">
                    <option value="">{{ __('messages.choisir_terrain') }}</option>

                    @foreach($terrains as $terrain)
                        <option
                            value="{{ $terrain->id_terrain }}"
                            data-nom="{{ $terrain->nom_terrain }}"
                            data-type="{{ $terrain->type_terrain }}"
                            data-localisation="{{ $terrain->localisation }}"
                            data-prix="{{ $terrain->prix_heure }}"
                            data-image="{{ $terrain->image ? asset('terrain_images/' . $terrain->image) : '' }}"
                            data-maps="{{ $terrain->google_maps_link }}"
                            {{ isset($selectedTerrain) && $selectedTerrain == $terrain->id_terrain ? 'selected' : '' }}
                        >
                            {{ $terrain->nom_terrain }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">{{ __('messages.horaire') }}</label>

                <select name="id_horaire" class="form-select">
                    @forelse($horaires->groupBy('date_horaire') as $date => $listeHoraires)
                        <optgroup label="{{ $date }}">
                            @foreach($listeHoraires as $horaire)
                                <option
                                    value="{{ $horaire->id_horaire }}"
                                    {{ isset($selectedHoraire) && $selectedHoraire == $horaire->id_horaire ? 'selected' : '' }}
                                >
                                    {{ $horaire->heure_debut }} → {{ $horaire->heure_fin }}
                                </option>
                            @endforeach
                        </optgroup>
                    @empty
                        <option value="">{{ __('messages.aucun_horaire_disponible') }}</option>
                    @endforelse
                </select>
            </div>

            <input type="hidden" id="prixInput" name="montant_total">

            <div class="price-box">
                <div class="price-label">{{ __('messages.montant_total') }}</div>
                <div class="price-value">
                    <span id="prixDisplay">0</span> DH
                </div>
            </div>

            <div class="action-row">
                <a href="{{ route('home') }}" class="btn btn-secondary btn-modern">
                    {{ __('messages.retour') }}
                </a>

                <button type="submit" class="btn btn-primary btn-modern">
                    {{ __('messages.reserver') }}
                </button>
            </div>

        </form>

    </div>

</div>

<script>
    const terrainSelect = document.getElementById('terrainSelect');
    const terrainNom = document.getElementById('terrainNom');
    const terrainType = document.getElementById('terrainType');
    const terrainLocalisation = document.getElementById('terrainLocalisation');
    const terrainPrix = document.getElementById('terrainPrix');
    const terrainImage = document.getElementById('terrainImage');
    const terrainPlaceholder = document.getElementById('terrainPlaceholder');
    const terrainMaps = document.getElementById('terrainMaps');
    const prixInput = document.getElementById('prixInput');
    const prixDisplay = document.getElementById('prixDisplay');

    function updateTerrainInfo() {
        const selected = terrainSelect.options[terrainSelect.selectedIndex];

        if (!selected || !selected.value) {
            terrainNom.textContent = '';
            terrainType.textContent = '';
            terrainLocalisation.textContent = '';
            terrainPrix.textContent = '';
            prixInput.value = '';
            prixDisplay.textContent = '0';
            terrainImage.style.display = 'none';
            terrainPlaceholder.style.display = 'flex';
            terrainMaps.style.display = 'none';
            return;
        }

        const nom = selected.getAttribute('data-nom');
        const type = selected.getAttribute('data-type');
        const localisation = selected.getAttribute('data-localisation');
        const prix = selected.getAttribute('data-prix');
        const image = selected.getAttribute('data-image');
        const maps = selected.getAttribute('data-maps');

        terrainNom.textContent = nom || '';
        terrainType.textContent = type || '';
        terrainLocalisation.textContent = localisation || '';
        terrainPrix.textContent = prix || '';
        prixInput.value = prix || '';
        prixDisplay.textContent = prix || '0';

        if (image) {
            terrainImage.src = image;
            terrainImage.style.display = 'block';
            terrainPlaceholder.style.display = 'none';
        } else {
            terrainImage.style.display = 'none';
            terrainPlaceholder.style.display = 'flex';
        }

        if (maps) {
            terrainMaps.href = maps;
            terrainMaps.style.display = 'inline-block';
        } else {
            terrainMaps.style.display = 'none';
        }
    }

    terrainSelect.addEventListener('change', function () {
        updateTerrainInfo();

        const terrainId = this.value;

        if (terrainId) {
            window.location.href = "{{ route('reservation.create') }}?terrain=" + terrainId;
        }
    });

    updateTerrainInfo();
</script>

</x-layouts.main>