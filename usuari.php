<?php
	include_once("piscina_funcions.php");
	piscina_cookies($_COOKIE);

if(isset($_POST['accio'])){
	if($_POST['accio']=="nou_user"){
		
		$nou_usuari=addslashes($_POST['nom']);
		if(strlen($nou_usuari)<3 or strlen($nou_usuari)>20){exit("Tria un nom d'usuari amb 3 caràcters o més. O de 20 o menys, si fos el cas.");}
		$sql_check_usuari="SELECT COUNT(userID) FROM user WHERE usuari='$nou_usuari'";
		$qry_check_usuari=mysqli_query($dbcnx, $sql_check_usuari);
		$check_usuari=mysqli_fetch_array($qry_check_usuari);
		if($check_usuari[0]>0){exit("Aquest usuari ja existeix.");}
		
		
		$nou_email=addslashes($_POST['email']);
		if(strlen($nou_email)==0){exit("Escriu un correu d'electrònic.");}
		if(strlen($nou_email)>50){exit("No tens un correu electrònic de menys de 50 caràcters?");}
		if(strpos($nou_email,"@")===false){exit("Vols dir que has escrit un correu electrònic vàlid?");}
		$sql_check_email="SELECT COUNT(userID) FROM user WHERE email='$nou_email'";
		$qry_check_email=mysqli_query($dbcnx, $sql_check_email);
		$check_email=mysqli_fetch_array($qry_check_email);
		if($check_email[0]>0){exit("Aquest correu electrònic ja està associat a un usuari.");}
		
		if(strlen($_POST['password1'])<8){exit("La contrassenya ha de contenir un mínim de 8 caràcters.");}
		if($_POST['password1']!=$_POST['password2']){exit("La contrassenya no coincideix.");}
		if(strlen($_POST['seguretat'])==0 or strlen($_POST['seguretat'])>20){exit("Has de respondre la pregunta de seguretat. I no responguis amb més de 20 caràcters.");}
				
		contrasenya($_POST,$nou_usuari,$nou_email);
		
	}elseif($_POST['accio']=="log_in"){
		$login_user=addslashes($_POST['usuari']);
		$login_pass=$_POST['contrassenya'];
		
		$sql_check_usuari="SELECT COUNT(userID) FROM user WHERE usuari='$login_user'";
		$qry_check_usuari=mysqli_query($dbcnx, $sql_check_usuari);
		$check_usuari=mysqli_fetch_array($qry_check_usuari);
		if($check_usuari[0]==0){exit("Aquest usuari no existeix.");}
		
		$sql_login="SELECT * FROM user WHERE usuari='$login_user'";
		$qry_login=mysqli_query($dbcnx, $sql_login);
		$login=mysqli_fetch_assoc($qry_login);
		
		$hash2=check_contrasenya($login,$login_pass);
		
		if($login['hash']!=$hash2){exit("Contrassenya incorrecta");}
		else{
			recordar_usuari($login,$login_user,$_POST);
?>
		<meta http-equiv="refresh" content="0; url=usuari.php?accio=personal" />
<?php
			
		}
		
	}
}elseif(isset($_GET['accio'])){
	if($_GET['accio']=="nou" and $_GET['permis']==$permis_user){
?>
<h1>Crear usuari</h1>
<h2>Creant-te un usuari <u>acceptes</u> l'ús de Cookies. Pel simple fet de navegar per aquí no en tindràs, només al crear un usuari.<br>No són ni publicitat, ni estadístiques, ni res d'això. Senzillament per recordar qui ets i mantenir-te la sessió oberta.</h2>
<form id="nou_usuari" method="post" action="usuari.php">
	<table>
		<tr>
			<td>Nom d'Usuari:</td>
			<td><input type="text" size="20" maxlength="20" name="nom" form="nou_usuari"></td>
			<td><small>Sensible a majúscuels/minúscules</small></td>
		</tr><tr>
			<td>Correu electrònic:</td>
			<td><input type="text" size="20" maxlength="50" name="email" form="nou_usuari"></td>
			<td><small>És per poder contactar amb tu en cas de dubtes o similars. No serà visible per ningú ni té cap altra finalitat.</small></td>
		</tr><tr>
			<td>Contrassenya:</td>
			<td><input type="password" size="20" name="password1" form="nou_usuari"></td>
			<td><small>Ha de contenir un mínim de 8 caràcters.</small></td>
		</tr><tr>
			<td>Confirma-la:</td>
			<td><input type="password" size="20" name="password2" form="nou_usuari"></td>
		</tr><tr>
			<td colspan="3">Pregunta de seguretat. Quin és el teu postre favorit?</td>
		</tr><tr>
			<td></td>
			<td><input type="text" size="20" maxlength="20" name="seguretat" form="nou_usuari"></td>
			<td><small>Respon sense caràcters especials. Només lletres, majúscules o minúscules.</small></td>
		</tr>
	</table>
<input type="hidden" name="accio" value="nou_user" form="nou_usuari">
<input type="submit" value="Crear" form="nou_usuari">
</form>
<?php
	}elseif($_GET['accio']=="log_in"){
?>
<h1>Inicia sessió</h1>
<form id="log_in" method="post" action="usuari.php">
	<table>
		<tr>
			<td>Usuari:</td>
			<td><input type="text" size="20" maxlength="20" name="usuari" form="log_in"></td>
		</tr><tr>
			<td>Contrassenya:</td>
			<td><input type="password" size="20" name="contrassenya" form="log_in"></td>
		</tr><tr>
			<td colspan="2"><input type="checkbox" name="recorda" value="1" form="log_in">Recorda'm a aquest ordinador</td>
		</tr>
	</table>
<input type="hidden" name="accio" value="log_in" form="log_in">
<input type="submit" value="Entrar" form="log_in">
</form>
<?php
	}elseif($_GET['accio']=="log_out"){
	setcookie("usuari",null,-1,"/");
	session_destroy();
?>
	<meta http-equiv="refresh" content="0; url=inici.php" />
<?php
	}elseif($_GET['accio']=="personal"){
?>
	<h1>Àrea personal</h1>
	<table>
		<tr>
			<td><b>Nom d'usuari:</b></td>
			<td><?php echo $_SESSION['usuari']; ?></td>
		</tr>
		<tr>
			<td><b>Usuari des de:</b></td>
			<td><?php echo $_SESSION['desde']; ?></td>
		</tr>
	</table>
<?php
	}
}else{
?>
<h1>Accés d'usuaris</h1>

<?php
}
?>
</body>
</html>