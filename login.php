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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow p-4 rounded" style="width: 100%; max-width: 400px;">
        <h2 class="text-center mb-4 fw-bold">Login</h2>
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form method="POST" action="">
            <!-- <input type="hidden" name="csrf" value="<?= htmlspecialchars($csrf ?? '') ?>"> -->
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <p class="text-center mt-3">You don'it have an account? 
                            <a href="signup.php" class="text-decoration-none text-success">Signup</a>
                        </p>
                        <p class="text-center mt-3">Or return
                            <a href="index.php" class="text-decoration-none text-success">Home</a>
                        </p>
    </div>
</body>
</html>
