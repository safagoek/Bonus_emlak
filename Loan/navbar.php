<style>
    .modern-sidebar {
        background: linear-gradient(135deg, #1b4332, #52b788);
        /* Koyu yeşilden açık yeşile */
        min-height: 100vh;
        padding-top: 15px;
        box-shadow: 3px 0 15px rgba(0, 0, 0, 0.2);
        width: 250px;
    }

    .sidebar-list {
        padding: 0 10px;
    }

    .nav-item {
        display: flex;
        align-items: center;
        padding: 10px 15px;
        margin: 5px 0;
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        border-radius: 8px;
        transition: all 0.3s ease;
        font-weight: 500;
        font-size: 0.9rem;
    }

    .nav-item:hover {
        background: #2d6a4f;
        /* Hover rengi */
        transform: translateX(5px);
        color: #fff;
    }

    .icon-field {
        display: flex;
        align-items: center;
        margin-right: 10px;
        width: 20px;
        height: 20px;
        justify-content: center;
    }

    .icon-field i {
        font-size: 1rem;
    }

    .active {
        background: #95d5b2;
        /* Aktif menü öğesi rengi */
        color: #081c15;
        /* Aktif menü yazı rengi */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    @media (max-width: 768px) {
        .modern-sidebar {
            width: 60px;
        }

        .nav-item span:not(.icon-field) {
            display: none;
        }

        .icon-field {
            margin-right: 0;
        }
    }
</style>

<nav id="sidebar" class="modern-sidebar">
    <div class="sidebar-list">
        <a href="index.php?page=home" class="nav-item nav-home">
            <span class='icon-field'><i class="fa fa-home"></i></span>
            <span>Ana Sayfa</span>
        </a>
        <a href="index.php?page=loans" class="nav-item nav-loans">
            <span class='icon-field'><i class="fa fa-file-invoice-dollar"></i></span>
            <span>Sözleşmeler</span>
        </a>
        <a href="index.php?page=deneme" class="nav-item nav-plan" >
            <span class='icon-field'><i class="fa fa-list-alt"></i></span>
            <span>Arıza</span>
        </a>
        <a href="index.php?page=deneme2" class="nav-item nav-plan" >
            <span class='icon-field'><i class="fa fa-list-alt"></i></span>
            <span>Dashboard</span>
        </a>
        <a href="index.php?page=houses" class="nav-item nav-house">
            <span class='icon-field'><i class="fa fa-file-invoice-dollar"></i></span>
            <span>Evler</span>
        </a>
        <a href="index.php?page=payments" class="nav-item nav-payments">
            <span class='icon-field'><i class="fa fa-money-bill"></i></span>
            <span>Ödemeler</span>
        </a>
        <a href="index.php?page=borrowers" class="nav-item nav-borrowers">
            <span class='icon-field'><i class="fa fa-user-friends"></i></span>
            <span>Kiracılar</span>
        </a>
        <a href="index.php?page=plan" class="nav-item nav-plan">
            <span class='icon-field'><i class="fa fa-list-alt"></i></span>
            <span>Ödeme Planları</span>
        </a>

        <a href="index.php?page=loan_type" class="nav-item nav-loan_type">
            <span class='icon-field'><i class="fa fa-th-list"></i></span>
            <span>Ev Tipleri</span>
        </a>
        <a href="index.php?page=deneme3" class="nav-item nav-plan" >
            <span class='icon-field'><i class="fa fa-list-alt"></i></span>
            <span>Dosyalar</span>
        </a>
        <?php if($_SESSION['login_type'] == 1): ?>
        <a href="index.php?page=users" class="nav-item nav-users">
            <span class='icon-field'><i class="fa fa-users"></i></span>
            <span>Kullanıcılar</span>
        </a>
        <?php endif; ?>
    </div>
</nav>

<script>
    $(document).ready(function() {
        $('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active');
    });
</script>