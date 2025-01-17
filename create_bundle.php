<?php
session_start();
require 'db.php';

// Verifică dacă utilizatorul este admin
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] != 1) {
    die("Access denied");
}

$name = $discount_price = "";
$name_err = $discount_price_err = $success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validare nume
    if (empty(trim($_POST['name']))) {
        $name_err = "Please enter a name for the bundle.";
    } else {
        $name = trim($_POST['name']);
    }

    // Validare preț redus
    if (empty(trim($_POST['discount_price']))) {
        $discount_price_err = "Please enter a discounted price.";
    } elseif (!is_numeric($_POST['discount_price']) || $_POST['discount_price'] <= 0) {
        $discount_price_err = "Please enter a valid positive price.";
    } else {
        $discount_price = trim($_POST['discount_price']);
    }

    // Dacă nu există erori, inserează bundle-ul în baza de date
    if (empty($name_err) && empty($discount_price_err)) {
        $sql = "INSERT INTO bundles (name, discount_price) VALUES (?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sd", $name, $discount_price);
            if (mysqli_stmt_execute($stmt)) {
                $bundle_id = mysqli_insert_id($conn);

                // Adaugă cărțile în bundle_books
                if (!empty($_POST['books'])) {
                    $book_ids = $_POST['books'];
                    foreach ($book_ids as $book_id) {
                        $sql = "INSERT INTO bundle_books (bundle_id, book_id) VALUES (?, ?)";
                        $stmt2 = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt2, "ii", $bundle_id, $book_id);
                        mysqli_stmt_execute($stmt2);
                        mysqli_stmt_close($stmt2);
                    }
                }

                $success_message = "Bundle created successfully!";
            } else {
                echo "Something went wrong. Please try again.";
            }
            mysqli_stmt_close($stmt);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Bundle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: beige;
            padding: 20px;
            margin: 0;
        }
        .container {
            max-width: 600px;
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
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #5D3A00;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .error {
            color: red;
            font-size: 14px;
        }
        button {
            background-color: #5D3A00;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #A47C48;
        }
        .success {
            color: green;
            font-size: 16px;
            text-align: center;
            margin-bottom: 20px;
        }
        .checkbox-group {
            margin-bottom: 15px;
        }
        .checkbox-group input {
            margin-right: 10px;
        }
        .back-button {
            margin-top: 20px;
            text-align: center;
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
        <h2>Create a Book Bundle</h2>
        <?php if (!empty($success_message)) echo "<p class='success'>$success_message</p>"; ?>
        <form action="create_bundle.php" method="post">
            <div class="form-group">
                <label for="name">Bundle Name:</label>
                <input type="text" name="name" id="name" value="<?= htmlspecialchars($name); ?>">
                <span class="error"><?= $name_err; ?></span>
            </div>
            <div class="form-group">
                <label for="discount_price">Discounted Price:</label>
                <input type="text" name="discount_price" id="discount_price" value="<?= htmlspecialchars($discount_price); ?>">
                <span class="error"><?= $discount_price_err; ?></span>
            </div>
            <div class="form-group checkbox-group">
                <label for="books">Select Books:</label>
                <?php
                $result = mysqli_query($conn, "SELECT id, title FROM books");
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div><input type='checkbox' name='books[]' value='" . $row['id'] . "'> " . htmlspecialchars($row['title']) . "</div>";
                }
                ?>
            </div>
            <button type="submit">Create Bundle</button>
        </form>
        <div class="back-button">
            <a href="logged_admin.php">Back to Homepage</a>
        </div>
    </div>
</body>
</html>

<?php
// Close the database connection at the end of the script
mysqli_close($conn);
?>
