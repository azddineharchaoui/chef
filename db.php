<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'chef';

$conn = new mysqli($host, $user, $password, $db);

if (!$conn) {
    die("Connection failed: " . $conn->connect_error);
}

function secure_query($conn, $query, $params, $types) {
    $stmt = $conn->prepare($query);
    $stmt->bind_param($types, ...$params);
    $stmt->execute();
    return $stmt;
}
?>
