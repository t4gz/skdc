<?php
session_start();
ob_start(); // Untuk output buffering

// Proses login saat tombol submit ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $koneksi = new mysqli("localhost", "root", "", "sk");

    // Pengecekan koneksi database
    if ($koneksi->connect_error) {
        die("Connection failed: " . $koneksi->connect_error);
    }

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Menggunakan prepared statements untuk mencegah SQL Injection
    $query = $koneksi->prepare("SELECT * FROM tb_admin WHERE nama=? AND passwd=?");
    $query->bind_param("ss", $username, $password);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['username'] = $username;
        header("Location: admin.php");
        exit;
    } else {
        echo "<script>alert('Login gagal! Username atau password salah.');</script>";
    }

    $query->close();
    $koneksi->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="icon" type="image/x-icon" href="../../assets/1-removebg-preview.png"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="../../css/login.css" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex items-center justify-center p-6 relative font-sans">
    <div class="background-gradient"></div>
    <div class="bg-white bg-opacity-5 backdrop-blur-md rounded-3xl shadow-2xl max-w-md w-full p-10">
        <div class="flex justify-center mb-5">
            <img alt="form" src="../../assets/img/1-removebg-preview.png" width="200"/>
        </div>
        <form class="space-y-5" method="POST">
            <div>
                <label class="block text-gray-800 font-semibold mb-2" for="username">Username</label>
                <input class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent transition" id="username" name="username" required="" type="text"/>
            </div>
            <div>
                <label class="block text-gray-800 font-semibold mb-2" for="password">Password</label>
                <input class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-600 focus:border-transparent transition" id="password" name="password" required="" type="password"/>
            </div>
            <button class="w-full py-3 rounded-xl bg-gradient-to-r from-purple-700 via-black to-red-600 text-white font-bold text-lg hover:brightness-110 transition" type="submit">
                Login
            </button>
        </form>
        <div class="mt-6 text-center">
            <a class="text-red-700 hover:text-red-900 font-semibold text-sm" href="https://wa.me/62895700381419?text=Halo%20Admin,%20saya%20lupa%20kata%20sandi%20akun%20saya." target="_blank">
                Lupa Kata Sandi?
            </a>
        </div>
    </div>
</body>
</html>