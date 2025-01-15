<?php
session_start(); // incepe sesiunea

// include db
require 'db.php';

//defineste variabilele si le afiseaza goale
$username = $first_name = $last_name = $email = $password = $confirm_password = "";
$username_err = $first_name_err = $last_name_err = $email_err = $password_err = $confirm_password_err = $success_message = "";

// proceseaza datele cand apesi submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // validare username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        // verifica daca username-ul exista deja
        $sql = "SELECT id FROM users WHERE username = ?";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    // valideaza prenumele
    if (empty(trim($_POST["first_name"]))) {
        $first_name_err = "Please enter your first name.";
    } elseif (!preg_match("/^[a-zA-Z]+$/", trim($_POST["first_name"]))) {
        $first_name_err = "First name can only contain letters.";
    } else {
        $first_name = trim($_POST["first_name"]);
    }

    // numele de familie
    if (empty(trim($_POST["last_name"]))) {
        $last_name_err = "Please enter your last name.";
    } elseif (!preg_match("/^[a-zA-Z]+$/", trim($_POST["last_name"]))) {
        $last_name_err = "Last name can only contain letters.";
    } else {
        $last_name = trim($_POST["last_name"]);
    }

    // emailul
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Please enter a valid email address.";
    } else {
        $email = trim($_POST["email"]);
    }

    // parola
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // confirmarea parolei
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm the password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Passwords do not match.";
        }
    }

    // veirifca daca exista erori inainte de a posta in baza de date
    if (empty($username_err) && empty($first_name_err) && empty($last_name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        // insereaza datele in db
        $sql = "INSERT INTO users (username, first_name, last_name, email, password, is_admin) VALUES (?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssi", $param_username, $param_first_name, $param_last_name, $param_email, $param_password, $param_is_admin);

            // seteaza parametrii
            $param_username = $username;
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // hasureaza parola
            $param_is_admin = 0; // default pt utilizatorii normali, se poate schimba doar din db pt a deveni admin

            if (mysqli_stmt_execute($stmt)) {
                $success_message = "Your account has been created successfully. <a href='login.php'>Login here</a>.";
            } else {
                echo "Something went wrong. Please try again later.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    // inchide conexiunea cu db
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: beige;
            padding: 20px;
        }
        .container {
            max-width: 400px;
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
        input[type="text"], input[type="email"], input[type="password"] {
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
        .success {
            color: green;
            font-size: 14px;
            text-align: center;
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
        .back-button {
            margin-top: 10px;
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
        <h2>Sign Up</h2>
        <?php if (!empty($success_message)): ?>
            <p class="success"><?= $success_message; ?></p>
        <?php endif; ?>
        <form action="signin.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?= htmlspecialchars($username); ?>">
                <span class="error"><?= $username_err; ?></span>
            </div>
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" value="<?= htmlspecialchars($first_name); ?>">
                <span class="error"><?= $first_name_err; ?></span>
            </div>
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" value="<?= htmlspecialchars($last_name); ?>">
                <span class="error"><?= $last_name_err; ?></span>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($email); ?>">
                <span class="error"><?= $email_err; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                <span class="error"><?= $password_err; ?></span>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" name="confirm_password" id="confirm_password">
                <span class="error"><?= $confirm_password_err; ?></span>
            </div>
            <button type="submit">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
        <div class="back-button">
            <a href="index.php">Back to Homepage</a>
        </div>
    </div>
</body>
</html>
