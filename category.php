<?php
session_start(); // incepe sesiunea

// include baza de date
require 'db.php';

// ia categoria si titlul prin query-uri
$category = isset($_GET['category']) ? $_GET['category'] : 'all';
$titleFilter = isset($_GET['title']) ? $_GET['title'] : '';

// afiseaza cartile in functie de filtre
$books = get_books_with_filters($category, $titleFilter);

// back to homepage
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
        $backHomepageLink = 'logged_admin.php';
    } else {
        $backHomepageLink = 'logged.php';
    }
} else {
    $backHomepageLink = 'index.php';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books in <?= htmlspecialchars($category); ?> Category</title>
    <style>
        body {
            background-color: beige;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h1, h2, h3 {
            color: #5D3A00;
            margin-left: 5px;
        }
        .announcement {
            background-color: #FFCCCC;
            color: red;
            padding: 10px;
            border: 1px solid red;
            margin-bottom: 20px;
            font-weight: bold;
            text-align: center;
        }
        p, li {
            color: #A47C48;
            margin-left: 5px;
        }
        .book-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-left: 5px;
        }
        .book {
            border: 1px solid #ddd;
            padding: 5px;
            width: 200px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .book img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #F4F4F4;
            border-top: 1px solid #ddd;
            color: #A47C48;
        }
        form {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        label {
            font-size: 16px;
            color: #5D3A00;
        }
        select, input[type="text"] {
            padding: 5px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: white;
            color: #5D3A00;
        }
        button {
            background-color: #5D3A00;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
        }
        button:hover {
            background-color: #A47C48;
        }
        .edit-button {
            display: inline-block;
            margin-top: 10px;
            background-color: #5D3A00;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
        }
        .edit-button:hover {
            background-color: #A47C48;
        }
        .back-button {
            display: inline-block;
            margin-top: 10px;
            background-color: #5D3A00;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
        }
        .back-button:hover {
            background-color: #A47C48;
        }
        .logout-button, .auth-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .logout-button {
            background-color: #5D3A00;
            color: white;
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            text-decoration: none;
        }
        .logout-button:hover {
            background-color: #A47C48;
        }
        .auth-buttons a {
            background-color: #5D3A00;
            color: white;
            padding: 8px 12px;
            margin-left: 5px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
        }
        .auth-buttons a:hover {
            background-color: #A47C48;
        }
    </style>
</head>
<body>
    <!-- butoanele din dreapta sus -->
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
        <a href="logout.php" class="logout-button">Logout</a>
    <?php else: ?>
        <div class="auth-buttons">
            <a href="login.php">Login</a>
            <a href="signin.php">Sign Up</a>
        </div>
    <?php endif; ?>

    <h1>Books in <?= htmlspecialchars($category); ?> Category</h1>

    <!-- anuntul petnru reducerea la cartile de copii -->
    <?php if (strtolower($category) === 'children'): ?>
        <div class="announcement">
            !!!JUST TODAY, BUY ONE CHILDREN'S BOOK, GET TWO!!!
        </div>
    <?php endif; ?>

    <form action="category.php" method="get">
        <label for="category">Choose a category:</label>
        <select name="category" id="category">
            <option value="all" <?= $category === 'all' ? 'selected' : ''; ?>>Show All</option>
            <?php foreach (array_unique(array_column(get_all_books(), 'category')) as $cat): ?>
                <option value="<?= htmlspecialchars($cat); ?>" <?= $category === $cat ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($cat); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <label for="title">Search by Title:</label>
        <input type="text" name="title" id="title" placeholder="Enter book title" value="<?= htmlspecialchars($titleFilter); ?>">
        <button type="submit">Filter Books</button>
    </form>
    <a href="<?= htmlspecialchars($backHomepageLink); ?>" class="back-button">Back to Homepage</a>
    <div class="book-list">
        <?php if (count($books) > 0): ?>
            <?php foreach ($books as $book): ?>
                <div class='book'>
                    <h3><?= htmlspecialchars($book['title']); ?></h3>
                    <img src="<?= htmlspecialchars($book['cover']); ?>" alt="<?= htmlspecialchars($book['title']); ?> Cover" />
                    <p><strong>Description:</strong> <?= htmlspecialchars($book['description']); ?></p>
                    <p><strong>Category:</strong> <?= htmlspecialchars($book['category']); ?></p>
                    <?php if (isset($book['discount_price']) && $book['discount_price'] < $book['price']): ?>
                        <p><strong>Price:</strong> <span style="text-decoration: line-through;">$<?= number_format($book['price'], 2); ?></span> <strong style="color: green;">$<?= number_format($book['discount_price'], 2); ?></strong></p>
                    <?php else: ?>
                        <p><strong>Price:</strong> $<?= number_format($book['price'], 2); ?></p>
                    <?php endif; ?>

                    <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true): ?>
                        <a href="edit_book.php?id=<?= urlencode($book['id']); ?>" class="edit-button">Edit</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No books found in this category.</p>
        <?php endif; ?>
    </div>
    <footer>
        <p>&copy; <?= date('Y'); ?> Bookstore. All rights reserved.</p>
    </footer>
</body>
</html>
