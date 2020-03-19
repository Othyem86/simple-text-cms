<?php include "./templates/include/header.php" ?>
        <div class="jumbotron p-3 p-md-5 text-white rounded menu-bar">
			<div class="col-md-6 px-0">
				<h1 class="display-4">News Archive</h1>
			</div>
      	</div>

        <ul class="list-group list-group-flush">

            <?php foreach ($results['posts'] as $post) { ?>
                <li class="list-group-item">
                    <h2>
                        <a href=".?action=viewPost&postId=<?php echo $post->id ?>">
                            <?php echo $post->title ?>
                        </a>
                    </h2>
                    <p>
                    <?php echo date('j F Y', $post->publicationDate)?>
                    </p>
                    <p>
                        <?php echo $post->summary ?>
                    </p>
                </li>
            <?php } ?>
        </ul>

        <p><?php echo $results['totalRows']?> post<?php echo ($results['totalRows'] != 1) ? 's' : '' ?> found.</p>
<?php include "./templates/include/footer.php" ?>