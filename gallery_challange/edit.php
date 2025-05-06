<?php
include "koneksi.php";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = mysqli_query($con, "SELECT * FROM foto WHERE FotoID = '$id'");
    $data = mysqli_fetch_assoc($query);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['JudulFoto'];
    $deskripsi = $_POST['DeskripsiFoto'];
    $tanggal = $_POST['TanggalUnggah'];
    $album = $_POST['album'];

    // Jika foto baru diupload, simpan file dan ganti lokasi
    if (!empty($_FILES['LokasiFoto']['name'])) {
        $lokasiFoto = 'uploads/' . basename($_FILES['LokasiFoto']['name']);
        move_uploaded_file($_FILES['LokasiFoto']['tmp_name'], $lokasiFoto);
    } else {
        $lokasiFoto = $data['LokasiFoto'];
    }

    $updateQuery = "
        UPDATE foto SET
        JudulFoto = '$judul',
        DeskripsiFoto = '$deskripsi',
        TanggalUnggah = '$tanggal',
        LokasiFoto = '$lokasiFoto',
        AlbumID = '$album'
        WHERE FotoID = '$id'
    ";
    if (mysqli_query($con, $updateQuery)) {
        header("Location: dashboard.php");
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Foto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d4f5f2; /* Hijau mint terang */
            margin: 0;
            padding: 20px;
        }
        .form-container {
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 50px auto;
            border: 2px solid #72cfc9; /* Hijau mint */
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #4a90e2; /* Biru pastel */
        }
        .form-container input,
        .form-container textarea,
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #72cfc9; /* Hijau mint */
            border-radius: 8px;
            background-color: #e8f9f7; /* Hijau mint terang */
            font-size: 14px;
        }
        .form-container img {
            display: block;
            margin-bottom: 15px;
            border-radius: 8px;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #4a90e2; /* Biru pastel */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-container button:hover {
            background-color: #3a78c0; /* Biru pastel lebih gelap */
        }
        footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #4a90e2; /* Biru pastel */
        }
        footer a {
            color: #72cfc9; /* Hijau mint */
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Foto</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <label>Judul Foto:</label>
            <input type="text" name="JudulFoto" value="<?php echo $data['JudulFoto']; ?>" required>

            <label>Deskripsi Foto:</label>
            <textarea name="DeskripsiFoto" rows="4" required><?php echo $data['DeskripsiFoto']; ?></textarea>

            <label>Tanggal Unggah:</label>
            <input type="date" name="TanggalUnggah" value="<?php echo $data['TanggalUnggah']; ?>" required>

            <label>Upload Foto:</label>
            <input type="file" name="LokasiFoto">
            <img src="<?php echo $data['LokasiFoto']; ?>" width="150" alt="Foto Saat Ini">

            <label>Album:</label>
            <select name="album" required>
                <?php
                $albumQuery = mysqli_query($con, "SELECT * FROM album");
                while ($album = mysqli_fetch_assoc($albumQuery)) {
                    $selected = ($album['AlbumID'] == $data['AlbumID']) ? 'selected' : '';
                    echo "<option value='{$album['AlbumID']}' $selected>{$album['NamaAlbum']}</option>";
                }
                ?>
            </select>

            <button type="submit">Update</button>
        </form>
    </div>
    <footer>
        <p>&copy;</p>
    </footer>
</body>
</html>
