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
    // Controlla che la data inserita sia valida
    var birthdate = new Date(document.getElementsByName("brt")[0].value);
    var currentDate = new Date();
    var minBirthdate = new Date();
    minBirthdate.setFullYear(currentDate.getFullYear() - 16);

    if (birthdate >= currentDate) {
      alert("Inserire una data di nascita valida");
      return false;
    }
    if (birthdate > minBirthdate) {
      alert("Devi avere almeno 16 anni per registrarti");
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

  <br>
  <div class="table-container">
    <form onsubmit="return checkForm()" name="input" method="POST" action="logged.php">
      <table>
      <br>
        <tr>
            <td class="invisible"> <label>Nome: </label> <input class="textfield" type="text" name="n"></td>
            <td class="invisible"> <label>Cognome: </label> <input class="textfield" type="text" name="sn"></td>
        </tr>
        <tr>
            <td class="invisible"> <label>Indirizzo: </label><input class="textfield" type="text" name="addr"></td>
            <td class="invisible"> <label>Data di nascita: </label> <input class="textfield" type="date" name="brt" value="2005-01-01"></td>
            
        </tr>
        <tr>
            <td class="invisible"> <label>Username: </label><input class="textfield" type="text" name="un"></td>
            <td class="invisible"> <label>Password: </label><input class="textfield" type="password" id="password" name="pw"></td>
            <input type="hidden" name="chekoperation" value="reg">
        </tr>
      </table>
      </p>
      <p>
        <input class="sub" type="submit" value="Sign Up">
      </p>
    </form>
  </div>
</body>
</html>
