<?php
session_start();
$name = isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Not provided';
$email = isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : 'Not provided';
$password = isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : 'Not provided';
$imagePath = isset($_SESSION['image']) ? htmlspecialchars('uploads/' . $_SESSION['image']) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="card mx-auto" style="max-width: 500px;">
        <div class="card-body">
            <h3 class="card-title text-center">User Registered Successfully</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Name:</strong> <?= $name ?></li>
                <li class="list-group-item"><strong>Email:</strong> <?= $email ?></li>
                <li class="list-group-item"><strong>Password:</strong> <?= $password ?></li>
                    <li class="list-group-item">
                        <strong>Uploaded Image:</strong><br>
                        <img src="<?= $imagePath ?>" alt="User Image" class="img-fluid mt-2">
                    </li>
            </ul>
            <a href="index.php" class="btn btn-primary mt-3 w-100">Go Back</a>
        </div>
    </div>
</div>
</body>
</html>
