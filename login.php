<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login page gestion des commandes</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
	<div id="frm">
		<form method="POST" action="<?php echo $_SERVER['PHP_SELF']?>">
			<label>Nom d'utilisateur</label><br>
			<input type="text" name="user"><br>
			<label>Mot de passe</label><br>
			<input type="password" name="pass"><br>
			<input type="submit" value="Se connecter" id="btn">
		</form>
	</div>
<?php 
	$servername="127.0.0.1";
	$username="root";
	$password="Zakaria123@-";
	$dbname="login";

	$conn = new mysqli($servername,$username,$password,$dbname);
	if($conn->connect_error){
		die("Connection non reussie: ".$conn->connect_error);
	}
if($_SERVER["REQUEST_METHOD"]=="POST"){
		$user = $_POST["user"];
		$pass = $_POST["pass"];
	
	//$sql="SELECT * FROM users WHERE username='$user' and password='$pass'";
	$sql="SELECT * FROM users";
	$result = $conn->query($sql);
	//$row = $result->fetch_assoc();
		while($row = $result->fetch_assoc()){
			if($row['username']==$user && $row['password']==$pass){
				//echo "Login sucess!!! Welcome ".$row['username'];
				header("Location: accueil.html");
			}else{
				//echo "Failed";
				echo '<font color="#FF0000"><p align="center" color="red">Erreur! Mot de passe && username sont invalides</p></font>';
			}
		}
}
	$conn->close();
 ?>
</body>
</html>