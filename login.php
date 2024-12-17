<?php
session_start();
include 'db.php';
// require_once 'add_admin_once.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Requête mise à jour avec une jointure pour récupérer le titre du rôle
    $query = "SELECT u.id_user, u.password, r.titre 
              FROM users u
              INNER JOIN roles r ON u.role_id = r.id_role
              WHERE u.email = ?";
    
    $stmt = secure_query($conn, $query, [$email], 's');
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['role'] = $user['titre']; 

            if ($user['titre'] === 'admin') {
                header("Location: dashboard.php");
            } else {
                header("Location: menus.php");
            }
            exit;
        } else {
            $error = "Invalid email or password.";
        }
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        <?php if (isset($error)) { echo "<p class='text-red-500'>$error</p>"; } ?>
        <form method="POST" action="">
            <!-- <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf ?? '') ?>"> -->
            <label for="email" class="block text-gray-700">Email:</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg mb-4">
            <label for="password" class="block text-gray-700">Password:</label>
            <input type="password" name="password" id="password" class="w-full px-4 py-2 border rounded-lg mb-4">
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-lg w-full">Login</button>
        </form>
    </div>
</body>
</html>
