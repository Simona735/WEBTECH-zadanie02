<?php
require_once "helpers/personDBController.php";
if (isset($_POST["name"]) && isset($_POST["surname"])) {
    console_log("aaa");
    $controller = new PersonDBController();
    $lastInsertedId = $controller->insertPerson($_POST['name'], $_POST['surname'],(new DateTime($_POST['birth_day']))->format('d.n.Y'), $_POST['birth_place'] , $_POST['birth_country'],((empty($_POST['death_day']) || is_null($_POST['death_day']))? '' : (new DateTime($_POST['death_day']))->format('d.n.Y')) ,((empty($_POST['death_place']) || is_null($_POST['death_place']) )? '' : $_POST['death_place']) , ((empty($_POST['death_country']) || is_null($_POST['death_country']) )? '' : $_POST['death_country']));
    header('Location:addRanking.php?id='.$lastInsertedId);
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
        <h2>Pridaj športovca</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 order-md-1">
            <form method="post" action="addPerson.php">
                <div class="form-row justify-content-center">
                    <div class="col-md-4 mb-3 ">
                        <label for="name">Meno</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Mark" required>
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="surname">Priezvisko</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Smith" required>
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-row ">
                    <div class="col-md-2 mb-3 ">
                    </div>
                    <div class="col-md-4 mb-3 ">
                        <label for="birth_day">Dátum narodenia</label>
                        <input type="date" class="form-control" id="birth_day" name="birth_day" required>
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="col-md-4 mb-3 ">
                        <label for="birth_place">Mesto narodenia</label>
                        <input type="text" class="form-control" id="birth_place" name="birth_place" placeholder="Paris" required>
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="birth_country">Štát narodenia</label>
                        <input type="text" class="form-control" id="birth_country" name="birth_country" placeholder="France" required>
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-row ">
                    <div class="col-md-2 mb-3 ">
                    </div>
                    <div class="col-md-4 mb-3 ">
                        <label for="death_day">Dátum úmrtia</label>
                        <input type="date" class="form-control" id="death_day" name="death_day">
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="col-md-4 mb-3 ">
                        <label for="death_place">Mesto úmrtia</label>
                        <input type="text" class="form-control" id="death_place" name="death_place" placeholder="Paris" >
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="death_country">Štát úmrtia</label>
                        <input type="text" class="form-control" id="death_country" name="death_country" placeholder="France" >
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-row justify-content-center">
                    <button type="submit" class="btn btn-success justify-content-center ">Pridať umiestnenie</button>
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
