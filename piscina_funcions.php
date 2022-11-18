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

function piscinaHeadUser($sessio){
?>
<div class="head_user">
    <span class="head_user" id="inici"><a class="dissimulat" href="/piscina"><i class="fa-solid fa-house"></i></a></span>
<?php
    if($sessio){
?>
    <span class="head_user"><a class="dissimulat" href="alerta.php"><i class="fa-regular fa-bell"></i></a></span>
    <!-- <span class="head_user"><i class="fa-solid fa-bell fa-beat" style="color:red; --fa-animation-duration: 2s;"></i></span>-->
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
}
?>