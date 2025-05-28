@extends('admin.layout')

@section('title', 'État Journalier')

@section('content')
<div class="daily-state">
    <!-- Daily State Form -->
    <div class="state-form-card">
        <h2 class="section-title">
            <i class="fas fa-file-alt me-2"></i>Nouvel État Journalier
        </h2>
        <form method="POST" action="{{ route('admin.etat.store') }}" class="state-form">
            @csrf
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-input" required>
                </div>
            </div>

            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-gas-pump me-2"></i>Ventes Carburant
                </h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Essence vendue (L)</label>
                        <input name="volume_essence" step="0.01" type="number" class="form-input" placeholder="0.00">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Prix/litre essence (MAD)</label>
                        <input name="prix_litre_essence" step="0.01" type="number" class="form-input" placeholder="0.00">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Diesel vendu (L)</label>
                        <input name="volume_diesel" step="0.01" type="number" class="form-input" placeholder="0.00">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Prix/litre diesel (MAD)</label>
                        <input name="prix_litre_diesel" step="0.01" type="number" class="form-input" placeholder="0.00">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-money-bill-wave me-2"></i>Autres Revenus
                </h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Recette lavage (MAD)</label>
                        <input name="recette_lavage" step="0.01" type="number" class="form-input" placeholder="0.00">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Recette urgence (MAD)</label>
                        <input name="recette_urgence" step="0.01" type="number" class="form-input" placeholder="0.00">
                    </div>
                </div>
            </div>

            <div class="form-section">
                <h3 class="form-section-title">
                    <i class="fas fa-wallet me-2"></i>Dépenses
                </h3>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Crédits clients (MAD)</label>
                        <input name="depenses_credits" step="0" type="number" class="form-input" placeholder="0.00">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Autres dépenses (MAD)</label>
                        <input name="depenses_autres" step="0.01" type="number" class="form-input" placeholder="0.00">
                    </div>
                </div>
            </div>

            <button type="submit" class="submit-btn">
                <i class="fas fa-save me-2"></i>Enregistrer l'état
            </button>
        </form>
    </div>

    <!-- States List -->
    <div class="states-list-card">
        <h2 class="section-title">
            <i class="fas fa-history me-2"></i>Historique des États
        </h2>
        
        <div class="table-responsive">
            <table class="states-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Recette Carburant</th>
                        <th>Autres Revenus</th>
                        <th>Dépenses</th>
                        <th>Bénéfice Net</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($etats as $etat)
                    @php
                        $recette_carburant = ($etat->volume_essence * $etat->prix_litre_essence) + ($etat->volume_diesel * $etat->prix_litre_diesel);
                        $recette_autres = $etat->recette_lavage + $etat->recette_urgence;
                        $depenses = $etat->depenses_credits + $etat->depenses_autres;
                        $benefice = ($recette_carburant + $recette_autres) - $depenses;
                    @endphp
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($etat->date)) }}</td>
                        <td class="text-primary">{{ number_format($recette_carburant, 2) }} MAD</td>
                        <td class="text-success">{{ number_format($recette_autres, 2) }} MAD</td>
                        <td class="text-danger">-{{ number_format($depenses, 2) }} MAD</td>
                        <td class="{{ $benefice >= 0 ? 'text-success' : 'text-danger' }} font-weight-bold">
                            {{ number_format($benefice, 2) }} MAD
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="table-footer">
            <div class="table-info">
                Affichage de <span>1</span> à <span>{{ count($etats) }}</span> sur <span>{{ count($etats) }}</span> états
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

    .daily-state {
        padding: 20px;
        background-color: #f5f7fa;
    }

    /* Form Section */
    .state-form-card {
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

    .state-form {
        margin-top: 20px;
    }

    .form-section {
        margin-bottom: 25px;
        padding-bottom: 20px;
        border-bottom: 1px dashed #eee;
    }

    .form-section:last-child {
        border-bottom: none;
    }

    .form-section-title {
        color: var(--dark-blue);
        font-size: 1.1rem;
        margin-bottom: 15px;
        display: flex;
        align-items: center;
    }

    .form-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
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

    .form-input {
        width: 100%;
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 0.95rem;
        transition: all 0.3s;
    }

    .form-input:focus {
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

    /* States List */
    .states-list-card {
        background-color: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .table-responsive {
        overflow-x: auto;
    }

    .states-table {
        width: 100%;
        border-collapse: collapse;
    }

    .states-table th {
        background-color: var(--light-bg);
        color: var(--text-dark);
        font-weight: 600;
        padding: 15px;
        text-align: left;
        border-bottom: 2px solid #eee;
    }

    .states-table td {
        padding: 15px;
        border-bottom: 1px solid #eee;
    }

    .states-table tr:hover {
        background-color: rgba(0, 91, 170, 0.03);
    }

    .text-primary {
        color: var(--primary-blue);
        font-weight: 500;
    }

    .text-success {
        color: var(--success-green);
        font-weight: 500;
    }

    .text-danger {
        color: var(--danger-red);
        font-weight: 500;
    }

    .font-weight-bold {
        font-weight: 600;
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
        .form-row,
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    // Calculate fuel revenue automatically when both volume and price are entered
    document.querySelectorAll('[name="volume_essence"], [name="prix_litre_essence"]').forEach(input => {
        input.addEventListener('input', function() {
            const volume = parseFloat(document.querySelector('[name="volume_essence"]').value) || 0;
            const price = parseFloat(document.querySelector('[name="prix_litre_essence"]').value) || 0;
            // You could display the calculated value somewhere if needed
        });
    });

    document.querySelectorAll('[name="volume_diesel"], [name="prix_litre_diesel"]').forEach(input => {
        input.addEventListener('input', function() {
            const volume = parseFloat(document.querySelector('[name="volume_diesel"]').value) || 0;
            const price = parseFloat(document.querySelector('[name="prix_litre_diesel"]').value) || 0;
            // You could display the calculated value somewhere if needed
        });
    });
</script>
@endsection