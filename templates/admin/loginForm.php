<?php include "./templates/include/header.php" ?>
        <div class="text-center">
        <form action="admin.php?action=login" method="post" class="form-signin vertical-center">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <input type="hidden" name="login" value="true" />

            <?php if (isset($results['errorMessage'])) { ?>
                <div class="container"> <?php echo $results['errorMessage'] ?> </div>
            <?php } ?>

            <label for="username" class="sr-only">Username</label>
            <input type="text" name="username" class="form-control" placeholder="User name" required autofocus maxlength="20"/>
            <label for="password" class="sr-only">Password</label>
            <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required maxlength="20"/>
            <button class="btn btn-lg btn-block menu-bar" type="submit">Sign in</button>
        </form>
        </div>
<?php include "./templates/include/footer.php" ?>