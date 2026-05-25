<x-layouts.main>

<style>
    .page-hero{
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 30px;
        color: white;
        margin-bottom: 30px;
    }

    .page-title{
        font-size: 42px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .page-subtitle{
        color: #e2e8f0;
        margin-bottom: 0;
    }

    .form-card{
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        background: white;
    }

    .btn-admin{
        border-radius: 12px;
        font-weight: 700;
        padding: 10px 16px;
    }
</style>

<div class="page-hero">
    <h1 class="page-title"> {{ __('messages.ajouter_horaire') }} </h1>
    <p class="page-subtitle">{{ __('messages.generer') }} </p>
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

        <form action="{{ route('horaire.store') }}" method="POST">
            @csrf

            <div class="row g-4">

                <div class="col-md-6">
                    <label class="form-label"> {{ __('messages.terrain') }} </label>
                    <select name="id_terrain" class="form-select">
                        @foreach($terrains as $terrain)
                            <option value="{{ $terrain->id_terrain }}">
                                {{ $terrain->nom_terrain }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label"> {{ __('messages.date') }} </label>
                    <!-- <input type="date" name="date" class="form-control" required> -->
                    <!-- <input type="date"  name="date" class="form-control" min="{{ date('Y-m-d') }}" required> -->
                    <input type="date" name="date" id="dateInput" class="form-control" min="{{ date('Y-m-d') }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label"> {{ __('messages.date_debut') }} </label>
                    <!-- <input type="time" name="heure_debut" class="form-control" required> -->
                    <input type="time"  name="heure_debut"  id="heureDebut" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label"> {{ __('messages.date_fin') }} </label>
                    <input type="time" name="heure_fin" class="form-control" required>
                </div>

                <div class="col-md-4">
                    <label class="form-label"> {{ __('messages.Durée_créneau') }} ({{ __('messages.minute')}})</label>
                    <input type="number" name="duree" value="60" class="form-control" required>
                </div>

                <div class="col-12 d-flex gap-2 flex-wrap">
                    <a href="{{ route('horaires.index') }}" class="btn btn-secondary btn-admin">
                        {{ __('messages.retour') }}
                    </a>

                    <button type="submit" class="btn btn-primary btn-admin">
                        {{ __('messages.generer') }}
                    </button>
                </div>

            </div>
        </form>

    </div>
</div>

<script>
    const dateInput = document.getElementById('dateInput');
    const heureDebut = document.getElementById('heureDebut');

    function updateTimeMin() {
        const now = new Date();

        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const day = String(now.getDate()).padStart(2, '0');
        const today = `${year}-${month}-${day}`;

        if (dateInput.value === today) {
            let hours = String(now.getHours()).padStart(2, '0');
            let minutes = String(now.getMinutes()).padStart(2, '0');

            heureDebut.min = `${hours}:${minutes}`;
        } else {
            heureDebut.min = "00:00";
        }
    }

    dateInput.addEventListener('change', updateTimeMin);
    updateTimeMin();
</script>

</x-layouts.main>