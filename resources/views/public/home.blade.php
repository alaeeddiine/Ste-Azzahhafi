<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afriquia Service Station - Carburant & Services Auto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #005baa;
            --secondary-orange: #f68b1f;
            --accent-yellow: #ffd100;
            --light-bg: #f8f9fa;
            --dark-blue: #003d7a;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            color: #333;
            overflow-x: hidden;
        }
        
        /* Header & Navigation */
        .top-bar {
            background-color: var(--dark-blue);
            color: white;
            padding: 8px 0;
            font-size: 0.9rem;
        }
        
        .navbar {
            background-color: white !important;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        
        .navbar.scrolled {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }
        
        .navbar-brand {
            font-weight: 700;
            color: var(--primary-blue) !important;
            font-size: 1.5rem;
        }
        
        .navbar-brand img {
            height: 40px;
            transition: all 0.3s;
        }
        
        .nav-link {
            color: var(--dark-blue) !important;
            font-weight: 500;
            margin: 0 8px;
            transition: all 0.3s;
            position: relative;
        }
        
        .nav-link:after {
            content: '';
            position: absolute;
            bottom: 5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--secondary-orange);
            transition: width 0.3s;
        }
        
        .nav-link:hover:after {
            width: 100%;
        }
        
        .nav-link.active {
            color: var(--secondary-orange) !important;
        }
        
        .nav-link.active:after {
            width: 100%;
        }
        
        /* Buttons */
        .btn-primary {
            background-color: var(--primary-blue);
            border-color: var(--primary-blue);
            padding: 10px 25px;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        
        .btn-orange {
            background-color: var(--secondary-orange);
            border-color: var(--secondary-orange);
            color: white;
            padding: 10px 25px;
            font-weight: 500;
            letter-spacing: 0.5px;
            transition: all 0.3s;
        }
        
        .btn-orange:hover {
            background-color: #e07d0d;
            border-color: #e07d0d;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(246, 139, 31, 0.3);
        }
        
        .btn-outline-blue {
            border: 2px solid var(--primary-blue);
            color: var(--primary-blue);
            font-weight: 500;
            transition: all 0.3s;
        }
        
        .btn-outline-blue:hover {
            background-color: var(--primary-blue);
            color: white;
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(0, 59, 122, 0.85), rgba(0, 59, 122, 0.85)), 
                        url('https://www.therollingnotes.com/wp-content/uploads/Photo-Station-Afriquia.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 180px 0 120px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-title {
            font-weight: 700;
            font-size: 3.2rem;
            line-height: 1.2;
            margin-bottom: 20px;
        }
        
        .hero-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 30px;
            max-width: 700px;
        }
        
        /* Price Display */
        .price-display {
            background-color: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
            margin-top: 40px;
            position: relative;
            overflow: hidden;
        }
        
        .price-display:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 100%;
            background: var(--secondary-orange);
        }
        
        .price-header {
            color: var(--primary-blue);
            font-weight: 700;
            margin-bottom: 25px;
            position: relative;
            padding-left: 15px;
        }
        
        .price-header:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 15px;
            width: 50px;
            height: 3px;
            background: var(--accent-yellow);
        }
        
        .price-item {
            border-bottom: 1px solid rgba(0,0,0,0.05);
            padding: 12px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .price-item:last-child {
            border-bottom: none;
        }
        
        .fuel-type {
            font-weight: 600;
            color: var(--primary-blue);
            display: flex;
            align-items: center;
        }
        
        .fuel-icon {
            margin-right: 10px;
            color: var(--secondary-orange);
            font-size: 1.1rem;
        }
        
        .fuel-price {
            font-weight: 700;
            color: var(--secondary-orange);
            font-size: 1.1rem;
        }
        
        /* Sections */
        .section {
            padding: 100px 0;
            position: relative;
        }
        
        .section-title {
            position: relative;
            color: var(--primary-blue);
            font-weight: 700;
            margin-bottom: 50px;
            text-align: center;
        }
        
        .section-title:after {
            content: '';
            position: absolute;
            bottom: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--accent-yellow);
            border-radius: 2px;
        }
        
        .section-subtitle {
            text-align: center;
            max-width: 700px;
            margin: 0 auto 60px;
            color: #666;
        }
        
        /* Services Cards */
        .service-card {
            border: none;
            border-radius: 12px;
            transition: all 0.4s;
            height: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            padding: 30px;
            background: white;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .service-card:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: var(--accent-yellow);
            transition: all 0.4s;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        
        .service-card:hover:before {
            height: 10px;
            background: var(--secondary-orange);
        }
        
        .service-icon {
            font-size: 2.8rem;
            color: var(--primary-blue);
            margin-bottom: 20px;
            transition: all 0.3s;
        }
        
        .service-card:hover .service-icon {
            color: var(--secondary-orange);
            transform: scale(1.1);
        }
        
        .service-card h4 {
            margin-bottom: 15px;
            color: var(--primary-blue);
            transition: all 0.3s;
        }
        
        .service-card:hover h4 {
            color: var(--secondary-orange);
        }
        
        .service-card p {
            color: #666;
            margin-bottom: 0;
        }
        
        /* About Section */
        .about-img {
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            transform: rotate(-2deg);
        }
        
        .about-img img {
            transition: all 0.5s;
        }
        
        .about-img:hover img {
            transform: scale(1.05);
        }
        
        .feature-box {
            display: flex;
            margin-bottom: 25px;
        }
        
        .feature-icon {
            width: 60px;
            height: 60px;
            background: rgba(0, 91, 170, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            color: var(--secondary-orange);
            font-size: 1.5rem;
            flex-shrink: 0;
        }
        
        .feature-content h5 {
            color: var(--primary-blue);
            margin-bottom: 5px;
        }
        
        .feature-content p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0;
        }
        
        /* Price Section */
        .price-card {
            border: none;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: all 0.4s;
            height: 100%;
        }
        
        .price-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        
        .price-card-header {
            background: var(--primary-blue);
            color: white;
            padding: 20px;
            position: relative;
        }
        
        .price-card-header:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 20px;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="%23005baa"/><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="%23005baa"/><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,233.58-87.57V0Z" fill="%23005baa"/></svg>');
            background-size: cover;
        }
        
        .price-table {
            margin-bottom: 0;
        }
        
        .price-table thead th {
            border-bottom: 2px solid rgba(0,0,0,0.05);
            font-weight: 600;
            color: var(--primary-blue);
        }
        
        .price-table tbody tr:last-child td {
            border-bottom: none;
        }
        
        .price-table tbody tr:hover td {
            background: rgba(0, 91, 170, 0.03);
        }
        
        /* Contact Section */
        .contact-info-box {
            background: var(--primary-blue);
            color: white;
            border-radius: 12px;
            padding: 30px;
            height: 100%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }
        
        .contact-info-box:before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transform: translate(50px, -50px);
        }
        
        .contact-info-box h4 {
            color: var(--accent-yellow);
            position: relative;
            margin-bottom: 25px;
            padding-bottom: 15px;
        }
        
        .contact-info-box h4:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--accent-yellow);
        }
        
        .contact-item {
            display: flex;
            margin-bottom: 20px;
        }
        
        .contact-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--accent-yellow);
            flex-shrink: 0;
        }
        
        .contact-text {
            flex-grow: 1;
        }
        
        .contact-text h5 {
            font-size: 1rem;
            margin-bottom: 5px;
        }
        
        .contact-text p {
            font-size: 0.9rem;
            margin-bottom: 0;
            opacity: 0.9;
        }
        
        .contact-form {
            background-color: white;
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            height: 100%;
        }
        
        .form-control {
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        
        .form-control:focus {
            border-color: var(--primary-blue);
            box-shadow: 0 0 0 0.25rem rgba(0, 91, 170, 0.25);
        }
        
        /* Map Section */
        .map-container {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0,0,0,0.1);
            border: none;
            height: 450px;
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--dark-blue), var(--primary-blue));
            color: white;
            padding: 80px 0 30px;
            position: relative;
        }
        
        .footer:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 20px;
            background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="white"/><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" fill="white"/><path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,233.58-87.57V0Z" fill="white"/></svg>');
            background-size: cover;
            transform: rotate(180deg);
        }
        
        .footer-logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: white;
            margin-bottom: 20px;
            display: inline-block;
        }
        
        .footer-about {
            margin-bottom: 20px;
        }
        
        .footer-links h5 {
            color: var(--accent-yellow);
            margin-bottom: 25px;
            font-size: 1.2rem;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-links h5:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: rgba(255, 255, 255, 0.3);
        }
        
        .footer-links ul {
            list-style: none;
            padding: 0;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s;
            display: inline-block;
        }
        
        .footer-links a:hover {
            color: var(--accent-yellow);
            transform: translateX(5px);
        }
        
        .social-links {
            display: flex;
            margin-top: 20px;
        }
        
        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            transition: all 0.3s;
            color: white;
        }
        
        .social-icon:hover {
            background: var(--accent-yellow);
            color: var(--primary-blue);
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            border-top: 1px solid rgba(255,255,255,0.1);
            padding-top: 20px;
            margin-top: 40px;
        }
        
        /* Promo Banner */
        .promo-banner {
            background: linear-gradient(90deg, var(--secondary-orange), #ff9e43);
            color: white;
            padding: 12px 0;
            font-weight: 500;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .promo-banner .container {
            position: relative;
            z-index: 2;
        }
        
        .promo-banner:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 L0,100 Z" fill="none" stroke="rgba(255,255,255,0.2)" stroke-width="2" stroke-dasharray="5,5"/></svg>');
            opacity: 0.3;
        }
        
        /* Back to top button */
        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            display: none;
            background-color: var(--secondary-orange);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            color: white;
            z-index: 99;
            transition: all 0.3s;
            box-shadow: 0 5px 20px rgba(246, 139, 31, 0.3);
            
        }

        .back-to-top i {
            width: 100%;
            height: 100%;
            font-size: 1.2rem;
            
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate {
            animation: fadeInUp 0.6s ease forwards;
        }
        
        .delay-1 {
            animation-delay: 0.2s;
        }
        
        .delay-2 {
            animation-delay: 0.4s;
        }
        
        .delay-3 {
            animation-delay: 0.6s;
        }
        
        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .section {
                padding: 70px 0;
            }
        }
        
        @media (max-width: 767.98px) {
            .hero-section {
                padding: 120px 0 80px;
                background-attachment: scroll;
            }
            
            .hero-title {
                font-size: 2rem;
            }
            
            .section {
                padding: 50px 0;
            }
        }
    </style>
</head>
<body>
    <!-- Promo Banner -->
    <div class="promo-banner">
        <div class="container">
            <i class="fas fa-gas-pump me-2"></i> Promotion spéciale : Lavage auto complet à -20% cette semaine seulement !
        </div>
    </div>

    <!-- Top Bar -->
    <div class="top-bar d-none d-md-block">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <i class="fas fa-phone-alt me-2"></i> +212 6 12 34 56 78
                <i class="fas fa-map-marker-alt ms-3 me-2"></i> Ben Tayeb, Driouch
            </div>
            <div>
                <span class="me-3"><i class="fas fa-clock me-2"></i> Ouvert 24h/24</span>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="images\logo.png" alt="Afriquia Logo" class="me-2">
                Sté Azzahhafi
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="#home">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">À propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#prices">Tarifs</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 animate">
                    <h1 class="hero-title">Votre Station-Service de confiance à Ben Tayeb</h1>
                    <p class="hero-subtitle">Carburants de qualité supérieure et services automobiles professionnels disponibles 24h/24 pour vos besoins quotidiens et vos voyages.</p>
                    <div class="d-flex gap-3">
                        <a href="#services" class="btn btn-orange btn-lg">
                            <i class="fas fa-gas-pump me-2"></i> Nos Services
                        </a>
                        <a href="#contact" class="btn btn-outline-blue btn-lg text-white border-white">
                            <i class="fas fa-phone me-2"></i> Nous contacter
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 animate delay-1">
                    <div class="price-display">
                        <h4 class="price-header">Nos Prix du Jour</h4>
                        
                        <div class="price-item">
                            <span class="fuel-type">
                                <i class="fas fa-gas-pump fuel-icon"></i> Essence Sans Plomb
                            </span>
                            <span class="fuel-price">11.50 DH/L</span>
                        </div>
                        
                        <div class="price-item">
                            <span class="fuel-type">
                                <i class="fas fa-truck fuel-icon"></i> Gazole
                            </span>
                            <span class="fuel-price">10.67 DH/L</span>
                        </div>
                        <div class="price-item">
                            <span class="fuel-type">
                                <i class="fas fa-fire fuel-icon"></i> Lavage Complet (promo -20%)
                            </span>
                            <span class="fuel-price">56 DH</span>
                        </div>
                        
                        <div class="text-end mt-3">
                            <small class="text-muted">Mise à jour: 19/05/2025 - 08:00</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="section bg-light">
        <div class="container">
            <h2 class="section-title animate">Nos Services</h2>
            <p class="section-subtitle animate delay-1">Découvrez notre gamme complète de services de qualité pour votre véhicule</p>
            
            <div class="row g-4">
                <div class="col-md-6 col-lg-3 animate delay-1">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-gas-pump"></i>
                        </div>
                        <h4>Carburant 24h/24</h4>
                        <p>Essence et diesel de qualité supérieure disponibles à toute heure avec des systèmes de paiement sécurisés.</p>
                        <a href="#prices" class="text-primary text-decoration-none mt-3 d-inline-block">Voir les prix <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3 animate delay-2">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <h4>Lavage Auto</h4>
                        <p>Lavage intérieur et extérieur professionnel avec produits haut de gamme pour un résultat impeccable.</p>
                        <a href="#prices" class="text-primary text-decoration-none mt-3 d-inline-block">Voir les tarifs <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3 animate delay-1">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-tools"></i>
                        </div>
                        <h4>Entretien Rapide</h4>
                        <p>Vidange, contrôle des niveaux, diagnostics express réalisés par nos techniciens certifiés.</p>
                        <a href="#contact" class="text-primary text-decoration-none mt-3 d-inline-block">Prendre RDV <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
                
                <div class="col-md-6 col-lg-3 animate delay-2">
                    <div class="service-card">
                        <div class="service-icon">
                            <i class="fas fa-store"></i>
                        </div>
                        <h4>Boutique & Café</h4>
                        <p>Produits frais, boissons chaudes, snacks et articles de voyage pour vos trajets.</p>
                        <a href="#about" class="text-primary text-decoration-none mt-3 d-inline-block">En savoir plus <i class="fas fa-arrow-right ms-2"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 animate">
                    <div class="about-img">
                        <img src="images\station.jpg" 
                             class="img-fluid" alt="Notre station">
                    </div><br>
                    <div class="about-img">
                        <img src="images\carousel4.jpg" 
                             class="img-fluid" alt="Notre station">
                    </div>
                </div>
                <div class="col-lg-6 animate delay-1">
                    <h2 class="section-title text-start">À propos de notre station</h2>
                    <p class="mb-4">Sté Azzahhafi, Ben Tayeb est un établissement moderne et convivial, offrant des produits pétroliers de qualité et une gamme complète de services automobiles depuis 1999 fondé par Lhaj Ahmed Azzahhafi.</p>
                    <p class="mb-5">Notre équipe de professionnels expérimentés est formée pour vous conseiller et vous offrir le meilleur service possible, 24 heures sur 24 et 7 jours sur 7, dans un environnement sécurisé et propre.</p>
                    
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Qualité certifiée</h5>
                            <p>Produits pétroliers contrôlés et certifiés selon les normes internationales</p>
                        </div>
                    </div>
                    
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Disponibilité permanente</h5>
                            <p>Ouvert 24h/24 et 7j/7 pour répondre à tous vos besoins</p>
                        </div>
                    </div>
                    
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-user-shield"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Sécurité optimale</h5>
                            <p>Installations aux normes avec personnel formé aux procédures de sécurité</p>
                        </div>
                    </div>
                    
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-smile"></i>
                        </div>
                        <div class="feature-content">
                            <h5>Service convivial</h5>
                            <p>Accueil chaleureux et service personnalisé pour chaque client</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Price Section -->
    <section id="prices" class="section bg-light">
        <div class="container">
            <h2 class="section-title animate">Nos Tarifs</h2>
            <p class="section-subtitle animate delay-1">Des prix compétitifs pour des services et produits de qualité</p>
            
            <div class="row mt-4">
                <div class="col-md-6 mb-4 animate delay-1">
                    <div class="price-card">
                        <div class="price-card-header">
                            <h4 class="mb-0"><i class="fas fa-gas-pump me-2"></i> Carburants</h4>
                        </div>
                        <div class="card-body">
                            <table class="table price-table">
                                <thead>
                                    <tr>
                                        <th>Produit</th>
                                        <th class="text-end">Prix (DH/L)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Essence Sans Plomb</td>
                                        <td class="text-end">11.50</td>
                                    </tr>
                                    <tr>
                                        <td>Gazole</td>
                                        <td class="text-end">10.67</td>
                                    </tr>
                                    <tr>
                                        <td>Les Produits d'Entretien</td>
                                        <td class="text-end"></td>
                                    </tr>
                                    <tr>
                                        <td>Les Accessoires Automobile</td>
                                        <td class="text-end"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-4 animate delay-2">
                    <div class="price-card">
                        <div class="price-card-header">
                            <h4 class="mb-0"><i class="fas fa-car me-2"></i> Services Auto</h4>
                        </div>
                        <div class="card-body">
                            <table class="table price-table">
                                <thead>
                                    <tr>
                                        <th>Service</th>
                                        <th class="text-end">Prix (DH)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Lavage extérieur</td>
                                        <td class="text-end">40.00</td>
                                    </tr>
                                    <tr>
                                        <td>Lavage intérieur/extérieur</td>
                                        <td class="text-end">70.00</td>
                                    </tr>
                                    <tr>
                                        <td>Lavage complet (promo)</td>
                                        <td class="text-end"><strong>56.00</strong> <small class="text-danger"><s>70.00</s></small></td>
                                    </tr>
                                    <tr>
                                        <td>Vidange standard</td>
                                        <td class="text-end">250.00</td>
                                    </tr>
                                    <tr>
                                        <td>Contrôle des niveaux</td>
                                        <td class="text-end">Gratuit</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="payment-methods mt-3 pt-3 border-top text-center">
                <p class="small text-muted mb-3">Modes de paiement acceptés :</p>
                <div class="d-flex justify-content-center align-items-center gap-4">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5e/Visa_Inc._logo.svg/2560px-Visa_Inc._logo.svg.png" alt="Visa" style="height: 24px; width: auto;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png" alt="Mastercard" style="height: 24px; width: auto;">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/2560px-PayPal.svg.png" alt="PayPal" style="height: 24px; width: auto;">
                    <img src="https://logos-world.net/wp-content/uploads/2022/03/Apple-Pay-Logo.png" alt="Apple Pay" style="height: 24px; width: auto;">
                </div>
            </div>
            <div class="text-center mt-4 animate delay-2">
                <p class="mb-4">Nos prix sont mis à jour quotidiennement pour refléter les fluctuations du marché.</p>
                <a href="#contact" class="btn btn-orange btn-lg">
                    <i class="fas fa-question-circle me-2"></i> Demander plus d'informations
                </a>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section">
        <div class="container">
            <h2 class="section-title animate">Contactez-nous</h2>
            <p class="section-subtitle animate delay-1">Nous sommes à votre disposition pour toute question ou demande de renseignement</p>
            
            <div class="row mt-5">
                <div class="col-lg-5 mb-4 mb-lg-0 animate delay-1">
                    <div class="contact-info-box">
                        <h4><i class="far fa-clock me-2"></i> Heures d'ouverture</h4>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="far fa-calendar-alt"></i>
                            </div>
                            <div class="contact-text">
                                <h5>Lundi - Dimanche</h5>
                                <p>Ouvert 24h/24</p>
                            </div>
                        </div>
                        
                        <h4 class="mt-5"><i class="fas fa-map-marker-alt me-2"></i> Localisation</h4>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-pin"></i>
                            </div>
                            <div class="contact-text">
                                <h5>Adresse</h5>
                                <p>Place Mohamed 5, Ben Tayeb, Driouch</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <div class="contact-text">
                                <h5>Téléphone</h5>
                                <p>+212 6 12 34 56 78</p>
                            </div>
                        </div>
                        
                        <div class="contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-text">
                                <h5>Email</h5>
                                <p>contact@afriquia-station.com</p>
                            </div>
                        </div>
                        
                        <div class="social-links mt-4">
                            <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-7 animate delay-2">
                    <div class="contact-form">
                        <h4 class="mb-4">Envoyez-nous un message</h4>
                        
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Votre nom *</label>
                                        <input type="text" class="form-control" id="name" placeholder="Votre nom complet" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Téléphone *</label>
                                        <input type="tel" class="form-control" id="phone" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="exemple@email.com">
                            </div>
                            
                            <div class="mb-3">
                                <label for="subject" class="form-label">Sujet</label>
                                <select class="form-select" id="subject">
                                    <option selected>Choisissez un sujet</option>
                                    <option>Demande d'information</option>
                                    <option>Réclamation</option>
                                    <option>Demande de partenariat</option>
                                    <option>Autre</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="message" class="form-label">Votre message *</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Décrivez votre demande..." required></textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-orange px-4">
                                <i class="fas fa-paper-plane me-2"></i> Envoyer le message
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="section pt-0 pb-5">
        <div class="container animate">
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3311.2688457653287!2d-3.456402!3d35.0442293!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd766700443b1a63%3A0xcf34ed60217a222e!2sStation%20Afriquia%20Azzahhafi!5e0!3m2!1sfr!2sma!4v1716039448401!5m2!1sfr!2sma" 
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0">
                    <a href="#" class="footer-logo">
                        <img src="images\logo.png" alt="Afriquia Logo" height="40" class="me-2"> Sté Azzahhafi
                    </a>
                    <div class="footer-about">
                        <p>Votre station-service de confiance à Ben Tayeb, offrant des carburants de qualité et des services automobiles professionnels depuis 1999.</p>
                    </div>
                    <div class="social-links">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-4 mb-4 mb-md-0">
                    <div class="footer-links">
                        <h5>Navigation</h5>
                        <ul>
                            <li><a href="#home">Accueil</a></li>
                            <li><a href="#services">Services</a></li>
                            <li><a href="#about">À propos</a></li>
                            <li><a href="#prices">Tarifs</a></li>
                            <li><a href="#contact">Contact</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4 mb-4 mb-md-0">
                    <div class="footer-links">
                        <h5>Services</h5>
                        <ul>
                            <li><a href="#prices">Carburants</a></li>
                            <li><a href="#prices">Lavage auto</a></li>
                            <li><a href="#prices">Entretien</a></li>
                            <li><a href="#services">Boutique</a></li>
                            <li><a href="#services">Promotions</a></li>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-3 col-md-4">
                    <div class="footer-links">
                        <h5>Contact</h5>
                        <ul>
                            <li><i class="fas fa-map-marker-alt me-2"></i> Ben Tayeb, Driouch</li>
                            <li><i class="fas fa-phone me-2"></i> +212 6 12 34 56 78</li>
                            <li><i class="fas fa-envelope me-2"></i> contact@afriquia-station.com</li>
                            <li><i class="fas fa-clock me-2"></i> Ouvert 24h/24, 7j/7</li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <p class="small mb-0">&copy; 2025 Station Afriquia Ben Tayeb. Tous droits réservés.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="small mb-0">
                            <a href="#" class="text-white">Mentions légales</a> | 
                            <a href="#" class="text-white">Politique de confidentialité</a> | 
                            <a href="#" class="text-white">Conditions générales</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button class="back-to-top">
        <i class="fas fa-arrow-up d-flex justify-content-center align-items-center"></i>
    </button>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Back to top button
        window.addEventListener('scroll', function() {
            var backToTop = document.querySelector('.back-to-top');
            var navbar = document.querySelector('.navbar');
            
            if (window.pageYOffset > 300) {
                backToTop.style.display = 'flex';
                navbar.classList.add('scrolled');
            } else {
                backToTop.style.display = 'none';
                navbar.classList.remove('scrolled');
            }
        });
        
        document.querySelector('.back-to-top').addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        
        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
        
        // Animation on scroll
        function animateOnScroll() {
            const elements = document.querySelectorAll('.animate');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.2;
                
                if(elementPosition < screenPosition) {
                    element.style.opacity = '1';
                }
            });
        }
        
        window.addEventListener('load', animateOnScroll);
        window.addEventListener('scroll', animateOnScroll);
        
        // Active nav link on scroll
        const sections = document.querySelectorAll('section');
        const navLinks = document.querySelectorAll('.nav-link');
        
        window.addEventListener('scroll', () => {
            let current = '';
            
            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;
                
                if(pageYOffset >= (sectionTop - 100)) {
                    current = section.getAttribute('id');
                }
            });
            
            navLinks.forEach(link => {
                link.classList.remove('active');
                if(link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>