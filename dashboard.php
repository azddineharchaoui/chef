<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Chef Cuisinier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Chef Admin</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Reservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Statistics</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-home"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-calendar-check"></i> Manage Reservations
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-chart-line"></i> Statistics
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <!-- Reservations Table -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-calendar-check"></i> Recent Reservations
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client Name</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>People</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Azzouz Azzouz</td>
                                    <td>2024-12-18</td>
                                    <td>19:00</td>
                                    <td>4</td>
                                    <td>
                                        <button class="btn btn-info btn-sm">Edit</button>
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Manage Menus Section -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <i class="fas fa-bars"></i> Manage Menus
                    </div>
                    <div class="card-body">
                        <!-- Form to Add Menu -->
                        <form method="POST" action="manage_menus.php">
                            <div class="mb-3">
                                <label for="menu_name" class="form-label">Menu Name</label>
                                <input type="text" class="form-control" id="menu_name" name="menu_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="menu_description" class="form-label">Description</label>
                                <textarea class="form-control" id="menu_description" name="menu_description" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-info">Add Menu</button>
                        </form>

                        <!-- Existing Menus List -->
                        <h5 class="mt-4">Existing Menus</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Menu Name</th>
                                    <th>Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'db.php';
                                $menus = $conn->query("SELECT id_menu, name, description FROM menus");
                                while ($menu = $menus->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$menu['id_menu']}</td>
                                            <td>{$menu['name']}</td>
                                            <td>{$menu['description']}</td>
                                            <td>
                                                <a href='edit_menu.php?id={$menu['id_menu']}' class='btn btn-warning btn-sm'>Edit</a>
                                                <a href='delete_menu.php?id={$menu['id_menu']}' class='btn btn-danger btn-sm'>Delete</a>
                                            </td>
                                          </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Manage plats Section -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-utensils"></i> Manage plats
                    </div>
                    <div class="card-body">
                        <!-- Form to Add or Edit a plat -->
                        <form method="POST" action="manage_plats.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="menu_id" class="form-label">Menu</label>
                                <select class="form-select" id="menu_id" name="menu_id" required>
                                    <option value="">-- Select a Menu --</option>
                                    <?php
                                    $menus = $conn->query("SELECT id_menu, name FROM menus");
                                    while ($menu = $menus->fetch_assoc()) {
                                        echo "<option value='{$menu['id_menu']}'>{$menu['name']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">plat Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="ingredients" class="form-label">Ingredients</label>
                                <textarea class="form-control" id="ingredients" name="ingredients" rows="4" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">plat Image</label>
                                <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                            </div>
                            <button type="submit" class="btn btn-info">Add plat</button>
                        </form>

                        <!-- List of Existing plats -->
                        <h5 class="mt-4">Existing plats</h5>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>plat Name</th>
                                    <th>Menu</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $plats = $conn->query("SELECT p.id_plat, p.name, m.name as menu_name FROM plats p JOIN menus m ON p.menu_id = m.id_menu");
                                while ($plat = $plats->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$plat['id_plat']}</td>
                                            <td>{$plat['name']}</td>
                                            <td>{$plat['menu_name']}</td>
                                            <td>
                                                <a href='edit_plat.php?id={$plat['id_plat']}' class='btn btn-warning btn-sm'>Edit</a>
                                                <a href='delete_plat.php?id={$plat['id_plat']}' class='btn btn-danger btn-sm'>Delete</a>
                                            </td>
                                          </tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Statistics Section -->
                <div class="row">
                    <div class="col-md-4">
                        <div class="card text-white bg-info mb-3">
                            <div class="card-header">Total Reservations</div>
                            <div class="card-body">
                                <h5 class="card-title">2658</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-success mb-3">
                            <div class="card-header">Satisfied Customers</div>
                            <div class="card-body">
                                <h5 class="card-title">89%</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card text-white bg-warning mb-3">
                            <div class="card-header">Pending Reservations</div>
                            <div class="card-body">
                                <h5 class="card-title">25</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
