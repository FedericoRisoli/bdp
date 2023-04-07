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
          <a href="modify.php">Modifica Prodotto</a>
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
  <td class="invisible" colspan="2"><input type="hidden" name="chekoperation" value="rmv">
 <input class="sub" type="submit" value="Rimuovi"></td>
</tr>
    </form>  
</body>
</html>
