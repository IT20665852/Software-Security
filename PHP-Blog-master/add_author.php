<?php include "assest/head.php"; ?>

<title>Add Author</title>
</head>

<body>

<?php include "assest/header.php" ?>

<main role="main" class="main">

    <div class="jumbotron text-center">
        <h1 class="display-3 font-weight-normal text-muted">Add Author</h1>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-lg-12 mb-4">
                <form action="assest/insert.php?type=author" method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label for="authName">Full Name</label>
                        <input type="text" class="form-control" name="authName" id="authName" required maxlength="50">
                    </div>

                    <div class="form-group">
                        <label for="authDesc">Description</label>
                        <input type="text" class="form-control" name="authDesc" id="authDesc" required maxlength="150">
                    </div>

                    <div class="form-group">
                        <label for="authEmail">Email</label>
                        <input type="email" class="form-control" name="authEmail" id="authEmail" required>
                    </div>

                    <div class="form-group">
                        <label for="authImage">Avatar</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="authImage" id="authImage" accept="image/jpeg, image/png">
                            <label class="custom-file-label" for="authImage">Choose file</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="authTwitter">Twitter Username <span class="text-info">(optional)</span></label>
                        <input type="text" class="form-control" name="authTwitter" id="authTwitter" placeholder="Ex: Moon96Schwarz" maxlength="15" pattern="^[A-Za-z0-9_]{1,15}$">
                    </div>

                    <div class="form-group">
                        <label for="authGithub">Github Username <span class="text-info">(optional)</span></label>
                        <input type="text" class="form-control" name="authGithub" id="authGithub" placeholder="Ex: Moon96Schwarz" maxlength="39" pattern="^[A-Za-z0-9-]{1,39}$">
                    </div>

                    <div class="form-group">
                        <label for="authLinkedin">Linkedin Username <span class="text-info">(optional)</span></label>
                        <input type="text" class="form-control" name="authLinkedin" id="authLinkedin" placeholder="Ex: Moon96Schwarz" maxlength="30" pattern="^[A-Za-z0-9-]{1,30}$">
                    </div>

                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-success btn-lg w-25">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

</main>

</body>
</html>
