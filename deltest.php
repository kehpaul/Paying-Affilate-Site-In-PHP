<?php
session_start();
require ("config.php");
$db = new mysqli($dbhost,$dbusername,$dbpassword,$dbdatabase);
if(isset($_SESSION['admin'])){
$userid = $_POST['userid'];
$post_id = $_POST['postid'];

  if(isset($_POST['delete'])){
  $delete = " DELETE FROM testimony WHERE id='{$post_id}' ";
  $updatedelete = mysqli_query($db,$delete);
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
  <li class='active'><a href='post.php'>Post</a></li>
  <li><a href='pay.php'>Payment</a></li>
  <li><a href='coupon.php'>Coupon</a></li>
  </ul>
  </div>
  <body>
  ";
  
  $fetchpendpost = "SELECT * FROM testimony WHERE approve='1' ORDER BY id DESC";
  $countpendpost = mysqli_query($db,$fetchpendpost);
  while($pendpost = mysqli_fetch_assoc($countpendpost)){
  $image = $pendpost['image'];
  if(!@$pendpost['image']){
  $image = 'default.jpg';
  }
  $post_id = $pendpost['id'];
  $userid = $pendpost['user_id'];
  
  echo"<br><br>
  <div id='login' style='width:90%;margin:2.5%;margin-left:2.5%,color:gray'>
   <h4>{$pendpost['name']}</h4>
   <h6>{$pendpost['date']}</h6>
   <img class='post' src='http://earnershub.com.ng/postimage/{$image}'>
   <p>{$pendpost['testimony']}</p>
   <form method='post' action=' '>
    <input type='text' name='userid' value='{$userid}' hidden/>
   <input type='text' name='postid' value='{$post_id}' hidden/>
  <!-- <input type='submit' name='approve' value='Approve'/> -->
   <input type='submit' name='delete' value='Delete'/>
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