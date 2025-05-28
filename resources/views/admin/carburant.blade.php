@extends('admin.layout')

@section('title', 'Gestion Carburant')

@section('content')
<div class="fuel-management">
    <!-- Fuel Summary Cards -->
    <div class="fuel-summary">
        @foreach(['essence', 'diesel'] as $type)
            <div class="fuel-card {{ $type }}">
                <div class="fuel-header">
                    <div class="fuel-icon">
                        <i class="fas fa-{{ $type === 'essence' ? 'gas-pump' : 'oil-can' }}"></i>
                    </div>
                    <h3>{{ ucfirst($type) }}</h3>
                </div>
                <div class="fuel-stats">
                    <div class="stat-item">
                        <span class="stat-label">Reçu</span>
                        <span class="stat-value">{{ $resume[$type]['recu'] }} L</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-label">Vendu</span>
                        <span class="stat-value">{{ $resume[$type]['vendu'] }} L</span>
                    </div>
                    <div class="stat-item highlight">
                        <span class="stat-label">Stock actuel</span>
                        <span class="stat-value">{{ $resume[$type]['stock'] }} L</span>
                    </div>
                </div>
                <div class="fuel-gauge">
                    <div class="gauge-track">
                        <div class="gauge-fill" style="width: {{ min(100, ($resume[$type]['stock'] / 10000) * 100) }}%"></div>
                    </div>
                    <span class="gauge-label">Niveau de stock</span>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Fuel Transaction Form -->
    <div class="fuel-form-card">
        <h2 class="section-title">
            <i class="fas fa-plus-circle me-2"></i>Nouvelle opération
        </h2>
        <form method="POST" action="{{ route('admin.carburant.store') }}" class="fuel-form">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Type de carburant</label>
                    <select name="type" class="form-select" required>
                        <option value="">Sélectionner un type</option>
                        <option value="essence">Essence</option>
                        <option value="diesel">Diesel</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Opération</label>
                    <select name="operation" class="form-select" required>
                        <option value="">Sélectionner une opération</option>
                        <option value="reception">Réception</option>
                        <option value="vente">Vente</option>
                    </select>
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Quantité (litres)</label>
                    <input name="quantite" type="number" step="0.01" class="form-input" placeholder="Ex: 5000" required>
                </div>
                
                <div class="form-group" id="fournisseur-group">
                    <label class="form-label">Fournisseur</label>
                    <input name="fournisseur" class="form-input" placeholder="Nom du fournisseur">
                </div>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Date</label>
                    <input name="date" type="date" class="form-input" required>
                </div>
            </div>
            
            <button type="submit" class="submit-btn">
                <i class="fas fa-save me-2"></i>Enregistrer
            </button>
        </form>
    </div>

    <!-- Fuel History -->
    <div class="fuel-history-card">
        <div class="history-header">
            <h2 class="section-title">
                <i class="fas fa-history me-2"></i>Historique des transactions
            </h2>
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Rechercher...">
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="fuel-history-table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Opération</th>
                        <th>Quantité</th>
                        <th>Fournisseur</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carburants as $c)
                    <tr>
                        <td>
                            <span class="fuel-type-badge {{ $c->type }}">
                                <i class="fas fa-{{ $c->type === 'essence' ? 'gas-pump' : 'oil-can' }} me-2"></i>
                                {{ ucfirst($c->type) }}
                            </span>
                        </td>
                        <td>
                            <span class="operation-badge {{ $c->operation }}">
                                {{ ucfirst($c->operation) }}
                            </span>
                        </td>
                        <td class="{{ $c->operation === 'vente' ? 'text-danger' : 'text-success' }}">
                            {{ $c->quantite }} L
                        </td>
                        <td>{{ $c->fournisseur ?? '-' }}</td>
                        <td>{{ date('d/m/Y', strtotime($c->date)) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="table-footer">
            <div class="table-info">
                Affichage de <span>1</span> à <span>{{ count($carburants) }}</span> sur <span>{{ count($carburants) }}</span> transactions
            </div>
            <div class="pagination">
                <button class="pagination-btn" disabled>
                    <i class="fas fa-chevron-left"></i> Précédent
                </button>
                <button class="pagination-btn">
                    Suivant <i class="fas fa-chevron-right"></i>
                </button>
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

    .fuel-management {
        padding: 20px;
        background-color: #f5f7fa;
    }

    /* Fuel Summary Cards */
    .fuel-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .fuel-card {
        background-color: white;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .fuel-card.essence {
        border-top: 4px solid var(--primary-blue);
    }

    .fuel-card.diesel {
        border-top: 4px solid var(--secondary-orange);
    }

    .fuel-header {
        display: flex;
        align-items: center;
        margin-bottom: 20px;
    }

    .fuel-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 15px;
        font-size: 1.2rem;
    }

    .fuel-card.essence .fuel-icon {
        background-color: rgba(0, 91, 170, 0.1);
        color: var(--primary-blue);
    }

    .fuel-card.diesel .fuel-icon {
        background-color: rgba(246, 139, 31, 0.1);
        color: var(--secondary-orange);
    }

    .fuel-card h3 {
        font-size: 1.2rem;
        color: var(--text-dark);
        margin: 0;
    }

    .fuel-stats {
        margin-bottom: 20px;
    }

    .stat-item {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px dashed #eee;
    }

    .stat-item:last-child {
        border-bottom: none;
    }

    .stat-item.highlight {
        background-color: var(--light-bg);
        padding: 10px;
        border-radius: 8px;
        margin-top: 15px;
    }

    .stat-label {
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .stat-value {
        font-weight: 600;
        color: var(--text-dark);
    }

    .highlight .stat-value {
        color: var(--primary-blue);
        font-size: 1.1rem;
    }

    .fuel-gauge {
        margin-top: 20px;
    }

    .gauge-track {
        height: 10px;
        background-color: #eee;
        border-radius: 5px;
        overflow: hidden;
        margin-bottom: 5px;
    }

    .fuel-card.essence .gauge-fill {
        height: 100%;
        background-color: var(--primary-blue);
    }

    .fuel-card.diesel .gauge-fill {
        height: 100%;
        background-color: var(--secondary-orange);
    }

    .gauge-label {
        font-size: 0.8rem;
        color: var(--text-light);
    }

    /* Fuel Form */
    .fuel-form-card {
        background-color: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .section-title {
        color: var(--dark-blue);
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .fuel-form {
        margin-top: 20px;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--text-dark);
    }

    .form-input, .form-select {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s;
    }

    .form-input:focus, .form-select:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 0.2rem rgba(0, 91, 170, 0.25);
        outline: none;
    }

    .submit-btn {
        background-color: var(--secondary-orange);
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
    }

    .submit-btn:hover {
        background-color: #e07d0d;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(246, 139, 31, 0.3);
    }

    /* History Table */
    .fuel-history-card {
        background-color: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .history-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .search-box {
        position: relative;
        min-width: 250px;
    }

    .search-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-light);
    }

    .search-input {
        width: 100%;
        padding: 10px 15px 10px 40px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 0.95rem;
    }

    .search-input:focus {
        border-color: var(--primary-blue);
        outline: none;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .fuel-history-table {
        width: 100%;
        border-collapse: collapse;
    }

    .fuel-history-table th {
        background-color: var(--light-bg);
        color: var(--text-dark);
        font-weight: 600;
        padding: 15px;
        text-align: left;
        border-bottom: 2px solid #eee;
    }

    .fuel-history-table td {
        padding: 15px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }

    .fuel-history-table tr:hover {
        background-color: rgba(0, 91, 170, 0.03);
    }

    .fuel-type-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }

    .fuel-type-badge.essence {
        background-color: rgba(0, 91, 170, 0.1);
        color: var(--primary-blue);
    }

    .fuel-type-badge.diesel {
        background-color: rgba(246, 139, 31, 0.1);
        color: var(--secondary-orange);
    }

    .operation-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .operation-badge.reception {
        background-color: rgba(40, 167, 69, 0.1);
        color: var(--success-green);
    }

    .operation-badge.vente {
        background-color: rgba(220, 53, 69, 0.1);
        color: var(--danger-red);
    }

    .text-success {
        color: var(--success-green);
        font-weight: 500;
    }

    .text-danger {
        color: var(--danger-red);
        font-weight: 500;
    }

    .table-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #eee;
    }

    .table-info {
        color: var(--text-light);
        font-size: 0.9rem;
    }

    .table-info span {
        font-weight: 600;
        color: var(--text-dark);
    }

    .pagination {
        display: flex;
        gap: 10px;
    }

    .pagination-btn {
        padding: 8px 15px;
        border-radius: 6px;
        border: 1px solid #ddd;
        background-color: white;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .pagination-btn:hover:not(:disabled) {
        background-color: var(--light-bg);
    }

    .pagination-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .history-header {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .search-box {
            width: 100%;
        }
    }
</style>

<script>
    // Show/hide supplier field based on operation type
    document.querySelector('select[name="operation"]').addEventListener('change', function(e) {
        const supplierGroup = document.getElementById('fournisseur-group');
        if (e.target.value === 'reception') {
            supplierGroup.style.display = 'block';
        } else {
            supplierGroup.style.display = 'none';
        }
    });

    // Initialize the supplier field visibility
    document.addEventListener('DOMContentLoaded', function() {
        const operationSelect = document.querySelector('select[name="operation"]');
        const supplierGroup = document.getElementById('fournisseur-group');
        
        if (operationSelect.value !== 'reception') {
            supplierGroup.style.display = 'none';
        }
    });

    // Search functionality
    document.querySelector('.search-input').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('.fuel-history-table tbody tr');
        
        rows.forEach(row => {
            const type = row.querySelector('.fuel-type-badge').textContent.toLowerCase();
            const operation = row.querySelector('.operation-badge').textContent.toLowerCase();
            const fournisseur = row.querySelector('td:nth-child(4)').textContent.toLowerCase();
            
            if (type.includes(searchTerm) || operation.includes(searchTerm) || fournisseur.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection