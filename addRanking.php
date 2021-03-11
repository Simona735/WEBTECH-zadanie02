<?php
require_once "helpers/personDBController.php";
$controller = new PersonDBController();

if (isset($_POST["person_id"]) && $_POST["person_id"]) {
    $controller->insertRanking($_POST['person_id'], $_POST['oh_id'], $_POST['placing'], $_POST['discipline']);
    header('Location:index.php');
}

$games = $controller->getAllOH();
$OHs = [];
foreach ($games as $game){
    array_push($OHs, $game->getOhLine());
}

$people = $controller->getAllPeople();
$athletes = [];
foreach ($people as $person){
    array_push($athletes, $person->getBasicData());
}

?>

<!doctype html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Richterova">
    <!-- favicon
		============================================ -->
    <link rel="icon" type="image/png" href="img/medal.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="css/default.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Olympiády</title>
</head>

<body class="bg-light">

<div class="container">
    <div class="py-5 text-center">
        <h2>Pridaj umiestnenie</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 order-md-1">
            <form method="post" action="addRanking.php">
                <div class="form-row justify-content-center">
                    <div class="col-md-6 mb-3 ">
                        <label for="person_id">Meno</label>
                        <select id="person_id" name="person_id" class="custom-select" <?php echo (isset($_GET["id"])?'disabled':'') ?>>
                            <?php
                            foreach ($athletes as $athlete){ ?>
                                <option value="<?php echo $athlete[0]; ?>" <?php echo ((isset($_GET["id"]) && $_GET["id"] == $athlete[0])? 'selected':'') ?>><?php echo $athlete[0].': '.$athlete[1].' '.$athlete[2] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="col-md-6 mb-3 ">
                        <label for="oh_id">Olympiáda</label>
                        <select id="oh_id" name="oh_id" class="custom-select">
                            <?php foreach ($OHs as $info){ ?>
                                <option value="<?php echo $info[0]; ?>"><?php echo $info[2].' '.$info[1].', '.$info[4].' - '.$info[3] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="col-md-6 mb-3 ">
                        <label for="placing">Umiestnenie</label>
                        <input type="number" class="form-control" id="placing" name="placing" placeholder="1" min="1" value="1" required>
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="col-md-6 mb-3 ">
                        <label for="discipline">Disciplína</label>
                        <input type="text" class="form-control" id="discipline" name="discipline" required>
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                </div>


                <br>
                <div class="form-row justify-content-center">
                    <button type="submit" class="btn btn-success justify-content-center ">Pridať údaje</button>
                </div>
            </form>
        </div>
    </div>
    <footer class="my-3 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy;2021 WEBTECH2 - Richterová </p>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>


</body>
</html>
