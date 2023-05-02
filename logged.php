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
        //echo "<script>alert('Login Avvenuto.');</script>";
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
  else if($operation=="comprato"){
    //id usr idprod, data
    $name= $_SESSION["usr"];
    $data = date("Y-m-d");
    $prodotto = $_SESSION['idprod'];
    $prezzo = $_POST['prezzo'];

    $compro="INSERT INTO `acquisti`(`id`, `usr`, `idprod`, `data`, `prezzo`) VALUES (null,'$name',$prodotto,'$data', $prezzo);";
    //eseguo la query
    if(!mysqli_query($conn,$compro))
    {
      print "\nORDINE NON PROCESSATO PER FAVORE RIPROVARE";
    }
    

  }
}

$sql2="SELECT id, nome, promo, prezzo, nomeimg FROM prodotti ORDER BY promo DESC" ;


$result2=mysqli_query($conn,$sql2);//eseguo la query

function login($u,$p,$conn)
{
  $sql="SELECT * FROM utenti WHERE username LIKE '$u' AND password LIKE '$p'" ;
  $result=mysqli_query($conn,$sql);
  if(mysqli_num_rows($result)>0 )  //questo è 1 modo per vedere se ci sono righe
  {
    while($row=$result->fetch_assoc())
    {
      $_SESSION["name"] = $row['nome'];
      $_SESSION["usr"] = $row['username'];
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
    
    <?php
    if($_SESSION["usr"]=="admin"){
      print('<li class="acc_button"><a class="normalbutton" href="insight.php">Insight</a></li>');
      print('<li class="dropdown">
      <a href="javascript:void(0)" class="dropbtn">Gestisci prodotti</a>
      <div class="dropdown-content">
        <a href="add.html">Aggiungi Prodotto</a>
        <a href="modify.php">Modifica Prodotto</a>
        <a href="remove.php">Rimuovi Prodotto</a>
      </div>
      <li class="acc_button"><a class="normalbutton" href="order.php">Ordini</a></li>
    </li>');
    }
    else{
      print('<li class="acc_button"><a class="normalbutton" href="myorder.php">i miei ordini</a></li>');
    }
    ?>
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
                if ($row['promo']==1)
                {
                  print("<td class=\"titolo_prod\">".$row['nome']."<br>PROMO -10%</td>");
                }
                else{
                  print("<td class=\"titolo_prod\">".$row['nome']."</td>");
                }
              }   
          } 
          ?>
        </tr>
        <tr>
        <?php 
        mysqli_data_seek($result2, 0); 
          if($result2->num_rows>0) //questo è un modo alternativo per vedere se ci sono righe (scegli tu tanto è uguale)
          { 
            //questa è la seconda riga della tabella che mostra tutte le immagini
              while($row=$result2->fetch_assoc())
              {
                  print"<td>"."<img class=\"prod-img\" src='imgsito/".$row['nomeimg']."'>"."</td>";
                 
              }
          }
          ?>
        </tr>
        <tr>
          <?php
        mysqli_data_seek($result2, 0); 
        if($result2->num_rows>0) //questa è la terza riga della tabella che mostra tutti i prezzi
          {
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
          }
          ?>
        </tr>
      </tbody>
    </table>
  </div>
  <form class="lform" name="form" method="POST" action="pagamento.php">
    <H4 class=titolo_prod>Quale Bonsai desideri?</H4>
    <SELECT name="bonsai">
    <?php
      mysqli_data_seek($result2, 0); 
      foreach ($result2 as $row) {
        echo "<option value=".$row['id'].">" . $row['nome'] . "</option>";
      }
            ?>
    </SELECT>
    <BR>
    <input class="sub" type="submit" value="Compra">
  </form>
</body>
</html>
