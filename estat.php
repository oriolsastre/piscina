<?php
include_once("piscina_funcionsAdmin.php");
piscina_cookies($_COOKIE);
include_once("piscina_funcions.php");
?>
<html>
<?php piscinaHead("Estat de la piscina"); ?>
<body>
<?php piscinaHeadUser(); ?>
<div style="text-align: center; margin-left: auto; margin-right:auto;">

    <h1 class="principal">Historial d'accions</h1>
    <div class="form">
    <table>
        <tr>
            <th>Data</th>
            <th>pH</th>
            <th>Clor</th>
            <th>AG</th>
            <th>Fluoc</th>
            <th>Fons</th>
            <th>Alka</th>
            <th>Aglut.</th>
            <th></th>
        </tr>
<?php
    $sql_historial_accions = "SELECT piscinaAccio.*, user.usuari AS 'nom_usuari' FROM piscinaAccio JOIN user ON piscinaAccio.usuari=userID ORDER BY data_hora DESC LIMIT 10;";
    $qry_historial_accions = mysqli_query($dbcnx, $sql_historial_accions);
    while($historial_accions = mysqli_fetch_array($qry_historial_accions)){
        echo "<tr style=\"text-align:center;\">";
        echo "<td>".substr($historial_accions[1],0,10)."</td>";
        if($historial_accions[2]>0){echo "<td>&uarr;</td>";}elseif($historial_accions[2]<0){echo "<td>&darr;</td>";}else{echo "<td></td>";}
        if($historial_accions[3]!=null){echo "<td>&#x2611;</td>";}else{echo "<td></td>";}
        if($historial_accions[4]!=null){echo "<td>&#x2611;</td>";}else{echo "<td></td>";}
        if($historial_accions[5]!=null){echo "<td>&#x2611;</td>";}else{echo "<td></td>";}
        if($historial_accions[6]!=null){echo "<td>&#x2611;</td>";}else{echo "<td></td>";}
        if($historial_accions[7]!=null){echo "<td>&#x2611;</td>";}else{echo "<td></td>";}
        if($historial_accions[8]!=null){echo "<td>&#x2611;</td>";}else{echo "<td></td>";}
        echo "<td style=\"text-align:left;\">".$historial_accions[10]."</td>";
        if($_SESSION['userID']==$historial_accions[9]){echo "<td><i class=\"fa-solid fa-circle-xmark\"></i></td>";}
        echo "</tr>";
    }
?>
    </table>
    <p style="font-size: 10px;"><b>AG</b>: Antialgues, <b>Fluoc</b>: Fluoculant, <b>Fons</b>: Aspirar el fons, <b>Aglut</b>: Aglutinant</p>
    </div>

    <h1 class="principal">Historial de controls</h1>
    <div class="form">
        <table>
            <tr>
                <th>Data</th>
                <th>pH</th>
                <th>Clor</th>
                <th>Alcali</th>
                <th>Temp.</th>
                <th>Trans.</th>
                <th>Fons</th>
                <th></th>
            </tr>
<?php
    $sql_historial_controls = "SELECT piscinaControl.*, user.usuari AS 'nom_usuari' FROM piscinaControl JOIN user ON piscinaControl.usuari=userID ORDER BY data_hora DESC LIMIT 20;";
    $qry_historial_controls = mysqli_query($dbcnx, $sql_historial_controls);
    while($historial_controls = mysqli_fetch_array($qry_historial_controls)){
        echo "<tr style=\"text-align:center;\">";
        echo "<td>".substr($historial_controls[1],0,10)."</td>";
        if($historial_controls[2]==6.5){$pH_control="<6.8";}else{$pH_control=$historial_controls[2];}
        echo "<td>$pH_control</td>";
        echo "<td>".$historial_controls[3]."</td>";
        echo "<td>".$historial_controls[4]."</td>";
        echo "<td>".$historial_controls[5]."</td>";
        echo "<td>".$historial_controls[6]."</td>";
        echo "<td>".$historial_controls[7]."</td>";
        echo "<td style=\"text-align:left;\">".$historial_controls[9]."</td>";
        if($_SESSION['userID']==$historial_controls[8]){echo "<td><i class=\"fa-solid fa-circle-xmark\"></i></td>";}
        echo "</tr>";
    }
?>
        </table>
        <p style="font-size: 10px;"><b>Temp.</b>: Temparatura, <b>Trans.</b>: Transparència de l'aigua, <b>Fons</b>: Brutícia al fons de la piscina<br>
        Transparència i fons segueixen una escala de l'1 al 5, on l'1 és aigua transparent/fons net, i 5 és aigua bruta,verda,tèrbola i fons ple de brutícia.</p>
    </div>
</div>
</body>
</html>