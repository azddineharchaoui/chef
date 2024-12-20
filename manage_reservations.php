<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT r.id_r, u.name AS user_name, m.name AS menu_name, r.date, r.number_of_people, r.status 
        FROM reservations r
        JOIN users u ON r.user_id = u.id_user
        JOIN menus m ON r.menu_id = m.id_menu
        WHERE r.user_id = {$_SESSION['user_id']}
        ORDER BY r.date DESC";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete'])) {
        $reservation_id = $_POST['reservation_id'];
        $stmt = $conn->prepare("DELETE FROM reservations WHERE id_r = ?");
        $stmt->bind_param("i", $reservation_id);
        if ($stmt->execute()) {
            $_SESSION['success'] = "Reservation deleted successfully.";
        } else {
            $_SESSION['error'] = "Error deleting reservation.";
        }
        $stmt->close();
        header("Location: manage_reservations.php");
        exit();
    }
}
$sql1 = "SELECT * FROM users WHERE id_user = {$_SESSION['user_id']}";
    $result1 = $conn->query($sql1);
    if($result1->num_rows == 1){
        $user = $result1->fetch_assoc();
    }

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reservations</title>
    <link href="assets/css/main.css" rel="stylesheet">
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
    <style>
        .custom-btn {
            background-color: #ce1212;
            color: #fff;
        }
    </style>
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
                    <li><a href="manage_reservations.php">Manage reservations</a></li>
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
    <div class="container py-3">
        <h1 class="text-center">Manage Reservations</h1>
        <a href="index.php" class="btn custom-btn">Back to Home</a>
    </div>

    <div class="container my-4">
        <?php
        if (isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>{$_SESSION['success']}</div>";
            unset($_SESSION['success']);
        }
        if (isset($_SESSION['error'])) {
            echo "<div class='alert alert-danger'>{$_SESSION['error']}</div>";
            unset($_SESSION['error']);
        }
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Menu</th>
                    <th>Date</th>
                    <th>Number of People</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id_r']}</td>
                            <td>{$row['user_name']}</td>
                            <td>{$row['menu_name']}</td>
                            <td>{$row['date']}</td>
                            <td>{$row['number_of_people']}</td>
                            <td>
                                <span class='badge bg-info'>{$row['status']}</span>
                            </td>
                            <td>
                                <a href='edit_reservation.php?id={$row['id_r']}' class='btn btn-sm btn-primary'>Edit</a>
                                <form method='post' class='d-inline'>
                                    <input type='hidden' name='reservation_id' value='{$row['id_r']}'>
                                    <button type='submit' name='delete' class='btn btn-sm btn-danger'>Delete</button>
                                </form>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>No reservations found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    
  <footer id="footer" class="footer dark-background">

<div class="container">
  <div class="row gy-3">
    <div class="col-lg-3 col-md-6 d-flex">
      <i class="bi bi-geo-alt icon"></i>
      <div class="address">
        <h4>Address</h4>
        <p>A108 Adam Street</p>
        <p>New York, NY 535022</p>
        <p></p>
      </div>

    </div>

    <div class="col-lg-3 col-md-6 d-flex">
      <i class="bi bi-telephone icon"></i>
      <div>
        <h4>Contact</h4>
        <p>
          <strong>Phone:</strong> <span>+1 5589 55488 55</span><br>
          <strong>Email:</strong> <span>info@example.com</span><br>
        </p>
      </div>
    </div>

    <div class="col-lg-3 col-md-6 d-flex">
      <i class="bi bi-clock icon"></i>
      <div>
        <h4>Opening Hours</h4>
        <p>
          <strong>Mon-Sat:</strong> <span>11AM - 23PM</span><br>
          <strong>Sunday</strong>: <span>Closed</span>
        </p>
      </div>
    </div>

    <div class="col-lg-3 col-md-6">
      <h4>Follow Us</h4>
      <div class="social-links d-flex">
        <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
      </div>
    </div>

  </div>
</div>

<div class="container copyright text-center mt-4">
  <p>© <span>Copyright</span> <strong class="px-1 sitename">Chef cuisinier</strong> <span>All Rights Reserved</span></p>
  
</div>

</footer>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/main.js"></script>
</body>

</html>
