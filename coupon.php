<?php
session_start();
require ("config.php");
$db = new mysqli($dbhost,$dbusername,$dbpassword,$dbdatabase);
if(isset($_SESSION['admin'])){
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
  <li ><a href='pay.php'>Payment</a></li>
  <li class='active'><a href='coupon.php'>Coupon</a></li>
  </ul>
  </div>
  <body>
  ";
  $fetchcoureq = "SELECT * FROM coupon WHERE given='0' ";
  $countcoureq = mysqli_query($db,$fetchcoureq);
  while($coureq = mysqli_fetch_assoc($countcoureq)){
  
  $cou_id = $coureq['id'];
  if(isset($_POST['give'])){
  $cgive = " UPDATE coupon WHERE id='{$cou_id}' SET given='1'";
  $updatecgive = mysqli_query($db,$cgive);
  }
  echo"
  <br/><br/>
  <div id='login' style='width:90%;margin:2.5%;margin-left:2.5%,color:gray'>
   <h4>Coupon Request</h4>
   <b>Firstname : {$coureq['firstname']}</b><br>
   <b>Lastname : {$coureq['lastname']}</b><br>
   <b>Email : {$coureq['email']}</b><br>
   <b>Phone Number : {$coureq['tel']}</b><br>
   
   <form method='post' action=' '>
   <input type='submit' name='give' value='Give'/>
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