<?php
session_start();
if(isset($_POST['submit'])){
$username = $_POST['username'];
$password = $_POST['password'];
if($username == 'Adminfeps' && $password == 'phalasy1078'){
$_SESSION['admin'] = $username;
header('location:index.php');
}
else{
$error = 'Access denied';
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <link href="style.css" rel="stylesheet">
  <body>
  <div id="login">
  <h4>Admin Login</h4>
  <p class="error"><?php echo $error; ?> </p>
  <form method="post" action=" ">
  <input type="text" name="username" placeholder="username" required/>
  <input type="password" name="password" placeholder="password" required/>
  <input type="submit" name="submit"/>
  </form>
  </div>
  <p class="footnote"><sup>&copy;</sup>2020 EarnersHub , Design by <a href="http://alarol.business.site">Alarol<sup>&trade;</sup></a></p>