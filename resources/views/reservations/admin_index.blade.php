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

    .reservation-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        background: white;
        height: 100%;
    }

    .reservation-title {
        font-size: 28px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 18px;
    }

    .reservation-card p {
        margin-bottom: 10px;
        color: #334155;
    }

    .user-header{
        background:rgba(255,255,255,0.18);
        backdrop-filter:blur(12px);
        color:white;
        font-size:28px;
        font-weight:900;
        border-radius:18px;
        padding:18px 24px;
        box-shadow:0 10px 25px rgba(0,0,0,0.15);
        text-transform: uppercase
    }

    .status-badge {
        padding: 8px 14px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 700;
    }

    .btn-admin {
        border-radius: 12px;
        font-weight: 700;
        padding: 10px 16px;
    }
</style>

<div class="page-hero">
    <h1 class="page-title">{{ __('messages.liste_reservations') }}</h1>
    <p class="page-subtitle">{{ __('messages.gerer_reservations_utilisateurs') }}</p>
</div>

@if(session('success'))
    <div class="alert alert-success">
        <i class="bi bi-info-circle"></i>
        {{ session('success') }}
    </div>
@endif

<div class="search-box">
    <label class="form-label fw-bold">
        {{ __('messages.Rechercher_reservation') }}
    </label>

    <input
        type="text"
        id="searchReservation"
        class="form-control search-input"
        placeholder="{{ __('messages.Tapez_terrain') }}"
    >
</div>

@php
    $reservationsParUser = $reservations->groupBy('user.name');
@endphp

<div id="reservationsContainer">

    @forelse($reservationsParUser as $userName => $userReservations)

        <div class="user-group mb-5">

            <div class="user-header mb-4">
                <i class="bi bi-person"></i>
                {{ $userName }}
            </div>

            <div class="row g-4">

                @foreach($userReservations as $reservation)

                    <div
                        class="col-md-6 col-lg-4 reservation-item"
                        data-search="{{ strtolower($reservation->terrain->nom_terrain . ' ' . $reservation->user->name . ' ' . $reservation->user->email) }}"
                    >

                        <div class="card reservation-card">

                            <div class="card-body p-4">

                                <h3 class="reservation-title">
                                    🏟️ {{ $reservation->terrain->nom_terrain }}
                                </h3>

                                <p>
                                    <strong>{{ __('messages.email') }} :</strong>
                                    {{ $reservation->user->email }}
                                </p>

                                <p>
                                    <strong>{{ __('messages.date_reservation') }} :</strong>
                                    {{ $reservation->date_reservation }}
                                </p>

                                <p>
                                    <strong>{{ __('messages.date_horaire') }} :</strong>
                                    {{ $reservation->horaire->date_horaire }}
                                </p>

                                <p>
                                    <strong>{{ __('messages.heure') }} :</strong>
                                    {{ $reservation->horaire->heure_debut }}
                                    -
                                    {{ $reservation->horaire->heure_fin }}
                                </p>

                                <p>
                                    <strong>{{ __('messages.montant') }} :</strong>
                                    {{ $reservation->montant_total }} DH
                                </p>

                                <p class="mb-3">
                                    <strong>{{ __('messages.statut') }} :</strong>

                                    @if($reservation->statut == 'confirmee')

                                        <span class="badge bg-success status-badge">
                                            {{ __('messages.confirmee') }}
                                        </span>

                                    @elseif($reservation->statut == 'en_attente')

                                        <span class="badge bg-warning text-dark status-badge">
                                            {{ __('messages.en_attente') }}
                                        </span>

                                    @else

                                        <span class="badge bg-danger status-badge">
                                            {{ __('messages.annulee') }}
                                        </span>

                                    @endif
                                </p>

                                <div class="d-flex flex-wrap gap-2 mt-3">

                                    @if($reservation->statut == 'en_attente')

                                        <a href="{{ route('reservation.confirmer', $reservation->id_reservation) }}"
                                           class="btn btn-success btn-sm btn-admin">

                                            {{ __('messages.confirmer') }}

                                        </a>

                                    @endif

                                    @if($reservation->statut != 'annulee')

                                        <a href="{{ route('reservation.admin.annuler', $reservation->id_reservation) }}"
                                           class="btn btn-danger btn-sm btn-admin">

                                            {{ __('messages.annuler') }}

                                        </a>

                                    @endif

                                </div>

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

    @empty

        <div class="col-12">
            <div class="alert alert-light">
                {{ __('messages.aucune_reservation_trouvee') }}
            </div>
        </div>

    @endforelse

</div>

<div id="noResult" class="alert alert-warning d-none mt-4">
    Aucune réservation trouvée.
</div>

<script>
    const searchInput = document.getElementById('searchReservation');
    const reservationItems = document.querySelectorAll('.reservation-item');
    const noResult = document.getElementById('noResult');

    searchInput.addEventListener('input', function () {
        const value = this.value.toLowerCase().trim();
        let visibleCount = 0;

        reservationItems.forEach(item => {
            const content = item.dataset.search;

            if (content.includes(value)) {
                item.style.display = 'block';
                visibleCount++;
            } else {
                item.style.display = 'none';
            }
        });

        noResult.classList.toggle('d-none', visibleCount > 0);
    });
</script>

</x-layouts.main>