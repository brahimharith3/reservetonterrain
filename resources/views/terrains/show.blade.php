<x-layouts.main>

<style>
    .show-hero{
        border-radius:32px;
        padding:34px;
        margin-bottom:34px;
        color:white;
        background:
            linear-gradient(135deg, rgba(15,23,42,.90), rgba(37,99,235,.55)),
            @if($terrain->image)
                url("{{ asset('terrain_images/' . $terrain->image) }}")
            @else
                linear-gradient(135deg,#0f172a,#2563eb)
            @endif;
        background-size:cover;
        background-position:center;
        box-shadow:0 18px 45px rgba(0,0,0,.25);
    }

    .show-hero-content{
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:20px;
        flex-wrap:wrap;
    }

    .show-hero h1{
        font-size:46px;
        font-weight:950;
        margin:0 0 8px;
    }

    .show-hero p{
        color:#dbeafe;
        font-weight:800;
        margin:0;
    }

    .back-btn{
        background:white;
        color:#0f172a;
        padding:13px 20px;
        border-radius:16px;
        font-weight:900;
        text-decoration:none;
        display:inline-flex;
        align-items:center;
        gap:8px;
    }

    .terrain-layout{
        display:grid;
        grid-template-columns:1.15fr .85fr;
        gap:30px;
        align-items:start;
        margin-bottom:34px;
    }

    .media-panel,
    .details-panel{
        background:rgba(255,255,255,.96);
        border-radius:30px;
        overflow:hidden;
        box-shadow:0 18px 45px rgba(0,0,0,.20);
    }

    .terrain-image{
        width:100%;
        height:380px;
        object-fit:cover;
        display:block;
    }

    .map-title{
        background:white;
        padding:16px 22px;
        display:flex;
        justify-content:space-between;
        align-items:center;
        border-top:1px solid #e2e8f0;
    }

    .map-title h5{
        margin:0;
        font-weight:950;
        color:#0f172a;
    }

    .map-title p{
        margin:4px 0 0;
        color:#64748b;
        font-weight:700;
    }

    .map-title a{
        text-decoration:none;
        font-weight:900;
        color:#2563eb;
        white-space:nowrap;
    }

    .map-panel{
        height:300px;
    }

    .map-panel iframe{
        width:100%;
        height:100%;
        border:0;
        display:block;
    }

    .details-panel{
        padding:32px;
    }

    .terrain-title{
        font-size:36px;
        font-weight:950;
        color:#0f172a;
        margin-bottom:20px;
    }

    .info-row{
        display:flex;
        justify-content:space-between;
        gap:15px;
        padding:15px 0;
        border-bottom:1px solid #e2e8f0;
        font-weight:850;
    }

    .info-row span:first-child{
        color:#0f172a;
        display:flex;
        gap:10px;
        align-items:center;
    }

    .info-row i{
        color:#2563eb;
    }

    .info-value{
        color:#475569;
        text-align:end;
    }

    .weather-card{
        margin-top:22px;
        border-radius:24px;
        padding:18px;
        background:linear-gradient(135deg,#eff6ff,#ecfeff);
        border:1px solid #bfdbfe;
        display:flex;
        align-items:center;
        gap:14px;
    }

    .weather-card img{
        width:70px;
    }

    .weather-temp{
        font-size:32px;
        font-weight:950;
        color:#0369a1;
    }

    .available-badge{
        margin-top:20px;
        border-radius:999px;
        padding:12px 18px;
        font-weight:900;
    }

    .description-card{
        margin-top:22px;
        padding:22px;
        border-radius:24px;
        background:#f8fafc;
        border:1px solid #e2e8f0;
    }

    .description-card h5{
        font-weight:950;
        color:#0f172a;
    }

    .description-card p{
        color:#475569;
        line-height:1.8;
        margin:0;
    }

    .maps-btn{
        margin-top:20px;
        border-radius:16px;
        padding:13px 18px;
        font-weight:900;
    }

    .quick-section{
        margin:45px 0;
        display:grid;
        grid-template-columns:repeat(4,1fr);
        gap:18px;
    }

    .quick-card{
        background:rgba(255,255,255,.14);
        backdrop-filter:blur(14px);
        border:1px solid rgba(255,255,255,.18);
        border-radius:26px;
        padding:24px;
        color:white;
        box-shadow:0 14px 35px rgba(0,0,0,.18);
    }

    .quick-card i{
        width:46px;
        height:46px;
        border-radius:15px;
        background:rgba(255,255,255,.18);
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:22px;
        margin-bottom:14px;
    }

    .quick-card small{
        color:#dbeafe;
        font-weight:800;
    }

    .quick-card h4{
        margin:6px 0 0;
        font-weight:950;
    }

    .section-title{
        color:white;
        font-size:42px;
        font-weight:950;
        margin-bottom:28px;
    }

    .date-header{
        background:rgba(15,23,42,.72);
        backdrop-filter:blur(15px);
        color:white;
        font-size:26px;
        font-weight:950;
        border-radius:22px;
        padding:18px 24px;
        margin-bottom:24px;
        display:flex;
        gap:12px;
        align-items:center;
    }

    .slot-card{
        background:white;
        border-radius:24px;
        box-shadow:0 14px 34px rgba(0,0,0,.14);
        height:100%;
        transition:.25s;
    }

    .slot-card:hover{
        transform:translateY(-6px);
    }

    .slot-card-body{
        padding:24px;
    }

    .slot-top{
        display:flex;
        justify-content:space-between;
        margin-bottom:18px;
        font-weight:950;
        color:#0f172a;
    }

    .slot-time{
        background:#eff6ff;
        color:#1d4ed8;
        border-radius:18px;
        padding:15px;
        font-size:20px;
        font-weight:950;
        text-align:center;
        margin-bottom:18px;
    }

    .reserve-btn{
        border-radius:16px;
        padding:13px;
        font-weight:950;
    }

    @media(max-width:992px){
        .terrain-layout,
        .quick-section{
            grid-template-columns:1fr;
        }

        .show-hero h1{
            font-size:34px;
        }

        .terrain-image{
            height:290px;
        }
    }
</style>

<div class="show-hero">
    <div class="show-hero-content">
        <div>
            <h1>{{ $terrain->nom_terrain }}</h1>
            <p>{{ __('messages.consultez_details') }}</p>
        </div>

        <a href="{{ route('home') }}" class="back-btn">
            <i class="bi bi-arrow-left-circle-fill"></i>
            {{ __('messages.retour') }}
        </a>
    </div>
</div>

<div class="terrain-layout">

    <div class="media-panel">
        @if($terrain->image)
            <img src="{{ asset('terrain_images/' . $terrain->image) }}" class="terrain-image" alt="{{ $terrain->nom_terrain }}">
        @endif

        @if(!empty($terrain->google_maps_embed) && str_contains($terrain->google_maps_embed, '/maps/embed'))
            <div class="map-title">
                <div>
                    <h5><i class="bi bi-geo-alt-fill"></i> Localisation du terrain</h5>
                    <p>{{ $terrain->localisation }}</p>
                </div>

                @if($terrain->google_maps_link)
                    <a href="{{ $terrain->google_maps_link }}" target="_blank">
                        Ouvrir Maps <i class="bi bi-box-arrow-up-right"></i>
                    </a>
                @endif
            </div>

            <div class="map-panel">
                <iframe src="{{ $terrain->google_maps_embed }}" allowfullscreen loading="lazy"></iframe>
            </div>
        @endif
    </div>

    <div class="details-panel">
        <h2 class="terrain-title">{{ $terrain->nom_terrain }}</h2>

        <div class="info-row">
            <span><i class="bi bi-dribbble"></i>{{ __('messages.type') }}</span>
            <div class="info-value">{{ $terrain->type_terrain }}</div>
        </div>

        <div class="info-row">
            <span><i class="bi bi-geo-alt-fill"></i>{{ __('messages.localisation') }}</span>
            <div class="info-value">{{ $terrain->localisation }}</div>
        </div>

        <div class="info-row">
            <span><i class="bi bi-cash-stack"></i>{{ __('messages.prix_par_heure') }}</span>
            <div class="info-value">{{ $terrain->prix_heure }} DH / {{ __('messages.par_heure') }}</div>
        </div>

        @if($meteo)
            <div class="weather-card">
                <img src="https://openweathermap.org/img/wn/{{ $meteo['icon'] }}@2x.png" alt="Météo">
                <div>
                    <strong><i class="bi bi-cloud-sun-fill"></i> {{ __('messages.Météo-actuelle') }}</strong>
                    <div class="weather-temp">{{ $meteo['temperature'] }}°C</div>
                    <div class="text-muted text-capitalize fw-bold">{{ $meteo['description'] }}</div>
                </div>
            </div>
        @endif

        <span class="badge {{ $horaires->count() > 0 ? 'bg-success' : 'bg-danger' }} available-badge">
            <i class="bi {{ $horaires->count() > 0 ? 'bi-check-circle-fill' : 'bi-x-circle-fill' }}"></i>
            {{ $horaires->count() > 0 ? $horaires->count().' '.__('messages.horaires_disponibles') : __('messages.tout_reserve') }}
        </span>

        @if($terrain->description)
            <div class="description-card">
                <h5><i class="bi bi-card-text me-2"></i>{{ __('messages.description') }}</h5>
                <p>{{ $terrain->description }}</p>
            </div>
        @endif

        @if($terrain->google_maps_link)
            <a href="{{ $terrain->google_maps_link }}" target="_blank" class="btn btn-outline-primary maps-btn">
                <i class="bi bi-geo-alt-fill"></i>
                {{ __('messages.voir_sur_google_maps') }}
            </a>
        @endif
    </div>
</div>

<div class="quick-section">
    <div class="quick-card">
        <i class="bi bi-dribbble"></i>
        <small>Type terrain</small>
        <h4>{{ $terrain->type_terrain }}</h4>
    </div>

    <div class="quick-card">
        <i class="bi bi-cash-stack"></i>
        <small>Prix par heure</small>
        <h4>{{ $terrain->prix_heure }} DH</h4>
    </div>

    <div class="quick-card">
        <i class="bi bi-calendar-check-fill"></i>
        <small>Créneaux</small>
        <h4>{{ $horaires->count() }} disponibles</h4>
    </div>

    <div class="quick-card">
        <i class="bi bi-geo-alt-fill"></i>
        <small>Ville</small>
        <h4>{{ $terrain->localisation }}</h4>
    </div>
</div>

<h2 class="section-title">{{ __('messages.creneaux_disponibles') }}</h2>

@php
    $horairesParDate = $horaires->groupBy('date_horaire');
@endphp

@forelse($horairesParDate as $date => $listeHoraires)
    <div class="date-block mb-5">
        <div class="date-header">
            <i class="bi bi-calendar3"></i>
            {{ $date }}
        </div>

        <div class="row g-4">
            @foreach($listeHoraires as $horaire)
                <div class="col-md-6 col-lg-4">
                    <div class="slot-card">
                        <div class="slot-card-body">
                            <div class="slot-top">
                                <span><i class="bi bi-dribbble"></i> {{ $terrain->nom_terrain }}</span>
                                <span class="badge bg-success">{{ __('messages.libre') }}</span>
                            </div>

                            <div class="slot-time">
                                <i class="bi bi-clock-fill"></i>
                                {{ $horaire->heure_debut }} → {{ $horaire->heure_fin }}
                            </div>

                            <a href="{{ route('reservation.create', [
                                'terrain' => $terrain->id_terrain,
                                'horaire' => $horaire->id_horaire
                            ]) }}" class="btn btn-success reserve-btn w-100">
                                <i class="bi bi-calendar-check-fill"></i>
                                {{ __('messages.reserver_ce_creneau') }}
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@empty
    <div class="alert alert-warning">
        <i class="bi bi-info-circle"></i>
        {{ __('messages.aucun_horaire_disponible') }}
    </div>
@endforelse

</x-layouts.main>