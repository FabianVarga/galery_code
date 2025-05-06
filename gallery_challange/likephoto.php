<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['UserID'])) {
    echo json_encode(["status" => "error", "message" => "Harus login untuk like!"]);
    exit;
}

$fotoID = $_POST['fotoID'];
$userID = $_SESSION['UserID'];

// Cek apakah user sudah like sebelumnya
$cekLike = mysqli_query($con, "SELECT * FROM likefoto WHERE FotoID = '$fotoID' AND UserID = '$userID'");

if (mysqli_num_rows($cekLike) > 0) {
    // Jika sudah like, maka unlike (hapus like)
    mysqli_query($con, "DELETE FROM likefoto WHERE FotoID = '$fotoID' AND UserID = '$userID'");
    $status = "unliked";
} else {
    // Jika belum like, tambahkan ke database
    mysqli_query($con, "INSERT INTO likefoto (FotoID, UserID) VALUES ('$fotoID', '$userID')");
    $status = "liked";
}

// Ambil jumlah like terbaru
$result = mysqli_query($con, "SELECT COUNT(*) AS JumlahLike FROM likefoto WHERE FotoID = '$fotoID'");
$row = mysqli_fetch_assoc($result);
$jumlahLike = $row['JumlahLike'];

echo json_encode(["status" => $status, "jumlahLike" => $jumlahLike]);
?>
