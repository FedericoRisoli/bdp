<html>
<head>
<?php session_start();?>
  <meta charset="UTF-8">
  <title>Bonsai Store</title>
  <link rel="stylesheet" href="Style.css">
  <script>
    function checkForm() 
    {
  
      //prendo tutti i campi e controllo che siano non vuoti
      var inputs = document.getElementsByTagName("input");
      for (var i = 0; i < inputs.length; i++) {
        //controllo senza caratteri bianchi (non blank)
        if (inputs[i].value.trim() == "") {
          alert("Tutti i campi sono obbligatori!");
          return false;
        }
      }
  
      return true;
  
    }
  
  </script>
</head>
<body>
  <ul>
    <li><a  href="logged.php"> <img class="logo" src="imgsito/logo.png"></a></li>
    <li><h2 class="title">Bonsai Store</h2></li>
    <li class="acc_button"><a class="normalbutton" href="logged.php">Indietro</a></li>
    <li class="dropdown">
        <a href="javascript:void(0)" class="dropbtn">Gestisci prodotti</a>
        <div class="dropdown-content">
          <a href="modify.php">Modifica Prodotto</a>
          <a href="remove.php">Rimuovi Prodotto</a>
        </div>
      </li>
  </ul>
  <br>
  <div class="table-container">
    <form name="f" method="POST" action="productmanager.php"  onsubmit="return checkForm()">
      <table>
        <tr>
        <td class="invisible"><label class="lab">Nome Prodotto:</label></td>
        <td class="invisible"><input class="textfield" type="text" name="n_prod"></td>
        </tr>
        <tr>
          <td class="invisible"><label>Prezzo:</label></td>
          <td class="invisible"><input class="textfield" type="number" step="0.01" name="price"></td>
        </tr>  
        <tr>
          <td class="invisible"><label>nomeimg:</label></td>
          <td class="invisible"><input class="textfield" type="text" name="n_img"></td>
        </tr>
        <tr>
          <td class="invisible"><label>Promo:</label></td>
          <td class="invisible"><input class="textfield" type="checkbox" name="promo"></td>
        </tr>
        <tr>
          <td colspan="2" class="invisible">
        <input type="hidden" name="chekoperation" value="add">
        <input class="sub" type="submit" value="Aggiungi">
      </td>
      </tr>
     </table>
    </form>  
  </div>
</body>
</html>
