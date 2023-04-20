<?php
$conn=new mysqli('localhost','root','','bonsaistore');
session_start();
if($conn->connect_error)
{
    die('connessione fallita' .$conn->connect_error);
}
$myorder="SELECT a.`data`,p.`nome`, a.`prezzo` FROM acquisti as a INNER JOIN prodotti as p ON a.`idprod`=p.`id` INNER JOIN utenti as u ON a.`usr`=u.`username` WHERE a.`usr` LIKE '".$_SESSION["usr"]."';";
$result = mysqli_query($conn, $myorder);
?>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>home</title>
  <link rel="stylesheet" href="Style.css">
</head>
<body>
<ul>
    <li><a  href="logged.php"> <img class="logo" src="imgsito/logo.png"></a></li>
    <li><h2 class="title">Bonsai Store</h2></li>
    
    <li class="acc_button"><a class="normalbutton" href="index.php">Log Out</a></li>
    <li class="acc_button"><a class="normalbutton" href="logged.php">Indietro</a></li>
    
    </li>
</ul>
<div class="table-container">
  <?php
echo "<table>";
echo "<tr><th>Data</th><th>Nome prodotto</th><th>Prezzo</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td class=\"i_td\">" . $row['data'] . "</td>";
    echo "<td class=\"i_td\">" . $row['nome'] . "</td>";
    echo "<td class=\"i_td\">" . $row['prezzo'] . "$</td>";
    echo "</tr>";
}
echo "</table>";
?>
  </div>



</body>
</html>
