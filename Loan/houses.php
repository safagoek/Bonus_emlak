<?php
// Veritabanı bağlantısı
$host = 'localhost';
$dbname = 'loan_db';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Bağlantı başarısız: " . $e->getMessage());
}

// Ev ekleme fonksiyonu
function addHouse($address, $ownerName, $price, $pdo) {
    $stmt = $pdo->prepare("INSERT INTO house (address, owner_name, price) VALUES (?, ?, ?)");
    $stmt->execute([$address, $ownerName, $price]);
    echo "<div class='notification success'>Ev başarıyla eklendi!</div>";
}

// Ev güncelleme fonksiyonu
function updateHouse($id, $address, $ownerName, $price, $status, $pdo) {
    $stmt = $pdo->prepare("UPDATE house SET address = ?, owner_name = ?, price = ?, status = ? WHERE id = ?");
    $stmt->execute([$address, $ownerName, $price, $status, $id]);
    echo "<div class='notification success'>Ev başarıyla güncellendi!</div>";
}

// Ev silme fonksiyonu
function deleteHouse($id, $pdo) {
    $stmt = $pdo->prepare("DELETE FROM house WHERE id = ?");
    $stmt->execute([$id]);
    echo "<div class='notification success'>Ev başarıyla silindi!</div>";
}

// Evleri listeleme fonksiyonu
function listHouses($pdo) {
    $stmt = $pdo->query("SELECT * FROM house");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Form işlemleri
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        addHouse($_POST['address'], $_POST['owner_name'], $_POST['price'], $pdo);
    } elseif ($action === 'update') {
        updateHouse($_POST['id'], $_POST['address'], $_POST['owner_name'], $_POST['price'], $_POST['status'], $pdo);
    } elseif ($action === 'delete') {
        deleteHouse($_POST['id'], $pdo);
    }
}

$houses = listHouses($pdo);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ev Yönetimi</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f5f7;
        }
        h1, h2 {
            color: #333;
            text-align: center;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .notification {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .notification.success {
            background-color: #e6ffed;
            color: #2e7d32;
            border: 1px solid #b7e1cd;
        }
        .form-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 40px;
        }
        .form-group {
            background: white;
            flex: 1;
            min-width: 280px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .form-group h3 {
            margin-bottom: 15px;
            color: #555;
        }
        .form-group input,
        .form-group select,
        .form-group button {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border-radius: 4px;
            border: 1px solid #ccc;
        }
        .form-group button {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-weight: bold;
        }
        .form-group button:hover {
            background: #0069d9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #dadada;
            text-align: left;
        }
        th {
            background: #f9fafb;
            font-weight: bold;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .delete-button {
            background: #dc3545;
            border: none;
            padding: 8px 12px;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        .delete-button:hover {
            background: #c82333;
        }
        @media(max-width: 768px) {
            .form-container {
                flex-direction: column;
            }
            .form-group {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <h1>Ev Yönetimi</h1>
    <div class="container">
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($action)): ?>
            <!-- Bildirim mesajları burada gösterilecek -->
        <?php endif; ?>

        <div class="form-container">
            <!-- Ev Ekleme Formu -->
            <div class="form-group">
                <h3>Ev Ekle</h3>
                <form method="POST">
                    <input type="hidden" name="action" value="add">
                    <input type="text" name="address" placeholder="Adres" required>
                    <input type="text" name="owner_name" placeholder="Sahip" required>
                    <input type="number" step="0.01" name="price" placeholder="Fiyat" required>
                    <button type="submit">Ekle</button>
                </form>
            </div>

            <!-- Ev Güncelleme Formu -->
            <div class="form-group">
                <h3>Evi Güncelle</h3>
                <form method="POST">
                    <input type="hidden" name="action" value="update">
                    <input type="number" name="id" placeholder="Ev ID" required>
                    <input type="text" name="address" placeholder="Adres">
                    <input type="text" name="owner_name" placeholder="Sahip">
                    <input type="number" step="0.01" name="price" placeholder="Fiyat">
                    <select name="status">
                        <option value="">Durum Seç</option>
                        <option value="1">Boş</option>
                        <option value="0">Dolu</option>
                    </select>
                    <button type="submit">Güncelle</button>
                </form>
            </div>
        </div>

        <!-- Ev Listesi -->
        <h2>Ev Listesi</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Adres</th>
                    <th>Sahip</th>
                    <th>Fiyat</th>
                    <th>Durum</th>
                    <th>Liste Tarihi</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($houses as $house): ?>
                <tr>
                    <td><?= htmlspecialchars($house['id']) ?></td>
                    <td><?= htmlspecialchars($house['address']) ?></td>
                    <td><?= htmlspecialchars($house['owner_name']) ?></td>
                    <td><?= htmlspecialchars($house['price']) ?> TL</td>
                    <td><?= $house['status'] == 1 ? 'Boş' : 'Dolu' ?></td>
                    <td><?= htmlspecialchars($house['date_listed']) ?></td>
                    <td>
                        <form method="POST" style="display:inline;" onsubmit="return confirm('Bu evi silmek istediğinizden emin misiniz?');">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($house['id']) ?>">
                            <button type="submit" class="delete-button">Sil</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($houses)): ?>
                <tr>
                    <td colspan="7" style="text-align:center;">Kayıtlı ev bulunmamaktadır.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>