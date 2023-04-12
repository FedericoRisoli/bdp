<?php
$conn=new mysqli('localhost','root','','bonsaistore');
session_start();
if($conn->connect_error)
{
    die('connessione fallita' .$conn->connect_error);
}

?>

<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Pagamento</title>
  <link rel="stylesheet" href="Style.css">
</head>
<body>
    <ul>
    <li><a  href="logged.php"> <img class="logo" src="imgsito/logo.png"></a></li>
    <li><h2 class="title">Bonsai Store</h2></li>
    
    <li class="acc_button"><a class="normalbutton" href="index.php">Log Out</a></li>
    <li class="saluto"><h4> Bentornato  <?php print $_SESSION["name"]?> </h4> </li>
  </ul>

      

  <div class="table-container">
    <table class="invisible">
  <tbody>
  <tr>
    <td class="i_td"><label>Intestatario Carta:</label></td>
    <td class="i_td"><input class="textfield" type="text" name="intestatario"></td>
  </tr>

  <tr>
    <td class="i_td"><label>Numero Carta:</label></td>
    <td class="i_td"><input class="textfield" type="number" name="numerocarta"  min="0"></td>
  </tr>

  <tr>
    <td class="i_td"><label>CVV:</label></td>
    <td class="i_td"><input class="textfield" type="number" name="numerocarta"  min="0"></td>
  </tr>

  <tr>
    <td class="i_td"><label>Anno Scadenza:</label></td>
    <td class="i_td"><input class="textfield" type="number" name="numerocarta"  min="0"></td>
  </tr>
  <tr>
    <td class="i_td"><label>Mese Scadenza:</label></td>
    <td class="i_td"><input class="textfield" type="number" name="numerocarta"  min="0"></td>
  </tr>
  <tr>
    <td class="i_td" colspan="2"><input class="sub" type="submit" value="Login"></td>
  </tr>
</tbody>
</table>
    </form>
  </div>
</body>
</html>
