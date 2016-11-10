<?php 
	require("0functions.php");
	
	//MUUTUJAD
	$food = $usernameError = $username = $birthday = "";
	
	// kas on sisseloginud, kui ei ole siis
	// suunata login lehele
	if (!isset ($_SESSION["userId"])) {
		header("Location: login.php");
		exit();	
	}
	
	//LOG OUT
	if (isset($_GET["logout"])) {
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	//USERNAME
	if (isset ($_POST["username"])) {
		if (empty ($_POST["username"])) {
		$usernameError = "* V�li on kohustuslik!";
	
		} else {
		if (strlen ($_POST["username"]) >18){
		$usernameError = "* Nickname ei tohi olla pikkem kui 18!";

		} else {
		$username = $_POST ["username"];
			}
		}
	}
	
	//KONTROLLIN,ET K�IK ON OKEI JA V�IB SALVESTADA
	if (isset($_POST["username"])&&
		isset($_POST["food"]) &&
		!empty($_POST["username"])&&
		!empty($_POST["food"])
		)
		
	{
	register_food($username,$_POST["birthday"],$_POST["food"],$_SESSION["userId"]);
	}
	
	
	$people = All_info();

?>

<html>
<p>
<h1>Salvesta andmed enda kohta</h1>
	Tere tulemast <?=$_SESSION["email"];?>!
	<a href="?logout=1">Logi v�lja</a>
</p>
<body>
<title>Registreerimise l�pp</title>


	
	<form method="POST">
	
	<p><label for="birthday">Kasutaja nimi:</label><br>
	<input name="username" type="text" placeholder="Kasutaja nimi" value=<?=$username;?>> 
	<br><font color="red"><?php echo $usernameError; ?></font>

	<p><label for="birthday">S�nnip�ev:</label><br>
	<input name= "birthday" type="date" id="birthday" required>
	
	<p><label for="food">Vali oma lemmiku k��ki:</label><br>
	<select name="food" id="food" required>
		<option value="">N�ita</option>
		<option value="Abhaasia kook">Abhaasia k��k</option>
		<option value="Australian kook">Australian k��k</option>
		<option value="Austria kook">Austria k��k</option>
		<option value="Aserbaidzaani kook<">Aserbaid�aani k��k</option>
		<option value="Ameerika kook<">Ameerika k��k</option>
		<option value="Araabia kook">Araabia k��k</option>
		<option value="Argentiina kook">Argentiina k��k</option>
		<option value="Armeenia kook">Armeenia k��k</option>
		<option value="Valgevene kook">Valgevene k��k</option>
		<option value="Bulgaaria kook">Bulgaaria k��k</option>
		<option value="Brasiilia kook">Brasiilia k��k</option>
		<option value="Ungari kook">Ungari k��k</option>
		<option value="Havai kook">Havai k��k</option>
		<option value="Hollandi kook">Hollandi k��k</option>
		<option value="Kreeka kook">Kreeka k��k</option>
		<option value="Gruusia kook">Gruusia k��k</option>
		<option value="Taani kook">Taani k��k</option>
		<option value="Juudi kook">Juudi k��k</option>
		<option value="Iiri kook">Iiri k��k</option>
		<option value="India kook">India k��k</option>
		<option value="Inglise kook">Inglise k��k</option>
		<option value="Itaalia kook">Itaalia k��k</option>
		<option value="Hispaania kook">Hispaania k��k</option>
		<option value="Kaukaasia kook">Kaukaasia k��k</option>
		<option value="Hiina kook">Hiina k��k</option>
		<option value="Korea kook">Korea k��k</option>
		<option value="Kuuba kook">Kuuba k��k</option>
		<option value="Lati kook">L�ti k��k</option>
		<option value="Leedu kook">Leedu k��k</option>
		<option value="Mehhiko kook">Mehhiko k��k</option>
		<option value="Moldaavia kook">Moldaavia k��k</option>
		<option value="Mongoli kook">Mongoli k��k</option>
		<option value="Saksa kook">Saksa k��k</option>
		<option value="Norra kook">Norra k��k</option>
		<option value="Poola kook">Poola k��k</option>
		<option value="Portugali kook">Portugali k��k</option>
		<option value="Rumeenia kook">Rumeenia k��k</option>
		<option value="Vene kook">Vene k��k</option>
		<option value="Tyrgi kook">T�rgi k��k</option>
		<option value="Ukraina kook">Ukraina k��k</option>
		<option value="Soome kook">Soome k��k</option>
		<option value="Prantsuse kook">Prantsuse k��k</option>
		<option value="Tsehhi kook">T�ehhi k��k</option>
		<option value="Rootsi kook">Rootsi k��k</option>
		<option value="Soti kook">�oti k��k</option>
		<option value="Eesti kook">Eesti k��k</option>
		<option value="Jaapani kook">Jaapani k��k</option>
	</select>
	
	<br><br>
	<input type="submit" style="background-color:#A1D852; color:white;" value="Salvesta andmed">
	

</form>
</body>
</html>
<h2>Table</h2>
<?php 
	
$html = "<table>";
	
		$html .= "<tr>";
			$html .= "<th>Kasutaja</th>";
			$html .= "<th>S�nniaasta</th>";
			$html .= "<th>K��k</th>";
			$html .= "<th>ID</th>";
		$html .= "</tr>";
		
		//iga liikme kohta massiivis
		foreach ($people as $p) {
			
			$html .= "<tr>";
				$html .= "<td>".$p->username."</td>";
				$html .= "<td>".$p->birthday."</td>";
				$html .= "<td>".$p->food."</td>";
				$html .= "<td>".$p->id."</td>";
			$html .= "</tr>";
		
		}
		
	$html .= "</table>";
	
	echo $html;
?>