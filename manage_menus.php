<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $menu_name = htmlentities($_POST['menu_name']);
    $menu_description = htmlentities($_POST['menu_description']);

    $stmt = $conn->prepare("INSERT INTO menus (name, description) VALUES (?, ?)");
    $stmt->bind_param('ss', $menu_name, $menu_description);
    if ($stmt->execute()) {
        $_SESSION['m_added'] = '
<div id="autoCloseAlert" class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!</strong> The menu has been added successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
';
        header("Location: dashboard.php");
    } else {
        echo "Erreur while adding the menu.";
    }
}
?>
