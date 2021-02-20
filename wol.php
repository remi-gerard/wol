<!-- wol.php V1.1 -->

<script src="./lib/jquery-3.4.1.min.js"></script>
<link rel="stylesheet" href="./lib/bootstrap/css/bootstrap.min.css">
<script src="./lib/bootstrap/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="./lib/circlebars/assets/circle.css">
<script src="./lib/circlebars/assets/circle.js"></script>
<link rel="stylesheet" href="./lib/circlebars/assets/skins/yellowcircle.css">
<link rel="stylesheet" href="./lib/circlebars/assets/skins/purplecircle.css">
<link rel="stylesheet" href="./lib/circlebars/assets/skins/firecircle.css">
<link rel="stylesheet" href="./lib/circlebars/assets/skins/whitecircle.css">
<link rel="stylesheet" href="./lib/circlebars/assets/skins/simplecircle.css">

<style type="text/css">
.circlecontainer {
  margin-left: auto;
  margin-right: auto;
  width: 300px;
  height: 300px;
}

.version {
  margin-right: 10px;

  position: absolute;
  bottom: 0;
  text-align: center;
}

#demarrage {
  margin-left: auto;
  margin-right: auto;
  display:none;
}

</style>

  <title>Démarrage en cours</title>
  <?php
    echo "<br>";
    echo "<img style='width:7%;float:left;margin-left:130px;margin-top:10px;' src='./lib/blason.jpg'>";
    echo "<br>";
    echo "<h4 class='display-4'>&nbsp;&nbsp;&nbsp;&nbsp;Démarrage de l'ordinateur à distance</h4><br>";
    echo "<hr>";
    $mymac = $_REQUEST['mymac'];

    wol("255.255.255.255", $mymac);

    echo "<p class='text-center'>Instruction de démarrage envoyée.<br>Merci d'attendre au moins 5 minutes avant le lancement de la session RDP à distance. L'ordinateur s'éteindra à 21h00.</p><br>";
    echo "<p class='text-center'>Référence technique : <b>".$mymac . '</b></p>';

    function wol($broadcast, $mac){
    $mac_array = preg_split('#:#', $mac);
    $hwaddr = '';

        //Magic Packet
        $packet = '';
        for ($i = 1; $i <= 6; $i++){
        $packet .= chr(255);
        }
        for ($i = 1; $i <= 16; $i++){
        $packet .= $hwaddr;
        }
        //set up socket
        $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
        if ($sock){
        $options = socket_set_option($sock, SOL_SOCKET, SO_REUSEADDR, true);
            if ($options >=0){
            $e = socket_sendto($sock, $packet, strlen($packet), 0, $broadcast, 7);
            socket_close($sock);
            }
        }
    }  //end function wol
  ?>
  <div id="demarrage">
    <div class="card bg-success" style="width: 21.5em;margin:0 auto;">
        <img src="./lib/demarrage.png" class="card-img-top" alt="Accroche HTML">
        <div class="card-body">
            <h2 class="card-title">Terminée !</h2>
            <h5 class="card-title">Étape 2 :</h5>
            <p class="card-text">Fermez cette fenêtre, retournez sur le portail et cliquez sur l'icône « PC ».</p>
            <a href="#" onclick="window.close();" class="btn btn-primary">Fermer cette fenêtre</a>
        </div>
    </div>
  </div>

  <br><br><br>
  <div class="circlecontainer">
    <div id="circlebar" data-circle-size="300px" data-circle-startTime=0 data-circle-dialWidth=10 data-circle-size="250px">
        <div class="loader-bg">
            <div class="text">00:00:00</div>
        </div>
    </div>
  </div>

<script>
  new Circlebar({
      element : "#circlebar",
      /* maxValue: en secondes, */
      maxValue: 300,

      size: "240px",
      fontSize: "30px",
      type: "timer"
        });

  // Faire disparaître le cercle
  setTimeout(function() {
    $('#circlebar').fadeOut('fast');
  }, 300000); // <-- en millisecondes

  // Faire disparaître le cercle
  setTimeout(function() {
    $('#demarrage').fadeIn('slow');
  }, 300000); // <-- en millisecondes

 </script>
