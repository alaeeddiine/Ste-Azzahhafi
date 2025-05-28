@extends('admin.layout')

@section('title', 'Gestion des Employés')

@section('content')
<div class="employee-management">
    <!-- Add Employee Form -->
    <div class="employee-form-section">
        <div class="form-card">
            <h2 class="section-title">
                <i class="fas fa-user-plus me-2"></i>Ajouter un employé
            </h2>
            <form method="POST" action="{{ route('employes.store') }}" class="employee-form">
                @csrf
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Nom complet</label>
                        <input name="nom" class="form-input" placeholder="Nom complet" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Âge</label>
                        <input name="age" type="number" class="form-input" placeholder="Âge" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Salaire (MAD)</label>
                        <input name="salaire" type="number" step="0.01" class="form-input" placeholder="Salaire" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Poste</label>
                        <select name="poste" class="form-select" required>
                            <option value="" disabled selected>Choisissez un poste</option>
                            <option value="Pompiste">Pompiste</option>
                            <option value="Lavage">Lavage</option>
                            <option value="Caissier">Caissier</option>
                            <option value="Chef de station">Chef de station</option>
                            <option value="Maintenance">Maintenance</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Date d'embauche</label>
                        <input name="date_embauche" type="date" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Heure de début</label>
                        <input type="time" name="horaire_debut" class="form-input" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Heure de fin</label>
                        <input type="time" name="horaire_fin" class="form-input" required>
                    </div>
                </div>
                
                <button type="submit" class="submit-btn">
                    <i class="fas fa-save me-2"></i>Ajouter l'employé
                </button>
            </form>
        </div>
    </div>

    <!-- Employees Table -->
    <div class="employee-table-section">
        <div class="table-header">
            <h2 class="section-title">
                <i class="fas fa-users me-2"></i>Liste des employés
            </h2>
            <div class="search-box">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Rechercher un employé...">
            </div>
        </div>
        
        <div class="table-responsive">
            <table class="employee-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Âge</th>
                        <th>Salaire</th>
                        <th>Poste</th>
                        <th>Embauche</th>
                        <th>Horaires</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employes as $e)
                    <tr>
                        <td>
                            <div class="employee-info">
                                <div class="employee-avatar">
                                    {{ strtoupper(substr($e->nom, 0, 1)) }}
                                </div>
                                <span class="employee-name">{{ $e->nom }}</span>
                            </div>
                        </td>
                        <td>{{ $e->age }} ans</td>
                        <td class="text-primary">{{ number_format($e->salaire, 2) }} MAD</td>
                        <td>
                            <span class="badge {{ $e->poste == 'Chef de station' ? 'badge-warning' : 'badge-info' }}">
                                {{ $e->poste }}
                            </span>
                        </td>
                        <td>{{ date('d/m/Y', strtotime($e->date_embauche)) }}</td>
                        <td>{{ $e->horaire_debut }} - {{ $e->horaire_fin }}</td>
                        <td>
                            <span class="status-badge active">Actif</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="#" class="edit-btn" title="Modifier">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('employes.destroy', $e) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet employé ?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="delete-btn" title="Supprimer">
                                        <i class="fas fa-user-times"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="table-footer">
            <div class="table-info">
                Affichage de <span>1</span> à <span>{{ count($employes) }}</span> sur <span>{{ count($employes) }}</span> employés
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

    .employee-management {
        padding: 20px;
        background-color: #f5f7fa;
    }

    /* Form Section */
    .employee-form-section {
        margin-bottom: 30px;
    }

    .form-card {
        background-color: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .section-title {
        color: var(--dark-blue);
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    .employee-form {
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

    /* Table Section */
    .employee-table-section {
        background-color: white;
        border-radius: 12px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .table-header {
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

    .employee-table {
        width: 100%;
        border-collapse: collapse;
    }

    .employee-table th {
        background-color: var(--light-bg);
        color: var(--text-dark);
        font-weight: 600;
        padding: 15px;
        text-align: left;
        border-bottom: 2px solid #eee;
    }

    .employee-table td {
        padding: 15px;
        border-bottom: 1px solid #eee;
        vertical-align: middle;
    }

    .employee-table tr:hover {
        background-color: rgba(0, 91, 170, 0.03);
    }

    .employee-info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .employee-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: var(--primary-blue);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }

    .employee-name {
        font-weight: 500;
    }

    .badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .badge-info {
        background-color: rgba(0, 91, 170, 0.1);
        color: var(--primary-blue);
    }

    .badge-warning {
        background-color: rgba(255, 209, 0, 0.2);
        color: #856404;
    }

    .status-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .status-badge.active {
        background-color: rgba(40, 167, 69, 0.1);
        color: var(--success-green);
    }

    .action-buttons {
        display: flex;
        gap: 10px;
    }

    .edit-btn, .delete-btn {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
    }

    .edit-btn {
        background-color: rgba(0, 91, 170, 0.1);
        color: var(--primary-blue);
    }

    .edit-btn:hover {
        background-color: rgba(0, 91, 170, 0.2);
    }

    .delete-btn {
        background-color: rgba(220, 53, 69, 0.1);
        color: var(--danger-red);
    }

    .delete-btn:hover {
        background-color: rgba(220, 53, 69, 0.2);
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
        
        .table-header {
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
        const rows = document.querySelectorAll('.employee-table tbody tr');
         
        rows.forEach(row => {
            const name = row.querySelector('.employee-name').textContent.toLowerCase();
            const position = row.querySelector('.badge').textContent.toLowerCase();
            
            if (name.includes(searchTerm) || position.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection