<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title><?php echo $results['pageTitle']?></title>
</head>
<body>
    <!-- Fixed navbar -->
    <nav class="navbar fixed-bottom navbar-expand-md navbar-dark menu-bar">
        <a class="navbar-brand" href=".">BOTTLE CAP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                <a class="nav-link" href=".">Home</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="./?action=archive">Archive</a>
                </li>
                <li class="nav-item">
                <a class="nav-link disabled" href="#">Impressum</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="admin.php">Login</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container" style="margin-bottom:66px;">