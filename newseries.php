<?php
    $data = array_fill_keys(array("newseriesTitle", "newseriesYear", "newseriesPlot", "newseriesCover", "newepisodeDate", "newepisodeTitle", "newepisodePlot", "newepisodeRating", "newepisodeCover"), "");;
    $errors = array_fill_keys(array("newseriesTitleError", "newseriesYearError", "newseriesPlotError", "newseriesCoverError", "newepisodeDateError", "newepisodeTitleError", "newepisodePlotError", "newepisodeRatingError", "newepisodeCoverError"), "");
    $information = array_fill_keys(array("series", "episode"), "");
    $is_login = false;
    $has_user = false;
    $is_new_episode = false;
    $active_user = [];

    $json_string = file_get_contents("series.json");
    $series = json_decode($json_string, true);
    $series_id = count($series) + 1;

    $json_string = file_get_contents("users.json");
    $users = json_decode($json_string, true);

    $json_string = file_get_contents("episodes.json");
    $episodes = json_decode($json_string, true);
    $episode_id = count($episodes) + 1;

    if (validate($_POST)) {
        if (isset($_POST["newseriesAdd"])) {
            $new_data = [
                "id" => "series{$series_id}",
                "year" => $data["newseriesYear"],
                "title" => $data["newseriesTitle"],
                "plot" => $data["newseriesPlot"],
                "cover" => $data["newseriesCover"],
                "episodes" => $episodes
            ];
            array_push($series, $new_data);
            $episodes = [];
            $information["series"] = "TV Series successfully added";
        }
        if (isset($_POST["newepisodeAdd"])) {
            $new_data = [
                $episode_id => [
                    "id" => $episode_id,
                    "date" => $data["newepisodeDate"],
                    "title" => $data["newepisodeTitle"],
                    "plot" => $data["newepisodePlot"],
                    "rating" => $data["newepisodeRating"],
                    "cover" => $data["newepisodeCover"]
                ]
            ];
            array_push($episodes, $new_data);
            $episode_id = $episode_id + 1;
            $is_new_episode = true;
            $information["episode"] = "Episode successfully added";
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

    if (isset($_POST["newepisodeMode"])) {
        $is_new_episode = true;
    }

    $new_array = json_encode($users, JSON_PRETTY_PRINT);
    file_put_contents("users.json", $new_array);

    $new_array = json_encode($series, JSON_PRETTY_PRINT);
    file_put_contents("series.json", $new_array);

    $new_array = json_encode($episodes, JSON_PRETTY_PRINT);
    file_put_contents("episodes.json", $new_array);

    function validate($fv) {
        global $data, $errors;

        $post_newseries_adding = filter_input(INPUT_POST, "newseriesAdd");
        $post_newepisode_adding = filter_input(INPUT_POST, "newepisodeAdd");
        $post_newepisode_mode = filter_input(INPUT_POST, "newepisodeMode");

        if (!empty($post_newseries_adding) || !empty($post_newepisode_mode)) {
            if ($fv["newseriesTitle"] === "") $errors["newseriesTitleError"] = "Title is required";
            else $data["newseriesTitle"] = $fv["newseriesTitle"];
            
            if ($fv["newseriesYear"] === "") $errors["newseriesYearError"] = "Year is required";
            else if (!(is_numeric($fv["newseriesYear"]) && $fv["newseriesYear"] > 1800)) $errors["newseriesYearError"] = "Year must be a number greater than 1800";
            else $data["newseriesYear"] = $fv["newseriesYear"];

            if ($fv["newseriesPlot"] === "") $errors["newseriesPlotError"] = "Plot is required";
            else if (strlen($fv["newseriesPlot"]) < 10) $errors["newseriesPlotError"] = "Plot must be at least 10 characters long";
            else $data["newseriesPlot"] = $fv["newseriesPlot"];

            if ($fv["newseriesCover"] === "") $errors["newseriesCoverError"] = "Cover is required";
            else if (!filter_var($fv["newseriesCover"], FILTER_VALIDATE_URL)) $errors["newseriesCoverError"] = "Invalid URL format";
            else $data["newseriesCover"] = $fv["newseriesCover"];
        }

        if (!empty($post_newepisode_adding)) {
            echo "In validate post_newepisode_adding.";
            if ($fv["newepisodeDate"] === "") $errors["newepisodeDateError"] = "Date is required";
            else $data["newepisodeDate"] = $fv["newepisodeDate"];

            if ($fv["newepisodeTitle"] === "") $errors["newepisodeTitleError"] = "Title is required";
            else $data["newepisodeTitle"] = $fv["newepisodeTitle"];

            if ($fv["newepisodePlot"] === "") $errors["newepisodePlotError"] = "Plot is required";
            else if (strlen($fv["newepisodePlot"]) < 10) $errors["newepisodePlotError"] = "Plot must be at least 10 characters long";
            else $data["newepisodePlot"] = $fv["newepisodePlot"];

            if ($fv["newepisodeRating"] === "") $errors["newepisodeRatingError"] = "Rating is required";
            else if (!(is_numeric($fv["newepisodeRating"]) && $fv["newepisodeRating"] >= 0.0 && $fv["newepisodeRating"] <= 10.0)) $errors["newepisodeRatingError"] = "Rating must be a number between 0.0 and 10.0";
            else $data["newepisodeRating"] = $fv["newepisodeRating"];

            if ($fv["newepisodeCover"] === "") $errors["newepisodeCoverError"] = "Cover is required";
            else if (!filter_var($fv["newepisodeCover"], FILTER_VALIDATE_URL)) $errors["newepisodeCoverError"] = "Invalid URL format";
            else $data["newepisodeCover"] = $fv["newepisodeCover"];
        }

        $is_empty = true;
        foreach ($errors as $error => $error_value) {
            if ($error_value !== "") {
                $is_empty = false;
            }
        }

        return $is_empty;
    }
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
        <link href="css/styles.css" rel="stylesheet" />
    
        <title>Add new TV Series - ScreenFlow</title>
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
        <header class="masthead text-center text-white bg-image" style="background-image: url('Media/TheLastDanceBG.jpg');">
            <div class="masthead-content">
                <div class="container py-1 px-5">
                    <div class="row g-0 align-items-center px-5">
                        <div class="col mb-5 mb-lg-0 px-5">
                            <div class="card mx-5" style="background: hsla(0, 0%, 9%, 0.5); backdrop-filter: blur(30px);">
                                <div class="card-body p-5 shadow-5 text-center">
                                    <h2 class="fw-bold mb-5">Add new TV Series to ScreenFlow</h2>
                                    <p><?= $information["series"] ?></p>
                                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
                                        <div class="form-outline mb-4">
                                            <input type="text" id="newseriesTitle" name="newseriesTitle" value="<?php echo htmlspecialchars($_POST["newseriesTitle"] ?? "", ENT_QUOTES); ?>" class="form-control bg-dark text-white" placeholder="Title"/><span style="color: red;"><?= $errors["newseriesTitleError"] ?></span>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="number" id="newseriesYear" name="newseriesYear" value="<?php echo htmlspecialchars($_POST["newseriesYear"] ?? "", ENT_QUOTES); ?>" class="form-control bg-dark text-white" placeholder="Year"/><span style="color: red;"><?= $errors["newseriesYearError"] ?></span>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="textarea" id="newseriesPlot" name="newseriesPlot" value="<?php echo htmlspecialchars($_POST["newseriesPlot"] ?? "", ENT_QUOTES); ?>" class="form-control bg-dark text-white" placeholder="Plot"/><span style="color: red;"><?= $errors["newseriesPlotError"] ?></span>
                                        </div>
                                        <div class="form-outline mb-4">
                                            <input type="url" id="newseriesCover" name="newseriesCover" value="<?php echo htmlspecialchars($_POST["newseriesCover"] ?? "", ENT_QUOTES); ?>" class="form-control bg-dark text-white" placeholder="Cover"/><span style="color: red;"><?= $errors["newseriesCoverError"] ?></span>
                                        </div>
                                        <?php if($is_new_episode): ?>
                                            <?php $i = 1; ?>
                                            <?php foreach($episodes as $episode): ?>
                                                <div class="row g-0 align-items-center px-5">
                                                    <div class="col mb-5 mb-lg-0 px-5">
                                                        <h2 class="lead text-start pb-1"><?= $episode["$i"]["title"]?></h2>
                                                    </div>
                                                </div>
                                                <?php $i = $i + 1; ?>
                                            <?php endforeach; ?>
                                            <h2 class="lead text-start pb-1">New episode</h2>
                                            <p><?= $information["episode"] ?></p>
                                            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" novalidate>
                                                <div class="form-outline mb-4">
                                                    <input type="date" id="newepisodeDate" name="newepisodeDate" class="form-control bg-dark text-white" placeholder="Date"/><span style="color: red;"><?= $errors["newepisodeDateError"] ?></span>
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <input type="text" id="newepisodeTitle" name="newepisodeTitle" class="form-control bg-dark text-white" placeholder="Title"/><span style="color: red;"><?= $errors["newepisodeTitleError"] ?></span>
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <input type="textarea" id="newepisodePlot" name="newepisodePlot" class="form-control bg-dark text-white" placeholder="Plot"/><span style="color: red;"><?= $errors["newepisodePlotError"] ?></span>
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <input type="number" step="0.1" id="newepisodeRating" name="newepisodeRating" class="form-control bg-dark text-white" placeholder="Rating"/><span style="color: red;"><?= $errors["newepisodeRatingError"] ?></span>
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <input type="url" id="newepisodeCover" name="newepisodeCover" class="form-control bg-dark text-white" placeholder="Cover"/><span style="color: red;"><?= $errors["newepisodeCoverError"] ?></span>
                                                </div>
                                                <div class="form-outline mb-4">
                                                    <input type="submit" class="btn btn-primary btn-block mb-4" name="newepisodeAdd" value="Add new episode">
                                                </div>
                                            </form>
                                        <?php else: ?>
                                            <div class="form-outline mb-4">
                                                <input type="submit" class="btn btn-primary btn-block mb-4" name="newepisodeMode" value="Add new episode">
                                            </div>
                                        <?php endif; ?>
                                        <input type="submit" class="btn btn-primary btn-block mb-4" name="newseriesAdd" value="Add new TV Series">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-circle-1 bg-circle"></div>
            <div class="bg-circle-2 bg-circle"></div>
            <div class="bg-circle-3 bg-circle"></div>
        </header>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>