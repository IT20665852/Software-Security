<?php include "assest/head.php"; ?>
<?php
session_start(); // Start session at the top

// Brute Force Protection Setup
if (!isset($_SESSION["login_attempts"])) {
    $_SESSION["login_attempts"] = 0;
    $_SESSION["last_attempt_time"] = time();
}
$lockout_time = 300; // Lockout time in seconds (5 minutes)
if ($_SESSION["login_attempts"] >= 5 && (time() - $_SESSION["last_attempt_time"]) < $lockout_time) {
    die("Too many login attempts. Please try again after 5 minutes.");
}

// Redirect if already logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT * FROM users WHERE username = :username";

        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $param_username = trim($_POST["username"]);

            if ($stmt->execute()) {
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $id = $row["id"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if (password_verify($password, $hashed_password)) {
                            // Successful login
                            session_regenerate_id(true); // Fix for session fixation
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Reset login attempts
                            $_SESSION["login_attempts"] = 0;
                            $_SESSION["last_attempt_time"] = time();

                            header("location: index.php");
                            exit;
                        } else {
                            $password_err = "Invalid username or password.";
                            $_SESSION["login_attempts"] += 1;
                            $_SESSION["last_attempt_time"] = time();
                        }
                    }
                } else {
                    $username_err = "Invalid username or password.";
                    $_SESSION["login_attempts"] += 1;
                    $_SESSION["last_attempt_time"] = time();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            unset($stmt);
        }
    }
    unset($pdo);
}
?>
