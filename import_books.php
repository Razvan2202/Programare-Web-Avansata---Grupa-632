<?php
// conexiunea cu db
$host = 'localhost';
$db = 'bookstore';
$user = 'root';
$password = '';

try {
    // creaza o noua conexiune PDO
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// incarca fisierul json
$jsonFile = 'books.json'; // path-ul catre json
if (!file_exists($jsonFile)) {
    die("Error: JSON file not found.");
}

$jsonData = file_get_contents($jsonFile);
$books = json_decode($jsonData, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    die("Error decoding JSON: " . json_last_error_msg());
}

// face queryul pt inserarea de date
$sql = "INSERT INTO books (id, title, description, cover, price, discount_price, category)
        VALUES (:id, :title, :description, :cover, :price, :discount_price, :category)
        ON DUPLICATE KEY UPDATE
            title = VALUES(title),
            description = VALUES(description),
            cover = VALUES(cover),
            price = VALUES(price),
            discount_price = VALUES(discount_price),
            category = VALUES(category)";
$stmt = $pdo->prepare($sql);

// insereaza fiecare carte in db
foreach ($books as $book) {
    try {
        $stmt->execute([
            ':id' => $book['id'],
            ':title' => $book['title'],
            ':description' => $book['description'],
            ':cover' => $book['cover'],
            ':price' => $book['price'],
            ':discount_price' => $book['discount_price'] ?? NULL,
            ':category' => $book['category']
        ]);
        echo "Inserted/Updated: " . $book['title'] . "<br>";
    } catch (PDOException $e) {
        echo "Error inserting book '" . $book['title'] . "': " . $e->getMessage() . "<br>";
    }
}

echo "Successfully processed " . count($books) . " books.";
?>
