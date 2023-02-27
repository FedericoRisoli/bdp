<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <title>Tabella con logo e link</title>
  <style>
    html{
      font-family:verdana;
      background-color:#343E3D;
    }
    /* Stili per il banner */
    
    .banner {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 10px;
      background-color: #C6EBBE;
      border-radius:25px;
      text-align:center;
    }
    
    /* Stili per il logo */
    .logo {
      max-height: 80px;     
    }
    
    /* Stili per i link nel banner */
    .banner-links a {
      margin-left: 10px;
      
      color:#FFDDD2;
      
      
    }
    a{
      background-color:#607466;
      border-radius:5px;
      width: 200px;
    }

    /* Stili per la tabella */
    .table-container {
      display: flex;
      justify-content: center; 
    
     
    }
    
    table {
      border-collapse: collapse;
      margin-top: 20px;
      margin-bottom:20px;
      border-radius:10px;
      overflow: hidden;
        
    }
    
    td,th {
      border: 5px solid #FCA311;
     
      padding: 10px;
      text-align: center;
      background-color:#607466;
      color:#FFDDD2;
      
    }
    .titolo_prod{
      font-weight:bold;
      color:#FFDDD2;
    }
    .prod-img{
      height:180px;
      width:150px;
      border-radius:50px;
    }
    h2{
      color:#343E3D;
    }
    
  </style>
</head>
<body>
  <div class="banner">
    <div class="logo-container">
      <img class="logo" src="imgsito/logo.png">
    </div>
    <div>
      <h2>Bonsai Store</h2>
    </div>  
    <div class="banner-links">
      <a href="#">Registrati</a>
      <a href="#">Accedi</a>
    </div>
  </div>

  <div class="table-container">
    <table>
      <tbody>
        <tr>
          <td class="titolo_prod">Olmo Bonsai</td>
          <td class="titolo_prod">Ficus Bonsai</td>
          <td class="titolo_prod">Olivo Bonsai</td>
          <td class="titolo_prod">Quercia Bonsai</td>
        </tr>
        <tr>
          <td><img class="prod-img" src="imgsito/b1.jpg"></td>
          <td><img class="prod-img" src="imgsito/b2.jpg"></td>
          <td><img class="prod-img" src="imgsito/b3.jpg"></td>
          <td><img class="prod-img" src="imgsito/b4.jpg"></td>
        </tr>
        <tr>
          <td>15.00 $</td>
          <td>35.00 $</td>
          <td>50.00 $</td>
          <td>120.00 $</td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
