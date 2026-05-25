<x-layouts.main>

    <style>
        .type-section {
            margin-top: 45px;
        }

        .type-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .type-title {
            color: white;
            font-size: 32px;
            font-weight: 900;
            margin: 0;
            padding: 14px 22px;
            border-radius: 18px;
            background: rgba(255, 255, 255, 0.18);
            backdrop-filter: blur(10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .filter-panel{
            background:rgba(255,255,255,0.96);
            border-radius:28px;
            padding:28px;
            margin:40px auto;
            box-shadow:0 18px 45px rgba(0,0,0,0.18);
        }

        .filter-header h3{
            font-size:28px;
            font-weight:900;
            color:#0f172a;
            margin-bottom:4px;
        }

        .filter-header p{
            color:#64748b;
            font-weight:600;
            margin-bottom:22px;
        }

        .filter-grid{
            display:grid;
            grid-template-columns:1.4fr 1fr 1fr 0.8fr auto;
            gap:18px;
            align-items:end;
        }

        .filter-field label{
            font-weight:800;
            color:#0f172a;
            margin-bottom:8px;
            display:block;
        }

        .field-control{
            position:relative;
        }

        .field-control i{
            position:absolute;
            top:50%;
            left:18px;
            transform:translateY(-50%);
            color:#2563eb;
            font-size:18px;
        }

        .field-control input{
            width:100%;
            height:58px;
            border:1px solid #dbe2ea;
            border-radius:18px;
            padding:0 18px 0 50px;
            font-size:16px;
            font-weight:700;
            outline:none;
            background:#f8fafc;
        }

        .field-control input:focus{
            border-color:#2563eb;
            box-shadow:0 0 0 4px rgba(37,99,235,0.12);
            background:white;
        }

        .filter-actions{
            display:flex;
            gap:10px;
        }

        .btn-filter-pro,
        .btn-reset-pro{
            height:58px;
            border-radius:18px;
            padding:0 24px;
            font-weight:900;
            text-decoration:none;
            display:inline-flex;
            align-items:center;
            justify-content:center;
            white-space:nowrap;
        }

        .btn-filter-pro{
            border:none;
            background:#0f172a;
            color:white;
        }

        .btn-reset-pro{
            border:1px solid #dbe2ea;
            background:white;
            color:#0f172a;
        }

        @media(max-width:1200px){
            .filter-grid{
                grid-template-columns:1fr 1fr;
            }
        }

        @media(max-width:768px){
            .filter-grid{
                grid-template-columns:1fr;
            }

            .filter-actions{
                flex-direction:column;
            }
        }

        #username {
            text-transform: uppercase;
            color: red;
        }
    </style>

    <div class="hero-box text-center">
        <h1 class="page-title">{{ __('messages.bonjour') }} <strong id="username">{{auth()->user()->name}}</strong></h1>
        <h1 class="page-title">{{ __('messages.trouver_terrain') }}</h1>
        <p class="page-subtitle">{{ __('messages.reservez_facilement') }}</p>
    </div>

    <div class="filter-panel">
        <div class="filter-header">
            <div>
                <h3>{{ __('messages.Rechercher_terrain') }} </h3>
                <p>{{ __('messages.filtrer_terrain') }} </p>
            </div>
        </div>

        <form action="{{ route('home') }}" method="GET" class="filter-grid">

            <div class="filter-field wide">
                <label> {{ __('messages.terrain') }} </label>
                <div class="field-control">
                    <i class="bi bi-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ __('messages.exemple_terrain') }}">
                </div>
            </div>

            <div class="filter-field">
                <label> {{ __('messages.type_du_terrain') }} </label>
                <div class="field-control">
                    <i class="bi bi-grid-fill"></i>
                    <input type="text" name="type" value="{{ request('type') }}" placeholder="{{ __('messages.exemple_type') }}">
                </div>
            </div>

            <div class="filter-field">
                <label> {{ __('messages.localisation') }} </label>
                <div class="field-control">
                    <i class="bi bi-geo-alt-fill"></i>
                    <input type="text" name="localisation" value="{{ request('localisation') }}" placeholder="{{ __('messages.exemple_localisation') }}">
                </div>
            </div>

            <div class="filter-field">
                <label> {{ __('messages.prix_max') }} </label>
                <div class="field-control">
                    <i class="bi bi-cash-stack"></i>
                    <input type="number" name="prix_max" value="{{ request('prix_max') }}" placeholder="300">
                </div>
            </div>

            <div class="filter-actions">
                <button type="submit" class="btn-filter-pro">
                    <i class="bi bi-funnel-fill me-2"></i>
                    {{ __('messages.filtrer') }}
                </button>

                <a href="{{ route('home') }}" class="btn-reset-pro">
                    <i class="bi bi-arrow-clockwise me-2"></i>
                    {{ __('messages.reset') }}
                </a>
            </div>

        </form>
    </div>
    <div class="row g-4">
        @foreach($terrains as $type => $terrainsParType)

            <div class="type-section mb-5">

                <div class="type-header mb-4">
                    <h2 class="type-title">
                        {{ ucfirst($type) }}
                    </h2>
                </div>

                <div class="row g-4">
                    @foreach($terrainsParType as $terrain)

                        <div class="col-md-6 col-lg-4">
                            <div class="card custom-card h-100">

                                @if($terrain->image)
                                    <img src="{{ asset('terrain_images/'.$terrain->image) }}" class="terrain-photo">
                                @endif

                                <div class="card-body">
                                    <h4 class="fw-bold">{{ $terrain->nom_terrain }}</h4>

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
                                        {{ $terrain->prix_heure }} DH / {{ __('messages.par_heure') }}
                                    </p>

                                    @if($terrain->horaires_libres_count > 0)
                                        <p class="text-success fw-bold">
                                            {{ $terrain->horaires_libres_count }} {{ __('messages.horaires_disponibles') }}
                                        </p>
                                    @else
                                        <p class="text-danger fw-bold">
                                            {{ __('messages.tout_reserve') }}
                                        </p>
                                    @endif

                                    <div class="d-flex gap-2 flex-wrap mt-3">
                                        @if($terrain->horaires_libres_count > 0)
                                            <a href="{{ route('terrain.show',$terrain->id_terrain) }}" class="btn btn-primary btn-sm">
                                                <i class="bi bi-eye-fill"></i>
                                                {{ __('messages.voir_details') }}
                                            </a>

                                            <!-- <a href="{{ route('reservation.create') }}?terrain={{ $terrain->id_terrain }}" class="btn btn-success btn-sm">
                                                {{ __('messages.reserver') }}
                                            </a> -->
                                        @endif

                                        @if($terrain->google_maps_link)
                                            <a href="{{ $terrain->google_maps_link }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                                <i class="bi bi-geo-alt-fill"></i>
                                                {{ __('messages.google_maps') }}
                                            </a>
                                        @endif
                                    </div>

                                </div>

                            </div>
                        </div>

                    @endforeach
                </div>

            </div>

        @endforeach
    </div>

</x-layouts.main>