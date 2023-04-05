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
    $n = $_POST["n"];     //nome
    $sn= $_POST["sn"];     //surname
    $add= $_POST["addr"];  //indirizzo
    $date= $_POST["brt"];   //nascita
    $un= $_POST["un"];      //username
    $pss= $_POST["pw"];     //password
    $sqlregistration="INSERT INTO `utenti`(`username`, `password`, `nome`, `cognome`, `datanascita`, `indirizzo`) VALUES ('$un','$pss','$n','$sn','$date','$add')" ;

    //registrazione andata a buon fine?
    if ($conn->query($sqlregistration) === TRUE) 
      {
        echo "<script>alert('Login Avvenuto.');</script>";
        login($un,$pss,$conn);
      } 
      else
      {
        //controllo se l'errore è duplicate entry, ovvero se la chiave primaria (username) è già presente
        $uguali = substr_compare($conn->error, "Duplicate entry ", 0, 16);
        if ( $uguali == 0 ){
          echo "<script>alert('Username già in uso , sceglierne uno differente');</script>";
        }
        else{
          echo "<script>alert('Error inserting record:  . $conn->error');</script>";
        }
        echo file_get_contents("registrati.php");
        exit(0);
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
