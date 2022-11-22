<?php
function piscinaHead($titol){
?>
<head>
    <meta charset="UTF8">
	<meta name="viewport" content="width=device-width"/>
	<title><?php echo $titol; ?></title>
	<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🏊</text></svg>">
    <link rel="stylesheet" type="text/css" href="format_mobil.css">
    <script src="https://kit.fontawesome.com/5d896814dd.js" crossorigin="anonymous"></script>
</head>
<?php
}

function piscinaHeadUser(){
?>
<div class="head_user">
    <span class="head_user" id="inici"><a class="dissimulat" href="/piscina"><i class="fa-solid fa-house"></i></a>
    <a class="dissimulat" href="calculadora.php"><i class="fa-solid fa-calculator"></i></a></span>
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
            // alerta => array(t/f,dies)
            "antialga" => array(false,0),
            "pHmenys" => array(false,0),
            "pHmes" => array(false,0)
        )
    );
    $sql_alerta_antialga = "SELECT DATEDIFF(CURDATE(),data_hora) FROM piscinaAccio WHERE antialga IS NOT NULL ORDER BY data_hora DESC LIMIT 1;";
    $qry_alerta_antialga = mysqli_query($_SESSION['DB'], $sql_alerta_antialga);
    $alerta_antialga = mysqli_fetch_array($qry_alerta_antialga)[0];
    if($alerta_antialga>7){$alertes[0]=true;$alertes[1]["antialga"]=array(true,$alerta_antialga);}else{$alertes[1]["antialga"]=array(false,$alerta_antialga);}

    $sql_ultima_ph = "SELECT ph, DATE(data_hora) FROM piscinaControl WHERE ph IS NOT NULL ORDER BY data_hora DESC LIMIT 1";
    $qry_ultima_ph = mysqli_query($_SESSION['DB'], $sql_ultima_ph);
    $ultima_ph = mysqli_fetch_array($qry_ultima_ph);
    if($ultima_ph[0]<6.8){
        $sql_phmenys_accio = "SELECT DATEDIFF('".$ultima_ph[1]."',data_hora) FROM piscinaAccio WHERE ph<0 ORDER BY data_hora DESC LIMIT 1";
        $qry_phmenys_accio = mysqli_query($_SESSION['DB'],$sql_phmenys_accio);
        $phmenys_accio = mysqli_fetch_array($qry_phmenys_accio)[0];
        if($phmenys_accio>5 OR $phmenys_accio==NULL){$alertes[0]=true;$alertes[1]["pHmenys"]=array(true,$phmenys_accio);}else{$alertes[1]["pHmenys"]=array(false,$phmenys_accio);}
    }elseif($ultima_ph[0]>7.8){
        $sql_phmes_accio = "SELECT DATEDIFF('".$ultima_ph[1]."',data_hora) FROM piscinaAccio WHERE ph>0 ORDER BY data_hora DESC LIMIT 1";
        $qry_phmes_accio = mysqli_query($_SESSION['DB'],$sql_phmes_accio);
        $phmes_accio = mysqli_fetch_array($qry_phmes_accio)[0];
        if($phmes_accio>5 OR $phmes_accio==NULL){$alertes[0]=true;$alertes[1]["pHmes"]=array(true,$phmes_accio);}else{$alertes[1]["pHmes"]=array(true,$phmes_accio);}
    }

    return $alertes;

}

function esSafari(){
    //la pàgina de control no va bé amb Safari.
    $ua = $_SERVER['HTTP_USER_AGENT']; 
    return preg_match("/^((?!chrome).)*safari/i",$ua) && stripos($ua,' version/')!==false && stripos($ua,'mqqbrowser')===false;
}
?>