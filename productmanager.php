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
    $promo= $_POST["promo"];   //promo
   
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
    $name= $_POST["usr"];
    $psw=$_POST["psw"];
   
  }
  else if($operation=="rmv"){

  }
}
?>
<html>
<body>



</body>
</html>
