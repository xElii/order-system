<?php require_once("/DATEN/Config/global.php");?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Home | Datalok Order System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="//files.datalok.de/Logos/favico.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://kit.fontawesome.com/09de98c34f.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once("./lib/navbar.php");?>
    <div class="container text-center" style="margin-top:100px;">
        <h1>Suche dir einfach etwas aus!</h1>
        <p>Hier gibt es eine kleine Übersicht was du so kaufen kannst.<br>Such dir was aus und du wirst zum Bestellvorgang geleitet.</p>
        <div class="row">
            <div class="col">
                <div class="card"><img src="https://img.freepik.com/vektoren-premium/grafikdesign-abstrakte-konzeptvektorillustration_107173-25089.jpg" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Einen Dienst für deinen Homeserver</h5>
                        <p class="card-text">Ich richte einen Dienst für dich und deinen Homeserver ein.</p>
                        <a href="./order?item=service" class="btn btn-secondary">Bestellen</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card"><img src="./lib/office.webp" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">Ein Dokument mit Vorlage aus deiner Office Suite, so wie du dir es vorstellst.</h5>
                        <p class="card-text">Ich erstelle dir ein Dokument, das du für dein Lager an V-Bucks Karten nutzen kannst.</p>
                        <a href="./order?item=office" class="btn btn-secondary">Bestellen</a>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card"><img src="https://img.freepik.com/vektoren-kostenlos/3d-lieferbox-paket_78370-825.jpg" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title">... oder auch deine Ideen</h5>
                        <p class="card-text">Schlage etwas beliebiges vor und ich könnte es verwirklichen, solange es mit der Informatik zu tun hat.</p>
                        <a href="./order?item=smth" class="btn btn-secondary">Bestellen</a>
                    </div>
                </div>
            </div>
        </div>
        <h1>Wie geht es weiter?</h1>
        <p>Nachdem du etwas bestellt hast bekomme ich eine Mail und werde Zeitnah deinen Auftrag bearbeiten. Da ich allein bin kann das etwas dauern. Mit deiner Bestellnummer die du erhältst kannst du deine Bestellung verfolgen.</p>
    </div>
    <div class="border-top mt-5" id="footer"></div><script>$("#footer").load("https://files.datalok.de/Config/footer.html");</script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
<?php $link->close();?>