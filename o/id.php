<?php require_once("/DATEN/Config/global.php");
$orderId=$_GET["id"];
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Bestellung #<?php echo $orderId;?> | Datalok Order System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="//files.datalok.de/Logos/favico.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://kit.fontawesome.com/09de98c34f.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once("../lib/navbar.php");
    $result=$link->query("SELECT * FROM Bestellung WHERE id='$orderId'");
    if ($result->num_rows > 0) {$idnotfound='<h1>Deine Bestellung!</h1><div class="card shadow-sm">';
        while($row = $result->fetch_assoc()) {
            $dateraw=date_create($row["date"]);
            $item=$row["item"];
            $email=$row["email"];
            $text=$row["text"];
            $filename=$row["filename"];
            $status=$row["status"];
    }} else {$idnotfound='<h1 class="text-danger">Diese Bestellnummer gibt es nicht!</h1><p>Überprüfe bitte deine Bestellnummer!</p><div class="card shadow-sm" style="display:none;">';$dateraw=date_create('2023-01-01');$status=0;}?>
    <div class="container text-center" style="margin-top:100px;">
        <?php echo $idnotfound?>
            <div class="card-body">
                <h5 class="card-title"><?php echo $item ?? null?></h5>
                <p class="card-text">Infos an: <?php echo $email ?? null?> - Letzte Änderung: <?php echo date_format($dateraw,"d. M Y") ?? null;?></p>
                <p style="font-style:italic;">"<?php echo $text ?? null?>"</p>
                <hr>
                <h5><?php
                    if ($status==0) {echo '<i class="fa-solid fa-hourglass-start me-2"></i>';}
                    if ($status==1) {echo '<i class="fa-solid fa-person-digging me-2"></i>';}
                    if ($status>=2) {echo '<i class="fa-solid fa-circle-check me-2"></i>';}
                ?> Status deiner Bestellung
                </h5>
                <div class="progress-stacked">
                <div class="progress" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 33%"><div class="progress-bar bg-success"></div></div>
                    <div class="progress" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" style="width: 33%"><div class="progress-bar <?php if ($status>=1) {echo 'bg-success';} else {echo 'bg-success-subtle';}?>"></div></div>
                    <div class="progress" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 34%"><div class="progress-bar <?php if ($status>=2) {echo 'bg-success';} else {echo 'bg-success-subtle';}?>"></div></div>
                </div>
                <p class="card-text mt-2"><?php
                    if ($status==0) {echo 'Deine Bestellung ist noch offen.';}
                    if ($status==1) {echo 'Deine Bestellung wird gerade bearbeitet!';}
                    if ($status>=2) {echo 'Deine Bestellung wurde erledigt! Entweder du kannst sie nun herunterladen oder sie existiert bereits.';}
                ?></p>
            </div>
        </div>
        <?php if ($status<=1) {echo '<div class="card shadow-sm" style="display:none;>';} else {echo '<h1 class="m-3">Lieferung</h1><div class="card shadow-sm">';}?>
            <div class="card-body">
                <p class="card-text">Da deine Bestellung nun Fertig ist kannst du sie hier herunterladen sofern nötig und entpacken.</p>
                <a class="btn btn-success px-4" href="/upload/DL-<?php echo $orderId?>.zip" download><i class="fa-solid fa-download me-2"></i> Datei Herunterladen</a>
                <p class="card-text text-success mt-3"><i class="fa-solid fa-circle-check me-2"></i>Bestellung abgeschlossen!</p>
            </div>
        </div>
    </div>
    <div class="border-top mt-5" id="footer"></div><script>$("#footer").load("https://files.datalok.de/Config/footer.html");</script>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
<?php $link->close();?>