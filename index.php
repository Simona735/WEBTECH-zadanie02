<!doctype html>
<html lang="sk">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Richterova">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <link rel="stylesheet" type="text/css" href="css/default.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>Olympiády</title>
</head>

<body class="bg-light">

<div class="container">
    <main>
        <div class="py-5 text-center">
            <h2>Olympionici</h2>
<!--            <button type="button" onclick="window.location.href='selectToUpload.php';" class="btn btn-primary my-2">-->
<!--                <i class="bi bi-file-earmark-plus"></i>-->
<!--                Nahrať súbor-->
<!--            </button>-->
        </div>
    </main>

    <table class="table" id="ourWinners">
        <thead>
        <tr>
            <th scope="col" >Meno</th>
            <th scope="col" data-sortable="true">Priezvisko</th>
            <th scope="col" data-sortable="true">Rok víťazstva</th>
            <th scope="col" >Miesto olympiády</th>
            <th scope="col" data-sortable="true">Typ</th>
            <th scope="col" data-sortable="true">Disciplína</th>
        </tr>
        </thead>
        <tbody id="tableBody">
        </tbody>
    </table>

    <table class="table" id="top10">
        <thead>
        <tr>
            <th scope="col" data-sortable="true">Meno súboru</th>
            <th scope="col" data-sortable="true">Veľkosť</th>
            <th scope="col" data-sortable="true">Dátum</th>
        </tr>
        </thead>
        <tbody id="tableBody">
        </tbody>
    </table>

    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                 <p>
                    <a href="#" class="btn btn-primary my-2">Pridať športovca</a>
                    <a href="#" class="btn btn-secondary my-2">Pridať umiestnenia</a>
                </p>
            </div>
        </div>
    </section>

    <footer class="my-3 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy;2021 WEBTECH2 - Richterová </p>
    </footer>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<script src="js/sort.js"></script>
</body>
</html>
