<?php


$cookie_name = "user";
if(!isset($_COOKIE[$cookie_name])) {
echo "Please click <a href='login.html'>homepage</a> to login first.";
} 
else {

echo "<br><a href='logout.php'>Logout</a>";

    $servername = "imc.kean.edu";
    $username = "zhugex";
    $password = "0988199";
    $dbname = "CPS3740_2018S";

    $con = mysqli_connect($servername, $username, $password, $dbname);
      if(!$con){
         die("login failed");
      }

      $user = $_COOKIE[$cookie_name];
      $m = "select id from CPS3740.Users where login = '$user';";
      $r=mysqli_query($con, $m);
      $id=mysqli_fetch_array($r);
      $user_id=$id[0];


$size1 = count($_POST['description']);
$size2 = count($_POST['cost']);
$size4 = count($_POST['quantity']);

$i = 0;
while ($i < $size1) {
	$des= $_POST['description'][$i];
	$id = $_POST['id'][$i];

	if($des==""){
		die ("Please enter description at product id: $id.");
	}

	$mysql1="select description from Products_zhugex where id = $id;";
	$result1=mysqli_query($con, $mysql1);
	$oldd=mysqli_fetch_array($result1);
	$old_des=$oldd[0];

	if($des!=$old_des){
	$query1 = "UPDATE Products_zhugex SET description = '$des' WHERE id = $id;";
	mysqli_query($con,$query1) or die ("Error in query: $query1");
	$update_user= "update Products_zhugex set user_id = $user_id where id = $id;";
	mysqli_query($con,$update_user) or die ("Error in query");
    echo "<br>Description: $des in product id: $id has been updated.";
  }
  ++$i;
}

$j = 0;
while ($j < $size2) {
	$cost= $_POST['cost'][$j];
	$sell= $_POST['sell_price'][$j];
	$id = $_POST['id'][$j];

	if($cost>$sell){
		die ("sell price should be higher than cost at product id:$id.");
	}else if($sell<=0){
		die ("sell price shoud not be less than 0 at product id:$id.");
	}else if($cost<=0){
		die ("sell price shoud not be less than 0 at product id:$id.");
	}else{

	$mysql2="select cost,sell_price from Products_zhugex where id = $id;";
	$result2=mysqli_query($con, $mysql2);
	$oldc=mysqli_fetch_array($result2);
	$old_cost=$oldc[0];
	$old_sell=$oldc[1];

	if($cost!=$old_cost||$sell!=$old_sell){
	$query2 = "UPDATE Products_zhugex SET cost = '$cost' WHERE id = $id;";
	mysqli_query($con,$query2) or die ("Error in query: $query2");
	$query3 = "UPDATE Products_zhugex SET sell_price = '$sell' WHERE id = $id;";
	mysqli_query($con,$query3) or die ("Error in query: $query3");
	$update_user2= "update Products_zhugex set user_id = $user_id where id = $id;";
	mysqli_query($con,$update_user2) or die ("Error in query");
	echo "<br>Cost and Sell: $cost, $sell in product id: $id has been updated.";
    }
    }
	++$j;
}

$l = 0;
while ($l < $size4) {
	$qua= $_POST['quantity'][$l];
	$id = $_POST['id'][$l];

	if($qua<=0){
		 die ("quantity should be positive at product id: $id.");
	}

	$mysql4="select quantity from Products_zhugex where id = $id;";
	$result4=mysqli_query($con, $mysql4);
	$oldq=mysqli_fetch_array($result4);
	$old_quantity=$oldq[0];

	if($qua!=$old_quantity){
	$query4 = "UPDATE Products_zhugex SET quantity = '$qua' WHERE id = $id;";
	mysqli_query($con,$query4) or die ("Error in query: $query4");
	$update_user4= "update Products_zhugex set user_id = $user_id where id = $id;";
	mysqli_query($con,$update_user4) or die ("Error in query");
	echo "<br>Quantity: $qua in product id: $id has been updated.";
}
	++$l;
}

mysqli_close($con);
}

?>