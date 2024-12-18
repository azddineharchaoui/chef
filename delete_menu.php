<?php
include 'db.php'; 


$menu_id = $_GET['id'];


$stmt = $conn->prepare("DELETE FROM menus WHERE id_menu = ?");
$stmt->bind_param('i', $menu_id);
if ($stmt->execute()) {
    echo "Menu supprimé avec succès!";
    header("Location: dashboard.php"); 
    exit();
} else {
    echo "Erreur lors de la suppression du menu.";
}
?>
