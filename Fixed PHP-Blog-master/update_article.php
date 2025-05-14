<!-- Include Head -->
<?php 
include "assest/head.php"; 
session_start();

// Validate article_id input
$article_id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$article_id) {
    die("Invalid article ID.");
}

// Get article data
$stmt = $conn->prepare("SELECT * FROM article WHERE article_id = ?");
$stmt->execute([$article_id]);
$article = $stmt->fetch();

if (!$article) {
    die("Article not found.");
}

// Get categories
$stmt = $conn->prepare("SELECT category_id, category_name FROM category");
$stmt->execute();
$categories = $stmt->fetchAll();

// Get authors
$stmt = $conn->prepare("SELECT author_id, author_fullname FROM author");
$stmt->execute();
$authors = $stmt->fetchAll();
?>

<!-- JS TextEditor -->
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<title>Update Article</title>
</head>

<body>
    <!-- Header -->
    <?php include "assest/header.php" ?>

    <!-- Main -->
    <main role="main" class="main">
        <div class="jumbotron text-center">
            <h1 class="display-3 font-weight-normal text-muted">Update Article</h1>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-8 mb-4">
                    <!-- Form -->
                    <form action="assest/update.php?type=article&id=<?= urlencode($article_id) ?>&img=<?= urlencode($article["article_image"]) ?>" method="POST" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <label for="arTitle">Title</label>
                            <input type="text" class="form-control" name="arTitle" id="arTitle" value="<?= htmlspecialchars($article["article_title"]) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="arContent">Content</label>
                            <textarea class="form-control" name="arContent" id="arContent" rows="3" required><?= htmlspecialchars($article["article_content"]) ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="arImage">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="arImage" id="arImage" accept="image/*">
                                <label class="custom-file-label" for="arImage"><?= htmlspecialchars($article['article_image']) ?></label>
                            </div>
                        </div>

                        <div class="my-2" style="width: 200px;">
                            <img class="w-100 h-auto" src="img/article/<?= htmlspecialchars($article["article_image"]) ?>" alt="Current Article Image">
                        </div>

                        <div class="form-group">
                            <label for="arCategory">Category</label>
                            <select class="custom-select" name="arCategory" id="arCategory" required>
                                <option disabled>-- Select Category --</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['category_id'] ?>" <?= ($article['id_categorie'] == $category['category_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($category['category_name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="arAuthor">Author</label>
                            <select class="custom-select" name="arAuthor" id="arAuthor" required>
                                <option disabled>-- Select Author --</option>
                                <?php foreach ($authors as $author): ?>
                                    <option value="<?= $author['author_id'] ?>" <?= ($article['id_author'] == $author['author_id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($author['author_fullname']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="text-center">
                            <button type="submit" name="update" class="btn btn-success btn-lg w-25">Update</button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-4 mb-4">
                    <!-- Optional Sidebar -->
                </div>
            </div>
        </div>
    </main>

    <!-- Text Editor Script -->
    <script>
        CKEDITOR.replace('arContent');
    </script>
</body>
</html>