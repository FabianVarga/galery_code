<?php
session_start();
include "koneksi.php"; // Pastikan file koneksi database ada

if (!isset($_SESSION['UserID'])) {
    die("Anda harus login terlebih dahulu.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fotoID = $_POST['FotoID'];
    $userID = $_SESSION['UserID']; // Ambil UserID dari session
    $isiKomentar = mysqli_real_escape_string($con, $_POST['IsiKomentar']);

    if (!empty($isiKomentar)) {
        $query = "INSERT INTO komentarfoto (FotoID, UserID, IsiKomentar) VALUES ('$fotoID', '$userID', '$isiKomentar')";
        if (mysqli_query($con, $query)) {
            header("Location: index.php"); // Redirect ke halaman utama setelah komentar ditambahkan
            exit;
        } else {
            echo "Gagal menambahkan komentar: " . mysqli_error($con);
        }
    } else {
        echo "Komentar tidak boleh kosong!";
    }
}
?>
