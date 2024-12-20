<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id'])) {
    $_SESSION['error'] = "No reservation ID provided.";
    header("Location: manage_reservations.php");
    exit();
}

$reservation_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = htmlentities($_POST['date']);
    $number_of_people = htmlentities($_POST['number_of_people']);

    $stmt = $conn->prepare("UPDATE reservations SET date = ?, number_of_people = ? WHERE id_r = ?");
    $stmt->bind_param("sii", $date, $number_of_people, $reservation_id);
    if ($stmt->execute()) {
        $_SESSION['success'] = "Reservation updated successfully.";
        header("Location: manage_reservations.php");
        exit();
    } else {
        $_SESSION['error'] = "Error updating reservation.";
    }
    $stmt->close();
}

$stmt = $conn->prepare("SELECT date, number_of_people FROM reservations WHERE id_r = ?");
$stmt->bind_param("i", $reservation_id);
$stmt->execute();
$stmt->bind_result($date, $number_of_people);
$stmt->fetch();
$stmt->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Reservation</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>
    <div class="container my-4">
        <h1 class="text-center">Edit Reservation</h1>
        <form method="post">
            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control" value="<?php echo $date; ?>" required>
            </div>
            <div class="mb-3">
                <label for="number_of_people" class="form-label">Number of People</label>
                <input type="number" name="number_of_people" id="number_of_people" class="form-control" value="<?php echo $number_of_people; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="manage_reservations.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
