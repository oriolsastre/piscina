<?php
include_once("piscina_funcionsAdmin.php");
piscina_cookies($_COOKIE);
if(!$sessio){ ?>
    <meta http-equiv="refresh" content="0; url=/piscina" />
<?php
    exit();
}
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
        <h2>Urgent</h2>
        <ul>
<?php if($alertes[1]["antialga"][0]){echo "<li>Fa més d'una setmana de l'última dosi d'antialgues.</li>";}
      if($alertes[1]["pHmenys"][0]){echo "<li>El pH està baix i no s'hi ha actuat.</li>";}
      if($alertes[1]["pHmes"][0]){echo "<li>El pH està massa alt i no s'hi ha actuat.</li>";}
?>
        </ul>
    </div>
<?php } ?>
    <ul>
<?php
    if(!$alertes[1]["pHmenys"][0]   AND $alertes[1]["pHmenys"][1]>0){echo "<li>Fa ".$alertes[1]["pHmenys"][1]." dies que el pH està baix i no s'hi ha actuat.</li>";}
    if(!$alertes[1]["pHmes"][0]     AND $alertes[1]["pHmes"][1]>0){echo "<li>Fa ".$alertes[1]["pHmenys"][1]." dies que el pH està massa alt i no s'hi ha actuat.</li>";}
    if(!$alertes[1]["antialga"][0]  AND $alertes[1]["antialga"][1]>4){echo "<li>L'última dosi setmanal d'antialgues és de fa ".$alertes[1]["antialga"][1]." dies. No te n'oblidis.</li>";}
?>
    </ul>
</div>
</body>
</html>