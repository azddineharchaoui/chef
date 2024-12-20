<?php
include 'db.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nbr_plat = htmlentities($_POST['nbr_plat']);
    $menu_id = htmlentities($_POST["menu_id_0"]);

    for($i = 0; $i < $nbr_plat; $i++) {
        $name = $_POST["name_{$i}"];
        $ingredients = $_POST["ingredients_{$i}"];
        $image = $_FILES["image_{$i}"]["tmp_name"];

        $imageData = file_get_contents($image);

        $stmt = $conn->prepare("INSERT INTO plats (menu_id, name, ingredients, image) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('isss', $menu_id, $name, $ingredients, $imageData);
        if ($stmt->execute()) {
            echo "Plat ajouté avec succès!";
            header("Location: dashboard.php");
        } else {
            echo "Erreur lors de l'ajout du plat.";
            header("Location: dashboard.php");
        }
}
}
?>
