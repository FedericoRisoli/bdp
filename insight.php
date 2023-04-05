<?php
$conn=new mysqli('localhost','root','','bonsaistore');

if($conn->connect_error)
{
    die('connessione fallita' .$conn->connect_error);
}
//inizio query prododtto migliore
$best_product="SELECT prodotti.id , COUNT(acquisti.idprod)as tot_acquisti FROM prodotti INNER JOIN acquisti ON prodotti.id=acquisti.idprod GROUP BY acquisti.idprod HAVING tot_acquisti>=(SELECT COUNT(acquisti.idprod)as tot_acquisti FROM prodotti INNER JOIN acquisti ON prodotti.id=acquisti.idprod GROUP BY acquisti.idprod LIMIT 1)";
$res_BEST=mysqli_query($conn,$best_product);

    if(mysqli_num_rows($res_BEST)>0)  
          {
              while($row=$res_BEST->fetch_assoc())
              {
                $id_best=$row["id"]; //prende l'id del prodotto migliore
                $q_best=$row["tot_acquisti"]; //prende la quanti prodotti 
              }   
          }
$best_product_selection="SELECT * FROM prodotti WHERE id=$id_best";
$res_BEST=mysqli_query($conn,$best_product_selection);
    if(mysqli_num_rows($res_BEST)>0)  
          {
              while($row=$res_BEST->fetch_assoc())
              {
                $nome_best=$row["nome"]; //prende il nome del prodotto migliore
                $prezzo_best=$row["prezzo"]; //prende il prezzo 
                $immagine_best=$row["nomeimg"]; //prendeil nome dell immagine
              }   
          }
//fine prodotto migliore
//inizio prodotto peggiore
$worse_product="SELECT prodotti.id , COUNT(acquisti.idprod)as tot_acquisti FROM prodotti INNER JOIN acquisti ON prodotti.id=acquisti.idprod GROUP BY acquisti.idprod HAVING tot_acquisti<=(SELECT COUNT(acquisti.idprod)as tot_acquisti FROM prodotti INNER JOIN acquisti ON prodotti.id=acquisti.idprod GROUP BY acquisti.idprod LIMIT 1)";
$res_worse=mysqli_query($conn,$worse_product);

    if(mysqli_num_rows($res_worse)>0) 
          {
              while($row=$res_worse->fetch_assoc())
              {
                $id_w=$row["id"]; //prende l'id del prodotto peggiore
                $q_w=$row["tot_acquisti"]; //prende la quantita'del prodotto peggiore
              }   
          }
$worse_product_selection="SELECT * FROM prodotti WHERE id=$id_w";
$res_worse=mysqli_query($conn,$worse_product_selection);
    if(mysqli_num_rows($res_worse)>0)  
          {
              while($row=$res_worse->fetch_assoc())
              {
                $nome_w=$row["nome"]; //prende il nome del prodotto peggiore
                $prezzo_w=$row["prezzo"]; //prende il prezzo 
                $immagine_w=$row["nomeimg"]; //prende il nome dell immagine
              }   
          }
//fine prodotto peggiore
//inizio prodotto con prezzo maggiore
$more_exp="SELECT * FROM prodotti WHERE prezzo = (SELECT MAX(prezzo) FROM prodotti);"; //seleziona prodotto con prezzo maggiore
$res_exp=mysqli_query($conn,$more_exp);
    if(mysqli_num_rows($res_exp)>0)  
          {
              while($row=$res_exp->fetch_assoc())
              {
                $nome_e=$row["nome"]; //prende il nome del prodotto con prezzo maggiore
                $prezzo_e=$row["prezzo"]; //prende il prezzo 
                $immagine_e=$row["nomeimg"]; //prende il nome dell immagine
              }   
          }
//fine prodotto con prezzo maggiore
//inizio prodotto con prezzo minore
$more_chp="SELECT * FROM prodotti WHERE prezzo = (SELECT MIN(prezzo) FROM prodotti);"; //seleziona prodotto con prezzo inferiore
$res_chp=mysqli_query($conn,$more_chp);
    if(mysqli_num_rows($res_chp)>0)  
          {
              while($row=$res_chp->fetch_assoc())
              {
                $nome_c=$row["nome"]; //prende il nome del prodotto con prezzo inferiore
                $prezzo_c=$row["prezzo"]; //prende il prezzo 
                $immagine_c=$row["nomeimg"]; //prende il nome dell immagine
              }   
          }
//fine prodotto con prezzo minore
//inizio prezzo medio pagato da utente
$avg_pay="SELECT AVG(subquery.guadagno) AS guadagno_medio FROM ( SELECT SUM(p.prezzo) AS guadagno FROM acquisti a JOIN prodotti p ON a.idprod = p.id WHERE MONTH(a.data) = MONTH(CURRENT_DATE()) AND YEAR(a.data) = YEAR(CURRENT_DATE()) GROUP BY a.usr ) AS subquery";
$res_avg=mysqli_query($conn,$avg_pay);
    if(mysqli_num_rows($res_avg)>0)  
          {
              while($row=$res_avg->fetch_assoc())
              {
                $avg_price=$row["guadagno_medio"]; //prende il prezzo medio pagato dagli utenti
               
              }   
          }
//fine prezzo medio pagato da utente
//inizio guadagno totale da inizio anno
$total_income="SELECT SUM(p.prezzo) as total FROM prodotti p INNER JOIN acquisti a ON p.id = a.idprod WHERE a.data >= '2023-01-01';";
$res_tot=mysqli_query($conn,$total_income);
    if(mysqli_num_rows($res_avg)>0)  
          {
              while($row=$res_tot->fetch_assoc())
              {
                $tot=$row["total"]; //prende la somma del prezzo  pagato dagli utenti dall'1/1/2013
               
              }   
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
<div class="table-container">
<table>
<tbody>
  <tr>
    <td rowspan="4"class="titolo_prod">Prodotto Migliore:<br>(Maggior numero di vendite)</td>
    <?php print("<td class=\"titolo_prod\">".$nome_best."</td>");?>
  </tr>
  <tr>
  <?php print("<td>"."<img class=\"prod-img\" src='imgsito/".$immagine_best."'>"."</td>");?>
  </tr>
  <tr>
  <?php print("<td>".$prezzo_best."$</td>");?>
  </tr>
  <tr>
  <?php print("<td>q.ta venduta: ".$q_best."</td>");?>
  </tr>
  <tr>
   
  </tr>
  <tr>
    <td rowspan="4"class="titolo_prod">Prodotto Peggiore:<br>(Minor numero di vendite)</td>
    <?php print("<td class=\"titolo_prod\">".$nome_w."</td>");?>
  </tr>
  <tr>
  <?php print("<td>"."<img class=\"prod-img\" src='imgsito/".$immagine_w."'>"."</td>");?>
  </tr>
  <tr>
  <?php print("<td>".$prezzo_w."$</td>");?>
  </tr>
  <tr>
  <?php print("<td>q.ta venduta: ".$q_w."</td>");?>
  </tr>
  <tr>
    <td rowspan="4"class="titolo_prod">Prodotto con prezzo maggiore:</td>
    <?php print("<td class=\"titolo_prod\">".$nome_e."</td>");?>
  </tr>
  <tr>
  <?php print("<td>"."<img class=\"prod-img\" src='imgsito/".$immagine_e."'>"."</td>");?>
  </tr>
  <tr>
  <?php print("<td>".$prezzo_e."$</td>");?>
  </tr>
  <tr>
  </tr>
  <tr>
    <td rowspan="4" class="titolo_prod">Prodotto con prezzo inferiore:</td>
    <?php print("<td class=\"titolo_prod\">".$nome_c."</td>");?>
  </tr>
  <tr>
  <?php print("<td>"."<img class=\"prod-img\" src='imgsito/".$immagine_c."'>"."</td>");?>
  </tr>
  <tr>
  <?php print("<td>".$prezzo_c."$</td>");?>
  </tr>
  <tr>

  </tr>
  <tr>
    <td class="titolo_prod">Prezzo medio pagato dagli utenti :</td>
    <?php print("<td>".$avg_price."$</td>");?>
  </tr>
  <tr>
    <td class="titolo_prod">Guadagno Totale dall' 1/1 a oggi:</td>
    <?php print("<td>".$tot."$</td>");?>
  </tr>
</tbody>
</table>
  </div>



</body>
</html>
