<?php
include_once("piscina_funcionsAdmin.php");
piscina_cookies($_COOKIE);
include_once("piscina_funcions.php");
?>
<html>
<?php piscinaHead("Calculadora"); ?>
<body>
<script src="calculadora.js"></script>
<?php piscinaHeadUser(); ?>
<div style="text-align: center; margin-left: auto; margin-right:auto;">
<h1 class="principal">Calculadora</h1>
<p>Quant producte haig de tirar a la piscina? El resultat és orientatiu.</p>
<select>
    <option selected>-----</option>
    <option onmouseup="">CTX-500 pH plus</option>
    <option onmouseup="">CTX-400 pH minus</option>
</select>

</div>
</body>
</html>