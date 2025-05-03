<?php
use App\Features;

require_once '../vendor/autoload.php';

$features = new Features();
$books = $features->getBooks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/PersonalLibiraryPoj/pages/Layout/Navbar.php') ?>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Book Inventory</h1>
        <a href="AddBooks.php" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add New Book
        </a>
    </div>

    <?php if (empty($books)): ?>
        <div class="no-books">
            <i class="bi bi-book"></i>
            <h4 class="mb-2">No books found in inventory</h4>
            <p class="text-muted mb-0">Start by adding your first book</p>
        </div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table book-table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Added Date</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($books as $book): ?>
                    <tr>
                        <td>
                            <span class="book-title"><?= htmlspecialchars($book['title']) ?></span>
                        </td>
                        <td class="book-author"><?= htmlspecialchars($book['author']) ?></td>
                        <td>
                            <span class="date-badge">
                                <i class="bi bi-calendar3"></i> <?= htmlspecialchars($book['formatted_date']) ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="mt-3 text-muted">
            <small>Showing <?= count($books) ?> book(s)</small>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>