<!DOCTYPE html>
<?php
session_start();
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
    <li><a  href="logged.php"> <img class="logo" src="imgsito/logo.png"></a></li>
    <li><h2 class="title">Bonsai Store</h2></li>
    <li class="acc_button"><a class="normalbutton" href="logged.php">Indietro</a></li>
    <li class="dropdown">
        <a href="javascript:void(0)" class="dropbtn">Gestisci prodotti</a>
        <div class="dropdown-content">
          <a href="add.html">Aggiungi Prodotto</a>
          <a href="remove.php">Rimuovi Prodotto</a>
        </div>
      </li>
  </ul>
    <form class="addform" name="f" method="POST" action="productmanager.php" >
      <table>
        <tr>
        <td class="invisible"><label>Seleziona prodotto</label></td>
        <td class="invisible">
    <select name="sel">
      <?php
foreach ($result as $row) {
  echo "<option value=".$row['id'].">" . $row['nome'] . "</option>";
}
      ?>
    </select>
    </td>
</tr>
<tr>
    <td class="invisible"><label class="lab">Nome Prodotto:</label></td>
    <td class="invisible"><input class="textfield" type="text" name="nome" value=""></td>
</tr>        
<tr>
  
  <td class="invisible"><label>Prezzo:</label></td>
  <td class="invisible"><input class="textfield" type="number" step="0.01" name="prezzo" value="0"></td>
<tr>
   
    <td class="invisible"><label>nomeimg:</label></td>
    <td class="invisible"><input class="textfield" type="text" name="n_img" value=""></td>
</tr>
<tr>
  <td class="invisible"> <label>Promo:</label></td>
  <td class="invisible"><input class="textfield" type="checkbox" name="promo"></td>
</tr>
<tr>
  <td class="invisible" colspan="2"><input type="hidden" name="chekoperation" value="mdf">
 <input class="sub" type="submit" value="Modifica"></td>
</tr>
    </form>  
</body>
</html>
