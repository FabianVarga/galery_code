<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi</title>
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
        .container {
            background: #ffffff;
            padding: 20px 30px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 320px;
            text-align: center;
            border: 2px solid #72cfc9; /* Hijau mint */
        }
        .container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #4a90e2; /* Biru pastel */
        }
        .container label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #4a90e2; /* Biru pastel */
            text-align: left;
        }
        .container input, .container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #72cfc9; /* Hijau mint */
            border-radius: 8px;
            font-size: 14px;
            background-color: #e8f9f7; /* Hijau mint terang */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .container input:focus, .container textarea:focus {
            border-color: #4a90e2; /* Biru pastel */
            box-shadow: 0 0 8px rgba(74, 144, 226, 0.5); /* Glow biru */
            outline: none;
        }
        .container button {
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
        .container button:hover {
            background-color: #3a78c0; /* Biru pastel lebih gelap */
            transform: translateY(-2px);
        }
        .container button:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Registrasi | NUSALOKA</h1>
        <form>
            <label>Nama Lengkap</label>
            <input type="text" name="Username" required>
            
            <label>Password</label>
            <input type="password" name="Password" required>
            
            <label>Email</label>
            <input type="email" name="Email" required>
            
            <label>Alamat</label>
            <textarea name="Alamat" required></textarea>
            
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
