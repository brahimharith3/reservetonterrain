<x-layouts.main>

    <style>
        .page-hero {
            background: rgba(255, 255, 255, 0.15);
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

        .form-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.12);
            background: white;
        }

        .btn-admin {
            border-radius: 12px;
            font-weight: 700;
            padding: 10px 16px;
        }

        .preview-img {
            width: 100%;
            max-width: 280px;
            height: 180px;
            object-fit: cover;
            border-radius: 14px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
        }
    </style>

    <div class="page-hero">
        <h1 class="page-title">{{ __('messages.ajouter_terrain') }}</h1>
        <p class="page-subtitle">{{ __('messages.ajoutez_nouveau_terrain') }}</p>
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

    <div class="card form-card">
        <div class="card-body p-4">

            <form action="{{ route('terrain.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row g-4">

                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.nom_du_terrain') }}</label>
                        <input
                            type="text"
                            name="nom_terrain"
                            value="{{ old('nom_terrain') }}"
                            class="form-control"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.type_du_terrain') }}</label>
                        <input
                            type="text"
                            name="type_terrain"
                            value="{{ old('type_terrain') }}"
                            class="form-control"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.localisation') }}</label>
                        <input
                            type="text"
                            name="localisation"
                            value="{{ old('localisation') }}"
                            class="form-control"
                        >
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.prix_par_heure') }}</label>
                        <input
                            type="number"
                            name="prix_heure"
                            value="{{ old('prix_heure') }}"
                            class="form-control"
                        >
                    </div>

                    <div class="col-12">
                        <label class="form-label">{{ __('messages.description') }}</label>
                        <textarea
                            name="description"
                            rows="4"
                            class="form-control"
                            placeholder="{{ __('messages.description_placeholder') }}"
                        >{{ old('description') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">{{ __('messages.photo_du_terrain') }}</label>
                        <input
                            type="file"
                            name="image"
                            class="form-control"
                            onchange="previewCreateImage(event)"
                        >
                    </div>

                    
                    
                    <div class="col-md-6">
                        <label class="form-label">Google Maps URL</label>
                        
                        <input
                        type="text"
                        name="google_maps_link"
                        class="form-control"
                        placeholder="Lien normal Google Maps">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Google Maps Embed</label>

                        <input
                            type="text"
                            name="google_maps_embed"
                            class="form-control"
                            placeholder="Lien embed Google Maps">
                    </div>
                    
                    <div class="col-12">
                        <img id="createPreview" class="preview-img d-none" alt="preview image">
                    </div>

                    <div class="col-12 d-flex gap-2 flex-wrap">
                        <a href="{{ route('terrains.index') }}" class="btn btn-secondary btn-admin">
                            {{ __('messages.retour') }}
                        </a>

                        <button type="submit" class="btn btn-primary btn-admin">
                            {{ __('messages.ajouter_le_terrain') }}
                        </button>
                    </div>

                </div>
            </form>

        </div>
    </div>

    <script>
        function previewCreateImage(event) {
            const input = event.target;
            const preview = document.getElementById('createPreview');

            if (input.files && input.files[0]) {
                preview.src = URL.createObjectURL(input.files[0]);
                preview.classList.remove('d-none');
            }
        }
    </script>

</x-layouts.main>