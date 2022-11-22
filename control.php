<?php
include_once("piscina_funcionsAdmin.php");
piscina_cookies($_COOKIE);
include_once("piscina_funcions.php");
?>
<html>
<?php
if(!$sessio){ ?>
<meta http-equiv="refresh" content="0; url=/piscina" />
<?php
exit();
}elseif(isset($_GET['form']) AND $_GET['form']=='add'){
    if(!isset($_POST['data_hora'])){$data_hora = date("Y-m-d H:i:s");}else{$data_hora=$_POST['data_hora'];}
    if(!isset($_POST['pH'])){$pH = 'NULL';}else{$pH = $_POST['pH'];}
    if(!isset($_POST['clor'])){$clor = 'NULL';}else{$clor = $_POST['clor'];}
    if(!isset($_POST['alcali'])){$alcali = 'NULL';}else{$alcali = $_POST['alcali'];}
    if(!isset($_POST['temperatura'])){$temperatura = 'NULL';}else{$temperatura = $_POST['temperatura'];}
    if(!isset($_POST['transparent'])){$transparent = 'NULL';}else{$transparent = $_POST['transparent'];}
    if(!isset($_POST['fons'])){$fons = 'NULL';}else{$fons = $_POST['fons'];}

    if($pH != 'NULL' OR $clor != 'NULL'){
        $sql_ultim_clorpH = "SELECT data_hora FROM piscinaControl WHERE clor IS NOT NULL OR ph IS NOT NULL ORDER BY data_hora DESC LIMIT 1";
        $qry_ultim_clorpH = mysqli_query($dbcnx, $sql_ultim_clorpH);
        $ultim_clorpH = new DateTime(mysqli_fetch_array($qry_ultim_clorpH)[0]);
        $clorpH_diff = $ultim_clorpH->diff(new DateTime($data_hora));
        $horesClorPh = intval($clorpH_diff->format('%h'));
    }

    $sql_insert_control = "INSERT INTO piscinaControl SET
        data_hora = '$data_hora',
        ph = $pH, clor = $clor, alcali = $alcali,
        temperatura = $temperatura, transparent = $transparent, fons = $fons,
        usuari = ".$_SESSION['userID'].";";
    
    if($horesClorPh>6){
        mysqli_query($dbcnx, $sql_insert_control);
        $avisTemporal=false;
    }else{$avisTemporal = true;}
}
piscinaHead("Estat de l'aigua"); ?>
<body>
<script src="control.js"></script>
<?php piscinaHeadUser(); ?>
<div style="text-align: center; margin-left: auto; margin-right:auto;">
    <h1 class="principal">Estat de l'aigua</h1>
<?php
    if($avisTemporal){
?>
    <div class="avisTemporal">
        <div class="tancar" onmouseup="this.parentElement.style.display = 'none'"><i class="fa-solid fa-circle-xmark" style="color:red;"></i></div>
        <h2>Avís</h2>
        <p>No s'han afegit les dades ja que fa menys de 6 hores que s'han intruoduït dades sobre Clor i pH.</p>
    </div>
<?php
    }
    if(esSafari()){
?>
    <div class="avisTemporal">
        <h2>Avís</h2>
        <p>Aquesta pàgina no funciona bé amb Safari. Obra-la amb Chrome o Firefox.</p>
    </div>
<?php
    }
   
?>
    <table class="control">
        <tr>
            <td style="width: 50%;">
                <div class="control" id="pHClor" onmouseup="formulariControls(true,true,false)">
                    <div class="controlText"><h2>pH i Clor</h2></div>
                </div>
            </td><td>
                <div class="control" id="aigua" onmouseup="formulariControls(true,false,true)">
                    <div class="controlText"><h2>Temperatura, transparència, fons</h2></div>
                </div>
            </td>
        </tr><tr>
            <td colspan="2">
                <div class="control" id="total" onmouseup="formulariControls(true,true,true)">
                    <div class="controlText"><h2>Control múltiple</h2></div>
                </div>
            </td>
        </tr>
    </table>
    <div class="form" id="formControl" style="display: none;">
        <form method="post" action="control.php?form=add">
            <table class="formTable">
                <tr id="formpH" style="display: none;">
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
                </tr><tr id="formClor" style="display: none;">
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
                </tr><tr id="formTemp" style="display: none;">
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
                </tr><tr id="formTrans" style="display: none;">
                    <td><b>Transparència de l'aigua</b></td>
                    <td><select name="transparent">
                        <option value="null">---</option>
                        <option value=5>5: Aigua molt tèrbola</option>
                        <option value=4>4: Aigua tèrbola</option>
                        <option value=3>3: Aigua translúcida</option>
                        <option value=2>2: Aigua força transparent</option>
                        <option value=1>1: Aigua transparent</option>
                    </select></td>
                </tr><tr id="formFons" style="display: none;">
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
            <input type="button" value="Cancelar" onmouseup="formulariControls(false,false,false)">
        </form>
    </div>
</div>
</body>
</html>