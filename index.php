<?php
include_once("../unite_tiaret/phpFiles/connection.php");
session_start();

if (isset($_POST['btn_s'])) {

  $email = $_POST['email_txt'];
  $password = $_POST['pass_txt'];

  $selection = $connecte->prepare("select * from access where Email_user='$email' AND password_user='$password'");
  $selection->execute();
  $row = $selection->fetch(PDO::FETCH_ASSOC);

  if (is_array($row)) {
    if ($row['Email_user'] == $email && $row['password_user'] == $password) {
      if ($row['service'] == 'GDS') {
        if ($row['role'] == 'user') {
          header('refresh:1;phpFiles/gds/gsd.php');
        }
      }if($row['service'] == 'BOSS'){
        header('refresh:1;phpFiles/boss/boss.php'); 
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <link rel="stylesheet" href="css/indexform.css" />
  <title>Document</title>
</head>

<body>
  <div class="contenant">
    <div class="titre">
      <h1>Connexion</h1>
    </div>
    <form action="#" method="POST" class="form-body">
      <div class="input-group">
        <i class="fa fa-envelope"></i>
        <input type="text" placeholder="Email" name="email_txt" />
      </div>
      <div class="input-group">
        <i class="fa fa-key"></i>
        <input type="text" placeholder="mot de passe" name="pass_txt" />
      </div>
      <button class="btn" type="submit" name="btn_s">connection</button>
    </form>
  </div>
</body>

</html>