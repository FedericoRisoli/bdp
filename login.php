<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Bonsai Store</title>
  <link rel="stylesheet" href="Style.css">
  <?php
  session_start();

  ?>
</head>
<body>
  <ul>
    <li><a  href="index.php"> <img class="logo" src="imgsito/logo.png"></a></li>
    <li><h2 class="title">Bonsai Store</h2></li>
    <li class="acc_button"><a class="normalbutton" href="registrati.php">Registrati</a></li>
  </ul>
    <form class="lform" name="f" method="POST" action="logged.php">
  <table >
  <tbody>
  <tr>
    <td class="i_td"><label>Username:</label></td>
    <td class="i_td"><input class="textfield" type="text" name="usr"></td>
  </tr>


  <tr>
    <td class="i_td"><label>Password:</label></td>
    <td class="i_td"><input class="textfield" type="password" name="psw"></td>
  </tr>
</tbody>
</table>

      <p>
        <input type="hidden" name="chekoperation" value="login">
        <input class="sub" type="submit" value="Login">
      </p>
    </form>
    <?php 
  if(isset($_SESSION["login_failed"]) && $_SESSION["login_failed"] == true)
  {
    echo '<h5 class="error">Username o password errati</h5>';
      $_SESSION["login_failed"] = false; // reimposta la variabile di sessione a false
  }
  ?>
  
</body>
</html>
