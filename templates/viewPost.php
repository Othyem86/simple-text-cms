<?php include "./templates/include/header.php" ?>
        <div class="jumbotron p-3 p-md-5 text-white menu-bar">
			<div>
				<h1 class="display-4 font-italic"><?php echo $results['post']->title ?></h1>
				<p class="lead my-3"><?php echo $results['post']->summary ?></p>
                <p class="pubDate font-italic">Published on <?php echo date('j F Y', $results['post']->publicationDate) ?></p>
			</div>
        </div>
        <div class="container b-white post"><?php echo $results['post']->content?></div>
<?php include "./templates/include/footer.php" ?>