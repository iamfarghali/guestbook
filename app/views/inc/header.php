<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Fontawsome -->
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <!-- App Style -->
    <link rel="stylesheet" href="<?= APPURL . 'css' . DS ?>app.css">

    <title><?=SITENAME?></title>
</head>
<body>
    <!-- Start Main Container -->
    <main class="container mb-5">
        <?php if (isUserlogged()): ?>
            <header>
                <nav class="navbar navbar-expand-md">

                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link text-muted" href="<?= APPURL ?>">Home</a>
                        </li>
        
                        <li class="nav-item">
                            <a class="nav-link text-muted" href="<?= APPURL.'users'.DS.'profile'.DS.$_SESSION['user_id'] ?>">Profile</a>
                        </li>

                    </ul>
                                
                    <ul class="navbar-nav ml-auto">  
                        <li class="nav-item">
                            <span class="nav-link text-dark"><?=$_SESSION['user_name']?></span>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link text-muted" href="<?=APPURL.'users'.DS.'logout'?>">Logout</a>
                        </li>
                    </ul>
                </nav>
            </header>
        <?php endif; ?>