@extends('admin.layout')

@section('title', 'Tableau de bord')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="dashboard-container">
    <!-- Welcome Section with Stats Overview -->
    <div class="welcome-section">
        <div class="welcome-card">
            <div class="welcome-content">
                <h1>Tableau de bord</h1>
                <p class="welcome-text">Bienvenue dans le panneau d'administration de la station Ste Azzahhafi</p>
                <div class="datetime-display">
                    <div class="date-box">
                        <i class="far fa-calendar-alt"></i>
                        {{ now()->format('d/m/Y') }}
                    </div>
                    <div class="time-box">
                        <i class="far fa-clock"></i>
                        {{ now()->format('H:i') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Key Metrics Dashboard -->
    <div class="metrics-grid">
        <!-- Employees Metric -->
        <div class="metric-card employee-metric">
            <div class="metric-header">
                <div class="metric-info">
                    <p class="metric-title">Employés</p>
                    <p class="metric-value">{{ $totalEmployees }}</p>
                </div>
                <div class="metric-icon">
                    <i class="fas fa-user-tie"></i>
                </div>
            </div>
            <div class="metric-footer">
                <div class="metric-trend">
                    <span class="trend-value">3 actifs</span>
                    <span class="trend-label">aujourd'hui</span>
                </div>
            </div>
        </div>

        <!-- Fuel Stock Metric -->
        <div class="metric-card fuel-metric">
            <div class="metric-header">
                <div class="metric-info">
                    <p class="metric-title">Stock Carburant</p>
                    <p class="metric-value">{{ $totalCarburant }} L</p>
                </div>
                <div class="metric-icon">
                    <i class="fas fa-gas-pump"></i>
                </div>
            </div>
            <div class="metric-footer">
                <div class="metric-trend">
                    <span class="trend-value">Niveau {{ $totalEssence > 5000 ? 'Élevé' : 'Moyen' }}</span>
                </div>
            </div>
        </div>

        <!-- Product Stock Metric -->
        <div class="metric-card product-metric">
            <div class="metric-header">
                <div class="metric-info">
                    <p class="metric-title">Stock Produits</p>
                    <p class="metric-value">{{ $stockTotal }}</p>
                </div>
                <div class="metric-icon">
                    <i class="fas fa-boxes"></i>
                </div>
            </div>
            <div class="metric-footer">
                <div class="metric-trend">
                    <span class="trend-label">3 catégories</span>
                </div>
            </div>
        </div>

        <!-- Sales Metric -->
        <div class="metric-card sales-metric">
            <div class="metric-header">
                <div class="metric-info">
                    <p class="metric-title">Ventes Aujourd'hui</p>
                    <p class="metric-value">{{ number_format($ventesToday, 0, ',', ' ') }} DH</p>
                </div>
                <div class="metric-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
            </div>
            <div class="metric-footer">
                <div class="metric-trend positive">
                    <i class="fas fa-arrow-{{ $evolutionVente >= 0 ? 'up' : 'down' }}"></i>
                    <span class="trend-value">{{ abs($evolutionVente) }}%</span>
                    <span class="trend-label">vs hier</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Financial Performance Section -->
    <div class="performance-section">
        <!-- Sales Summary -->
        <div class="performance-card">
            <div class="performance-header">
                <h2>Performance Financière</h2>
                <div class="time-selector">
                    <button class="time-btn active">Jour</button>
                    <button class="time-btn">Mois</button>
                    <button class="time-btn">Année</button>
                </div>
            </div>
            
            <div class="performance-metrics">
                <div class="performance-metric">
                    <p class="metric-value">{{ number_format($ventesToday, 0, ',', ' ') }} DH</p>
                    <span class="trend-value">{{ abs($evolutionVente) }}%</span>
                    <i class="fas fa-arrow-{{ $evolutionVente >= 0 ? 'up' : 'down' }}"></i>
                    </p>
                </div>
                <div class="performance-metric">
                    <p class="metric-amount">{{ number_format($recettesToday, 0, ',', ' ') }} DH</p>
                    <p class="metric-value {{ $evolutionRecette >= 0 ? 'positive' : 'negative' }}">
                        <i class="fas fa-arrow-{{ $evolutionRecette >= 0 ? 'up' : 'down' }}"></i>
                        {{ abs($evolutionRecette) }}%
                    </p>
                </div>
                <div class="performance-metric">
                    <p class="metric-amount">{{ number_format($beneficesToday, 0, ',', ' ') }} DH</p>
                    <p class="metric-value {{ $evolutionBenefice >= 0 ? 'positive' : 'negative' }}">
                        <i class="fas fa-arrow-{{ $evolutionBenefice >= 0 ? 'up' : 'down' }}"></i>
                        {{ abs($evolutionBenefice) }}%
                    </p>
                </div>
            </div>
            
            <div class="bg-white rounded-lg shadow p-4 mt-6">
                <h2 class="text-xl font-semibold mb-4">Évolution des ventes (7 derniers jours)</h2>
                <canvas id="ventesChart" height="100"></canvas>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions-card">
            <h2>Actions Rapides</h2>
            <div class="action-items">
                <a href="{{ route('admin.employes') }}" class="action-item">
                    <div class="action-icon employee-action">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <div class="action-info">
                        <p class="action-title">Ajouter employé</p>
                        <p class="action-subtitle">Gestion du personnel</p>
                    </div>
                    <div class="action-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>
                
                <a href="{{ route('admin.carburant') }}" class="action-item">
                    <div class="action-icon fuel-action">
                        <i class="fas fa-gas-pump"></i>
                    </div>
                    <div class="action-info">
                        <p class="action-title">Gérer carburant</p>
                        <p class="action-subtitle">Approvisionnement</p>
                    </div>
                    <div class="action-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>
                
                <a href="{{ route('admin.stock') }}" class="action-item">
                    <div class="action-icon stock-action">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="action-info">
                        <p class="action-title">Vérifier stock</p>
                        <p class="action-subtitle">Inventaire produits</p>
                    </div>
                    <div class="action-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>

                <a href="{{ route('admin.etat') }}" class="action-item">
                    <div class="action-icon report-action">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <div class="action-info">
                        <p class="action-title">Générer rapport</p>
                        <p class="action-subtitle">Analyse des ventes</p>
                    </div>
                    <div class="action-arrow">
                        <i class="fas fa-chevron-right"></i>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary-blue: #005baa;
        --secondary-orange: #f68b1f;
        --accent-yellow: #ffd100;
        --light-bg: #f8f9fa;
        --dark-blue: #003366;
        --success-green: #28a745;
        --danger-red: #dc3545;
        --text-dark: #343a40;
        --text-light: #6c757d;
    }

    .dashboard-container {
        padding: 20px;
        background-color: #f5f7fa;
    }

    /* Welcome Section */
    .welcome-section {
        margin-bottom: 25px;
    }

    .welcome-card {
        background: linear-gradient(135deg, var(--primary-blue) 0%, #0077cc 100%);
        border-radius: 12px;
        padding: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
        box-shadow: 0 4px 20px rgba(0, 91, 170, 0.15);
    }

    .welcome-content h1 {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .welcome-text {
        font-size: 1rem;
        opacity: 0.9;
        margin-bottom: 20px;
    }

    .datetime-display {
        display: flex;
        gap: 15px;
    }

    .date-box, .time-box {
        background-color: rgba(255, 255, 255, 0.15);
        padding: 8px 15px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.9rem;
    }

    .welcome-graphic img {
        height: 120px;
    }

    /* Metrics Grid */
    .metrics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
    }

    .metric-card {
        background-color: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .metric-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    .metric-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 15px;
    }

    .metric-title {
        font-size: 0.9rem;
        color: var(--text-light);
        margin-bottom: 5px;
    }

    .metric-value {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark-blue);
    }

    .metric-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .metric-footer {
        border-top: 1px solid #eee;
        padding-top: 15px;
    }

    .metric-trend {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.85rem;
    }

    .trend-value {
        font-weight: 600;
    }

    .trend-label {
        color: var(--text-light);
    }

    /* Metric Card Colors */
    .employee-metric .metric-icon {
        background-color: rgba(0, 91, 170, 0.1);
        color: var(--primary-blue);
    }

    .fuel-metric .metric-icon {
        background-color: rgba(246, 139, 31, 0.1);
        color: var(--secondary-orange);
    }

    .product-metric .metric-icon {
        background-color: rgba(255, 209, 0, 0.1);
        color: var(--accent-yellow);
    }

    .sales-metric .metric-icon {
        background-color: rgba(40, 167, 69, 0.1);
        color: var(--success-green);
    }

    /* Performance Section */
    .performance-section {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
    }

    @media (max-width: 992px) {
        .performance-section {
            grid-template-columns: 1fr;
        }
    }

    .performance-card, .quick-actions-card {
        background-color: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .performance-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .performance-header h2 {
        font-size: 1.4rem;
        color: var(--dark-blue);
    }

    .time-selector {
        display: flex;
        gap: 10px;
    }

    .time-btn {
        padding: 6px 12px;
        border-radius: 6px;
        border: 1px solid #ddd;
        background-color: white;
        font-size: 0.8rem;
        cursor: pointer;
        transition: all 0.3s;
    }

    .time-btn.active {
        background-color: var(--primary-blue);
        color: white;
        border-color: var(--primary-blue);
    }

    .performance-metrics {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 25px;
    }

    .performance-metric {
        text-align: center;
    }

    .metric-label {
        font-size: 0.9rem;
        color: var(--text-light);
        margin-bottom: 5px;
    }

    .metric-value {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 5px;
    }

    .metric-amount {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dark-blue);
    }

    .positive {
        color: var(--success-green);
    }

    .negative {
        color: var(--danger-red);
    }

    .performance-chart {
        height: 250px;
        margin-top: 20px;
    }

    /* Quick Actions */
    .quick-actions-card h2 {
        font-size: 1.4rem;
        color: var(--dark-blue);
        margin-bottom: 20px;
    }

    .action-items {
        display: grid;
        gap: 12px;
    }

    .action-item {
        display: flex;
        align-items: center;
        padding: 15px;
        border-radius: 8px;
        background-color: var(--light-bg);
        text-decoration: none;
        color: var(--text-dark);
        transition: all 0.3s;
    }

    .action-item:hover {
        background-color: #e9ecef;
        transform: translateX(5px);
    }

    .action-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.1rem;
    }

    .action-info {
        flex: 1;
    }

    .action-title {
        font-weight: 600;
        margin-bottom: 3px;
    }

    .action-subtitle {
        font-size: 0.8rem;
        color: var(--text-light);
    }

    .action-arrow {
        color: var(--text-light);
    }

    /* Action Icon Colors */
    .employee-action {
        background-color: rgba(0, 91, 170, 0.1);
        color: var(--primary-blue);
    }

    .fuel-action {
        background-color: rgba(246, 139, 31, 0.1);
        color: var(--secondary-orange);
    }

    .stock-action {
        background-color: rgba(255, 209, 0, 0.1);
        color: var(--accent-yellow);
    }

    .report-action {
        background-color: rgba(108, 117, 125, 0.1);
        color: var(--text-light);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ventesChart').getContext('2d');

    const ventesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($dates) !!},
            datasets: [{
                label: 'Recette Totale (DH)',
                data: {!! json_encode($ventes) !!},
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                tension: 0.3,
                fill: true,
                pointBackgroundColor: '#3B82F6',
                pointBorderColor: '#3B82F6'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString() + ' DH';
                        }
                    }
                }
            }
        }
    });
</script>
<script>
    // Initialize sales chart
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'],
                datasets: [{
                    label: 'Ventes Mensuelles',
                    data: [12000, 19000, 15000, 22000, 20000, 25000, 28000],
                    backgroundColor: 'rgba(0, 91, 170, 0.1)',
                    borderColor: 'rgba(0, 91, 170, 1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Time selector functionality
        const timeButtons = document.querySelectorAll('.time-btn');
        timeButtons.forEach(button => {
            button.addEventListener('click', function() {
                timeButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                // Here you would update the chart data based on the selected time period
            });
        });
    });
</script>
@endsection