<?php
$conn=new mysqli('localhost','root','','bonsaistore');
session_start();
if($conn->connect_error)
{
    die('connessione fallita' .$conn->connect_error);
}
$myorder="SELECT a.`data`,p.`nome`, p.`prezzo` FROM acquisti as a INNER JOIN prodotti as p ON a.`idprod`=p.`id` INNER JOIN utenti as u ON a.`usr`=u.`username` WHERE a.`usr` LIKE '$_SESSION["usr"]';"

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

  </div>



</body>
</html>
