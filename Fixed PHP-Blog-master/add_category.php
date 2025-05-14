<?php
// Enforce HTTPS
if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
    $redirect = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header("Location: $redirect");
    exit();
}

session_start();

// Check if the user is logged in and has admin role
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "assest/head.php"; ?>
    <title>Add Category</title>

    <!-- Content Security Policy -->
    <meta http-equiv="Content-Security-Policy"
          content="default-src 'self'; script-src 'self'; style-src 'self' 'unsafe-inline'; img-src 'self' data:;">
</head>

<body>

    <!-- Header -->
    <?php include "assest/header.php"; ?>

    <!-- Main -->
    <main role="main" class="main">
        <div class="jumbotron text-center">
            <h1 class="display-3 font-weight-normal text-muted">Submit a Category</h1>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Form -->
                    <form action="assest/insert.php?type=category" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="catName">Category Name</label>
                            <input type="text" class="form-control" name="catName" id="catName" required>
                        </div>

                        <div class="form-group">
                            <label for="catImage">Category Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="catImage" id="catImage" required>
                                <label class="custom-file-label" for="catImage">Choose file</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="catColor">Category Color</label>
                            <input type="color" id="catColor" name="catColor" value="#0f88e1" required>
                        </div>

                        <div class="text-center">
                            <button type="submit" name="submit" class="btn btn-success btn-lg w-25">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <!-- <?php include "assest/footer.php"; ?> -->

</body>
</html>
