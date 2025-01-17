<?php
session_start();
require 'db.php';

// Ia toate bundle-urile și cărțile asociate
$sql = "SELECT b.id AS bundle_id, b.name AS bundle_name, b.discount_price, 
        GROUP_CONCAT(books.title SEPARATOR ', ') AS books_in_bundle 
        FROM bundles b
        LEFT JOIN bundle_books bb ON b.id = bb.bundle_id
        LEFT JOIN books ON bb.book_id = books.id
        GROUP BY b.id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error fetching bundles: " . mysqli_error($conn));
}

$bundles = [];
while ($row = mysqli_fetch_assoc($result)) {
    $bundles[] = $row;
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Bundles</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: beige;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #5D3A00;
        }
        .bundle {
            border: 1px solid #ddd;
            margin-bottom: 20px;
            padding: 15px;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        .bundle h3 {
            margin: 0;
            color: #5D3A00;
        }
        .bundle p {
            color: #A47C48;
        }
        .back-button {
            text-align: center;
            margin-top: 20px;
        }
        .back-button a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #5D3A00;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .back-button a:hover {
            background-color: #A47C48;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bundles Created</h2>
        <?php if (empty($bundles)): ?>
            <p>No bundles found.</p>
        <?php else: ?>
            <?php foreach ($bundles as $bundle): ?>
                <div class="bundle">
                    <h3><?= htmlspecialchars($bundle['bundle_name']); ?></h3>
                    <p><strong>Discounted Price:</strong> $<?= number_format($bundle['discount_price'], 2); ?></p>
                    <p><strong>Books in Bundle:</strong> 
                        <?= htmlspecialchars($bundle['books_in_bundle'] ?? 'No books in this bundle'); ?>
                    </p>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="back-button">
            <a href="<?= isset($_SESSION['logged_in']) && $_SESSION['logged_in'] ? 'logged.php' : 'index.php'; ?>">Back to Homepage</a>
        </div>
    </div>
</body>
</html>
