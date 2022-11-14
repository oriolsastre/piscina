<?php
include_once("piscina_funcionsAdmin.php");
piscina_cookies($_COOKIE);
include_once("piscina_funcions.php");
?>
<html>
<?php piscinaHead("Control de la piscina"); ?>
<body>
<?php piscinaHeadUser($sessio); ?>
<div style="text-align: center; margin-left: auto; margin-right:auto;">
    <h1>Control de la piscina</h1>
    <table class="control">
        <tr>
            <td style="width: 50%;">
                <div class="control" id="pHClor">
                    <div class="controlText">pH i Clor</div>
                </div>
            </td><td>
                <div class="control" id="pHClor">
                    <div class="controlText">Alcalinitat</div>
                </div>
            </td>
        </tr>
    </table>
</div>
</body>
</html>