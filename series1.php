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
        <link href="css/styles.css" rel="stylesheet" />

        <title><?= $series1["title"] ?> - ScreenFlow</title>
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top">
            <div class="container px-5">
                <a class="navbar-brand" href="#page-top"><img src="assets/logo.ico">ScreenFlow</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="./index.php">Home</a></li>
                        <?php if($has_user): ?>
                            <li class="nav-item"><a class="nav-link" href="./series1.php?logout=true">Log Out</a></li>
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
            </div>
        </nav>
        <!-- Header-->
        <header class="masthead text-center text-white bg-image" style="background-image: url('Media/StrangerThings.jpg');">
            <div class="masthead-content">
                <div class="container px-5">
                    <h1 class="masthead-heading mb-0"><?= $series1["title"] ?></h1>
                    <h2 class="lead mb-0 mx-5"><?= $series1["plot"] ?></h2>
                    <a class="btn btn-primary btn-xl rounded-pill mt-5" href="#scroll">Show progress</a>
                </div>
            </div>
            <div class="bg-circle-1 bg-circle" style="left: -60rem;"></div>
            <div class="bg-circle-2 bg-circle"></div>
            <div class="bg-circle-3 bg-circle"></div>
        </header>
        <!-- Content section 1-->
        <?php $i = 1; ?>
        <?php foreach($series1["episodes"] as $episode): ?>
            <section id="scroll" class="bg-dark text-white py-5">
                <div class="container px-0">
                    <div class="row gx-5 align-items-center">
                        <?php if($has_user): ?>
                            <?php if($i <= $active_user["watched"]["series1"]): ?>
                                <?php if($i % 2 == 1): ?>
                                    <div class="col-lg-5 order-lg-2">
                                        <div class="p-1 py-5"><img class="img-fluid rounded" src="<?= $episode[$i]["cover"]?>" alt="..."/></div>
                                    </div>
                                    <div class="col-lg-7 order-lg-1">
                                        <div class="p-1 py-5">
                                            <h2 class="display-6">
                                                <?= $episode[$i]["title"]?>
                                                <a href="./series1.php?watched=<?= $i ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                    </svg>
                                                </a>
                                            </h2>
                                            <p class="text-white-50">Episode aired <?= $episode[$i]["date"]?> | IMDb rating: <?= $episode[$i]["rating"]?></p>
                                            <p><?= $episode[$i]["plot"]?></p>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-lg-5">
                                        <div class="p-1 py-5"><img class="img-fluid rounded" src="<?= $episode[$i]["cover"]?>" alt="..."/></div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="p-1 py-5">
                                            <h2 class="display-6">
                                                <?= $episode[$i]["title"]?>
                                                <a href="./series1.php?watched=<?= $i ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                                                    </svg>
                                                </a>
                                            </h2>
                                            <p class="text-white-50">Episode aired <?= $episode[$i]["date"]?> | IMDb rating: <?= $episode[$i]["rating"]?></p>
                                            <p><?= $episode[$i]["plot"]?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <?php if($i % 2 == 1): ?>
                                    <div class="col-lg-5 order-lg-2">
                                        <div class="p-1 py-5"><img class="img-fluid rounded" style="filter: grayscale(1);" src="<?= $episode[$i]["cover"]?>" alt="..."/></div>
                                    </div>
                                    <div class="col-lg-7 order-lg-1">
                                        <div class="p-1 py-5">
                                            <h2 class="display-6 text-white-50">
                                                <?= $episode[$i]["title"]?>
                                                <a href="./series1.php?unwatched=<?= $i ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                                    </svg>
                                                </a>
                                            </h2>
                                            <p class="text-white-50">Episode aired <?= $episode[$i]["date"]?> | IMDb rating: <?= $episode[$i]["rating"]?></p>
                                            <p class="text-white-50"><?= $episode[$i]["plot"]?></p>
                                        </div>
                                    </div>
                                <?php else: ?>
                                    <div class="col-lg-5">
                                        <div class="p-1 py-5"><img class="img-fluid rounded" style="filter: grayscale(1);" src="<?= $episode[$i]["cover"]?>" alt="..."/></div>
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="p-1 py-5">
                                            <h2 class="display-6 text-white-50">
                                                <?= $episode[$i]["title"]?>
                                                <a href="./series1.php?unwatched=<?= $i ?>">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                                                    </svg>
                                                </a>
                                            </h2>
                                            <p class="text-white-50">Episode aired <?= $episode[$i]["date"]?> | IMDb rating: <?= $episode[$i]["rating"]?></p>
                                            <p class="text-white-50"><?= $episode[$i]["plot"]?></p>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php else: ?>
                            <?php if($i % 2 == 1): ?>
                                <div class="col-lg-5 order-lg-2">
                                    <div class="p-1 py-5"><img class="img-fluid rounded" src="<?= $episode[$i]["cover"]?>" alt="..."/></div>
                                </div>
                                <div class="col-lg-7 order-lg-1">
                                    <div class="p-1 py-5">
                                        <h2 class="display-6"><?= $episode[$i]["title"]?></h2>
                                        <p class="text-white-50">Episode aired <?= $episode[$i]["date"]?> | IMDb rating: <?= $episode[$i]["rating"]?></p>
                                        <p><?= $episode[$i]["plot"]?></p>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="col-lg-5">
                                    <div class="p-1 py-5"><img class="img-fluid rounded" src="<?= $episode[$i]["cover"]?>" alt="..."/></div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="p-1 py-5">
                                        <h2 class="display-6"><?= $episode[$i]["title"]?></h2>
                                        <p class="text-white-50">Episode aired <?= $episode[$i]["date"]?> | IMDb rating: <?= $episode[$i]["rating"]?></p>
                                        <p><?= $episode[$i]["plot"]?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <?php $i = $i + 1; ?>
        <?php endforeach; ?>
        
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>