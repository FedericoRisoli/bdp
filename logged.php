<?php
$conn=new mysqli('localhost','root','','bonsaistore');
if($conn->connect_error)
{
    die('connessione fallita' .$conn->connect_error);
}
$name;
$sql="SELECT * FROM utenti";
$result=$conn->query($sql);
if($result->num_rows>0)
{
    while($row=$result->fetch_assoc())
    {
        $name=$row['nome'];
    }
   
}

?>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Tabella con logo e link</title>
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
      <a href="#">Registrati</a>
      <a href="login.html">Accedi</a>
    </div>
  </div>
  <div>
      <?php print"<h4> Bentornato ".$name."</h4>"?>
    </div>
  <div class="table-container">
    <table>
      <tbody>
        <tr>
          <td class="titolo_prod">Olmo Bonsai</td>
          <td class="titolo_prod">Ficus Bonsai</td>
          <td class="titolo_prod">Olivo Bonsai</td>
          <td class="titolo_prod">Quercia Bonsai</td>
        </tr>
        <tr>
          <td><img class="prod-img" src="imgsito/b1.jpg"></td>
          <td><img class="prod-img" src="imgsito/b2.jpg"></td>
          <td><img class="prod-img" src="imgsito/b3.jpg"></td>
          <td><img class="prod-img" src="imgsito/b4.jpg"></td>
        </tr>
        <tr>
          <td>15.00 $</td>
          <td>35.00 $</td>
          <td>50.00 $</td>
          <td>120.00 $</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
