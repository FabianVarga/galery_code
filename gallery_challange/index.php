<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d4f5f2; /* Hijau mint terang */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .form-container {
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 320px;
            text-align: center;
            border: 2px solid #72cfc9; /* Hijau mint */
        }
        .form-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #4a90e2; /* Biru pastel */
        }
        .form-container label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #4a90e2; /* Biru pastel */
            text-align: left;
        }
        .form-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #72cfc9; /* Hijau mint */
            border-radius: 8px;
            font-size: 14px;
            background-color: #e8f9f7; /* Hijau mint terang */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .form-container input:focus {
            border-color: #4a90e2; /* Biru pastel */
            box-shadow: 0 0 8px rgba(74, 144, 226, 0.5); /* Glow biru */
            outline: none;
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
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .form-container button:hover {
            background-color: #3a78c0; /* Biru pastel lebih gelap */
            transform: translateY(-2px);
        }
        .form-container button:active {
            transform: translateY(0);
        }
        .form-container p {
            margin-top: 15px;
            font-size: 14px;
            color: #72cfc9; /* Hijau mint */
        }
        .form-container p a {
            color: #4a90e2; /* Biru pastel */
            text-decoration: none;
            font-weight: bold;
        }
        .form-container p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Login | NUSALOKA</h1>
        <form action="checklogin.php" method="POST">
            <label for="username">Username</label>
            <input type="text" id="username" name="Username" placeholder="Masukan username" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="Password" placeholder="Masukan password" required>
            <button type="submit" value="submit">Submit</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
    </div>
</body>
</html>