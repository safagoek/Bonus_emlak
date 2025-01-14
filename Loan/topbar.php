<style>
.modern-navbar {
    background: linear-gradient(to right, #2E7D32, #43A047);
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 0.8rem 0;
}

.logo-container {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255,255,255,0.1);
    border-radius: 12px;
    transition: all 0.3s ease;
}

.logo-container:hover {
    background: rgba(255,255,255,0.2);
    transform: translateY(-2px);
}

.logo {
    color: white;
    font-size: 1.3rem;
}

.navbar-brand-text {
    font-size: 1.25rem;
    font-weight: 600;
    color: white;
    margin: 0;
    letter-spacing: 0.5px;
}

.user-section {
    display: flex;
    align-items: center;
    padding: 8px 15px;
    background: rgba(255,255,255,0.1);
    border-radius: 25px;
    transition: all 0.3s ease;
}

.user-section:hover {
    background: rgba(255,255,255,0.2);
}

.user-name {
    color: white;
    margin-right: 10px;
    font-weight: 500;
}

.logout-icon {
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(255,255,255,0.1);
    transition: all 0.3s ease;
}

.logout-icon:hover {
    background: rgba(255,255,255,0.2);
    transform: rotate(180deg);
}

@media (max-width: 768px) {
    .navbar-brand-text {
        font-size: 1rem;
    }
    
    .user-section {
        padding: 5px 10px;
    }
    
    .user-name {
        display: none;
    }
}
</style>

<nav class="navbar navbar-expand-lg fixed-top modern-navbar">
    <div class="container-fluid">
        <div class="d-flex align-items-center w-100">
            <!-- Logo -->
            <div class="logo-container me-3">
                <div class="logo">
                    <i class="fa fa-home"></i>
                </div>
            </div>

            <!-- Brand -->
            <div class="flex-grow-1">
                <h1 class="navbar-brand-text">
                    Bonus Emlak Apart Yönetim Sistemi
                </h1>
            </div>

            <!-- User Section -->
            <a href="ajax.php?action=logout" class="text-decoration-none">
                <div class="user-section">
                    <span class="user-name"><?php echo $_SESSION['login_name'] ?></span>
                    <div class="logout-icon">
                        <i class="fa fa-power-off text-white"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</nav>