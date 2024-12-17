<?php 
    include 'db.php';

    $query = "INSERT INTO users (name, email, password, phone, role_id, created_at) VALUES (?, ?, ?, ?, ?, ?)";
    $params = ['admin', 'admin@admin.com', password_hash('admin', PASSWORD_BCRYPT), '0618350694', 1 , date('Y-m-d')];
    $types = 'ssssss';

    $result = secure_query($conn, $query, $params, $types);

    if ($result) {
        echo "Admin inserted successfully!";
    } else {
        echo "Error: " . $conn->error;
    }
?>