<?php
session_start();

// verifica daca utilizatorul este admin
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || !$_SESSION['is_admin']) {
    header("Location: login.php");
    exit;
}

// include db
require 'db.php';

// ia toate cartile din db
$books = get_all_books();
if (!$books || count($books) === 0) {
    die("Error: No books available in the database.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            background-color: beige;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .button {
            margin-right: 20px;
            padding: 8px 12px;
            background-color: #5D3A00;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            text-decoration: none;
            cursor: pointer;
        }
        .button:hover {
            background-color: #A47C48;
        }
        h1, h2 {
            color: #5D3A00;
        }
        .book-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .book {
            border: 1px solid #ddd;
            padding: 10px;
            width: 200px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .book img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .book-id {
            font-size: 14px;
            color: #A47C48;
            margin: 5px 0;
        }
        .edit-button {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #5D3A00;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
        }
        .edit-button:hover {
            background-color: #A47C48;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome, <?= htmlspecialchars($_SESSION['username']); ?> (Admin)!</h1>
        <div>
            <a href="logout.php" class="button">Logout</a>
        </div>
    </div>

    <h2>All Books</h2>
    <div class="book-list">
        <?php foreach ($books as $book): ?>
            <div class="book">
                <h3><?= htmlspecialchars($book['title']); ?></h3>
                <img src="<?= htmlspecialchars($book['cover']); ?>" alt="<?= htmlspecialchars($book['title']); ?> Cover" />
                <p class="book-id"><strong>ID:</strong> <?= htmlspecialchars($book['id']); ?></p>
                <p><strong>Description:</strong> <?= htmlspecialchars($book['description']); ?></p>
                <p><strong>Category:</strong> <?= htmlspecialchars($book['category']); ?></p>
                <p><strong>Price:</strong> $<?= number_format($book['price'], 2); ?></p>
                <!-- butonul de edit -->
                <a href="edit_book.php?id=<?= urlencode($book['id']); ?>" class="edit-button">Edit</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
