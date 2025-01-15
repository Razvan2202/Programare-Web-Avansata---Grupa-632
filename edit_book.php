<?php
require 'auth.php'; // include logica de autentificare, pt a verifica daca esti admin sau nu
require 'db.php';   // include conexiunea cu baza de date

// ia id-ul fiecarei carti printr-un query
$idToEdit = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// editeaza cartea in baza de date
$sql = "SELECT * FROM books WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $idToEdit);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && $result->num_rows > 0) {
    $bookToEdit = $result->fetch_assoc();
} else {
    // te redirectioneaza daca nicio carte nu e gasita
    header("Location: logged_admin.php");
    exit;
}

$errors = []; // Array to store validation errors

// handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ia date din formm
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $price = $_POST['price'];
    $discount_price = !empty($_POST['discount_price']) ? $_POST['discount_price'] : null;

    // validare
    if (empty($title) || strlen($title) > 100) {
        $errors[] = "The title is required and must not exceed 100 characters.";
    }

    if (empty($description) || strlen($description) > 500) {
        $errors[] = "The description is required and must not exceed 500 characters.";
    }

    if (empty($category)) {
        $errors[] = "The category is required.";
    }

    if (!is_numeric($price) || $price < 0) {
        $errors[] = "The price must be a positive number.";
    }

    if (!is_null($discount_price) && (!is_numeric($discount_price) || $discount_price < 0 || $discount_price >= $price)) {
        $errors[] = "The discount price must be a positive number less than the regular price.";
    }

    // daca nu sunt erori, modfiica cartea in baza de date
    if (empty($errors)) {
        // pregateste query-ul pt modificarea cartii
        $sql = "UPDATE books SET title = ?, description = ?, category = ?, price = ?, discount_price = ? WHERE id = ?";
        $stmt = mysqli_prepare($conn, $sql);

        // bind parameters
        mysqli_stmt_bind_param($stmt, "sssddi", $title, $description, $category, $price, $discount_price, $idToEdit);

        // verifica daca a avut succes
        if (mysqli_stmt_execute($stmt)) {
            // verifica daca e o noua imagine
            if (!empty($_FILES['cover']['tmp_name'])) {
                $coverPath = 'covers/' . basename($_FILES['cover']['name']);
                if (move_uploaded_file($_FILES['cover']['tmp_name'], $coverPath)) {
                    // updateaza path-ul catre cover in baza de date
                    $sql = "UPDATE books SET cover = ? WHERE id = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "si", $coverPath, $idToEdit);
                    mysqli_stmt_execute($stmt);
                } else {
                    $errors[] = "Failed to upload the new cover image.";
                }
            }

            // redirectioneaza in admin panel
            header("Location: logged_admin.php");
            exit;
        } else {
            $errors[] = "Failed to update the book. Please try again.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book - <?= htmlspecialchars($bookToEdit['title']); ?></title>
    <style>
        body {
            background-color: beige;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #5D3A00;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
        }
        label {
            font-size: 16px;
            color: #5D3A00;
            display: block;
            margin-bottom: 5px;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background-color: #5D3A00;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #A47C48;
        }
        .back-link {
            display: inline-block;
            margin-top: 10px;
            background-color: #5D3A00;
            color: white;
            padding: 8px 12px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
        }
        .back-link:hover {
            background-color: #A47C48;
        }
        .errors {
            color: red;
            font-size: 14px;
            margin-bottom: 15px;
            list-style: none;
            padding: 0;
        }
    </style>
</head>
<body>
    <h1>Edit Book - <?= htmlspecialchars($bookToEdit['title']); ?></h1>

    <!-- arata erorile -->
    <?php if (!empty($errors)): ?>
        <ul class="errors">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <label for="title">Title (max 100 characters):</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($bookToEdit['title']); ?>" required maxlength="100">

        <label for="description">Description (max 500 characters):</label>
        <textarea name="description" id="description" required maxlength="500"><?= htmlspecialchars($bookToEdit['description']); ?></textarea>

        <label for="category">Category:</label>
        <input type="text" name="category" id="category" value="<?= htmlspecialchars($bookToEdit['category']); ?>" required>

        <label for="price">Price (positive number):</label>
        <input type="number" name="price" id="price" step="0.01" value="<?= htmlspecialchars($bookToEdit['price']); ?>" required min="0">

        <label for="discount_price">Discount Price (optional, less than price):</label>
        <input type="number" name="discount_price" id="discount_price" step="0.01" value="<?= htmlspecialchars($bookToEdit['discount_price']); ?>" min="0">

        <label for="cover">Cover Image:</label>
        <input type="file" name="cover" id="cover">

        <button type="submit">Save Changes</button>
    </form>
    <a href="logged_admin.php" class="back-link">Back to Admin Panel</a>
</body>
</html>
