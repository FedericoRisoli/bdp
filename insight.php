<?php
$conn=new mysqli('localhost','root','','bonsaistore');
session_start();
if($conn->connect_error)
{
    die('connessione fallita' .$conn->connect_error);
}
$best_product="SELECT prodotti.id , COUNT(acquisti.idprod)as tot_acquisti FROM prodotti INNER JOIN acquisti ON prodotti.id=acquisti.idprod GROUP BY acquisti.idprod HAVING tot_acquisti>=(SELECT COUNT(acquisti.idprod)as tot_acquisti FROM prodotti INNER JOIN acquisti ON prodotti.id=acquisti.idprod GROUP BY acquisti.idprod LIMIT 1)";
$res_BEST=mysqli_query($conn,$best_product);




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
    
    </li>
</ul>
<div class="table-container">
<table>
<tbody>
  <tr>
    <td rowspan="4">Prodotto Migliore:<br>(Maggior numero di vendite)</td><?php
    if(mysqli_num_rows($res_BEST)>0)  //questa è la prima riga della tabella che mostra tutti i nomi
          {
              while($row=$res_BEST->fetch_assoc())
              {
                  
              }   
          } ?>
  </tr>
  <tr>
    <td><?php print("qui ci va il nome del prodotto");?></td>
  </tr>
  <tr>
    <td><?php print("qui ci va límmagine del prodotto");?></td>
  </tr>
  <tr>
    <td><?php print("qui ci va il prezzo del prodotto");?></td>
  </tr>
  <tr>
    <td><?php print("qui ci va la quantita'venduta del prodotto");?></td>
  </tr>
  <tr>
    <td rowspan="4">Prodotto Peggiore:<br>(Minor numero di vendite)</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td rowspan="4">Prodotto con prezzo maggiore:</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td rowspan="4">Prodotto con prezzo inferiore:</td>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td>Guadagno Medio mensile :<br>(anno corrente)</td>
    <td></td>
  </tr>
  <tr>
    <td>Guadagno Totale dall' 1/1 a oggi:</td>
    <td></td>
  </tr>
</tbody>
</table>
  </div>



</body>
</html>
