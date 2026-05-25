<x-layouts.main>

<style>
    .dashboard-hero {
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 30px;
        color: white;
        margin-bottom: 30px;
    }

    .dashboard-title {
        font-size: 48px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .dashboard-subtitle {
        color: #e2e8f0;
        margin-bottom: 0;
    }

    .stat-card {
        border: none;
        border-radius: 20px;
        padding: 28px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        background: white;
        height: 100%;
    }

    .stat-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 12px;
    }

    .stat-number {
        font-size: 46px;
        font-weight: 800;
        line-height: 1;
    }

    .chart-card1,
    .chart-card2 {
        margin: 30px 0 0;
        background-color: white;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .chart-card1 {
        flex: 1;
        min-width: 300px;
    }

    .chart-card2 {
        flex: 2;
        min-width: 300px;
    }

    .chart-title {
        font-size: 22px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 20px;
    }

    .action-card {
        border: none;
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.12);
        background: white;
        margin-top: 30px;
    }

    .action-title {
        font-size: 22px;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 18px;
    }

    .btn-admin {
        border-radius: 12px;
        font-weight: 700;
        padding: 12px 20px;
        margin-bottom: 20px;
    }

    .btn-admin-pdf {
        border-radius: 12px;
        font-weight: 700;
        padding: 12px 20px;
        height: 54px;
    }

    .bilan-box{
        background:white;
        border-radius:22px;
        padding:26px 30px;
        margin-top: 20px;
        box-shadow:0 10px 25px rgba(0,0,0,0.12);
    }

    .revenus-card{
        padding:34px 38px;
    }

    .revenus-select{
        min-width:220px;
        height:52px;
        border-radius:12px;
        font-weight:700;
    }
</style>



<div class="dashboard-hero">
    <h1 class="dashboard-title">{{ __('messages.dashboard_admin') }}</h1>
    <p class="dashboard-subtitle">{{ __('messages.consultez_statistiques') }}</p>
</div>




{{-- Bilan PDF --}}
<div class="bilan-box mb-4">

    <h4 class="fw-bold mb-3">
        {{ __('messages.generer_bilan_personnalise') }}
    </h4>

    <form method="GET" action="{{ route('dashboard.bilan.pdf') }}">
        <div class="row g-3 align-items-end">

            <div class="col-md-4">
                <label class="form-label fw-bold">
                    {{ __('messages.date_debut') }}
                </label>

                <input type="date"
                    name="date_debut"
                    class="form-control"
                    required>
            </div>

            <div class="col-md-4">
                <label class="form-label fw-bold">
                    {{ __('messages.date_fin') }}
                </label>

                <input type="date"
                    name="date_fin"
                    class="form-control"
                    required>
            </div>

            <div class="col-md-4">
                <button type="submit"
                    class="btn btn-warning btn-admin-pdf w-100">

                    {{ __('messages.Télécharger_Bilan_PDF') }}

                </button>
            </div>

        </div>
    </form>
</div>

{{-- Statistiques --}}
<div class="row g-4">

    <div class="col-md-6 col-lg-4">
        <div class="stat-card">
            <div class="stat-title">{{ __('messages.terrains') }}</div>
            <div class="stat-number text-primary">{{ $terrains }}</div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="stat-card">
            <div class="stat-title">{{ __('messages.horaires') }}</div>
            <div class="stat-number text-success">{{ $horaires }}</div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="stat-card">
            <div class="stat-title">{{ __('messages.reservations') }}</div>
            <div class="stat-number text-danger">{{ $reservations }}</div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="stat-card">
            <div class="stat-title">{{ __('messages.confirmees') }}</div>
            <div class="stat-number text-success">{{ $confirmees }}</div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="stat-card">
            <div class="stat-title">{{ __('messages.en_attente') }}</div>
            <div class="stat-number text-warning">{{ $en_attente }}</div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="stat-card">
            <div class="stat-title">{{ __('messages.annulees') }}</div>
            <div class="stat-number text-danger">{{ $annulees }}</div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="stat-card">
            <div class="stat-title">{{ __('messages.utilisateurs') }}</div>
            <div class="stat-number text-info">{{ $utilisateurs }}</div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="stat-card">
            <div class="stat-title">{{ __('messages.reservations_count') }}</div>
            <div class="stat-number text-danger">{{ $resertodays }}</div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="stat-card">
            <div class="stat-title">{{ __('messages.terrains_dispo') }}</div>
            <div class="stat-number text-success">
                {{ $terrains_libre }}
            </div>
        </div>
    </div>

    {{-- Total Revenus --}}
    <div class="col-12">
        <div class="stat-card revenus-card">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                <div>
                    <div class="stat-title">
                        {{ __('messages.Total_Revenus') }}
                        ({{ $jours }} {{ __('messages.derniers_jours') }})
                    </div>

                    <div class="stat-number text-success">
                        {{ number_format($totalRevenus, 2) }} DH
                    </div>
                </div>

                <form method="GET" action="{{ route('dashboard') }}">

                    <select name="jours"
                        onchange="this.form.submit()"
                        class="form-select revenus-select">

                        <option value="5" {{ $jours == 5 ? 'selected' : '' }}>
                            5 {{ __('messages.derniers_jours') }}
                        </option>

                        <option value="15" {{ $jours == 15 ? 'selected' : '' }}>
                            15 {{ __('messages.derniers_jours') }}
                        </option>

                        <option value="30" {{ $jours == 30 ? 'selected' : '' }}>
                            30 {{ __('messages.derniers_jours') }}
                        </option>

                    </select>

                </form>

            </div>

        </div>
    </div>

</div>

{{-- Charts --}}
<div style="display: flex; gap: 20px; flex-wrap: wrap;">

    <div class="chart-card1">

        <h3 class="chart-title">
            {{ __('messages.reservations_par_statut') }}
        </h3>

        <canvas id="reservationsPieChart"></canvas>

    </div>

    <div class="chart-card2">

        <h3 class="chart-title">
            {{ __('messages.Statistiques_Hebdomadaires') }}
        </h3>

        <canvas id="reservationsBarChart"></canvas>

    </div>

</div>



{{-- Derniers utilisateurs --}}
<div class="action-card">

    <div class="user-table-card">

        <h3 class="action-title">
            {{ __('messages.derniers_utilisateurs') }}
        </h3>

        <div class="table-responsive">

            <table class="table table-hover align-middle">

                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>{{ __('messages.nom') }}</th>
                        <th>{{ __('messages.email') }}</th>
                        <th>{{ __('messages.date_inscription') }}</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($derniers_utilisateurs as $index => $user)

                        <tr>
                            <td>
                                <strong>{{ $index + 1 }}</strong>
                            </td>

                            <td>{{ $user->name }}</td>

                            <td>
                                <span class="text-muted">
                                    {{ $user->email }}
                                </span>
                            </td>

                            <td>
                                {{ $user->created_at->format('d/m/Y H:i') }}
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="4"
                                class="text-center text-muted">
                                Aucun utilisateur trouvé.
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

<script src="{{ asset('assets/chart/chart.umd.js') }}"></script>

<script>

    const ctxPie = document.getElementById('reservationsPieChart').getContext('2d');

    new Chart(ctxPie, {
        type: 'pie',

        data: {
            labels: ['Confirmées', 'En attente', 'Annulées'],

            datasets: [{
                data: @json($pieData),
                backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
                borderWidth: 0
            }]
        },

        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    const ctxBar = document.getElementById('reservationsBarChart').getContext('2d');

    new Chart(ctxBar, {
        type: 'bar',

        data: {
            labels: ['Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam', 'Dim'],

            datasets: [{
                label: 'Nombre de réservations',
                data: @json($reservationsData),
                backgroundColor: '#28a745',
                borderRadius: 8,
            }]
        },

        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        display: false
                    },
                    ticks: {
                        precision: 0
                    }
                },

                x: {
                    grid: {
                        display: false
                    }
                }
            },

            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

</script>

</x-layouts.main>