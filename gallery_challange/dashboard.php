<?php
session_start();
if (!isset($_SESSION['Username'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUSALOKA</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f8fb;
            padding: 20px;
            color: #333;
        }
        header {
            text-align: center;
            padding: 30px 0;
            background-color: #3b5998;
            color: white;
            border-radius: 12px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }
        header h1 {
            font-size: 36px;
            font-weight: 700;
        }
        header p {
            margin-top: 10px;
            font-size: 18px;
        }
        header a {
            color: #e6e6e6;
            text-decoration: none;
            font-weight: bold;
            margin-left: 10px;
            transition: color 0.3s ease;
        }
        header a:hover {
            color: #ffd700;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto 40px;
            padding: 30px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .form-container:hover {
            transform: translateY(-10px);
        }
        .form-container label {
            font-weight: 600;
            margin-bottom: 8px;
            display: block;
            font-size: 16px;
        }
        .form-container input,
        .form-container textarea,
        .form-container select {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }
        .form-container input:focus,
        .form-container textarea:focus,
        .form-container select:focus {
            border-color: #3b5998;
        }
        .form-container button {
            width: 100%;
            padding: 15px;
            font-size: 18px;
            background-color: #3b5998;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .form-container button:hover {
            background-color: #2d4373;
        }
        .search-box {
            text-align: center;
            margin-bottom: 30px;
        }
        .search-box input {
            padding: 10px;
            width: 70%;
            max-width: 400px;
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            margin-right: 10px;
        }
        .search-box button {
            padding: 10px 15px;
            border-radius: 8px;
            background-color: #3b5998;
            color: white;
            border: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .search-box button:hover {
            background-color: #2d4373;
        }
        .post-table {
            display: flex;
            background-color: white;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .post-table:hover {
            transform: translateY(-5px);
        }
        .post-table img {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 12px;
            margin-right: 20px;
        }
        .post-header {
            font-size: 22px;
            font-weight: 700;
            color: #3b5998;
            margin-bottom: 15px;
        }
        .post-actions a,
        .post-actions button {
            background-color: #3b5998;
            color: white;
            padding: 8px 15px;
            border-radius: 8px;
            margin-top: 15px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .post-actions a:hover,
        .post-actions button:hover {
            background-color: #2d4373;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #3b5998;
            color: white;
            border-radius: 12px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.1);
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <header>
        <h1>NUSALOKA</h1>
        <p>Selamat datang, <?php echo $_SESSION['Username']; ?> | <a href='logout.php'>Logout</a></p>
    </header>

    <!-- FORM UPLOAD FOTO -->
    <div class="form-container">
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <label>Judul foto:</label>
            <input type="text" name="judul" required><br>
            <label>Deskripsi foto:</label>
            <textarea name="deskripsi" required></textarea><br>
            <label>Tanggal unggah:</label>
            <input type="date" name="tanggal" required><br>
            <label>Upload foto:</label>
            <input type="file" name="berkas" required><br>
            <label>Album:</label>
            <select name="album" required>
                <option value="">Silahkan Pilih</option>
                <option value="1">Album 1</option>
                <option value="2">Album 2</option>
            </select><br>
            <button type="submit" name="submit">Submit</button><br>
        </form>
    </div>
    <!-- END FORM -->

    <!-- SEARCH BOX -->
    <div class="search-box">
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Cari berdasarkan judul atau user..." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit">Cari</button>
        </form>
    </div>
    
    <?php
    include "koneksi.php";
    $search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
    
    $query = "SELECT f.FotoID, f.JudulFoto, f.DeskripsiFoto, f.TanggalUnggah, f.LokasiFoto, u.Username, a.NamaAlbum,
        COUNT(k.KomentarID) AS JumlahKomentar, COUNT(l.LikeID) AS JumlahLike
        FROM user u
        INNER JOIN foto f ON u.UserID = f.UserID
        LEFT JOIN komentarfoto k ON f.FotoID = k.FotoID
        LEFT JOIN likefoto l ON f.FotoID = l.FotoID
        LEFT JOIN Album a ON f.AlbumID = a.AlbumID
        WHERE f.JudulFoto LIKE '%$search%' OR u.Username LIKE '%$search%'
        GROUP BY f.FotoID";
    
    $query2 = mysqli_query($con, $query);
    
    if (mysqli_num_rows($query2) > 0) {
        while ($row2 = mysqli_fetch_assoc($query2)) {
            ?>
            <div class="post-table">
                <img src="terupload/<?php echo $row2['LokasiFoto']; ?>" alt="Foto">
                <div>
                    <div class="post-header">Judul: <?php echo $row2['JudulFoto']; ?></div>
                    <div><strong>Deskripsi:</strong> <?php echo $row2['DeskripsiFoto']; ?></div>
                    <div><strong>Tanggal:</strong> <?php echo $row2['TanggalUnggah']; ?></div>
                    <div><strong>Album:</strong> <?php echo $row2['NamaAlbum']; ?></div>
                    <div><strong>User:</strong> <?php echo $row2['Username']; ?></div>
                    <div><strong>Komentar:</strong> <?php echo $row2['JumlahKomentar']; ?></div>
                    <div><strong>Like:</strong> <span id="like-count-<?php echo $row2['FotoID']; ?>"><?php echo $row2['JumlahLike']; ?></span></div>
                    

                    <!-- PERCOBAAN -->

                    <div class="comments-section">
    <form class="comment-box" method="POST" action="proses_komentar.php">
        <input type="hidden" name="FotoID" value="<?php echo $row2['FotoID']; ?>">
        <input type="text" name="IsiKomentar" placeholder="Tambahkan komentar..." required>
        <button type="submit">Kirim</button>
    </form>

    <div class="comment-list">
        <?php
        $fotoID = $row2['FotoID'];
        $queryKomentar = "SELECT k.IsiKomentar, k.TanggalKomentar, u.Username 
                          FROM komentarfoto k 
                          JOIN user u ON k.UserID = u.UserID 
                          WHERE k.FotoID = '$fotoID' 
                          ORDER BY k.TanggalKomentar DESC";
        $resultKomentar = mysqli_query($con, $queryKomentar);

        if (mysqli_num_rows($resultKomentar) > 0) {
            while ($rowKomentar = mysqli_fetch_assoc($resultKomentar)) {
                echo "<p><strong>" . $rowKomentar['Username'] . ":</strong> " . $rowKomentar['IsiKomentar'] . " <em>(" . $rowKomentar['TanggalKomentar'] . ")</em></p>";
            }
        } else {
            echo "<p>Belum ada komentar.</p>";
        }
        ?>
    </div>
</div>


                    <!-- PERCOBAAN TUTUP -->



                    <div class="post-actions">
                        <button class="like-btn" data-fotoid="<?php echo $row2['FotoID']; ?>">Like</button>
                        <a href='edit.php?id=<?php echo $row2["FotoID"]; ?>'>Edit</a>
                        <a href='delete.php?id=<?php echo $row2["FotoID"]; ?>' onclick='return confirm("Yakin ingin menghapus foto ini?")'>Hapus</a>
                    </div>
                    
                    
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>Tidak ada hasil yang ditemukan.</p>";
    }
    ?>

    <footer>
        <p>&copy; NUSALOKA</p>
    </footer>
</body>
</html>