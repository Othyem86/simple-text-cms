<?php include "./templates/include/header.php" ?>
        <div class="jumbotron p-3 p-md-5 text-white rounded menu-bar">
			<div class="col-md-6 px-0">
                <h1 class="display-4">BOTTLE CAP ADMIN</h1>
                <p class="lead my-3">You are logged in as <b><?php echo $_SESSION['username'] ?></b>.</p>	
			</div>
      	</div>

        <h1><?php echo $results['pageTitle']?></h1>

        <form action="admin.php?action=<?php echo $results['formAction']?>" method="post" class="form-signin">
            <input type="hidden" name="postId" value="<?php echo $results['post']->id ?>"/>

            <?php if (isset( $results['errorMessage'])) { ?>
                <div class="errorMessage"><?php echo $results['errorMessage'] ?></div>
            <?php } ?>
            
            <div class="form-group">
                <label for="title">Post Title</label>
                <input type="text" name="title" class="form-control" placeholder="Name of the post" required autofocus maxlength="255" value="<?php echo $results['post']->title ?>"/>
            </div>
            <div class="form-group">
                <label for="summary">Post Summary</label>
                <textarea name="summary"  class="form-control" placeholder="Brief description of the post" required maxlength="1000" rows="4"><?php echo $results['post']->summary ?></textarea>
            </div>
            <div class="form-group">
                <label for="content">Post Content</label>
                <textarea name="content" class="form-control" placeholder="The HTML content of the post" required maxlength="100000" rows="20"><?php echo $results['post']->content ?></textarea>
            </div>
            <div class="form-group">
                <label for="publicationDate">Publication Date</label>
                <input type="date" name="publicationDate" class="form-control" placeholder="YYYY-MM-DD" required maxlength="10" value="<?php echo $results['post']->publicationDate ? date( "Y-m-d", $results['post']->publicationDate ) : "" ?>" />
            </div>

            <div >
                <input class="btn btn-lg btn-block menu-bar" type="submit" name="saveChanges" value="Save Changes"/>
                <input class="btn btn-lg btn-block menu-bar" type="submit" formnovalidate name="cancel" value="Cancel"/>
            </div>
        </form>
        <hr>
        <?php if ($results['post']->id) { ?>
            <a href="admin.php?action=deletePost&postId=<?php echo $results['post']->id ?>" onclick="return confirm('Delete This Post?')">
                <button class="btn btn-lg btn-block btn-secondary">Delete This Post</button>
            </a>
            
        <?php } ?>

<?php include "./templates/include/footer.php" ?>