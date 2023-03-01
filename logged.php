<?php
$conn=new mysqli('localhost','root','','bonsaistore');
if($conn->connect_error)
{
    die('connessione fallita' .$conn->connect_error);
}
$name;
$sql="SELECT nome FROM utenti WHERE username LIKE 'fede'" ;
$result=$conn->query($sql);
if($result->num_rows>0)
{
    while($row=$result->fetch_assoc())
    {
        $name=$row['nome'];
    }
   
}
$sql2="SELECT nome FROM prodotti" ;
$result2=$conn->query($sql2);
$sql3="SELECT prezzo FROM prodotti" ;
$result3=$conn->query($sql3);
$sql4="SELECT nomeimg FROM prodotti" ;
$result4=$conn->query($sql4);


?>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>home</title>
  <link rel="stylesheet" href="Style.css">
</head>
<body>
  <div class="banner">
    <div class="logo-container">
      <img class="logo" src="imgsito/logo.png">
    </div>
    <div>
      <h2>Bonsai Store</h2>
    </div>  
    <div class="banner-links">
    <h4> Bentornato  <?php print $name?> </h4> 
    </div>
  </div>
 
    
  
  <div class="table-container">
    <table>
      <tbody>
        <tr>
          <?php 
          if($result2->num_rows>0)
          {
              while($row=$result2->fetch_assoc())
              {
                  print("<td class=\"titolo_prod\">".$nprod=$row['nome']."</td>");
              }   
          } 
          ?>
        </tr>
        <tr>
        <?php 
          if($result4->num_rows>0)
          {
              while($row=$result4->fetch_assoc())
              {
                  print"<td>"."<img class=\"prod-img\" src='imgsito/".$row['nomeimg']."'>"."</td>";
                 
              }
          }
          ?>
        </tr>
        <tr>
          <?php
        if($result3->num_rows>0)
          {
              while($row=$result3->fetch_assoc())
              {
                  print("<td>".$pprod=$row['prezzo']." $"."</td>");
              }
          }
          ?>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
