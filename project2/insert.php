<?php

$cookie_name = "user";
if(!isset($_COOKIE[$cookie_name])) {
echo "Please click <a href='index.html'>homepage</a> to login first.";
} 
else {

echo "<br><a href='logout.php'>Logout</a>";

$name = $_POST["product_name"];
$description = $_POST["description"];
$cost = $_POST["cost"];
$sell_price = $_POST["sell_price"];
$quantity = $_POST["quantity"];
$vendor = $_POST["V_Id"];

if($name == ""||$description==""){
	die ("name or description is empty.");
}else if($cost<0||$sell_price<0){
	die ("cost or sell price is negative.");
}else if($sell_price<$cost){
	die ("sell price is less than cost.");
}else if($quantity<=0){
    die ("quantity should be positive.");
}else{

$servername = "imc.kean.edu";
$username = "zhugex";
$password = "0988199";
$dbname = "CPS3740_2018S";

$con = mysqli_connect($servername, $username, $password, $dbname);
if(!$con){
 die("login failed");
}
$user = $_COOKIE[$cookie_name];

$sql = "select name from Products_zhugex where name = '$name';";
$result=mysqli_query($con, $sql);
$count = mysqli_num_rows($result);

$m = "select id from CPS3740.Users where login = '$user';";
$result2=mysqli_query($con, $m);
$id=mysqli_fetch_array($result2);
$user_id=$id[0];


if($count==1){
   die ("There is the same prouct name in the database.");
}else{
   $sql2="insert into Products_zhugex (name,description,sell_price,cost,quantity,user_id,vendor_id) Values ('$name','$description',$sell_price,$cost,$quantity,$user_id,$vendor);";
   
   if(mysqli_query($con, $sql2)){
   	   echo "Successfully run query: INSERT into Products_zhugex (name,description,sell_price,cost,quantity,user_id,vendor_id) VALUES ($name,$description,$sell_price,$$cost,quantity,$user_id,$vendor)";
   }else{
   	die ("Insert Error");
   }

}



}
mysqli_close($con);







}
?>

