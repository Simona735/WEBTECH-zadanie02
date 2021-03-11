<?php
require_once "helpers/personDBController.php";
require_once "models/person.php";
require_once "models/ranking.php";

$controller = new PersonDBController();

if (!isset($_GET["id"])) {
    header('Location:index.php');
}

$person = $controller->getPerson($_GET["id"]);
$rankings = $person->getRankingLine();

//var_dump($person);

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Detail</title>
</head>

<body class="bg-light">

<div class="container">
    <div class="py-5 text-center">
        <h2 class="bi bi-person-circle" >
            Detail športovca
        </h2>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-4 order-md-1">
            <table class="table" id="details">
                <tbody id="table1Body">
                <tr>
                    <th scope="col">Id</th>
                    <td scope="col"><?php echo $person->getId() ?></td>
                </tr>
                <tr>
                    <th scope="col">Meno</th>
                    <td scope="col"><?php echo $person->getName() ?></td>
                </tr>
                <tr>
                    <th scope="col">Priezvisko</th>
                    <td scope="col"><?php echo $person->getSurname() ?></td>
                </tr>
                <tr>
                    <th scope="col">Dátum narodenia</th>
                    <td scope="col"><?php echo $person->getBirthDay() ?></td>
                </tr>
                <tr>
                    <th scope="col">Miesto narodenia</th>
                    <td scope="col"><?php echo $person->getBirthPlace() ?></td>
                </tr>
                <tr>
                    <th scope="col">Štát narodenia</th>
                    <td scope="col"><?php echo $person->getBirthCountry() ?></td>
                </tr>
                <tr>
                    <th scope="col">Dátum úmrtia</th>
                    <td scope="col"><?php echo $person->getDeathDay() ?></td>
                </tr>
                <tr>
                    <th scope="col">Miesto úmrtia</th>
                    <td scope="col"><?php echo $person->getDeathPlace() ?></td>
                </tr>
                <tr>
                    <th scope="col">Štát úmrtia</th>
                    <td scope="col"><?php echo $person->getDeathCountry() ?></td>
                </tr>
                </tbody>
            </table>
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
