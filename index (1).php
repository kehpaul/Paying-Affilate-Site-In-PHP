<?php
session_start();
require ("config.php");
$db = new mysqli($dbhost,$dbusername,$dbpassword,$dbdatabase);
if(isset($_SESSION['admin'])){
$regwithsql = "SELECT * FROM reg_withdrawal WHERE id='1'";
$fetchregwith = mysqli_query($db,$regwithsql);
$regwith = mysqli_fetch_assoc($fetchregwith);
if($regwith['reg'] == 0){
$allow = 'none';
$close = 'block';
}
else{
$allow = 'block';
$close = 'none';
}
if(isset($_POST['allow'])){
$upwith = "UPDATE reg_withdrawal SET reg='0' WHERE id='1'";
$upregwith = mysqli_query($db,$upwith);
}
if(isset($_POST['close'])){
$upwith = "UPDATE reg_withdrawal SET reg='1' WHERE id='1'";
$upregwith = mysqli_query($db,$upwith);
}
if($regwith['ref'] == 1){
$rallow = 'none';
$rclose = 'block';
}
else{
$rallow = 'block';
$rclose = 'none';
}
if(isset($_POST['rallow'])){
$upwith = "UPDATE reg_withdrawal SET ref='1' WHERE id='1'";
$upregwith = mysqli_query($db,$upwith);
}
if(isset($_POST['rclose'])){
$upwith = "UPDATE reg_withdrawal SET ref='0' WHERE id='1'";
$upregwith = mysqli_query($db,$upwith);
}
if($regwith['act'] == 1){
$aallow = 'none';
$aclose = 'block';
}
else{
$aallow = 'block';
$aclose = 'none';
}
if(isset($_POST['aallow'])){
$upwith = "UPDATE reg_withdrawal SET act='1' WHERE id='1'";
$upregwith = mysqli_query($db,$upwith);
}
if(isset($_POST['aclose'])){
$upwith = "UPDATE reg_withdrawal SET act='0' WHERE id='1'";
$upregwith = mysqli_query($db,$upwith);
}
echo"


<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='utf-8'>
  <meta content='width=device-width, initial-scale=1.0,minimum-scale:1,maximum-scale:1' name='viewport'>
  <link href='style.css' rel='stylesheet'>
   <style>
  #header{
width:105%;
height:60px;
background: #fff;
padding:0;
margin:-2.5%;
}
#header ul{
display:inline;
width:100%;
}
#header li{
width:20%;
height:36px;
float:left;
background:none;
color:#00ffaa;
padding-top:20px;
padding-left:5px;
list-style-type:none;
margin-right:5px;
}
#header li.active{
border-bottom:4px solid #00ffaa;
}
#header li a{
color:#00ffaa;
text-decoration:none;
padding:5%;
text-align:center;
font-weight:bold;
list-style-type:none;
}
img.post{
width:95%;
height:200px;
border-radius:5px;
margin:2.5%;
}
  
  
  </style>
  <body>
  <div id='header'>
  <ul>
  <li class='active'><a href='index.php'>Home</a></li>
  <li><a href='post.php'>Post</a></li>
  <li><a href='pay.php'>Payment</a></li>
  <li><a href='coupon.php'>Coupon</a></li>
  </ul>
  </div>
  
  <div id='login' style='color:gray'>
  <p style='color:gray'>welcome {$_SESSION['admin']} to the administration of EarnersHub</p>
  <h4>Statistics</h4>
  ";
  $fetchreguser = "SELECT COUNT(id) AS reg FROM users";
  $countreguser = mysqli_query($db,$fetchreguser);
  $reguser = mysqli_fetch_assoc($countreguser);
  echo" 
  
  <b>Number of Registered Users : {$reguser['reg']}</b>
  <br><br>
  
  ";
  
  $fetchactuser = "SELECT COUNT(id) AS act FROM users WHERE active='1'";
  $countactuser = mysqli_query($db,$fetchactuser);
  $actuser = mysqli_fetch_assoc($countactuser);
  echo" 
  <b>Number of Active Users : {$actuser['act']}</b>
  <br><br>
  ";
  $fetchpendpost = "SELECT COUNT(id) AS pend FROM Post WHERE approve='0'";
  $countpendpost = mysqli_query($db,$fetchpendpost);
  $pendpost = mysqli_fetch_assoc($countpendpost);
  echo" 
  <b>Number of Pending Posts : {$pendpost['pend']}</b>
  <br><br>
  ";
  
  $fetchwitreq = "SELECT COUNT(id) AS req FROM withdrawal WHERE paid='0'";
  $countwitreq = mysqli_query($db,$fetchwitreq);
  $witreq = mysqli_fetch_assoc($countwitreq);
  echo" 
  <b>Number of Withdrawal Requests : {$witreq['req']}</b>
 <br><br>

  ";
  $fetchcoureq = "SELECT COUNT(id) AS cou FROM coupon WHERE given='0'";
  $countcoureq = mysqli_query($db,$fetchcoureq);
  $coupreq = mysqli_fetch_assoc($countcoureq);
  echo" 
  <b>Number of Coupon Requests : {$coupreq['cou']}</b>
  <br><br>
  
  ";
  
  echo"
  <br>
  <h4>Quick links</h4>
  <a href='insertcoupon.php' style='text-decoration:none;color:gray'>Insert New Coupon Code</a><br>
  <a href='sponsorpost.php' style='text-decoration:none;color:gray'>Make Sponsor Post</a><br>
  <a href='insertvendor.php' style='text-decoration:none;color:gray'>Insert New Vendor</a><br>
   <a href='delpost.php' style='text-decoration:none;color:gray'>Delete Approved Post</a><br>
  <a href='deluser.php' style='text-decoration:none;color:gray'>Delete User Account</a><br>
 <a href='testimony.php' style='text-decoration:none;color:gray'>Approve Testimony</a><br>
   <a href='deltest.php' style='text-decoration:none;color:gray'>Delete Approved Testimony</a><br>
 <a href='adminpost.php' style='text-decoration:none;color:gray'>Make Admin Post</a><br>
 
<br><br>";

echo"
<form action=' ' method='post' >
<input type='submit' name='allow' value='Allow Withdrawal' style='display:{$allow}'\>
<input type='submit' name='close' value='Close Withdrawal' style='display:{$close}'\>
<input type='submit' name='rallow' value='Allow Referral Earnings' style='display:{$rallow}'\>
<input type='submit' name='rclose' value='Close Referral Earnings' style='display:{$rclose}'\>
<input type='submit' name='aallow' value='Allow Activities Earnings' style='display:{$aallow}'\>
<input type='submit' name='aclose' value='Close Activities Earnings' style='display:{$aclose}'\>



</form>
<br><br>
  </div>
  <p class='footnote'><sup>&copy;</sup>2020 EarnersHub , Design by <a href='http://alarol.business.site'>Alarol<sup>&trade;</sup></a></p>
  ";
  }
  else{
  header('location:login.php');
  }
  ?>