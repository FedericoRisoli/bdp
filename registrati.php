<!DOCTYPE html>
<?php
session_start();
?>
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

    // Controlla che la password sia lunga almeno 6 caratteri
    var password = document.getElementById("password").value
    if (password.lenght < 6) {
      alert("La password deve avere almeno 6 caratteri e contenere un numero ed una lettera")
      return false;
    }
    // Se la password non ha almeno una lettera e non ha almeno un numero ritorna false
    if (! (/\d/.test(password)) && (/[a-zA-Z]/.test(password)) ) {
      alert("La password deve avere almeno 6 caratteri e contenere un numero ed una lettera")
      return false;
    } 
    return true;

  }

</script>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Bonsai Store</title>
  <link rel="stylesheet" href="Style.css">
</head>
<body>
  <ul>
    <li><a  href="index.php"> <img class="logo" src="imgsito/logo.png"></a></li>
    <li><h2 class="title">Bonsai Store</h2></li>
    <li class="acc_button"><a class="normalbutton" href="login.php">Accedi</a></li>
   
  </ul>

    <form onsubmit="return checkForm()" class ="tform" name="input" method="POST" action="logged.php">
      <table class="tform">
        <tr>
            <td> <label>Nome: </label> <input class="textfield" type="text" name="n"></td>
            <td> <label>Cognome: </label> <input class="textfield" type="text" name="sn"></td>
        </tr>
        <tr>
            <td> <label>Indirizzo: </label><input class="textfield" type="text" name="addr"></td>
            <td> <label>Data di nascita: </label> <input class="textfield" type="date" name="brt" value="2005-01-01"></td>
            
        </tr>
        <tr>
            <td> <label>Username: </label><input class="textfield" type="text" name="un"></td>
            <td> <label>Password: </label><input class="textfield" type="password" id="password" name="pw"></td>
            <input type="hidden" name="chekoperation" value="reg">
        </tr>
      </table>
      </p>
      <p>
        <input class="sub" type="submit" value="Sign Up">
      </p>
    </form>
</body>
</html>