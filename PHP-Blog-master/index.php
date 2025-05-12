<?php
session_start(); // Must be first line
?>

<!-- Include Head -->
<?php include "assest/head.php"; ?>
<?php

// Get Latest articles
$stmt = $conn->prepare("SELECT * FROM `article` INNER JOIN category ON id_categorie=category_id ORDER BY `article_created_time` DESC  LIMIT 9");
$stmt->execute();
$articles = $stmt->fetchAll();

// Get Categories
$stmt = $conn->prepare("SELECT *,COUNT(*) as article_count FROM `article` INNER JOIN category ON id_categorie=category_id GROUP BY id_categorie");
$stmt->execute();
$categories = $stmt->fetchAll();

// Get Most Read Articles
$stmt = $conn->prepare("SELECT * FROM `article` INNER JOIN category ON id_categorie=category_id order by RAND() LIMIT 4");
$stmt->execute();
$most_read_articles = $stmt->fetchAll();

?>

<!-- Google font -->
<link href="https://fonts.googleapis.com/css?family=Nunito+Sans:700%7CNunito:300,600" rel="stylesheet">
<link type="text/css" rel="stylesheet" href="css/style.css" />

<style>
    .bg-div {
        background: linear-gradient(rgba(0, 0, 0, 0.5),
                rgba(0, 0, 0, 0.5)), url("./img/slider/pexels-marc-mueller.jpg");
        height: 680px;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
</style>

<title>Home</title>
</head>

<body class="d-flex flex-column min-vh-100">

    <!-- Header -->
    <?php include "assest/header.php" ?>

    <!-- Main -->
    <main class="main">

        <!-- Jumbotron -->
        <div class="jumbotron text-center p-0 mb-0">
            <div class="bg-div px-5 d-flex align-items-center">
                <div class="text-left w-50">
                    <h1 class="display-4 text-white">Welcome to Dev Culture!</h1>
                    <h2 class="display-5 text-white">Discover Dev tutorial and articles that you can read completely for free!</h2>

                    <!-- Login Section -->
                    <?php if (isset($_SESSION['user_name'])): ?>
                        <p class="text-white mt-3">
                            Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!
                            <br>Email: <?= htmlspecialchars($_SESSION['user_email']) ?>
                            <br><a href="logout.php" class="btn btn-danger btn-sm mt-2">Logout</a>
                        </p>
                    <?php else: ?>
                        <a href="login-with-google.php" class="btn btn-light mt-3">Login with Google</a>
                    <?php endif; ?>
                </div>
            </div>
        </div><!-- /Jumbotron -->

        <!-- Latest Articles -->
        <!-- (Your original article sections go here) -->

        <!-- Footer -->
        <?php include "assest/footer.php" ?>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>
</html>
