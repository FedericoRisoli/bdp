<?php
$conn=new mysqli('localhost','root','','bonsaistore');

if($conn->connect_error)
{
    die('connessione fallita' .$conn->connect_error);
}


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
<div>
<form class="lform" name="f" method="POST" action="productmanager.php">
<h3 class="normal-subtitle">Aggiungi Prodotto</h3>
      <label>Nome Prodotto:</label>
      <input class="textfield" type="text" name="prodname">
   <br>
 
      <label>Prezzo:</label>
      <input class="textfield" type="text" name="price">
      <br>
 
    <label>Nome immagine:</label>
    <input class="textfield" type="text" name="imgname">

    <p>
     
      <input class="sub" type="submit" value="Aggiungi Prodotto">
    </p>
  </form>


</div>





</body>
</html>
