<header>
    <nav class="navbar">
        <div class="container">
            <a href="#" class="logo">
                <img src="{{ asset('images/logo.jpg') }}" alt="Novis Togo" class="logo-img">
                <span class="logo-text">Novis Togo</span>
            </a>
            <div class="menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
            <ul class="nav-menu">
                <li><a href="#accueil" class="active">Accueil</a></li>
                <li><a href="#apropos">À propos</a></li>
                <li><a href="#missions">Nos missions</a></li>
                <li><a href="#projets">Projets</a></li>
                <li><a href="#temoignages">Témoignages</a></li>
                <li><a href="#contact">Contact</a></li>
                <li><a href="#blog">Blog</a></li>
                <li><a href="#donation" class="btn-donate">Faire un don</a></li>
            </ul>
        </div>
    </nav>
    <style>
        .logo {
            display: flex;
            align-items: center;
        }
        .logo-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--primary-color);
            margin-right: 10px;
        }
        .logo-text {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
        }
    </style>
</header>