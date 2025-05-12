<!-- Include Head -->
<?php 
include "assest/head.php"; 

// CSRF token generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$stmt = $conn->prepare("SELECT category_id, category_name FROM category");
$stmt->execute();
$categories = $stmt->fetchAll();

$stmt = $conn->prepare("SELECT author_id, author_fullname FROM author");
$stmt->execute();
$authors = $stmt->fetchAll();
?>

<!-- JS TextEditor -->
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>

<title>Add Article</title>
</head>

<body>

    <!-- Header -->
    <?php include "assest/header.php" ?>

    <!-- Main -->
    <main role="main" class="main">
        <div class="jumbotron text-center">
            <h1 class="display-3 font-weight-normal text-muted">Submit an Article</h1>
        </div>

        <div class="container">
            <div class="row">

                <div class="col-lg-12 mb-4">
                    <!-- Form -->
                    <form action="assest/insert.php?type=article" method="POST" enctype="multipart/form-data">
                        <!-- CSRF Token -->
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

                        <div class="form-group">
                            <label for="arTitle">Title</label>
                            <input type="text" class="form-control" name="arTitle" id="arTitle" maxlength="255" required>
                        </div>

                        <div class="form-group">
                            <label for="arContent">Content</label>
                            <textarea class="form-control" name="arContent" id="arContent" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="arImage">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="arImage" id="arImage" accept=".jpg,.jpeg,.png">
                                <label class="custom-file-label" for="arImage">Choose file</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="arCategory">Category</label>
                            <select class="custom-select" name="arCategory" id="arCategory" required>
                                <option disabled selected>-- Select Category --</option>
                                <?php foreach ($categories as $category) : ?>
                                    <option value="<?= htmlspecialchars($category['category_id']) ?>">
                                        <?= htmlspecialchars($category['category_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="arAuthor">Author</label>
                            <select class="custom-select" name="arAuthor" id="arAuthor" required>
                                <option disabled selected>-- Select Author --</option>
                                <?php foreach ($authors as $author) : ?>
                                    <option value="<?= htmlspecialchars($author['author_id']) ?>">
                                        <?= htmlspecialchars($author['author_fullname']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
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
    <!-- <?php include "assest/footer.php" ?> -->

    <!-- Text Editor Script -->
    <script>
        CKEDITOR.replace('arContent');
    </script>

</body>
</html>
