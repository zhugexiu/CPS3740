<?php

$cookie_name = "user";
if(!isset($_COOKIE[$cookie_name])) {
echo "Please click <a href='login.html'>homepage</a> to login first.";
} 
else {
echo "<br><a href='logout.php'>Logout</a>";

echo "<br>Add products";

echo "<form action='insert.php' method='post'>";
echo "<br>Product Name: <input type='text' name='product_name' size='20'>";
echo "<br>description: <input type='text' name='description' size='20'>";
echo "<br>Cost: <input type='text' name='cost' size='20'>";
echo "<br>Sell Price: <input type='text' name='sell_price' size='20'>";
echo "<br>Quantity: <input type='text' name='quantity' size='20'>";

$servername = "imc.kean.edu";
$username = "zhugex";
$password = "0988199";
$dbname = "CPS3740";

$con = mysqli_connect($servername, $username, $password, $dbname);
if(!$con){
 die("login failed");
}

$query="SELECT V_Id,Name from Vendors;";
$result=mysqli_query($con, $query);
echo "<br>select a vendor: ";
echo "<select name = 'V_Id'>";

while($row = mysqli_fetch_array($result)){
	$id = $row['V_Id'];
	$name = $row['Name'];
	echo "<option value = $id>$name</option>";
}
echo "</select>";
echo "<br><input type='submit' value='Submit'>";
echo "</form>";

mysqli_close($con);
}
?>