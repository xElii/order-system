<?php require_once("/DATEN/Config/global.php");
$option = $_GET["item"] ?? null;
$msg='' ?? null;

function generateUniqueID($length = 6) {
    global $link;
    function generateRandomID($length) {
        $characters = '0123456789';
        $randomID = '';
        for ($i = 0; $i < $length; $i++) {
            $randomID .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomID;
    }
    $uniqueID = '';
    $isUnique = false;
    while (!$isUnique) {
        $uniqueID = generateRandomID($length);
        $query = "SELECT id FROM Bestellung WHERE id='$uniqueID'";
        $result = $link->query($query);
        if ($result->num_rows == 0) {
            $isUnique = true;
        }
    }
    return $uniqueID;}
$orderId = generateUniqueID();

# Bestellung
if ($_SERVER['REQUEST_METHOD']==='POST') {
    $target_dir = "./upload/";
    $fullfilename = basename($_FILES["file"]["name"]);
    $file_ext = pathinfo($fullfilename, PATHINFO_EXTENSION);
    $target_file = $target_dir.$orderId.'.'.$file_ext;
    if ($fullfilename!="") {move_uploaded_file($_FILES["file"]["tmp_name"],$target_file);}
    $u_item = $_POST["item"];
    $u_email = $_POST["email"];
    $u_text = $_POST["text"];
    $sql = "INSERT INTO Bestellung (id, item, email, text, filename) VALUES ($orderId, '$u_item', '$u_email', '$u_text', '$file_ext')";
    if ($link->query($sql)===TRUE) {
        $modalactivation='<script>new bootstrap.Modal("#conformationmodal").show()</script>';
        sendmail('ekoeppl@datalok.de', 'Bestellung #'.$orderId.' eingegangen!', 'So ein random Typ hat bei dir bestellt!!! <a href="https://order.datalok.de/o/'.$orderId.'">Zur Übersicht!</a><br><a href="https://admin.datalok.de/order">Zum Adminpanel</a>');
    }
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <title>Bestellen | Datalok Order System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="//files.datalok.de/Logos/favico.ico" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://kit.fontawesome.com/09de98c34f.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php include_once("./lib/navbar.php"); $username = $_SESSION['username']; if (isset($username)) {$result = $link->query("SELECT email FROM Accounts WHERE username='$username'");if ($result->num_rows > 0) {while($row = $result->fetch_assoc()) {$usermail = $row["email"];}}}?>
    <div class="container" style="margin-top:100px;">
    <?php echo $msg;?>
        <form action="" method="POST" enctype="multipart/form-data">
        <h1 class="text-center">Nimm deine Bestellung auf.</h1>
            <div class="mb-3">
                <label class="form-label">Was hättest du gerne?</label>
                <select name="item" class="form-select">
                    <option value="none">Bitte wähle eine Option</option>
                    <option value="Server-Dienst" <?php if ($option=='service') {echo 'selected';}?>>Dienst für den Homeserver</option>
                    <option value="Office Dokument" <?php if ($option=='office') {echo 'selected';}?>>Dokument für Office</option>
                    <option value="LS-Mod">Mod für den Landwirtschafts Simulator 22</option>
                    <option value="Eigene Idee" <?php if ($option=='smth') {echo 'selected';}?>>Deine Idee</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Email Adresse</label>
                <input name="email" type="email" class="form-control" placeholder="mail@example.com" value="<?php echo $usermail?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Beschreibe wie wir es am Besten machen sollen:</label>
                <textarea name="text" class="form-control" rows="6"></textarea>
            </div>  
            <div class="mb-3">
                <label class="form-label">Möchtest du noch eine Datei anhängen? (Bilder, Infos etc.)</label>
                <input name="file" class="form-control" type="file">
            </div>
            <button type="submit" class="btn btn-success w-100 mb-2">Bestellung aufgeben<i class="fa-solid fa-paper-plane ms-2"></i></button>
        </form>
    </div>
    <div class="border-top mt-5" id="footer"></div><script>$("#footer").load("https://files.datalok.de/Config/footer.html");</script>
<div class="modal" id="conformationmodal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Super! Deine Bestellung ist abgeschickt!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Deine Bestellung wird nun bearbeitet! Deine Bestellnummer: <?php echo $orderId;?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Schließen</button>
        <a href="/o/<?php echo $orderId;?>" type="button" class="btn btn-primary">Zur Infoseite</a>
      </div>
    </div>
  </div>
</div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<?php echo $modalactivation?>
</html>
<?php $link->close();?>