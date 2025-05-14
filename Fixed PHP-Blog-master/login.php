<?php
include "assest/head.php";

// Start session
session_start();

// Redirect if already logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

// Database connection (assumed)
require_once "config.php";

// Define variables
$username = $password = "";
$login_err = "";
$max_attempts = 5;
$lockout_time = 15 * 60; // 15 minutes

// Processing form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($password)) {
        $login_err = "Please enter both username and password.";
    } else {
        // Prepare SQL
        $sql = "SELECT id, username, password, login_attempts, last_attempt FROM users WHERE username = :username";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":username", $username, PDO::PARAM_STR);

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);

                    $id = $row["id"];
                    $hashed_password = $row["password"];
                    $attempts = $row["login_attempts"];
                    $last_attempt = strtotime($row["last_attempt"]);

                    // Check if account is locked
                    if ($attempts >= $max_attempts && (time() - $last_attempt) < $lockout_time) {
                        $login_err = "Account locked. Try again later.";
                    } else {
                        if (password_verify($password, $hashed_password)) {
                            // Reset login attempts
                            $reset_sql = "UPDATE users SET login_attempts = 0 WHERE id = :id";
                            $reset_stmt = $pdo->prepare($reset_sql);
                            $reset_stmt->bindParam(":id", $id, PDO::PARAM_INT);
                            $reset_stmt->execute();

                            // Set session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            header("location: index.php");
                            exit;
                        } else {
                            // Increment login attempts
                            $update_sql = "UPDATE users SET login_attempts = login_attempts + 1, last_attempt = NOW() WHERE id = :id";
                            $update_stmt = $pdo->prepare($update_sql);
                            $update_stmt->bindParam(":id", $id, PDO::PARAM_INT);
                            $update_stmt->execute();

                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    $login_err = "Invalid username or password.";
                }
            } else {
                $login_err = "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }
    unset($pdo);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="icon" href="img/logo/flogo.png" sizes="32x32" type="image/png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

<?php include "assest/header.php"; ?>

<main class="main">
    <div class="section jumbotron mb-0 h-100">
        <div class="container d-flex flex-column justify-content-center align-items-center h-100">
            <div class="wrapper my-0 pt-3 bg-white w-50 text-center">
                <img src="img/logo/logo.png" alt="dev culture logo" style="width: 100px;">
            </div>

            <div class="wrapper bg-white rounded px-4 py-4 w-50">
                <?php if (!empty($login_err)) : ?>
                    <div class="alert alert-danger"><?= $login_err; ?></div>
                <?php endif; ?>

                <form action="<?= htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($username); ?>">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Login">
                    </div>
                    <p><a href="#" class="text-muted">Lost your password?</a></p>
                </form>
            </div>
        </div>
    </div>
</main>

<!-- <footer><?php include "assest/footer.php"; ?></footer> -->

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>