<?php 
    include 'db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    
        $query = "INSERT INTO users (name, email, password, role_id, created_at) VALUES (?, ?, ?, 2, NOW())";
        $stmt = secure_query($conn, $query, [$name, $email, $password], 'sss');
        
        if ($stmt->affected_rows === 1) {
            header("Location: login.php");
        } else {
            $error = "Registration failed. Please try again.";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<section class="min-h-screen flex items-center justify-center bg-gradient-to-r from-green-400 to-teal-500">
    <div class="bg-white rounded-lg shadow-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-6">Sign Up</h1>
        <?php if (isset($error)): ?>
            <div class="text-red-500 text-sm mb-4"><?= $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="name" placeholder="Name" required class="w-full p-2 mb-4 border rounded">
            <input type="email" name="email" placeholder="Email" required class="w-full p-2 mb-4 border rounded">
            <input type="password" name="password" placeholder="Password" required class="w-full p-2 mb-4 border rounded">
            <button class="w-full bg-green-600 text-white py-2 rounded">Sign Up</button>
        </form>
        <p class="text-center mt-4">Already have an account? <a href="login.php" class="text-green-500">Login</a></p>
    </div>
</section>
</body>
</html>