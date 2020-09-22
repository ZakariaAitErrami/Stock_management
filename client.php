<!DOCTYPE html>
<html lang="en">
<head>
	<title>PERLE E-COM clients</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv=“Pragma” content=”no-cache”>
	<meta http-equiv=“Expires” content=”-1″>
	<meta http-equiv=“CACHE-CONTROL” content=”NO-CACHE”>
	<!-- CSS Stylesheets -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">  
	<link rel="stylesheet" href="css/client.css?v=4">
</head>
<body>
	<img class="hero" src="images/banner.jpg" alt="banner">
	<h1 class='section-heading'><img class="logo" src="images/logo.jpg" alt="logo" />&nbsp;PERLE E-COM</h1>
	<h2 class='section-subheading'>Departement d'expedition</h2>
	<p><code class="copyright-text">La liste des clients</code></p>

<div class="options-div">
<?php
$servername="127.0.0.1";
$username="root";
$password="Zakaria123@-";
$dbname="gestion_commande";
    $conn= new mysqli($servername,$username,$password,$dbname);
if ($conn->connect_error) {
  die("Connection avec la base de données est échoué: " . $conn->connect_error);
}
$sql="SELECT id_client,nom_client FROM client";
$result=$conn->query($sql);
	if($result->num_rows > 0){
		echo "<table><thead><tr><th>ID Client</th><th>Nom client</th></tr></thead>";
		echo "<tbody>";
		while($row=$result->fetch_assoc()){
			echo "<tr>";
			echo "<td>".$row['id_client']."</td><td>".$row['nom_client']."</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
	}
	else{
		echo "<h2>aucun client n'est enregistré dans la base de données</h2>";
	}
    $conn->close();
?>
</div>
<div>
  <p class="option-centered"><a href="accueil.html">&lt;&lt;&lt;&nbsp;Revenir au menu pricipal</a></p>
</div>
<br />
<footer>
	<hr>
		<p><code class="copyright-text">Copyright &copy; PERLE E-COM</code></p>
		<p><code class="copyright-text">Created by Zakaria AIT ERRAMI</code></p>
</footer>
</body>
</html>