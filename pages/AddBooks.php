<?php
use App\Authenticate;
require_once("../vendor/autoload.php"); 

$authObj = new Authenticate();

$authObj->isAuth();

$featObj = new App\Features;
$featObj->addBook();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/index.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap">
    <title>Bookcase</title>
</head>

<body>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/PersonalLibiraryPoj/pages/Layout/Navbar.php') ?>

<div class="container mt-5">
    <div class="form-container shadow p-4 rounded bg-light">
        <h2 class="text-center mb-4">Add Book</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Book Title:</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter book title" required>
            </div>

            <div class="mb-3">
                <label for="author" class="form-label">Author:</label>
                <input type="text" name="author" id="author" class="form-control" placeholder="Enter author name" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Add Book</button>
        </form>
    </div>
</div>
</body>
</html>
