<?php
include "koneksi.php";
if (isset($_POST['submit'])) {
    $judul = mysqli_real_escape_string($con, $_POST['judul']);
    $deskripsi = mysqli_real_escape_string($con, $_POST['deskripsi']);
    $tanggal = $_POST['tanggal'];
    $album = $_POST['album'];

    // Ambil data file
    $namaFile = $_FILES['berkas']['name'];
    $namaSementara = $_FILES['berkas']['tmp_name'];

    // Tentukan lokasi file akan dipindahkan
    $dirUpload = "terupload/";

    // Validasi input
    if (empty($judul) || empty($deskripsi) || empty($tanggal) || empty($album) || empty($namaFile)) {
        die("Semua kolom wajib diisi.");
    }

    // Buat direktori jika belum ada
    if (!is_dir($dirUpload)) {
        mkdir($dirUpload, 0777, true);
    }

    // Rename file untuk menghindari duplikat
    $namaFile = time() . "_" . $namaFile;

    // Pindahkan file
    $terupload = move_uploaded_file($namaSementara, $dirUpload . $namaFile);

    if ($terupload) {
        // Menyimpan data ke dalam database
        $querySQL = "INSERT INTO foto 
            (JudulFoto, DeskripsiFoto, TanggalUnggah, LokasiFoto, AlbumID, UserID) 
            VALUES ('$judul', '$deskripsi', '$tanggal', '$namaFile', '$album', 1)";
        
        $query = mysqli_query($con, $querySQL);

        if ($query) {
            echo "Upload berhasil!<br/>";
            echo "Link: <a href='" . htmlspecialchars($dirUpload . $namaFile) . "'>" . htmlspecialchars($namaFile) . "</a>";
            header('Location: dashboard.php');  // Redirect ke dashboard setelah sukses
            exit;
        } else {
            die("Gagal menyimpan data ke database: " . mysqli_error($con));
        }
    } else {
        die("Gagal mengunggah file.");
    }
}
?>
