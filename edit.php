<?php
require_once "helpers/personDBController.php";
require_once "models/person.php";
require_once "models/ranking.php";
$controller = new PersonDBController();
if (isset($_POST["submit"])) {
    if(isset($_POST['id']) && $_POST['id']) {
        $person = $controller->getPerson($_POST['id']);
        $person->setName($_POST['name']);
        $person->setSurname($_POST['surname']);
        $person->setDeathDay((new DateTime($_POST['death_day']))->format('d.n.Y'));
        $person->setDeathPlace($_POST['death_place']);
        $person->setDeathCountry($_POST['death_country']);
        $controller->updatePerson($person);
        header('Location:index.php');
    }
}else{
    if (!isset($_GET["id"])) {
        header('Location:index.php');
    }else{
        $person = $controller->getPerson($_GET["id"]);
        $rankings = $person->getRankingLine();
    }
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
        <h2>Editovanie údajov</h2>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12 order-md-1">
            <form method="post" action="edit.php">
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $_GET["id"] ?>">
                <div class="form-row justify-content-center">
                    <div class="col-md-4 mb-3 ">
                        <label for="name">Meno</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $person->getName()  ?>" required>
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="surname">Priezvisko</label>
                        <input type="text" class="form-control" id="surname" name="surname" value="<?php echo $person->getSurname()  ?>" required>
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
                        <input type="date" class="form-control" id="death_day" name="death_day" value="<?php  echo empty($person->getDeathDay())? '': date('Y-m-d',strtotime($person->getDeathDay()))  ?>">
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="col-md-4 mb-3 ">
                        <label for="death_place">Mesto úmrtia</label>
                        <input type="text" class="form-control" id="death_place" name="death_place" value="<?php echo $person->getDeathPlace() ?>" >
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="death_country">Štát úmrtia</label>
                        <input type="text" class="form-control" id="death_country" name="death_country" value="<?php echo $person->getDeathCountry() ?>" >
                        <div class="valid-tooltip">
                            Looks good!
                        </div>
                    </div>
                </div>
                <br>
                <div class="form-row justify-content-center">
                    <button type="submit" name="submit" class="btn btn-success justify-content-center "><i class="bi bi-check-circle"></i>
                        Aktualizovať údaje</button>
                </div>
            </form>
        </div>
    </div>

    <div class="py-5 text-center">
        <h2 class="bi bi-trophy">
            Umiestnenia</h2>
    </div>
    <table class="table" id="details">
        <thead>
        <tr>
            <th scope="col" >Rok</th>
            <th scope="col" >Typ</th>
            <th scope="col" >Mesto</th>
            <th scope="col" >Umiestnenie</th>
            <th scope="col" >Disciplína</th>
        </tr>
        </thead>
        <tbody id="table2Body">
        <?php
        foreach ($rankings as $ranking){?>
            <tr>
                <td><?php echo $ranking[0] ?></td>
                <td><?php echo $ranking[1] ?></td>
                <td><?php echo $ranking[2] ?></td>
                <td><?php echo $ranking[3] ?>.</td>
                <td><?php echo $ranking[4] ?></td>
            </tr>
            <?php
        } ?>
        </tbody>
    </table>

    <div class="row py-lg-5 text-center">
        <div class="col-lg-12 col-md-12">
            <p>
                <a href="index.php" class="btn btn-primary my-2">Naspäť</a>
            </p>
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