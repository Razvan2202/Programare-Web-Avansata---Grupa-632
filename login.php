<?php
session_start();

// include db
require 'db.php';

// verifica daca formul e trimis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    //valideaza credentialele
    $sql = "SELECT id, username, password, is_admin FROM users WHERE username = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_username);
        $param_username = $username;

        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);

            // verifica daca username-ul exista
            if (mysqli_stmt_num_rows($stmt) === 1) {
                mysqli_stmt_bind_result($stmt, $id, $db_username, $db_password, $is_admin);
                if (mysqli_stmt_fetch($stmt)) {
                    // verifica parola
                    if (password_verify($password, $db_password)) {
                        // incepe sesiunea si salveaza datele utilizatorului
                        $_SESSION['logged_in'] = true;
                        $_SESSION['username'] = $db_username;
                        $_SESSION['is_admin'] = $is_admin; // verifica daca esti admin

                        // te redirectioneaza la pagina normala, sau la pagina de edit daca esti admin
                        if ($is_admin) {
                            header("Location: logged_admin.php");
                        } else {
                            header("Location: logged.php");
                        }
                        exit;
                    } else {
                        $error = "Invalid password.";
                    }
                }
            } else {
                $error = "Invalid username.";
            }
        } else {
            $error = "Something went wrong. Please try again later.";
        }
        mysqli_stmt_close($stmt);
    }
}

// inchide conexiunea cu db
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: beige;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }
        h1 {
            color: #5D3A00;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            color: #5D3A00;
            text-align: left;
        }
        input {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
        }
        button {
            padding: 10px;
            background-color: #5D3A00;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #A47C48;
        }
        .error {
            color: red;
            margin-bottom: 10px;
        }
        .signup-link {
            margin-top: 10px;
            color: #5D3A00;
            font-size: 14px;
        }
        .signup-link a {
            color: blue;
            text-decoration: none;
            font-weight: bold;
        }
        .signup-link a:hover {
            text-decoration: underline;
        }
        .back-button {
            margin-top: 15px;
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
    <div class="login-container">
        <h1>Login</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form method="post" action="login.php">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Login</button>
        </form>
        <p class="signup-link">Don't have an account? <a href="signin.php">Sign Up!</a></p>
        <div class="back-button">
            <a href="index.php">Back to Homepage</a>
        </div>
    </div>
</body>
</html>
