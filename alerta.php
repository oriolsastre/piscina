<?php
include_once("piscina_funcionsAdmin.php");
piscina_cookies($_COOKIE);
include_once("piscina_funcions.php");
?>
<html>
<?php piscinaHead("Alertes"); ?>
<body>
<?php $alertes = piscinaHeadUser(); ?>
<div style="text-align: center; margin-left: auto; margin-right:auto;">
    <h1 class="principal">Alertes</h1>
<?php
    if($alertes[0]){
?>
    <div class="alertaUrgent">
        <ul>
<?php if($alertes[1]["antialga"][0]){echo "<li>Fa més d'una setmana de l'última dosi d'antialgues.</li>";}
      if($alertes[1]["pHmenys"][0]){echo "<li>El pH està baix i no s'hi ha actuat.</li>";}
      if($alertes[1]["pHmes"][0]){echo "<li>El pH està massa alt i no s'hi ha actuat.</li>";}
?>
        </ul>
    </div>
<?php } ?>
</div>
</body>
</html>