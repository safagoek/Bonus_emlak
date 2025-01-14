<?php
// Hata raporlamayı aktif et
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Veritabanı bağlantısı
$host = '127.0.0.1';
$db = 'loan_db';
$user = 'root'; 
$pass = ''; 
$charset = 'utf8mb4';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    die("Veritabanı Bağlantı Hatası: " . $e->getMessage());
}

// Mesaj değişkeni
$message = '';

// Yeni Bakım Talebi Ekleme
if(isset($_POST['submit_maintenance'])) {
    try {
        $property_id = $_POST['property_id'];
        $borrower_id = $_POST['borrower_id'];
        $issue = $_POST['issue'];
        $priority = $_POST['priority'];
        $status = $_POST['status'];

        $sql = "INSERT INTO maintenance_requests 
                (property_id, borrower_id, issue_description, priority, status, request_date) 
                VALUES (:property_id, :borrower_id, :issue, :priority, :status, NOW())";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindParam(':property_id', $property_id, PDO::PARAM_INT);
        $stmt->bindParam(':borrower_id', $borrower_id, PDO::PARAM_INT);
        $stmt->bindParam(':issue', $issue, PDO::PARAM_STR);
        $stmt->bindParam(':priority', $priority, PDO::PARAM_STR);
        $stmt->bindParam(':status', $status, PDO::PARAM_STR);

        if($stmt->execute()) {
            $message = '<div class="alert alert-success">Bakım talebi başarıyla eklendi.</div>';
        }
    } catch (PDOException $e) {
        $message = '<div class="alert alert-danger">Hata: ' . $e->getMessage() . '</div>';
    }
}

// Bakım Talebi Güncelleme
if(isset($_POST['update'])) {
    try {
        // Giriş doğrulaması
        $required_fields = ['request_id', 'edit_priority', 'edit_status', 'edit_issue'];
        foreach($required_fields as $field) {
            if(empty($_POST[$field])) {
                throw new Exception("Lütfen tüm alanları doldurunuz.");
            }
        }

        $id = $_POST['request_id'];
        $priority = $_POST['edit_priority'];
        $status = $_POST['edit_status'];
        $issue = $_POST['edit_issue'];

        $sql = "UPDATE maintenance_requests 
                SET priority = :priority, 
                    status = :status, 
                    issue_description = :issue,
                    completion_date = CASE WHEN status = 'completed' THEN NOW() ELSE completion_date END
                WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        
        $stmt->bindValue(':priority', $priority, PDO::PARAM_STR);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':issue', $issue, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        if($stmt->execute()) {
            $message = '<div class="alert alert-success">Bakım talebi başarıyla güncellendi.</div>';
        }
    } catch (Exception $e) {
        $message = '<div class="alert alert-danger">Hata: ' . $e->getMessage() . '</div>';
    } catch (PDOException $e) {
        $message = '<div class="alert alert-danger">Veritabanı Hatası: ' . $e->getMessage() . '</div>';
    }
}

// Listeleri çek
$houses = $pdo->query("SELECT id, address, owner_name FROM house ORDER BY id DESC")->fetchAll();
$borrowers = $pdo->query("SELECT id, firstname, lastname FROM borrowers ORDER BY id DESC")->fetchAll();

// Bakım Talepleri Listesi
$maintenance_requests = $pdo->query("
    SELECT m.*, h.address, h.owner_name, b.firstname, b.lastname 
    FROM maintenance_requests m 
    LEFT JOIN house h ON m.property_id = h.id 
    LEFT JOIN borrowers b ON m.borrower_id = b.id 
    ORDER BY m.request_date DESC
")->fetchAll();
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bakım Talepleri Yönetimi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f4f6f9; }
        .card { 
            margin-bottom: 20px; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
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
                <i class="bi bi-tools"></i> Bakım Talepleri Yönetimi
            </h1>
        </div>
    </div>

    <?php echo $message; ?>

    <div class="row">
        <!-- Yeni Bakım Talebi Ekleme Formu -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="bi bi-plus-circle"></i> Yeni Bakım Talebi</h3>
                </div>
                <div class="card-body">
                    <form method="post" id="maintenanceForm">
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-house"></i> Ev Seçin</label>
                            <select name="property_id" class="form-select" required>
                                <option value="">Seçiniz...</option>
                                <?php foreach($houses as $house): ?>
                                    <option value="<?= $house['id'] ?>">
                                        <?= htmlspecialchars($house['address'], ENT_QUOTES) . ' (' . htmlspecialchars($house['owner_name'], ENT_QUOTES) . ')' ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-person"></i> Kiracı Seçin</label>
                            <select name="borrower_id" class="form-select" required>
                                <option value="">Seçiniz...</option>
                                <?php foreach($borrowers as $borrower): ?>
                                    <option value="<?= $borrower['id'] ?>">
                                        <?= htmlspecialchars($borrower['firstname'], ENT_QUOTES) . ' ' . htmlspecialchars($borrower['lastname'], ENT_QUOTES) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-chat-text"></i> Sorun Açıklaması</label>
                            <textarea name="issue" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><i class="bi bi-exclamation-triangle"></i> Öncelik</label>
                                <select name="priority" class="form-select" required>
                                    <option value="low">Düşük</option>
                                    <option value="medium">Orta</option>
                                    <option value="high">Yüksek</option>
                                    <option value="emergency">Acil</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><i class="bi bi-check-circle"></i> Durum</label>
                                <select name="status" class="form-select" required>
                                    <option value="pending">Beklemede</option>
                                    <option value="in_progress">İşlemde</option>
                                    <option value="completed">Tamamlandı</option>
                                    <option value="cancelled">İptal</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" name="submit_maintenance" class="btn btn-primary w-100">
                            <i class="bi bi-save"></i> Kaydet
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bakım Talepleri Listesi -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"><i class="bi bi-list-task"></i> Bakım Talepleri Listesi</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ev</th>
                                    <th>Kiracı</th>
                                    <th>Sorun</th>
                                    <th>Öncelik</th>
                                    <th>Durum</th>
                                    <th>Tarih</th>
                                    <th>İşlemler</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($maintenance_requests as $row): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['id'], ENT_QUOTES) ?></td>
                                        <td>
                                            <?= htmlspecialchars($row['address'], ENT_QUOTES) ?><br>
                                            <small class="text-muted"><?= htmlspecialchars($row['owner_name'], ENT_QUOTES) ?></small>
                                        </td>
                                        <td><?= htmlspecialchars($row['firstname'], ENT_QUOTES) . ' ' . htmlspecialchars($row['lastname'], ENT_QUOTES) ?></td>
                                        <td><?= htmlspecialchars($row['issue_description'], ENT_QUOTES) ?></td>
                                        <td>
                                            <span class="badge bg-<?= 
                                                ($row['priority'] == 'high' || $row['priority'] == 'emergency') ? 'danger' : 
                                                ($row['priority'] == 'medium' ? 'warning' : 'info')
                                            ?>">
                                                <?= ucfirst($row['priority']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-<?= 
                                                ($row['status'] == 'completed') ? 'success' : 
                                                ($row['status'] == 'in_progress' ? 'primary' : 
                                                ($row['status'] == 'cancelled' ? 'danger' : 'secondary'))
                                            ?>">
                                                <?= ucfirst(str_replace('_', ' ', $row['status'])) ?>
                                            </span>
                                        </td>
                                        <td><?= date('d/m/Y', strtotime($row['request_date'])) ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="#" 
                                                   class="btn btn-sm btn-warning edit-maintenance" 
                                                   data-id="<?= htmlspecialchars($row['id'], ENT_QUOTES) ?>"
                                                   data-issue="<?= htmlspecialchars($row['issue_description'], ENT_QUOTES) ?>"
                                                   data-priority="<?= htmlspecialchars($row['priority'], ENT_QUOTES) ?>"
                                                   data-status="<?= htmlspecialchars($row['status'], ENT_QUOTES) ?>"
                                                   data-bs-toggle="modal" 
                                                   data-bs-target="#editMaintenanceModal">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <!-- Silme butonu kaldırıldı -->
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                <?php if(empty($maintenance_requests)): ?>
                                    <tr>
                                        <td colspan="8" class="text-center">Kayıtlı bakım talebi bulunmamaktadır.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bakım Talebi Düzenleme Modalı -->
    <div class="modal fade" id="editMaintenanceModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="bi bi-pencil"></i> Bakım Talebi Düzenle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form method="post" id="editMaintenanceForm">
                    <div class="modal-body">
                        <input type="hidden" name="request_id" id="edit_request_id">
                        
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-chat-text"></i> Sorun Açıklaması</label>
                            <textarea name="edit_issue" id="edit_issue" class="form-control" rows="3" required></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><i class="bi bi-exclamation-triangle"></i> Öncelik</label>
                                <select name="edit_priority" id="edit_priority" class="form-select" required>
                                    <option value="low">Düşük</option>
                                    <option value="medium">Orta</option>
                                    <option value="high">Yüksek</option>
                                    <option value="emergency">Acil</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label"><i class="bi bi-check-circle"></i> Durum</label>
                                <select name="edit_status" id="edit_status" class="form-select" required>
                                    <option value="pending">Beklemede</option>
                                    <option value="in_progress">İşlemde</option>
                                    <option value="completed">Tamamlandı</option>
                                    <option value="cancelled">İptal</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle"></i> İptal
                        </button>
                        <button type="submit" name="update" class="btn btn-primary">
                            <i class="bi bi-save"></i> Kaydet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

<!-- JavaScript Kodları -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Düzenleme modalını açma
        document.querySelectorAll('.edit-maintenance').forEach(function(element) {
            element.addEventListener('click', function() {
                // Veri çekme
                var requestId = this.getAttribute('data-id');
                var issue = this.getAttribute('data-issue');
                var priority = this.getAttribute('data-priority');
                var status = this.getAttribute('data-status');

                // Modal alanlarını doldurma
                document.getElementById('edit_request_id').value = requestId;
                document.getElementById('edit_issue').value = issue;
                document.getElementById('edit_priority').value = priority;
                document.getElementById('edit_status').value = status;
            });
        });

        // Yeni bakım talebi form doğrulaması
        document.getElementById('maintenanceForm').addEventListener('submit', function(e) {
            var property_id = document.getElementsByName('property_id')[0].value;
            var borrower_id = document.getElementsByName('borrower_id')[0].value;
            var issue = document.getElementsByName('issue')[0].value;

            if(!property_id || !borrower_id || !issue.trim()) {
                alert('Lütfen tüm alanları doldurun!');
                e.preventDefault();
            }
        });

        // Düzenleme formu doğrulaması
        document.getElementById('editMaintenanceForm').addEventListener('submit', function(e) {
            var issue = document.getElementById('edit_issue').value;

            if(!issue.trim()) {
                alert('Sorun açıklaması boş bırakılamaz!');
                e.preventDefault();
            }
        });
    });
</script>
</body>
</html>