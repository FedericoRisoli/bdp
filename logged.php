<?php
$conn=new mysqli('localhost','root','','bonsaistore');
session_start();
if($conn->connect_error)
{
    die('connessione fallita' .$conn->connect_error);
}
//REGISTRATION
if(isset($_POST["chekoperation"])) 
  {
  $operation=$_POST["chekoperation"];
  if($operation=="reg")
    {
    $n = $_POST["n"];
    $sn= $_POST["sn"];
    $add= $_POST["addr"];
    $date= $_POST["brt"];
    $un= $_POST["un"];
    $pss= $_POST["pw"];
    $sqlregistration="INSERT INTO `utenti`(`id`, `username`, `password`, `nome`, `cognome`, `datanascita`, `indirizzo`, `ruolo`) VALUES ('','$un','$pss','$n','$sn','$date','$add','cli')" ;
      if ($conn->query($sqlregistration) === TRUE) 
      {
        login($un,$pss,$conn);
      } 
      else
      {
        echo "Error inserting record: " . $conn->error;
      }

    }
  else if($operation=="login")
  {
    $name= $_POST["usr"];
    $psw=$_POST["psw"];
    login($name,$psw,$conn);
  }
}

$sql2="SELECT nome FROM prodotti" ;
$sql3="SELECT prezzo FROM prodotti" ;
$sql4="SELECT nomeimg FROM prodotti" ;


$result2=mysqli_query($conn,$sql2);//questi eseguono le query
$result3=mysqli_query($conn,$sql3);
$result4=mysqli_query($conn,$sql4);

function login($u,$p,$conn)
{
  $sql="SELECT nome FROM utenti WHERE username LIKE '$u' AND password LIKE '$p'" ;
  $result=mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)>0 )  //questo è 1 modo per vedere se ci sono righe
  {
      while($row=$result->fetch_assoc())
      {
        $_SESSION["name"] = $row['nome'];
      } 
     
  }
  else if((empty($u) || empty($p)|| ($u==""||$p==""))){
    $_SESSION["login_failed"] = true; 
    header("location: login.php"); //questo è un redirect
    exit; 
  }
  else 
  {
    $_SESSION["login_failed"] = true; 
    header("location: login.php"); //questo è un redirect
    exit; 
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
    <li class="saluto"><h4> Bentornato  <?php print $_SESSION["name"]?> </h4> </li>
    <li class="dropdown">
      <a href="javascript:void(0)" class="dropbtn">Dropdown</a>
      <div class="dropdown-content">
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
      </div>
    </li>
  </ul>

      

  <div class="table-container">
    <table>
      <tbody>
        <tr>
          <?php 
          if(mysqli_num_rows($result2)>0)  //questa è la prima riga della tabella che mostra tutti i nomi
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
          if($result4->num_rows>0) //questo è un modo alternativo per vedere se ci sono righe (scegli tu tanto è uguale)
          { 
            //questa è la seconda riga della tabella che mostra tutte le immagini
              while($row=$result4->fetch_assoc())
              {
                  print"<td>"."<img class=\"prod-img\" src='imgsito/".$row['nomeimg']."'>"."</td>";
                 
              }
          }
          ?>
        </tr>
        <tr>
          <?php
        if($result3->num_rows>0) //questa è la terza riga della tabella che mostra tutti i prezzi
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
