@extends('admin.layout')

@section('title', 'Gestion du Stock')

@section('content')
<div class="stock-management">
    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success">
        <div class="alert-content">
            <i class="fas fa-check-circle"></i>
            <p>{{ session('success') }}</p>
        </div>
        <button class="alert-close">&times;</button>
    </div>
    @endif

    <!-- Stock Movement Form -->
    <div class="stock-form-card">
        <h2 class="section-title">
            <i class="fas fa-box-open me-2"></i>Enregistrer un mouvement de stock
        </h2>
        <form action="{{ route('admin.stock.store') }}" method="POST" class="stock-form">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Produit</label>
                    <select name="produit" class="form-select" required>
                        <option value="">-- Choisir un produit --</option>
                        <option value="huile">Huile moteur</option>
                        <option value="essence">Additif essence/diesel</option>
                        <option value="accessoires">Accessoires</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Opération</label>
                    <select name="operation" class="form-select" required>
                        <option value="">-- Choisir une opération --</option>
                        <option value="reception">Réception</option>
                        <option value="vente">Vente</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Quantité</label>
                    <input type="number" name="quantite" class="form-input" step="0.1" min="0.1" placeholder="Ex: 10.5" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Date</label>
                    <input type="date" name="date" class="form-input" required>
                </div>
            </div>
            
            <button type="submit" class="submit-btn">
                <i class="fas fa-plus-circle me-2"></i>Ajouter le mouvement
            </button>
        </form>
    </div>

    <!-- Stock Summary -->
    <div class="stock-summary-card">
        <h2 class="section-title">
            <i class="fas fa-clipboard-list me-2"></i>Résumé du stock
        </h2>
        
        <div class="table-responsive">
            <table class="stock-summary-table">
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Quantité Reçue</th>
                        <th>Quantité Vendue</th>
                        <th>Stock Disponible</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($resume as $produit => $data)
                    <tr>
                        <td class="product-name">{{ ucfirst($produit) }}</td>
                        <td class="text-primary">{{ $data['recu'] }}</td>
                        <td class="text-danger">{{ $data['vendu'] }}</td>
                        <td class="stock-quantity">
                            <span>{{ $data['stock'] }}</span>
                            @if($data['stock'] <= 5)
                                <i class="fas fa-exclamation-triangle low-stock-icon"></i>
                            @endif
                        </td>
                        <td>
                            @if($data['stock'] <= 5)
                                <span class="status-badge danger">Stock faible</span>
                            @elseif($data['stock'] <= 15)
                                <span class="status-badge warning">Stock moyen</span>
                            @else
                                <span class="status-badge success">Stock suffisant</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Movement History -->
    <div class="movement-history-card">
        <div class="history-header">
            <h2 class="section-title">
                <i class="fas fa-history me-2"></i>Historique des mouvements
            </h2>
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Rechercher un produit...">
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="movement-history-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Produit</th>
                        <th>Opération</th>
                        <th>Quantité</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $s)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($s->date)) }}</td>
                        <td class="product-name">{{ ucfirst($s->produit) }}</td>
                        <td>
                            @if($s->operation == 'reception')
                                <span class="operation-badge reception">
                                    <i class="fas fa-arrow-down me-2"></i>Réception
                                </span>
                            @else
                                <span class="operation-badge vente">
                                    <i class="fas fa-arrow-up me-2"></i>Vente
                                </span>
                            @endif
                        </td>
                        <td class="{{ $s->operation == 'vente' ? 'text-danger' : 'text-primary' }}">
                            {{ $s->quantite }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="table-footer">
            <div class="table-info">
                Affichage de <span>1</span> à <span>{{ count($stocks) }}</span> sur <span>{{ count($stocks) }}</span> mouvements
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
        --warning-orange: #fd7e14;
        --text-dark: #343a40;
        --text-light: #6c757d;
    }

    .stock-management {
        padding: 20px;
        background-color: #f5f7fa;
    }

    /* Alert Message */
    .alert {
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .alert-success {
        background-color: rgba(40, 167, 69, 0.1);
        border-left: 4px solid var(--success-green);
    }

    .alert-content {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .alert-success i {
        color: var(--success-green);
        font-size: 1.2rem;
    }

    .alert p {
        margin: 0;
        color: var(--text-dark);
    }

    .alert-close {
        background: none;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        color: var(--text-light);
    }

    /* Form Section */
    .stock-form-card {
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

    .stock-form {
        margin-top: 20px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 25px;
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

    /* Stock Summary */
    .stock-summary-card {
        background-color: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        margin-bottom: 30px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .stock-summary-table {
        width: 100%;
        border-collapse: collapse;
    }

    .stock-summary-table th {
        background-color: var(--light-bg);
        color: var(--text-dark);
        font-weight: 600;
        padding: 15px;
        text-align: left;
        border-bottom: 2px solid #eee;
    }

    .stock-summary-table td {
        padding: 15px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }

    .stock-summary-table tr:hover {
        background-color: rgba(0, 91, 170, 0.03);
    }

    .product-name {
        font-weight: 500;
        color: var(--dark-blue);
    }

    .text-primary {
        color: var(--primary-blue);
        font-weight: 500;
    }

    .text-danger {
        color: var(--danger-red);
        font-weight: 500;
    }

    .stock-quantity {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
    }

    .low-stock-icon {
        color: var(--danger-red);
    }

    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .status-badge.success {
        background-color: rgba(40, 167, 69, 0.1);
        color: var(--success-green);
    }

    .status-badge.warning {
        background-color: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }

    .status-badge.danger {
        background-color: rgba(220, 53, 69, 0.1);
        color: var(--danger-red);
    }

    /* Movement History */
    .movement-history-card {
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

    .movement-history-table {
        width: 100%;
        border-collapse: collapse;
    }

    .movement-history-table th {
        background-color: var(--light-bg);
        color: var(--text-dark);
        font-weight: 600;
        padding: 15px;
        text-align: left;
        border-bottom: 2px solid #eee;
    }

    .movement-history-table td {
        padding: 15px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }

    .movement-history-table tr:hover {
        background-color: rgba(0, 91, 170, 0.03);
    }

    .operation-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
    }

    .operation-badge.reception {
        background-color: rgba(0, 91, 170, 0.1);
        color: var(--primary-blue);
    }

    .operation-badge.vente {
        background-color: rgba(220, 53, 69, 0.1);
        color: var(--danger-red);
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
        .form-grid {
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
    // Search functionality
    document.querySelector('.search-input').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('.movement-history-table tbody tr');
        
        rows.forEach(row => {
            const product = row.querySelector('.product-name').textContent.toLowerCase();
            if (product.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Close alert message
    document.querySelector('.alert-close')?.addEventListener('click', function() {
        this.closest('.alert').style.display = 'none';
    });
</script>
@endsection