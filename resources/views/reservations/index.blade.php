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

        .reservation-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.12);
            background: white;
            height: 100%;
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


    @if(session('error'))
        <div class="alert alert-danger">
            <i class="bi bi-info-circle"></i>
            {{ session('error') }}
        </div>
    @endif

    

    
    <div class="page-hero">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h1 class="page-title">{{ __('messages.mes_reservations') }}</h1>
                <p class="page-subtitle">{{ __('messages.consultez_gerer_reservations') }}</p>
            </div>

            <a href="{{ route('home') }}" class="btn btn-primary btn-admin">
                <i class="bi bi-cart-plus"></i>
                {{ __('messages.nouvelle_reservation') }}
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="alert alert-warning shadow mb-4 alert-dismissible fade show" role="alert">
        <i class="bi bi-filetype-pdf"></i>
        {{ __('messages.telecharger_pdf_paiement') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>



    <div class="row g-4">

        @forelse($reservations as $reservation)

            <div class="col-md-6 col-lg-4">
                <div class="card reservation-card">
                    <div class="card-body p-4">

                        <h4 class="fw-bold mb-3">{{ $reservation->terrain->nom_terrain }}</h4>

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
                            {{ $reservation->horaire->heure_debut }} - {{ $reservation->horaire->heure_fin }}
                        </p>

                        <p>
                            <strong>{{ __('messages.montant') }} :</strong>
                            {{ $reservation->montant_total }} DH
                        </p>

                        <p class="mb-3">
                            <strong>{{ __('messages.statut') }} :</strong>

                            @if($reservation->statut == 'confirmee')
                                <span class="badge bg-success status-badge">{{ __('messages.confirmee') }}</span>
                            @elseif($reservation->statut == 'en_attente')
                                <span class="badge bg-warning text-dark status-badge">{{ __('messages.en_attente') }}</span>
                            @else
                                <span class="badge bg-danger status-badge">{{ __('messages.annulee') }}</span>
                            @endif
                        </p>

                        <div class="d-flex gap-2 mt-3 flex-wrap">

                            @if($reservation->statut != 'annulee')
                                <a href="{{ route('reservation.annuler', $reservation->id_reservation) }}"
                                   class="btn btn-outline-warning btn-sm btn-admin">
                                    {{ __('messages.annuler') }}
                                    <i class="bi bi-x"></i>
                                </a>
                            @endif

                            <form
                                action="{{ route('reservations.destroy', $reservation->id_reservation) }}"
                                method="POST"
                                onsubmit="return confirm('{{ __('messages.confirmer_suppression_reservation') }}')"
                            >
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-outline-danger btn-sm btn-admin">
                                    {{ __('messages.supprimer') }}
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>

                            @if ($reservation->statut == 'confirmee')
                                <a href="{{ route('reservation.pdf', $reservation->id_reservation) }}"
                                class="btn btn-outline-primary btn-sm btn-admin">
                                    {{ __('messages.reçu') }}
                                    <i class="bi bi-filetype-pdf"></i>

                                </a>
                            @endif


                        </div>

                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-light">
                    {{ __('messages.aucune_reservation') }}
                </div>
            </div>
        @endforelse

    </div>

</x-layouts.main>