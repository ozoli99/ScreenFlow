<?php
    $json_string = file_get_contents("series.json");
    $series = json_decode($json_string, true);

    $json_string = file_get_contents("users.json");
    $users = json_decode($json_string, true);

    $active_user = [];
    $has_user = false;
    $is_admin = false;

    if (is_array($users) || is_object($users)) {
        foreach ($users as $user) {
            if ($user["login"]) {
                $active_user = $user;
                $has_user = true;
                if ($active_user["username"] === "admin") {
                    $is_admin = true;
                }
            }
        }
    }

    if (isset($_GET["logout"])) {
        foreach ($users as $key => $user) {
            if ($user["login"]) {
                $users[$key]["login"] = false;
                $has_user = false;
                $active_user = [];
            }
        }
    }

    $new_array = json_encode($users, JSON_PRETTY_PRINT);
    file_put_contents("users.json", $new_array);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Orosz Zoltán">

        <link rel="icon" type="image/x-icon" href="assets/logo.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="css/styles.css"/>

        <title>Mainpage - ScreenFlow</title>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
            <div class="container px-5">
                <a class="navbar-brand" href="#page-top"><img src="assets/logo.ico">ScreenFlow</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <?php if($has_user): ?>
                        <li class="nav-item"><a class="nav-link" href="./index.php?logout=true">Log Out</a></li>
                        <li class="nav-item pt-1" style="color: #6c757d;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                            <?= $active_user["username"] ?>
                        </li>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link" href="./login.php">Log In</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <!-- Header-->
        <header class="masthead text-center text-white bg-image" style="background-image: url('Media/TheWitcher.jpg');">
            <div class="masthead-content">
                <div class="container px-5">
                    <h1 class="masthead-heading mb-0">ScreenFlow</h1>
                    <h2 class="display-6 mb-0">The ultimate tool for tracking your TV Show progress!</h2>
                    <a class="btn btn-primary btn-xl rounded-pill mt-5" href="#scroll">Show TV Shows</a>
                </div>
            </div>
            <div class="bg-circle-1 bg-circle" style="left: -60rem;"></div>
            <div class="bg-circle-2 bg-circle"></div>
            <div class="bg-circle-3 bg-circle"></div>
        </header>
        <!-- Content section-->
        <?php $i = 1; ?>
        <?php foreach($series as $show): ?>
            <section id="scroll" class="py-5 bg-dark text-white">
                <div class="container px-5">
                    <div class="row gx-5 align-items-center">
                        <?php if($i % 2 == 1): ?>
                            <div class="col-lg-6 order-lg-2">
                                <div class="p-5">
                                    <a href="./<?= $show["id"] ?>.php">
                                        <img class="img-fluid rounded-circle" src="<?= $show["cover"] ?>" alt="..."/>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6 order-lg-1">
                                <div class="p-5">
                                    <h2 class="display-4"><?= $show["title"] ?></h2>
                                    <p class="text-white-50"><?= count($show["episodes"]) ?> episodes | Last epidose on <?= $show["episodes"][count($show["episodes"])-1][count($show["episodes"])]["date"] ?></p>
                                    <p><?= $show["plot"] ?></p>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <a href="./<?= $show["id"] ?>.php">
                                        <img class="img-fluid rounded-circle" src="<?= $show["cover"] ?>" alt="..."/>
                                    </a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <h2 class="display-4"><?= $show["title"] ?></h2>
                                    <p class="text-white-50"><?= count($show['episodes']) ?> episodes | Last episode on <?= $show['episodes'][count($show['episodes'])-1][count($show['episodes'])]['date'] ?></p>
                                    <p><?= $show["plot"] ?></p>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <?php $i = $i + 1; ?>
        <?php endforeach; ?>
        <?php if($is_admin): ?>
            <section class="py-5 bg-dark text-white">
                <div class="container px-5">
                    <div class="row gx-3">
                        <div class="col text-end order-lg-1">
                            <a href="./newseries.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                </svg>
                            </a>
                        </div>
                        <div class="col order-lg-2 py-1">
                            <p>Add new TV Series</p>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>