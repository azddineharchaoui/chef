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
        $_SESSION['m_edited'] = '
        <div id="autoCloseAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> The menu has been edited successfuly.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
        ';
        header("Location: dashboard.php"); 
        exit();
    } else {
        echo "Erreur lors de la modification du menu.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Chef Cuisinier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    .custom-btn {
        background-color: #ce1212;
        color: #fff;
    }

    .bg-custom {
        background-color: #ce1212;
    }
    </style>
</head>

<body>
    <div class="card mb-4">
        <div class="card-header bg-custom text-white">
            <i class="fas fa-bars"></i> Edit Menus
            <a href="dashboard.php" class="btn-getstarted">Return </a>
        </div>
        <div class="card-body">

            <!-- Formulaire d'édition du menu -->
            <form method="POST">
                <div class="mb-3">
                    <label for="menu_name" class="form-label">Menu Name</label>
                    <input type="text" class="form-control" id="menu_name" name="menu_name" value="<?= $menu['name']?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="menu_description" class="form-label">Description</label>
                    <textarea class="form-control" id="menu_description" name="menu_description" rows="4"
                        value="<?= $menu['description']?>" required></textarea>
                </div>
                <button type="submit" class="btn custom-btn">Save</button>
            </form>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>