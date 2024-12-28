<?php
require_once '../app/Classes/FileHandler.php';
require_once '../app/Classes/VehicleActions.php';
require_once '../app/Classes/VehicleBase.php';
require_once '../app/Classes/VehicleManager.php';

use App\Classes\VehicleManager;

$vehicleManager = new VehicleManager('', '', '', '');

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $vehicleManager->addVehicle([
            'name' => $_POST['name'],
            'type' => $_POST['type'],
            'price' => $_POST['price'],
            'image' => $_POST['image']
        ]);
    } elseif (isset($_POST['edit'])) {
        $vehicleManager->editVehicle($_POST['id'], [
            'name' => $_POST['name'],
 'type' => $_POST['type'],
            'price' => $_POST['price'],
            'image' => $_POST['image']
        ]);
    } elseif (isset($_POST['delete'])) {
        $vehicleManager->deleteVehicle($_POST['id']);
    }
}

// Fetch all vehicles to display
$vehicles = $vehicleManager->getVehicles();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Vehicle Management</title>
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Vehicle Management System</h1>
        <div class="mt-4">
            <h2>Add Vehicle</h2>
            <form method="POST">
                <input type="text" name="name" placeholder="Vehicle Name" required>
                <input type="text" name="type" placeholder="Vehicle Type" required>
                <input type="number" name="price" placeholder="Vehicle Price" required>
                <input type="text" name="image" placeholder="Image URL" required>
                <button type="submit" name="add" class="btn btn-primary">Add Vehicle</button>
            </form>
        </div>

        <h2 class="mt-5">Vehicle List</h2>
        <div class="row">
            <?php foreach ($vehicles as $id => $vehicle): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= htmlspecialchars($vehicle['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($vehicle['name']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($vehicle['name']) ?></h5>
                            <p class="card-text">Type: <?= htmlspecialchars($vehicle['type']) ?></p>
                            <p class="card-text">Price: $<?= htmlspecialchars($vehicle['price']) ?></p>
                            <form method="POST">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <button type="submit" name="edit" class="btn btn-warning">Edit</button>
                                <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>