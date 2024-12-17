<?php
include 'db.php'; 
session_start();
if()

$query = "SELECT id_menu, name, description FROM menus";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menus</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <section class="min-h-screen bg-gray-50 py-8">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold text-center mb-6">Exclusive Menus</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ($row = $result->fetch_assoc()): ?>
                <div class="p-4 bg-white shadow rounded-lg">
                    <h3 class="text-lg font-bold"><?= htmlspecialchars($row['name']) ?></h3>
                    <p class="text-gray-700"><?= htmlspecialchars($row['description']) ?></p>
                    <form action="reserve.php" method="POST">
                        <input type="hidden" name="menu_id" value="<?= $row['id_menu'] ?>">
                        <button type="submit" class="mt-4 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Book Now</button>
                    </form>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>
</body>
</html>
