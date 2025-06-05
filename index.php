<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Register</h3>
                    <form action="registration" method="POST" enctype="multipart/form-data" id="registrationForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value = <?= isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : '' ?>>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="text" class="form-control" id="email" name="email" value = <?= isset($_SESSION['email']) ? htmlspecialchars($_SESSION['email']) : '' ?> >
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value = <?= isset($_SESSION['password']) ? htmlspecialchars($_SESSION['password']) : '' ?> >
                        </div>

                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" value = <?= isset($_SESSION['confirm_password']) ? htmlspecialchars($_SESSION['confirm_password']) : '' ?> >
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Upload Image</label>
                            <input class="form-control" type="file" id="image" name="image" accept="image/*" >
                        </div>

                        <button name="submit" type="submit" class="btn btn-primary w-100">Register</button>
                    </form>
                    <div class="mt-3">
                        <?php
                        if (isset($_SESSION['message'])) {
                            echo '<div class="alert alert-info">';
                            foreach ($_SESSION['message'] as $msg) {
                                if ($msg) echo '<div>' . htmlspecialchars($msg) . '</div>';
                            }
                            echo '</div>';
                            unset($_SESSION['message']);
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

<?php
include 'registration.php';