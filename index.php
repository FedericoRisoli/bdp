<?php
$conn=new mysqli('localhost','root','','bonsaistore');
if($conn->connect_error)
{
    die('connessione fallita' .$conn->connect_error);
}

//reset sessione se ci sono precedenti sessioni(serve per logout più sicuro)
session_start();
session_destroy();


function arrotonda_a_due_decimali($numero) {
  return round($numero, 2);
}

$sql2="SELECT nome, promo, prezzo, nomeimg FROM prodotti ORDER BY promo DESC" ;


$result2=mysqli_query($conn,$sql2);//questi eseguono le query

?>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>home</title>
  <link rel="stylesheet" href="Style.css">
</head>
<body>
<ul>
    <li><a  href="index.php"> <img class="logo" src="imgsito/logo.png"></a></li>
    <li><h2 class="title">Bonsai Store</h2></li>
    
    <li class="acc_button"><a class="normalbutton" href="registrati.php">Registrati</a></li>
    <li class="acc_button"><a class="normalbutton" href="login.php">Accedi</a></li>
 
  </ul>

      

  <div class="table-container">
    <table>
      <tbody>
        <tr>
          <?php  //questa è la prima riga della tabella che mostra tutti i nomi
        
            while($row=$result2->fetch_assoc())
            {
              if ($row['promo']==1)
                {
                  print("<td class=\"titolo_prod\">".$row['nome']."<br>PROMO -10%</td>");
                }
              else{
                print("<td class=\"titolo_prod\">".$row['nome']."</td>");
              }
            }   
        
          ?>
        </tr>
        <tr>
        <?php //questo è un modo alternativo per vedere se ci sono righe (scegli tu tanto è uguale)
          
        //questa è la seconda riga della tabella che mostra tutte le immagini
        mysqli_data_seek($result2, 0); 
          while($row=$result2->fetch_assoc())
          {
              print"<td>"."<img class=\"prod-img\" src='imgsito/".$row['nomeimg']."'>"."</td>";
              
          }
        
          ?>
        </tr>
        <tr>
          <?php
              mysqli_data_seek($result2, 0); 

              //questa è la terza riga della tabella che mostra tutti i prezzi
        
              while($row=$result2->fetch_assoc())
              {
                if($row['promo']==0)
                {
                  print("<td>".$row['prezzo']." $"."</td>");
                }
                else
                {
                  print("<td>".round($row['prezzo']*0.9, 2)." $"."</td>");
                }

              }
    
          ?>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
