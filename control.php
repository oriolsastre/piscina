<?php
include_once("piscina_funcionsAdmin.php");
piscina_cookies($_COOKIE);
include_once("piscina_funcions.php");
?>
<html>
<?php piscinaHead("Estat de l'aigua"); ?>
<body>
<?php piscinaHeadUser($sessio); ?>
<div style="text-align: center; margin-left: auto; margin-right:auto;">
    <h1>Estat de l'aigua</h1>
    <table class="control">
        <tr>
            <td style="width: 50%;">
                <div class="control" id="pHClor" onmouseup=" document.getElementById('formPHClor').style.display = ''; document.getElementById('formAigua').style.display = 'none';">
                    <div class="controlText"><h2>pH i Clor</h2></div>
                </div>
            </td><td>
                <div class="control" id="aigua" onmouseup=" document.getElementById('formPHClor').style.display = 'none'; document.getElementById('formAigua').style.display = '';">
                    <div class="controlText"><h2>Temperatura, transparència, fons</h2></div>
                </div>
            </td>
        </tr><tr>
            <td colspan="2">
                <div class="control" id="total" onmouseup=" document.getElementById('formPHClor').style.display = 'none'; document.getElementById('formAigua').style.display = 'none';">
                    <div class="controlText"><h2>Control múltiple</h2></div>
                </div>
            </td>
        </tr>
    </table>
    <div class="form" id="formPHClor" style="display: none;">
        <h3>Control de Clor i pH</h3>
        <form method="post" action="">
            <table class="formTable">
                <tr>
                    <td><b>pH<b></td>
                    <td><select name="pH">
                        <option value="8.5">8.2&gt;</option>
                        <option value="8.2">8.2</option>
                        <option value="8.0">8.0</option>
                        <option value="7.8">7.8</option>
                        <option value="7.6" selected>7.6</option>
                        <option value="7.4">7.4</option>
                        <option value="7.2">7.2</option>
                        <option value="7.0">7.0</option>
                        <option value="6.8">6.8</option>
                        <option value="6.5">&lt;6.8</option>
                    </select></td>
                </tr><tr>
                    <td><b>Clor</b></td>
                    <td><select name="clor">
                        <option value="3.0">3.0</option>
                        <option value="2.0">2.0</option>
                        <option value="1.5" selected>1.5</option>
                        <option value="1.0">1.0</option>
                        <option value="0.5">0.5</option>
                        <option value="0.2">0.2</option>
                        <option value="0">0</option>
                    </select></td>
                </tr>
            </table>
            <input type="submit" value="Enviar">
            <input type="button" value="Cancelar" onmouseup="document.getElementById('formPHClor').style.display = 'none';">
        </form>
    </div>
    <div class="form" id="formAigua" style="display: none;">
        <h3>Temperatura, transparència i fons</h3>
        <form method="post" action="">
            <table class="formTable">
                <tr>
                    <td><b>Temperatura de l'aigua</b></td>
                    <td><select name="temperatura">
                        <option value="null">---</option>
                        <option value=30>30&ge;</option><?php
for($temp=29;$temp>15;$temp--){
?>
                        <option value=<?php echo $temp; ?>><?php echo $temp; ?></option>
<?php
}
?>
                        <option value=15>&le;15</option>
                    </select></td>
                </tr><tr>
                    <td><b>Transparència de l'aigua</b></td>
                    <td><select name="transparent">
                        <option value="null">---</option>
                        <option value=5>5: Aigua molt tèrbola</option>
                        <option value=4>4: Aigua tèrbola</option>
                        <option value=3>3: Aigua translúcida</option>
                        <option value=2>2: Aigua força transparent</option>
                        <option value=1>1: Aigua transparent</option>
                    </select></td>
                </tr><tr>
                    <td><b>Fons de la piscina</b></td>
                    <td><select name="fons">
                        <option value="null">---</option>
                        <option value=5>5: Fons molt brut</option>
                        <option value=4>4: Fons brut</option>
                        <option value=3>3: Fons amb algunes fulles</option>
                        <option value=2>2: Fons amb sorreta/polsim</option>
                        <option value=1>1: Fons net</option>
                    </select></td>
                </tr>
            </table>
            <input type="submit" value="Enviar">
            <input type="button" value="Cancelar" onmouseup="document.getElementById('formAigua').style.display = 'none';">
        </form>
    </div>
</div>
</body>
</html>