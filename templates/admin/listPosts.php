<?php include "./templates/include/header.php" ?>

        <div class="jumbotron p-3 p-md-5 text-white rounded menu-bar">
			<div class="col-md-6 px-0">
                <h1 class="display-4">BOTTLE CAP ADMIN</h1>
                <p class="lead my-3">You are logged in as <b><?php echo $_SESSION['username'] ?></b>.</p>	
			</div>
      	</div>
        <h2>All Posts</h2>
        <hr>

        <?php if (isset($results['errorMessage'])) { ?>
            <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
        <?php } ?>


        <?php if (isset($results['statusMessage'])) { ?>
            <div class="statusMessage"><?php echo $results['statusMessage'] ?></div>
        <?php } ?>

        <table class="table table-hover">
            <thead class="thead-light">
                <tr>
                    <th>Publication Date</th>
                    <th>Post</th>
                </tr>
            </thead>

            <?php foreach ( $results['posts'] as $post ) { ?>

            <tr onclick="location='admin.php?action=editPost&postId=<?php echo $post->id?>'">
                <td><?php echo date('j M Y', $post->publicationDate)?></td>
                <td>
                    <?php echo $post->title?>
                </td>
            </tr>

            <?php } ?>

        </table>

        <p><?php echo $results['totalRows']?> post<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> found.</p>

        <button class="btn btn-lg btn-block menu-bar" onclick="window.location.href = 'admin.php?action=newPost';">Create New Post</button>
        <button class="btn btn-lg btn-block btn-secondary" onclick="window.location.href = 'admin.php?action=logout';">Log out</button>
        
<?php include "./templates/include/footer.php" ?>