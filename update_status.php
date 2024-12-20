<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['reservation_id'], $_POST['action'])) {
        $reservation_id = intval($_POST['reservation_id']);
        $action = $_POST['action'];

        $status = '';
        if ($action === 'accept') {
            $status = 'Confirmed';
        } elseif ($action === 'refuse') {
            $status = 'Canceled';
        }

        if ($status !== '') {
            $stmt = $conn->prepare("UPDATE reservations SET status = ?, created_at = NOW() WHERE id_r = ?");
            $stmt->bind_param("si", $status, $reservation_id);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Reservation status updated successfully.";
            } else {
                $_SESSION['message'] = "Failed to update reservation status.";
            }

            $stmt->close();
        }
    }
}

header("Location: dashboard.php");
exit;
