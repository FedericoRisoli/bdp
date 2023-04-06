<!DOCTYPE html>
<?php
$conn=new mysqli('localhost','root','','bonsaistore');
if($conn->connect_error)
{
    die('connessione fallita' .$conn->connect_error);
}
$prodotti="SELECT id,nome FROM prodotti";
$result=mysqli_query($conn,$prodotti);
?>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Bonsai Store</title>
  <link rel="stylesheet" href="Style.css">
 
</head>
<body>
  <ul>
    <li><a  href="index.php"> <img class="logo" src="imgsito/logo.png"></a></li>
    <li><h2 class="title">Bonsai Store</h2></li>
    <li class="acc_button"><a class="normalbutton" href="logged.php">Indietro</a></li>
    <li class="dropdown">
        <a href="javascript:void(0)" class="dropbtn">Gestisci prodotti</a>
        <div class="dropdown-content">
          <a href="add.html">Aggiungi Prodotto</a>
          <a href="modify.html">Modifica Prodotto</a>
          <a href="remove.html">Rimuovi Prodotto</a>
        </div>
      </li>
  </ul>
    <form class="lform" name="f" method="POST" action="productmanager.php" >
    <label>Seleziona prodotti</label>
    <select name="sel">
      <?php
foreach ($result as $row) {
  echo "<option value=".$row['id'].">" . $row['nome'] . "</option>";
}
      ?>
    </select>
    <br>
      
        <label class="lab">Nome Prodotto:</label>
        <input class="textfield" type="text" name="nome" value="">
     <br>
   
        <label>Prezzo:</label>
        <input class="textfield" type="number" step="0.01" name="prezzo" value="0">
    <br>
   
        <label>nomeimg:</label>
        <input class="textfield" type="text" name="n_img" value="">
    <br>
   
        <label>Promo:</label>
        <input class="textfield" type="checkbox" name="promo">

      <p>
        <input type="hidden" name="chekoperation" value="mdf">
        <input class="sub" type="submit" value="Modifica">
      </p>
    </form>  
</body>
</html>
