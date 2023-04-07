<?php
$conn=new mysqli('localhost','root','','bonsaistore');

if($conn->connect_error)
{
    die('connessione fallita' .$conn->connect_error);
}
if(isset($_POST["chekoperation"])) 
  {
  $operation=$_POST["chekoperation"];
  if($operation=="add")
  {
    $n = $_POST["n_prod"];     //nome  prodotto
    $p= $_POST["price"];     //prezzo
    $n_img= $_POST["n_img"];  //nome immagine
    if(isset($_POST['promo'])) {
      $promo = 1;
   } else {
      $promo = 0;
   }
   
    $sqlregistration="INSERT INTO `prodotti`(`nome`, `prezzo`, `nomeimg`, `promo`) VALUES ('$n','$p','$n_img','$promo')" ; //inserisco prodotto

  
    if ($conn->query($sqlregistration) === TRUE) 
      {
        echo "<script>alert('Prodotto aggiunto correttamente.');</script>";
        header("location: logged.php"); //questo è un redirect
        exit; 
      } 
      else
      {
        echo "<script>alert('Errore inserimento.');</script>";
        header("location: add.html"); //questo è un redirect
        exit; 
      }

  }
  else if($operation=="mdf")
  {
   
      $id = $_POST["sel"];
      $sql = "SELECT * FROM prodotti WHERE id = $id";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $nome = isset($_POST["nome"]) ? $_POST["nome"] : $row["nome"];
      $prezzo = isset($_POST["prezzo"]) ? $_POST["prezzo"] : $row["prezzo"];
      $n_img = isset($_POST["n_img"]) ? $_POST["n_img"] : $row["n_img"];
      if(isset($_POST['promo'])) {
        $promo = 1;
     } else {
        $promo = 0;
      
      $sql = "UPDATE prodotti SET nome = '$nome', prezzo = $prezzo , nomeimg= '$n_img', promo='$promo' WHERE id = $id";
      if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Prodotto Modificato Correttamente.');</script>";
        header("location: logged.php"); //questo è un redirect
        exit; 
      } else {
        echo "<script>alert('Errore odifica.');</script>";
        header("location: add.html"); //questo è un redirect
        exit; 
      }

    }
  }
  else if($operation=="rmv")
  {
    $id = $_POST["sel"];
    $remove_query="DELETE  FROM `prodotti` WHERE id=$id";
    if (mysqli_query($conn, $remove_query)) {
      echo "<script>alert('Prodotto Rimosso correttamente.');</script>";
      header("location: logged.php"); //questo è un redirect
      exit; 
    } else {
      echo "<script>alert('Errore Rimozione.');</script>";
      header("location: add.html"); //questo è un redirect
      exit; 
    }
  }
}
    ?>
    
   
<html>
<body>



</body>
</html>
