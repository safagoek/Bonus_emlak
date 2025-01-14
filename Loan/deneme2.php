<?php
// Veritabanı bağlantısı
$host = 'localhost';
$db = 'loan_db';
$user = 'root'; 
$pass = ''; 
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Veritabanı Bağlantı Hatası: " . $e->getMessage());
}

// Analiz sorguları
$queries = [
    'total_borrowers' => "SELECT COUNT(*) AS total FROM borrowers",
    'total_houses' => "SELECT COUNT(*) AS total FROM house",
    'total_payments_monthly' => "SELECT COALESCE(SUM(amount), 0) AS total FROM payments WHERE MONTH(date_created) = MONTH(CURRENT_DATE()) AND YEAR(date_created) = YEAR(CURRENT_DATE())",
    'today_payments' => "SELECT COALESCE(SUM(amount), 0) AS total FROM payments WHERE DATE(date_created) = CURRENT_DATE()",
    'active_loans' => "SELECT COUNT(*) AS total FROM loan_list WHERE status = 2",
    'active_loan_types' => "SELECT COUNT(DISTINCT loan_type_id) AS total FROM loan_list WHERE status = 2",
    'maintenance_requests' => "SELECT COUNT(*) AS total FROM maintenance_requests"
];

$stats = [];
foreach ($queries as $key => $sql) {
    $stmt = $pdo->query($sql);
    $stats[$key] = $stmt->fetch()['total'];
}

// Yaklaşan ödemeler
$upcoming_payments_sql = "SELECT 
    ls.loan_id, ls.date_due, ll.ref_no,
    b.firstname, b.lastname,
    ll.amount AS total_loan_amount,
    lp.months AS loan_duration,
    lp.interest_percentage
FROM 
    loan_schedules ls
JOIN loan_list ll ON ls.loan_id = ll.id
JOIN borrowers b ON ll.borrower_id = b.id
JOIN loan_plan lp ON ll.plan_id = lp.id
WHERE 
    ls.date_due BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 3 MONTH)
    AND ls.id NOT IN (SELECT loan_id FROM payments)
ORDER BY ls.date_due ASC
LIMIT 10";
$upcoming_payments = $pdo->query($upcoming_payments_sql);

// Son 5 ödeme
$last_payments_sql = "SELECT 
    p.id, p.amount, p.date_created,
    b.firstname, b.lastname,
    ll.ref_no, p.penalty_amount
FROM 
    payments p
JOIN loan_list ll ON p.loan_id = ll.id
JOIN borrowers b ON ll.borrower_id = b.id
ORDER BY p.date_created DESC
LIMIT 5";
$last_payments = $pdo->query($last_payments_sql);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kredi Yönetim Sistemi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
        }
        .card-custom {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .card-custom:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 15px rgba(0,0,0,0.2);
        }
        .table-hover tbody tr:hover {
            background-color: rgba(0,0,0,0.075);
        }
    </style>
</head>
<body>
<div class="container-fluid px-4 py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="display-6 text-center mb-4">
                <i class="bi bi-graph-up"></i> Apartman Yönetim Paneli
            </h1>
        </div>
    </div>

    <!-- İstatistik Kartları -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card card-custom bg-primary text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Toplam Borçlu</h5>
                        <p class="display-6"><?= $stats['total_borrowers'] ?></p>
                    </div>
                    <i class="bi bi-people-fill fs-2"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom bg-success text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Toplam Ev</h5>
                        <p class="display-6"><?= $stats['total_houses'] ?></p>
                    </div>
                    <i class="bi bi-house-fill fs-2"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom bg-warning text-dark">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Aylık Ödemeler</h5>
                        <p class="display-6"><?= number_format($stats['total_payments_monthly'], 2) ?> TL</p>
                    </div>
                    <i class="bi bi-currency-dollar fs-2"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom bg-info text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Bugünkü Ödemeler</h5>
                        <p class="display-6"><?= number_format($stats['today_payments'], 2) ?> TL</p>
                    </div>
                    <i class="bi bi-calendar-check fs-2"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom bg-secondary text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Aktif Sözleşmeler</h5>
                        <p class="display-6"><?= $stats['active_loans'] ?></p>
                    </div>
                    <i class="bi bi-credit-card fs-2"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom bg-dark text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Ev Tipi Çeşitliliği</h5>
                        <p class="display-6"><?= $stats['active_loan_types'] ?></p>
                    </div>
                    <i class="bi bi-stack fs-2"></i>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card card-custom bg-danger text-white">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Bakım Talepleri</h5>
                        <p class="display-6"><?= $stats['maintenance_requests'] ?></p>
                    </div>
                    <i class="bi bi-tools fs-2"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Tablo Bölümü -->
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="bi bi-clock-history"></i> Yaklaşan Ödemeler
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Borçlu</th>
                                <th>Ödeme Tarihi</th>
                                <th>Miktar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $upcoming_payments->fetch()): ?>
                            <tr>
                                <td><?= $row['firstname'] . ' ' . $row['lastname'] ?></td>
                                <td><?= $row['date_due'] ?></td>
                                <td><?= number_format($row['total_loan_amount'], 2) ?> TL</td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="bi bi-cash-stack"></i> Son Ödemeler
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Borçlu</th>
                                <th>Tarih</th>
                                <th>Miktar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row = $last_payments->fetch()): ?>
                            <tr>
                                <td><?= $row['firstname'] . ' ' . $row['lastname'] ?></td>
                                <td><?= $row['date_created'] ?></td>
                                <td><?= number_format($row['amount'], 2) ?> TL</td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>