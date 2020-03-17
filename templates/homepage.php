<?php include "./templates/include/header.php" ?>
		<div class="jumbotron p-3 p-md-5 text-white rounded menu-bar">
			<div class="col-md-6 px-0">
				<h1 class="display-4">BOTTLE CAP</h1>
				<p class="lead my-3">Because little plastic round things are better than humans.</p>
			</div>
		</div>
		<div class="album py-5 bg-light">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
						<div class="card mb-4 shadow-sm">
							<div class="thumbnail">
								<img src="./images/attac.jpg" alt="attac" style="width:100%">
							</div>
							<div class="card-body text-center">
								<p class="card-text">Bottle Cap attac.</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card mb-4 shadow-sm">
							<img src="images/protec.jpg" alt="protec" style="width:100%">
							<div class="card-body text-center">
								<p class="card-text">Bottle Cap protec.</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="card mb-4 shadow-sm">
							<img src="images/fake.jpg" alt="fake" style="width:100%">
							<div class="card-body text-center">
								<p class="card-text">This site fek.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>

		<ul class="list-group list-group-flush">
			<li class="list-group-item">
				<h2>Latest News</h2>
			</li>
		<?php foreach ($results['posts'] as $post) { ?>
			<li class="list-group-item">
				<h2>						
					<a href=".?action=viewPost&postId=<?php echo $post->id ?>">
						<?php echo $post->title ?>
					</a>
				</h2>
				<p>
					<?php echo date('j F', $post->publicationDate)?>
				</p>
				<p>
					<?php echo $post->summary ?>
				</p>
			</li>
		<?php } ?>
		</ul>
<?php include "./templates/include/footer.php" ?>