<?php
include_once("piscina_funcions.php");
include_once("piscina_funcionsAdmin.php");
piscina_cookies($_COOKIE);
?>
<html>
<?php piscinaHead("Control de la piscina"); ?>
<body>
<?php piscinaHeadUser(); ?>
    <h1>PISCINA</h1>
    <div>
        <div class="boto_inici" id="estat"><h2><a href="estat.php" class="dissimulat">ESTAT DE LA PISCINA</a></h2></div>
        <div class="boto_inici" id="control"><h2><a href="estat.php" class="dissimulat">CONTROL DE LA PISCINA</a></h2></div>
        <div class="boto_inici" id="accio"><h2><a href="estat.php" class="dissimulat">ESTAT DE LA PISCINA</a></h2></div>
    </div>
</body>
</html>