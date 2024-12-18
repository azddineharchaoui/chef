<?php 
    session_start();
    if(!isset($_SESSION['user_id'])){
        header("Location: login.php");
    }
    include ("db.php");
    $sql = "SELECT * FROM users WHERE id_user = {$_SESSION['user_id']}";
    $result = $conn->query($sql);
    if($result->num_rows == 1){
        $user = $result->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Reservations</title>
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Amatic+SC:wght@400;700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>
    <!-- Header -->
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container position-relative d-flex align-items-center justify-content-between">

            <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
                <img src="assets/img/logo.png" alt="">
                <h1 class="sitename">Yummy</h1>
                <span>.</span>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="reservations.php">Reserve</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <?php 
    if(!isset($_SESSION['user_id'])){
      ?>
      <a class="btn-getstarted" href="login.php">Login</a>
      <a class="btn-getstarted" href="signup.php">Signup</a>
    <?php }else { 
        
      ?>
          <div class="b-flex justify-content-end">
          <span><?php if(isset($user)){echo $user['name'];}?></span>
            <a class="btn-getstarted" href="logout.php">Logout</a>
      </div>
    <?php }
    ?>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container my-5">
        <h2 class="text-center mb-4">Reserve Your Menu</h2>
        <form action="process_reservation.php" method="post" class="row g-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'];?>" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'];?>" required>
            </div>
            <div class="col-md-6">
                <label for="phone" class="form-label">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" value="<?= $user['phone'];?>" required>
            </div>
            <div class="col-md-6">
                <label for="num_places" class="form-label">Number of places</label>
                <input type="tel" class="form-control" id="num_places" name="number_of_places" required>
            </div>
            <div class="col-md-6">
                <label for="date" class="form-label">Reservation Date</label>
                <input type="date" class="form-control" id="date" name="date" required>
            </div>
            <div class="col-md-6">
                <label for="menu" class="form-label">Select Menu</label>
                <select class="form-select" id="menu" name="menu" required>
                    <option value="">Choose a menu</option>
                    <?php 
                        $sql = "SELECT id_menu, name FROM `menus`";
                        $result = $conn->query($sql);
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                echo '<option value="' . $row['id_menu']. '"> ' . $row['name'] . '</option>';
                            }
                        }
                    ?>
                </select>
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary w-100">Submit Reservation</button>
            </div>
        </form>
    </main>

    <!-- Footer -->
    <footer class="text-center py-4">
        <p>&copy; 2024 Yummy. All Rights Reserved.</p>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
