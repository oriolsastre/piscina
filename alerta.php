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
<?php if($alertes[1]["antialga"]){echo "<li>Fa més d'una setmana de l'última dosi d'antialgues.</li>";} ?>
        </ul>
    </div>
<?php } ?>
</div>
</body>
</html>