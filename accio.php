<?php
include_once("piscina_funcionsAdmin.php");
piscina_cookies($_COOKIE);
if(!$sessio){ ?>
    <meta http-equiv="refresh" content="0; url=/piscina" />
<?php
    exit();
}elseif(isset($_GET['form']) AND $_GET['form']=='add'){
    if($_POST['pHmes']==1 AND $_POST['pHmenys']==1){$pH='NULL';}
    elseif($_POST['pHmes']==1 AND $_POST['pHmenys']=='null'){$pH=1;}
    elseif($_POST['pHmes']=='null' AND $_POST['pHmenys']=='1'){$pH=-1;}
    elseif($_POST['pHmes']=='null' AND $_POST['pHmenys']=='null'){$pH='NULL';}

    $sql_insert_accio = "INSERT INTO piscinaControl SET
        ph=$pH, clor =".$_POST['clor'].", antialga = ".$_POST['antialga'].", fluoculant = ".$_POST['fluoculant'].",
        aspirar = ".$_POST['aspirar'].", alcali = ".$_POST['alcali'].", aglutinant = ".$_POST['aglutinant'].",
        usuari = ".$_SESSION['userID'].";";
    
    $qry_inser_accio = mysqli_query($dbcnx, $sql_insert_accio);
}
include_once("piscina_funcions.php");
?>
<html>
<?php piscinaHead("Acció sobre la piscina"); ?>
<body>
<?php piscinaHeadUser($sessio); ?>
<div style="text-align: center; margin-left: auto; margin-right:auto;">
    <h1 class="principal">Acció sobre la piscina</h1>
    <table class="control" id="accio">
<?php
    $llistaControls = array(
        0 => array("pHmes","pH+", "He apujat el pH."),
        1 => array("pHmenys","pH-", "He abaixat el pH"),
        2 => array("clor","Clor", "He afegit clor."),
        3 => array("antialga","Antialgues", "He afegit la dosi setmanal d'antialgues."),
        4 => array("fluoculant","Fluoculant", "He afegit fluoculant."),
        5 => array("aspirar","Aspirar el fons", "He aspirat el fons."),
        6 => array("alcali", "Alka+", "He posat Alka+"),
        7 => array("aglutinant", "Aglutinant", "He afegit aglutinant.")
    );
    foreach($llistaControls as $i => $control){
        if($i%2==0){echo "<tr>";}
?>
            <td style="width: 50%;">
                <div class="control" id="<?php echo $control[0] ?>" onmouseup="document.getElementById('formAccio').style.display = '';document.getElementById('<?php echo $control[0] ?>Form').style.display = ''; document.getElementById('<?php echo $control[0] ?>Valor').value='1';this.style.opacity='0.5'">
                    <div class="controlText"><h1><?php echo $control[1]; ?></h1></div>
                </div>
            </td>
<?php
        if($i%2==1){echo "</tr>";}
    } ?>
        <!-- <tr>
            <td colspan="2">
                <div class="control" id="total" onmouseup="">
                    <div class="controlText"><h2>Control múltiple</h2></div>
                </div>
            </td>
        </tr> -->
    </table>
    <div class="form" id="formAccio" style="display: none;">
        <form method="post" action="accio.php?form=add">
<?php
    foreach($llistaControls as $i => $control){
?>
            <div id="<?php echo $control[0] ?>Form" style="position:relative; display: none;">
                <div class="tancar" onmouseup="this.parentElement.style.display = 'none';document.getElementById('<?php echo $control[0] ?>Valor').value='null';document.getElementById('<?php echo $control[0] ?>').style.opacity='1'"><i class="fa-solid fa-circle-xmark"></i></div>
                <p><br><?php echo $control[2] ?></p>
                <input type="hidden" id="<?php echo $control[0] ?>Valor" name="<?php echo $control[0] ?>" value="null">
            </div>
<?php
    }
?>
            <input type="submit" value="Enviar">
            <input type="button" value="Cancelar" onmouseup="document.getElementById('formAccio').style.display = 'none';">
        </form>
    </div>
</div>
</body>
</html>