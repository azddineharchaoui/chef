<?php
session_start();
include("db.php");

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = htmlentities($_SESSION['user_id']);
    $menu_id = htmlentities($_POST['menu']);
    $date = htmlentities($_POST['date']);
    $number_of_places = htmlentities($_POST['number_of_places']);
    $status = 'Pending';

    if (empty($menu_id) || empty($date) || empty($number_of_places)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: manage_reservations.php");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO reservations (user_id, menu_id, date, number_of_people, status, created_at) VALUES (?, ?, ?, ?, ?, NOW())");
    $stmt->bind_param("iisis", $user_id, $menu_id, $date, $number_of_places, $status);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Reservation added successfully.";
        header("Location: manage_reservations.php");
    } else {
        $_SESSION['error'] = "Error adding the reservation. Please try again.";
        header("Location: reservations.php");
    }

    $stmt->close();
} else {
    header("Location: manage_reservations.php");
    exit();
}

$conn->close();
?>
