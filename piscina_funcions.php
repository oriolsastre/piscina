<?php
function piscinaHead($titol){
?>
<head>
    <meta charset="UTF8">
	<meta name="viewport" content="width=device-width"/>
	<title><?php echo $titol; ?></title>
	<link rel="icon" type="image/ico" href="logo.ico"/>
    <link rel="stylesheet" type="text/css" href="format_mobil.css">
    <script src="https://kit.fontawesome.com/5d896814dd.js" crossorigin="anonymous"></script>
</head>
<?php
}

function piscinaHeadUser(){
?>
<div class="head_user">
    <span class="head_user" id="inici"><a class="dissimulat" href="/piscina"><i class="fa-solid fa-house"></i></a></span>
<?php
    if(isset($_SESSION['userID'])){
        $alertes = alertes();
?>
    <span class="head_user"><a class="dissimulat" href="alerta.php"><?php
        if($alertes[0]){
?><i class="fa-solid fa-bell fa-beat" style="color:red; --fa-animation-duration: 2s;"></i><?php
        }else{
?><i class="fa-regular fa-bell"></i><?php
        } ?></a></span>
    <span class="head_user"><a href="usuari.php?accio=personal" class="dissimulat"><i class="fa-solid fa-user"></i></a></span>
<?php
    }else{
?>
    <span class="head_user"><a href="usuari.php?accio=log_in" class="dissimulat"><i class="fa-regular fa-user"></i></a></span>
<?php
    }
?>
</div>
<?php
return $alertes;
}

function alertes(){
    $alertes = array(
        false,
        array(
            "antialga" => false,
        )
    );
    $sql_alerta_antialga = "SELECT DATEDIFF(CURDATE(),data_hora) FROM piscinaAccio WHERE antialga IS NOT NULL ORDER BY data_hora DESC LIMIT 1;";
    $qry_alerta_antialga = mysqli_query($_SESSION['DB'], $sql_alerta_antialga);
    $alerta_antialga = mysqli_fetch_array($qry_alerta_antialga)[0];
    if($alerta_antialga>7){$alertes[0]=true;$alertes[1]["antialga"]=true;}

    return $alertes;

}
?>