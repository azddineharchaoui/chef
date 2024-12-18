<?php
include 'db.php'; 

// Récupérer l'ID du menu depuis l'URL
$menu_id = $_GET['id'];

// Récupérer les détails du menu
$stmt = $conn->prepare("SELECT name, description FROM menus WHERE id_menu = ?");
$stmt->bind_param('i', $menu_id);
$stmt->execute();
$result = $stmt->get_result();
$menu = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_name = $_POST['menu_name'];
    $new_description = $_POST['menu_description'];

    $updateStmt = $conn->prepare("UPDATE menus SET name = ?, description = ? WHERE id_menu = ?");
    $updateStmt->bind_param('ssi', $new_name, $new_description, $menu_id);
    if ($updateStmt->execute()) {
        echo "Menu modifié avec succès!";
        header("Location: dashboard.php"); // Redirection vers le tableau de bord après la modification
        exit();
    } else {
        echo "Erreur lors de la modification du menu.";
    }
}
?>

<!-- Formulaire d'édition du menu -->
<form method="POST">
    <div class="mb-3">
        <label for="menu_name" class="form-label">Nom du Menu</label>
        <input type="text" class="form-control" id="menu_name" name="menu_name" value="<?php echo $menu['name']; ?>" required>
    </div>
    <div class="mb-3">
        <label for="menu_description" class="form-label">Description</label>
        <textarea class="form-control" id="menu_description" name="menu_description" rows="4" required><?php echo $menu['description']; ?></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Modifier le Menu</button>
</form>
