<?php 
// Sesuaikan dengan setting MySQL
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "penduduk_db";

// Create connection  
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Mendapatkan ID dari URL dan validasi
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']); // Mengubah ID menjadi integer

    // Query untuk menghapus catatan dengan prepared statement
    $stmt = $conn->prepare("DELETE FROM penduduk WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID tidak valid.";
}

// Tutup koneksi
$conn->close();

// Redirect kembali ke halaman utama (index.php)
header("Location: index.php");
exit;
?>
