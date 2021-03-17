<?php
require_once "helpers/personDBController.php";
require_once "models/person.php";
require_once "models/ranking.php";

$controller = new PersonDBController();

if (isset($_GET["deleteId"])) {
    $controller->deletePerson($_GET["deleteId"]);
}

$people = $controller->getAllPeople();
//$controller->insertPerson("Alenka", "test");

$ourAthletes = [];
foreach ($people as $person){
    $personRecords = $person->getGoldRankings();
    if(!empty($personRecords)){
       foreach ($personRecords as $record){
           array_push($ourAthletes, $record);
       }
    }
}

$ourAthletesJSON = json_encode($ourAthletes);

$top10 = [];
foreach ($people as $person) {
        array_push($top10, [$person->getId(), $person->getName(), $person->getSurname(), $person->getGoldCount()]);
}
array_multisort(array_column($top10, 3), SORT_DESC, array_column($top10, 1),SORT_ASC,  $top10);
$top10 = array_slice($top10, 0, 10);


function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Olympiády</title>
</head>

<body class="bg-light">

<div class="container">
    <div class="py-5 text-center">
        <h2>Naši olympijskí víťazi</h2>
    </div>
    <div class="table-responsive">
        <table class="table " id="ourWinners">
            <thead>
            <tr class="table-active">
                <th scope="col" >ID</th>
                <th scope="col" >Meno</th>
                <th scope="col" class="sortable" id="surname" ><p><u>Priezvisko</u></p></th>
                <th scope="col" class="sortable" id="year"><p><u>Rok</u></p></th>
                <th scope="col" >Mesto</th>
                <th scope="col" class="sortable" id="type"><p><u>Typ</u></p></th>
                <th scope="col" >Disciplína</th>
            </tr>
            </thead>
            <tbody id="table1Body">
            </tbody>
        </table>
    </div>
    <div class="row py-lg-5 text-center">
        <div class="col-lg-12 col-md-12">
            <p>
                <a href="addPerson.php" class="btn btn-success my-2">
                    <i class="bi bi-person-plus-fill"></i>
                    Pridať športovca
                </a>
                <a href="addRanking.php" class="btn btn-success my-2">
                    <i class="bi bi-plus"></i>
                    Pridať umiestnenia
                </a>
            </p>
        </div>
    </div>


    <div class="py-5 text-center">
        <h2>10 najúspešnejších olympionikov</h2>
    </div>
    <div class="table-responsive">
        <table class="table" id="top10">
            <thead>
            <tr class="table-active">
                <th scope="col" >Poradie</th>
                <th scope="col" >Meno</th>
                <th scope="col" >Priezvisko</th>
                <th scope="col" >Počet zlatých medajlí</th>
                <th scope="col" ></th>
                <th scope="col" ></th>
            </tr>
            </thead>
            <tbody id="table2Body">
            <?php
                $rank = 0;
                foreach ($top10 as $data){
                    $rank++;?>
                <tr>
                    <td><?php echo $rank?>.</td>
                    <td>
                        <a class="text-decoration-none" href="detail.php?id=<?php echo $data[0] ?>"><?php echo $data[1] ?><a>
                    </td>
                    <td><?php echo $data[2] ?></td>
                    <td><?php echo $data[3] ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $data[0] ?>" type="button" class="btn btn-primary btn-sm rounded-1 action-button" data-toggle="tooltip" data-placement="top" title="Edit">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                    </td>
                    <td>
                        <a href="index.php?deleteId=<?php echo $data[0] ?>" type="button" class="btn btn-danger btn-sm rounded-1 action-button" data-toggle="tooltip" data-placement="top" title="Delete">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php
                } ?>
            </tbody>
        </table>
    </div>


    <footer class="my-3 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy;2021 WEBTECH2 - Richterová </p>
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script>
    var ourAthletes = <?php echo $ourAthletesJSON?>;
</script>
<script src="js/indexJS.js"></script>

</body>
</html>
