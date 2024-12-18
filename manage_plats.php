<?php
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $menu_id = $_POST['menu_id'];
    $name = $_POST['name'];
    $ingredients = $_POST['ingredients'];
    $image = $_FILES['image']['tmp_name'];

    $imageData = file_get_contents($image);

    // Insertion du plat dans la base de données
    $stmt = $conn->prepare("INSERT INTO plats (menu_id, name, ingredients, image) VALUES (?, ?, ?, ?)");
    $stmt->bind_param('isss', $menu_id, $name, $ingredients, $imageData);
    if ($stmt->execute()) {
        echo "Plat ajouté avec succès!";
    } else {
        echo "Erreur lors de l'ajout du plat.";
    }
}
?>
