<?php
session_start();
require ("config.php");
$db = new mysqli($dbhost,$dbusername,$dbpassword,$dbdatabase);
if(isset($_SESSION['admin'])){
$userid = $_POST['userid'];
$req_id = $_POST['req_id'];
if(isset($_POST['pay'])){

  $wpay = " UPDATE withdrawal SET paid='1' WHERE id='{$req_id}' ";
  $updatewpay = mysqli_query($db,$wpay);

  /*$pay = " UPDATE payment_account SET paid='1' WHERE user_id='{$userid}' ";
  $updatepay = mysqli_query($db,$pay);*/
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
  <div id='header'>
  <ul>
  <li><a href='index.php'>Home</a></li>
  <li ><a href='post.php'>Post</a></li>
  <li class='active'><a href='pay.php'>Payment</a></li>
  <li><a href='coupon.php'>Coupon</a></li>
  </ul>
  </div>
  <body>
  ";
  $fetchwitreq = "SELECT * FROM withdrawal WHERE paid='0'";
  $countwitreq = mysqli_query($db,$fetchwitreq);
  while($witreq = mysqli_fetch_assoc($countwitreq)){
  $userid = $witreq['user_id'];
  $req_id = $witreq['id'];
  
  echo"<br><br>
  <div id='login' style='width:90%;margin:2.5%;margin-left:2.5%,color:gray'>
   <h4>Withdrawal Slip</h4>
   <b>Username : {$witreq['username']}</b><br>
   <b>Email : {$witreq['email']}</b><br>
   <b>Activities Earning : # {$witreq['activities_earning']}</b><br>
   <b>Referral Earning : # {$witreq['referral_earning']}</b><br>
   <b>Total Earning : # {$witreq['total_earning']}</b><br>
   <b>Bank Name :  {$witreq['bank_name']}</b><br>
   <b>Account Name :  {$witreq['account_name']}</b><br>
   <b>Account Number :  {$witreq['account_number']}</b><br>
   <b>Fb Timeline : {$witreq['fb_timeline']}</b><br>
   <form method='post' action=' '>
    <input type='text' name='userid' value='{$userid}' hidden/>
   <input type='text' name='req_id' value='{$req_id}' hidden/>
  
   <input type='submit' name='pay' value='Pay'/>
    </form>
   </div>";
   }
   echo"
   </div>
   <p class='footnote'><sup>&copy;</sup>2020 EarnersHub , Design by <a href='http://alarol.business.site'>Alarol<sup>&trade;</sup></a></p>
   ";
   
   }
   else{
   header('location:login.php');
   }
   ?>