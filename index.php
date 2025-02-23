<?php
include "Petshop.php";

// Handle Add Pet
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addPet"])) {
    $id = count(Petshop::getAllPets()) + 1; // Generate unique ID
    $name = $_POST["name"];
    $category = $_POST["category"];
    $price = $_POST["price"];

    // Handle Image Upload
    $image = "uploads/default.jpg"; // Default image
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $targetDir = "uploads/";
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true); // Buat direktori jika belum ada
        }
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . time() . "_" . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Valid file types
        $allowedTypes = array("jpg", "jpeg", "png", "gif");
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                $image = $targetFilePath;
            }
        }
    }

    $newPet = new Petshop($id, $name, $category, $price, $image);
    Petshop::addPet($newPet);
}

// Handle Update Pet
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["updatePet"])) {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $category = $_POST["category"];
    $price = $_POST["price"];

    // Handle Image Upload
    $image = null; // Default tidak update gambar
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $targetDir = "uploads/";
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . time() . "_" . $fileName;
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Valid file types
        $allowedTypes = array("jpg", "jpeg", "png", "gif");
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                $image = $targetFilePath;
            }
        }
    }

    Petshop::updatePet($id, $name, $category, $price, $image);
}

// Handle Delete Pet
if (isset($_GET["delete"])) {
    $deleteId = $_GET["delete"];
    Petshop::deletePet($deleteId);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Petshop Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f8f9fa; }
        .container { margin-top: 50px; max-width: 800px; background: white; padding: 30px; border-radius: 10px; }
        h2 { text-align: center; color: #007bff; }
        .table { background-color: white; }
        .table-hover tbody tr:hover { background-color: #f1f1f1; }
        .form-control, .btn { border-radius: 20px; }
        .pet-img { width: 80px; height: 80px; border-radius: 10px; object-fit: cover; }
        .cancel-edit-btn { margin-top: 10px; }
    </style>
</head>
<body>

<div class="container">
    <h2>🐶 Petshop Inventory 🐱</h2>

    <div class="input-group mb-3">
        <input type="text" id="search" class="form-control" placeholder="🔍 Search for pets..." onkeyup="searchPet()">
    </div>

    <table class="table table-bordered table-hover text-center">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price ($)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="petTable">
            <?php foreach (Petshop::getAllPets() as $pet): ?>
            <tr>
                <td><?= $pet->getId(); ?></td>
                <td><img src="<?= $pet->getImage(); ?>" class="pet-img"></td>
                <td><?= $pet->getName(); ?></td>
                <td><?= $pet->getCategory(); ?></td>
                <td><?= $pet->getPrice(); ?></td>
                <td>
                    <a href="?edit=<?= $pet->getId(); ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?delete=<?= $pet->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Delete this pet?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="card p-4 mt-4">
        <h3 class="text-center text-success"><?= isset($_GET['edit']) ? 'Edit Pet' : 'Add New Pet'; ?></h3>
        <form method="post" enctype="multipart/form-data">
            <?php if (isset($_GET['edit'])): ?>
                <input type="hidden" name="id" value="<?= $_GET['edit']; ?>">
            <?php endif; ?>
            <div class="mb-3">
                <input type="text" name="name" class="form-control" placeholder="🐾 Pet Name" value="<?= isset($_GET['edit']) ? Petshop::getPetById($_GET['edit'])->getName() : ''; ?>" required>
            </div>
            <div class="mb-3">
                <input type="text" name="category" class="form-control" placeholder="📌 Category" value="<?= isset($_GET['edit']) ? Petshop::getPetById($_GET['edit'])->getCategory() : ''; ?>" required>
            </div>
            <div class="mb-3">
                <input type="number" name="price" class="form-control" placeholder="💰 Price" value="<?= isset($_GET['edit']) ? Petshop::getPetById($_GET['edit'])->getPrice() : ''; ?>" required>
            </div>
            <div class="mb-3">
                <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" name="<?= isset($_GET['edit']) ? 'updatePet' : 'addPet'; ?>" class="btn btn-success w-100">
                <?= isset($_GET['edit']) ? 'Update Pet' : '➕ Add Pet'; ?>
            </button>
            <?php if (isset($_GET['edit'])): ?>
                <a href="?" class="btn btn-secondary w-100 cancel-edit-btn">Cancel Edit</a>
            <?php endif; ?>
        </form>
    </div>
</div>

<script>
function searchPet() {
    let input = document.getElementById("search").value.toLowerCase();
    let rows = document.querySelectorAll("#petTable tr");
    rows.forEach(row => {
        let found = Array.from(row.getElementsByTagName("td")).some(td => td.innerText.toLowerCase().includes(input));
        row.style.display = found ? "" : "none";
    });
}
</script>

</body>
</html>