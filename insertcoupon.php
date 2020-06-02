<?php
session_start();
require("config.php");
$db = new mysqli($dbhost,$dbusername,$dbpassword,$dbdatabase);
if(!isset($_SESSION['admin'])){
header('location:login.php');
}
if(isset($_POST['submit'])){
$coupon =$_POST['coupon'];
$couponsql = "INSERT INTO coupon_code(coupon)VALUE('$coupon')";
$insertcoupon = mysqli_query($db,$couponsql);
}
$id = $_POST['id'];
if(isset($_POST['delete'])){
  $delete = " DELETE FROM coupon_code WHERE id='{$id}' ";
  $updatedelete = mysqli_query($db,$delete);
  }
?>
<meta content="width=device-width, initial-scale=1.0,minimum-scale=1,maximum-scale=1" name="viewport">
<link href="style.css" rel="stylesheet">
<style>
body{
background:#dddfe2;
}
#log{
width:90%;
height:auto;
background: #fff;
margin:5%;
}
input{
width:90%;
height:50px;
border:1px solid #00ff00;
border-radius:5px;
margin:5%;
}
input[type=submit]{
width:85%;
height:50px;
background:#00ff00;
border-radius:5px;
color: #fff;
margin:7.5%;
}
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
<div id="log">
<form action=" " method="post">
<input type="text" name="coupon" placeholder="Insert Coupon code" required/>
<input type="submit" name="submit" value="submit">
</form>
</div>
<div id='log'>
<h4>Added Coupon codes </h4>
<table>
<tr>
<th>ID</th>
<th>CODE</th>
<th>STATUS</th>
<th>ACTION</th>
</tr>
<?php
$fcouponsql = "SELECT * FROM coupon_code ORDER BY id ASC";
$fetchcoupon = mysqli_query($db,$fcouponsql);
while($fcoupon = mysqli_fetch_assoc($fetchcoupon)){
$id = $fcoupon['id'];
$gcoupon = $fcoupon['coupon'];
$ucouponsql = "SELECT * FROM users WHERE coupon='{$gcoupon}'";
$fetchucoupon = mysqli_query($db,$ucouponsql);
$ucoupon = mysqli_num_rows($fetchucoupon);
if($ucoupon > 0){
$active = 'used';
}
else{
$active = 'free';
}
echo"
<tr>
<td>
{$fcoupon['id']}
</td>
<td>
{$fcoupon['coupon']} 
</td>
<td>
{$active}
</td>
<td>
<form method='post' action=' '>
<input type='text' name='id' value='{$id}' hidden />
<input type='submit' name='delete' value='Delete' />
</form>
</td>
</tr>
";
}
?>
</table>
</div>
<p class='footnote'><sup>&copy;</sup>2020 EarnersHub , Design by <a href='http://alarol.business.site'>Alarol<sup>&trade;</sup></a></p>