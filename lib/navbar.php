<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap');
body {font-family: Inter, system-ui, sans-serif;}
h1,h2,h3,h4,h5,h6 {font-weight:700;}
p {font-size:18px;}
</style>
<nav data-bs-theme="dark" class="navbar navbar-expand-lg fixed-top shadow-sm" style="background-color: #212829;">
  <div class="container">
    <a class="navbar-brand" href="/"><img src="//files.datalok.de/Logos/logo.webp" width="40" alt="DATALOK"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#global-navbar" aria-controls="global-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="global-navbar">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link" href="/" id="nav/"><i class="fa-solid fa-house-chimney pe-2"></i>Startseite</a></li>
        <li class="nav-item"><a class="nav-link" href="/order" id="nav/order"><i class="fa-solid fa-box-open pe-2"></i>Bestellen</a></li>
        <?php if (isset($_GET["id"])) {echo '<li class="nav-item"><a class="nav-link active" href="#">#'.$orderId.'</a></li>';}?>
      </ul>
      <div class="d-flex align-items-center">
        <form onsubmit="orderSearch()" action="#" class="me-3" style="width: 150px;"><input id="ordersearchinput" class="form-control me-2" min="6" maxlength="6" placeholder="Bestellnummer" aria-label="Bestellnummer"></form>
        <?php session_start();
        if(isset($_SESSION['username'])){echo '
        <div class="dropdown-center">
          <span class="text-light" type="button" data-bs-toggle="dropdown" aria-expanded="false">'.$_SESSION["realname"].'<img class="rounded ms-2" src="https://api.datalok.de/avatar?u='.$_SESSION['username'].'" width="40" alt""></span>
          <ul class="dropdown-menu">
            <li><a href="https://account.datalok.de/" class="dropdown-item" type="button"><i class="fa-solid fa-gear pe-2"></i>Einstellungen</a></li>
            <li><a href="https://account.datalok.de/logout" class="dropdown-item text-danger" type="button"><i class="fa-solid fa-right-from-bracket pe-2"></i>Abmelden</a></li>
          </ul>
        </div>';}
        else {echo '<a href="https://account.datalok.de/login?url=https://'.$_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"].'">Anmelden</a>';}?>
      </div>
    </div>
  </div>
</nav>
<script>
var navbarelement = document.getElementById("nav"+window.location.pathname);
navbarelement.classList.add("active");

function orderSearch() {
  var idinput = document.getElementById("ordersearchinput").value;
  window.location.replace("./o/"+idinput);
  event.preventDefault();
}
</script>