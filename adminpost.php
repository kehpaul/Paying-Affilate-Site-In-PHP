<?php
session_start();
require("config.php");
$db = new mysqli($dbhost,$dbusername,$dbpassword,$dbdatabase);
if(isset($_SESSION['admin'])){
if(isset($_POST['submit'])){
$post = $_POST['post'];
$_SESSION['post'] = $post;
$title = $_POST['title'];
$_SESSION['title'] = $title;
$userid = $_SESSION['USERID'];
$category = $_POST['category'];
$approve = '1';
$sponsor = '1';
$image = $_FILES['image']['name'];
$target = "postimage/".basename($_FILES['image']['name']);
$check = strtolower(pathinfo($target,PATHINFO_EXTENSION));
if($check == "jpg" || $check == "png" || $check != "jpeg") {
if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
$postsql = " INSERT INTO Post(user_id,title,post,category,image,approve,admin)VALUES('$userid','$title','$post','$category','$image','$approve','$sponsor')";
$insertpost = mysqli_query($db,$postsql);
    echo"your image has been uploaded and you've made a sponsor post";
  
}
else{
    echo"an error occurred while uploading your image or your image is not acceptable try uploading a jpg or jpeg or png image";
}		
}
else{
echo "you can only upload an image";
}	   



if(empty($image)){
$postsql = " INSERT INTO Post(user_id,title,post,category,approve,admin)VALUES('$userid','$title','$post','$category','$approve','$sponsor')";
$insertpost = mysqli_query($db,$postsql);
echo"You've made a sponsor post";
}
}
}
else{
header('location:login.php');
}
?>
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
  <h4>Make Admin Post</h4>
  <form method="post" action=" " enctype="multipart/form-data" style="margin-top:20px">
  <input type="text" name="title" placeholder="title" value="<?php echo $_SESSION['title']; ?>" require/>
  <select name="category" placeholder="Select Post category" required>
  <option value="general">General</option>
  <option value="sport">Sport</option>
  <option value="politics">Politics</option>
  <option value="entertainment">Entertainment</option>
  </select>
  <input type="file" name="image" accept="images/*" />
  <textarea style="width:90%;height:150px;border:1px solid #008821;margin:5%" type="text" name="post" placeholder="Enter Comment" value="<?php echo $_SESSION['post']; ?>" require/></textarea>
  <input type="submit" name="submit" value="submit"/>
  </form>
  </div>
  <p class='footnote'><sup>&copy;</sup>2020 EarnersHub , Design by <a href='http://alarol.business.site'>Alarol<sup>&trade;</sup></a></p>