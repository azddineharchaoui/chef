<?php
include 'db.php'; 


$plat_id = $_GET['id'];


$stmt = $conn->prepare("DELETE FROM plats WHERE id_plat = ?");
$stmt->bind_param('i', $plat_id);
if ($stmt->execute()) {
    echo "Plat is deleted successfully!";
    header("Location: dashboard.php"); 
    exit();
} else {
    echo "Error while deleting the plat.";
}
?>
