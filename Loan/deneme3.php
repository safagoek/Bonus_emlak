<?php
// Hata raporlamayı aç (sorun giderme amacıyla)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Veritabanı bağlantısı için gerekli bilgiler
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "loan_db";

// Veritabanı bağlantısını oluştur
$conn = new mysqli($servername, $username, $password, $dbname);

// Bağlantıyı kontrol et
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// pdf_files tablosunu oluştur (eğer yoksa)
$sql_create_table = "CREATE TABLE IF NOT EXISTS pdf_files (
    id INT AUTO_INCREMENT PRIMARY KEY,
    file_name VARCHAR(255) NOT NULL,
    file_path VARCHAR(255) NOT NULL,
    custom_name VARCHAR(255) NOT NULL,
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
$conn->query($sql_create_table);

// Dosya silme işlemi
if (isset($_POST['delete'])) {
    $delete_id = intval($_POST['delete_id']);

    // Önce dosya yolunu veritabanından alalım
    $stmt = $conn->prepare("SELECT file_path FROM pdf_files WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    $stmt->bind_result($file_path);
    $stmt->fetch();
    $stmt->close();

    if ($file_path && file_exists($file_path)) {
        // Dosyayı sunucudan sil
        unlink($file_path);
    }

    // Veritabanından kaydı sil
    $stmt = $conn->prepare("DELETE FROM pdf_files WHERE id = ?");
    $stmt->bind_param("i", $delete_id);
    if ($stmt->execute()) {
        $message = "Dosya başarıyla silindi.";
    } else {
        $message = "Dosya silinirken bir hata oluştu: " . $stmt->error;
    }
    $stmt->close();
}

// PDF dosyasını yükleme işlemi
if (isset($_POST['upload'])) {
    // Kullanıcının girdiği dosya ismini al
    $custom_name = trim($_POST['custom_name']);

    if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == 0) {
        $file_name = $_FILES['pdf']['name'];
        $file_tmp = $_FILES['pdf']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Sadece PDF dosyalarına izin ver
        if ($file_ext == 'pdf') {
            $upload_dir = 'uploads/';
            // Yükleme klasörü yoksa oluştur
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $new_file_name = uniqid() . '_' . basename($file_name);
            $file_path = $upload_dir . $new_file_name;

            if (move_uploaded_file($file_tmp, $file_path)) {
                // Dosya bilgilerini veritabanına güvenli bir şekilde kaydet
                $stmt = $conn->prepare("INSERT INTO pdf_files (file_name, file_path, custom_name) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $file_name, $file_path, $custom_name);
                if ($stmt->execute()) {
                    $message = "Dosya başarıyla yüklendi.";
                } else {
                    $message = "Veritabanına kaydedilirken hata oluştu: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $message = "Dosya yüklenirken hata oluştu.";
            }
        } else {
            $message = "Lütfen sadece PDF dosyaları yükleyin.";
        }
    } else {
        $message = "Dosya yüklenirken hata oluştu.";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>PDF Yükleme ve Görüntüleme</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9fafb;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 30px auto;
            display: flex;
            gap: 20px;
        }

        .form-card, .list-card {
            flex: 1;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
        }

        h1, h2 {
            font-size: 18px;
            margin: 0 0 15px;
            color: #333;
        }

        .form-card h2, .list-card h2 {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .upload-form input, .upload-form button {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            font-size: 14px;
            border-radius: 6px;
            border: 1px solid #d1d5db;
        }

        .upload-form button {
            background-color: #3b82f6;
            color: #ffffff;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }

        .upload-form button:hover {
            background-color: #2563eb;
        }

        .list-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        .list-table th, .list-table td {
            text-align: left;
            padding: 10px;
            border-bottom: 1px solid #e5e7eb;
        }

        .list-table th {
            background-color: #f3f4f6;
            font-weight: bold;
        }

        .list-table tr:hover {
            background-color: #f9fafb;
        }

        .delete-button {
            background-color: #ef4444;
            color: #ffffff;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 12px;
        }

        .delete-button:hover {
            background-color: #dc2626;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-card">
            <h2>Yeni Bakım Talebi</h2>
            <div class="upload-form">
                <?php if (isset($message)) { echo "<p class='message'>$message</p>"; } ?>
                <form action="" method="POST" enctype="multipart/form-data">
                    <input type="file" name="pdf" accept=".pdf" required>
                    <input type="text" name="custom_name" placeholder="Dosya için bir isim girin" required>
                    <button type="submit" name="upload">Kaydet</button>
                </form>
            </div>
        </div>

        <div class="list-card">
            <h2>Bakım Talepleri Listesi</h2>
            <table class="list-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Dosya İsmi</th>
                        <th>Özel İsim</th>
                        <th>Yüklenme Tarihi</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM pdf_files ORDER BY upload_date DESC";
                    $result = $conn->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['id']}</td>
                                <td><a href='" . htmlspecialchars($row['file_path']) . "' target='_blank'>" . htmlspecialchars($row['file_name']) . "</a></td>
                                <td>" . htmlspecialchars($row['custom_name']) . "</td>
                                <td>" . date('d/m/Y H:i', strtotime($row['upload_date'])) . "</td>
                                <td>
                                    <form method='POST' style='display:inline;' onsubmit='return confirm(\"Bu dosyayı silmek istediğinize emin misiniz?\");'>
                                        <input type='hidden' name='delete_id' value='{$row['id']}'>
                                        <button type='submit' name='delete' class='delete-button'>Sil</button>
                                    </form>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5'>Henüz dosya yüklenmedi.</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>