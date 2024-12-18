<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $menu_name = $_POST['menu_name'];
    $menu_description = $_POST['menu_description'];

    // Insertion du menu dans la base de données
    $stmt = $conn->prepare("INSERT INTO menus (name, description) VALUES (?, ?)");
    $stmt->bind_param('ss', $menu_name, $menu_description);
    if ($stmt->execute()) {
        echo "Menu ajouté avec succès!";
    } else {
        echo "Erreur lors de l'ajout du menu.";
    }
}
?>
