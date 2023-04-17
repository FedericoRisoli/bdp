<?php
$conn=new mysqli('localhost','root','','bonsaistore');
session_start();
if($conn->connect_error)
{
    die('connessione fallita' .$conn->connect_error);
}

$id_prod = $_POST["bonsai"];

$bonsai="SELECT * FROM  `prodotti` WHERE  `id`= $id_prod" ;
$result=mysqli_query($conn,$bonsai);
$row=$result->fetch_assoc();
//$_SESSION["usr"];
$_SESSION["idprod"]=$id_prod;
//user idprod data
?>

<html lang="it">
<script>
function cvvCheck() {
  let cvv = document.getElementsByName("CVV")[0];
  
  if (cvv.value.length > 3) {
        cvv.value = cvv.value.slice(0,3); 
    }
}

function numberCheck() {
  let num = document.getElementsByName("numerocarta")[0];
  
  if (num.value.length > 16) {
        num.value = num.value.slice(0,16); 
    }
}

function setDate() {
  // new Date().getFullYear() ottiene anno corrente
  let date = document.getElementsByName("annoscadenza")[0];
  let anno = new Date().getFullYear();
  date.value = anno;
  date.min = anno;
  date.max = anno + 20;
}

function check(){
  //prendo tutti i campi e controllo che siano non vuoti
  var inputs = document.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) {
      //controllo senza caratteri bianchi (non blank)
      if (inputs[i].value.trim() == "") {
        alert("Tutti i campi sono obbligatori!");
        return false;
      }
    }

  let anno_s = document.getElementsByName("annoscadenza")[0].value;
  let mese_s = document.getElementsByName("mesescadenza")[0].value;
  let anno = new Date().getFullYear();
  let mese = new Date().getMonth()+1;//più uno perchè va da 0 a 11
  
  //non strettamente necessario ma lo lascio per sicurezza
  if(anno_s<anno)
  {
    alert("Data scadenza non valida");
    return false;
  }
  
  if(anno_s==anno)
  {
    if(mese_s<mese)
    {
      alert("Data scadenza non valida");
      return false;
    }
  }

  let num = document.getElementsByName("numerocarta")[0];
  
  if (num.value.length != 16) {
        alert("Numero Carta non valido");
        return false;
    }
  let cvv = document.getElementsByName("CVV")[0];
  
  if (cvv.value.length != 3) {
        alert("CVV non valido");
        return false;
  }

  alert("Il tuo ordine è stato registrato, otterrai il Bonsai in 3 giorni");
  return true;
}
</script>

<head>
  <meta charset="UTF-8">
  <title>Pagamento</title>
  <link rel="stylesheet" href="Style.css">
</head>
<body onload="setDate()">
    <ul>
    <li><a  href="logged.php"> <img class="logo" src="imgsito/logo.png"></a></li>
    <li><h2 class="title">Bonsai Store</h2></li>
    
    <li class="acc_button"><a class="normalbutton" href="index.php">Log Out</a></li>
    <li class="saluto"><h4> Bentornato  <?php print $_SESSION["name"]?> </h4> </li>
  </ul>

<br><br>

  <div class="table-container">
    <form onsubmit="return check()" name="input" method="POST" action="logged.php">
    <table class="invisible">
    <input type="hidden" name="chekoperation" value="comprato">
  <tbody>
  <tr>
    <td class="i_td"><label>Prdodotto:</label></td>
    <td class="i_td"><label><?php print $row['nome']; ?></label></td>
  </tr>
  <tr>
    <td class="i_td"><label>Prezzo:</label></td>
    <td class="i_td"><label><?php print $row['prezzo']; ?> $</label></td>
  </tr>
  <tr>
    <td class="i_td"><label>Intestatario Carta:</label></td>
    <td class="i_td"><input class="textfield" type="text" name="intestatario"></td>
  </tr>

  <tr>
    <td class="i_td"><label>Numero Carta:</label></td>
    <td class="i_td"><input class="textfield" id="no-spinner" type="number" name="numerocarta" min="0" max="9999999999999999" oninput="numberCheck()"></td>
  </tr>

  <tr>
    <td class="i_td"><label>CVV:</label></td>
    <td class="i_td"><input class="textfield" id="no-spinner" type="number" name="CVV" min="0" max="999" oninput="cvvCheck()"></td>
  </tr>

  <tr>
    <td class="i_td"><label>Anno Scadenza:</label></td>
    <td class="i_td"><input class="textfield" type="number" name="annoscadenza" min="2020" ></td>
  </tr>
  <tr>
    <td class="i_td"><label>Mese Scadenza:</label></td>
    <td class="i_td"><input class="textfield" type="number" name="mesescadenza" min="1" max="12" value="1"></td>
  </tr>
  <tr>
    <td class="i_td"><label>Indirizzo:</label></td>
    <td class="i_td"><input class="textfield" type="text" name="indirizzo" min="0" ></td>
  </tr>
  <tr>
    <td class="i_td" colspan="2"><input class="sub" type="submit" value="Compra"></td>
  </tr>
</tbody>
</table>
    </form>
  </div>
</body>
</html>
