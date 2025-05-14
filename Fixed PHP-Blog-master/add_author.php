<!-- Include Head -->
<?php include "assest/head.php"; ?>

<title>Add Author</title>
</head>

<body>

    <!-- Header -->
    <?php include "assest/header.php"; ?>

    <!-- Main -->
    <main role="main" class="main">
        <div class="jumbotron text-center">
            <h1 class="display-3 font-weight-normal text-muted">Add Author</h1>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-4">
                    <!-- Form -->
                    <form action="assest/insert.php?type=author" method="POST" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <label for="authName">Full Name</label>
                            <input type="text" class="form-control" name="authName" id="authName" 
                                   required maxlength="100" pattern="[A-Za-z\s]+" 
                                   title="Only letters and spaces allowed">
                        </div>

                        <div class="form-group">
                            <label for="authDesc">Description</label>
                            <input type="text" class="form-control" name="authDesc" id="authDesc" 
                                   required maxlength="255">
                        </div>

                        <div class="form-group">
                            <label for="authEmail">Email</label>
                            <input type="email" class="form-control" name="authEmail" id="authEmail" 
                                   required maxlength="100">
                        </div>

                        <div class="form-group">
                            <label for="authImage">Avatar</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="authImage" id="authImage" required>
                                <label class="custom-file-label" for="authImage">Choose file</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="authTwitter">Twitter Username <span class="text-info">(optional)</span></label>
                            <input type="text" class="form-control" name="authTwitter" id="authTwitter" 
                                   maxlength="50" pattern="^[A-Za-z0-9_]{1,15}$" 
                                   title="Enter a valid Twitter username">
                        </div>

                        <div class="form-group">
                            <label for="authGithub">GitHub Username <span class="text-info">(optional)</span></label>
                            <input type="text" class="form-control" name="authGithub" id="authGithub" 
                                   maxlength="39" pattern="^[a-zA-Z0-9-]+$" 
                                   title="GitHub usernames may only contain letters, digits, and hyphens">
                        </div>

                        <div class="form-group">
                            <label for="authLinkedin">LinkedIn Username <span class="text-info">(optional)</span></label>
                            <input type="text" class="form-control" name="authLinkedin" id="authLinkedin" 
                                   maxlength="100" pattern="^[A-Za-z0-9-]+$" 
                                   title="LinkedIn usernames may only contain letters, numbers, and hyphens">
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