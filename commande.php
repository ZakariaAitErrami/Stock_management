<!DOCTYPE html>
<html>
<head>
	<title>PERLE E-COM commandes</title>
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
		<p><code class="copyright-text">La liste des commandes des clients</code></p>
<div class="results-div">
<?php
$servername="127.0.0.1";
$username="root";
$password="Zakaria123@-";
$dbname="gestion_commande";
    $conn= new mysqli($servername,$username,$password,$dbname);
if ($conn->connect_error) {
  die("Connection avec la base de données est échoué: " . $conn->connect_error);
}
$sql = <<< SQL
SELECT
client.nom_client,
ligne_commande.id_commande,
marchandise.description,
ligne_commande.quantity,
marchandise.unit_price /100 AS "unit_price_decimal",
ligne_commande.quantity * marchandise.unit_price / 100 AS "prix_total"
FROM ligne_commande, commande, client, marchandise
WHERE
ligne_commande.id_marchandise = marchandise.id_marchandise AND
commande.id_client = client.id_client AND
ligne_commande.id_commande = commande.id_commande
ORDER BY
nom_client,
ligne_commande.id_commande,
marchandise.description
SQL;

$result = $conn->query($sql);
if ($result->num_rows > 0) {
  // output data of each row

  $orderTotal = 0;
  $currentOrder= "";

  while($row = $result->fetch_assoc()) {

    if ($currentOrder!= $row["id_commande"]) {
      // starting a new customer

      if ($currentOrder != "") {
        // there was a customer before this one
        echo "</tbody>";
        echo "<tfoot><tr><td class='empty-cell' colspan='2'></td><td class='highlight-cell'>Prix Total de la commande</td><td class='highlight-cell'>".number_format($orderTotal, 2)."$</td></tr></tfoot>";
        echo "</table>";
        $orderTotal = 0;
      }

      // show customer name here
      echo "<table><thead>";
      echo "<tr><th class='highlight-cell' colspan='2'>Client: ".$row["nom_client"]."</th>";
      echo "<th class='highlight-cell' colspan='2'>ID commande: ".$row["id_commande"]."</th></tr>";
      echo "<tr><th>Description</th><th>Quantité</th><th>Prix unitaire</th><th>Line Total</th></tr></thead>";

      $currentOrder = $row["id_commande"];

    }

    echo "<tr>";
    echo "<td>".$row["description"]."</td><td>".$row["quantity"]."</td><td>".number_format($row["unit_price_decimal"], 2)."$</td><td>".number_format($row["prix_total"], 2)."$</td>";
    echo "</tr>";

    $orderTotal += $row["prix_total"];

  }

  echo "</tbody>";
  echo "<tfoot><tr><td class='empty-cell' colspan='2'></td><td class='highlight-cell'>Prix Total de la commande</td><td class='highlight-cell'>".number_format($orderTotal, 2)."$</td></tr></tfoot>";
  echo "</table>";

} else {
  echo "<h2>Acune commande trouvée !!!</h2>";
}
$conn->close();
?>
</div>
<div>
  <p class="option-centered"><a href="accueil.html">&lt;&lt;&lt;&nbsp;Revenir au menu pricipal</a></p>
</div>
<br />
</body>
<br />
<footer>
	<hr>
		<p><code class="copyright-text">Copyright &copy; PERLE E-COM</code></p>
		<p><code class="copyright-text">Created by Zakaria AIT ERRAMI</code></p>
</footer>
</html>