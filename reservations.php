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
  <style>
        .custom-btn {
            background-color: #ce1212;
            color: #fff;
        }
    </style>
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

    <!-- Main Content -->
    <main class="container my-5">
    <h1 class="text-center">Manage Reservations</h1>
    <form action="add_reservation.php" method="post" class="row g-3" id="form-reservation">
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
                <button type="submit" class="btn custom-btn w-100">Reserve</button>
            </div>
        </form>
    </main>

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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
        const name = /^[a-zA-Z\s]+$/;
        const phone = /^(?\d{3})?[\s-]?\d{3}[\s-]?\d{4}$/;
        const email = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,4}$/;
        // const password = /^(?=.[A-Za-z])(?=.\d)[A-Za-z\d]{8,}$/;
        const date = /^\d{4}-\d{2}-\d{2}$/;
        // const title = /^[A-Za-z0-9\s]+$/;
    document.querySelector("#form-reservation").addEventListener("submit",(event)=>{
        const formElements = event.target.elements;


        let getDate = formElements['date'];
        let getName = formElements['name'];
        let getEmail = formElements['email'];
        let getPhone = formElements['phone'];


        getDate.style.border = "1px solid #d1d5db";
        getName.style.border = "1px solid #d1d5db";
        getEmail.style.border = "1px solid #d1d5db";
        getPhone.style.border = "1px solid #d1d5db";

        if(!date.test(getDate.value)){
            event.preventDefault();
            getDate.style.border = "2px solid red";
        }else if(!email.test(getEmail)){
            event.preventDefault();
            getEmail.style.border = "2px solid red";
        }else if(!name.test(getName.value)){
            event.preventDefault();
            getName.style.border = "2px solid red";
        }else if(!phone.test(getPhone.value)){
            event.preventDefault();
            getPhone.style.border = "2px solid red";
        }
    }
    )

    </script>
</body>

</html>
