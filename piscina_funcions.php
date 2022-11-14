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
    <span class="head_user"><i class="fa-regular fa-bell"></i></span>
    <span class="head_user"><a href="usuari.php?accio=log_in" class="dissimulat"><i class='fas'>&#xf406;</i></a></span></div>
<?php
}

?>