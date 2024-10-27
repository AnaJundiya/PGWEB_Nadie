<?php
// Koneksi ke database MySQL
$host = 'localhost';
$user = 'root';  // Ganti dengan username MySQL Anda jika berbeda
$password = '';  // Ganti dengan password MySQL Anda jika ada
$dbname = 'penduduk_db';

// Membuat koneksi
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data kecamatan
$sql = "SELECT * FROM penduduk";
$result = $conn->query($sql);

// Cek apakah ada data yang ditemukan
if ($result->num_rows > 0) {
    // Membuat tabel HTML
    echo "<table border='2' cellpadding='10' cellspacing='1'>";
    echo "<tr>
            <th>Kecamatan</th>
            <th>Luas</th>
            <th>Jumlah Penduduk</th>
            <th>Longitude</th>
            <th>Latitude</th>
            <th>Aksi</th>
        </tr>";

    // Menampilkan data setiap baris
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['kecamatan']}</td>
                <td>{$row['luas']}</td>
                <td align='right'>{$row['jumlah_penduduk']}</td>
                <td align='right'>{$row['longitude']}</td>
                <td align='right'>{$row['latitude']}</td>
                <td><a href='delete.php?id={$row['id']}' onclick='return confirm(\"Apakah Anda yakin ingin menghapus data ini?\");'>Hapus</a></td>
            </tr>";
    }
    echo "</table>";
} else {
    echo "Tidak ada data ditemukan.";
}
// Tutup koneksi
$conn->close();
