<?php 
    include 'db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $phone = trim($_POST['phone']);
        $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);
    
        $query = "INSERT INTO users (name, email, password, phone, role_id, created_at) VALUES (?, ?, ?, ?, 2, NOW())";
        $stmt = secure_query($conn, $query, [$name, $email, $password, $phone], 'ssss');
        
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<section class="d-flex align-items-center justify-content-center vh-100 bg-gradient">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg rounded">
                    <div class="card-body p-4">
                        <h1 class="text-center mb-4">Sign Up</h1>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger"><?= $error; ?></div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" placeholder="Name" required class="form-control">
                            </div>
                            <div class="mb-3">
                            <label for="email">Email</label>
                                <input type="email" name="email" id="email" placeholder="Email" required class="form-control">
                            </div>
                            <div class="mb-3">
                            <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" placeholder="Phone" required class="form-control">
                            </div>
                            <div class="mb-3">
                            <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password" required class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success w-100">Sign Up</button>
                        </form>
                        <p class="text-center mt-3">Already have an account? 
                            <a href="login.php" class="text-decoration-none text-success">Login</a>
                        </p>
                        <p class="text-center mt-3">Or return
                            <a href="index.php" class="text-decoration-none text-success">Home</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
