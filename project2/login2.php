<?php


$un = $_POST["username"];
$pd = $_POST["password"];

if($un==""&&$pd!==""){
  die ("Please insert your username");
}else if($un!==""&&$pd==""){
  die ("Please insert your password");
}else if($un==""&&$pd==""){
  die ("Plesase insert your password and username");
}else{



$servername = "imc.kean.edu";
$username = "zhugex";
$password = "0988199";
$dbname = "CPS3740";

$con = mysqli_connect($servername, $username, $password, $dbname);
if(!$con){
 die("login failed");
 }


$dbusername = null;
$dbpassword = null;


$query="SELECT login,password from CPS3740.Users where login= '$un' ;";
$result=mysqli_query($con, $query);

$count = mysqli_num_rows($result);

while($row=mysqli_fetch_array($result)){
 $dbusername=$row["login"];
 $dbpassword=$row["password"];
}


if($count == 0){
	die ("Login ID $un doesn't exit in the database.");
}
else if($dbpassword!=$pd){
    die ("User exists, but password not matches.");
	}
	else{
     //successfully login
     $cookie_name = "user";
     $cookie_value = $un;
     setcookie($cookie_name,$cookie_value,time()+3600,"/");


     $ip = $_SERVER['REMOTE_ADDR'];
     echo "<br>Your IP: $ip";
     $IPv4 = explode(".",$ip);
     if($IPv4[0]==10 || ($IPv4[0]==131 && $IPv4[1]==125)){
      echo "<br>You are from Kean University.";
    }else{
      echo "<br>You are NOT from Kean University.";
    }
      
	 $sql="SELECT concat(last_name, ' ', first_name) AS name,role,concat(address,',',state,',',zipcode) AS Address from CPS3740.Users where login= '$un';";
	    $r=mysqli_query($con, $sql);
        $info=mysqli_fetch_array($r);
	 	$UN=$info[0];
	 	$Role=$info[1];
	 	$FullAddress=$info[2];
	 
	 echo "<br>Welcome user: $UN";
	 echo "<br>Role: $Role";
	 echo "<br>Address: $FullAddress";

     if(strtolower($Role)==staff){
        echo "<ul>";
        echo "<li><a href='add.php'>Add products</a></li>";
        echo "<li><a href='display.php'>Display products</a></li>";
        echo "<li><a href='update.php'>Update products</a></li>";
        echo "</ul>";
     }


     echo "<br><a href='logout.php'>Logout</a>";
     echo "<br><a href='view_vendors.php'>View vendors</a>";


     mysqli_select_db($con,"CPS3740_2018S"); 

     $query2="SELECT * from CPS3740_2018S.Customers_zhugex;";
     $result2=mysqli_query($con,$query2);
     
     $sum_balance = "SELECT sum(balance) FROM CPS3740_2018S.Customers_zhugex;";
     $query4=mysqli_query($con, $sum_balance);
     $balance_info_sum=mysqli_fetch_array($query4);

     echo "<br>The customers are:";

     echo "<table border='1'>
     <tr>
     <th>ID</th>
     <th>Name</th>
     <th>Balance</th>
     <th>Zipcode</th>
     </tr>";

     while ($row = mysqli_fetch_array($result2))
     {
     	echo "<tr>";
	    echo "<td>".$row['id']."</td>";
	    echo "<td>".$row['name']."</td>";
	    echo "<td>".$row['balance']."</td>";
	    echo "<td>".$row['zipcode']."</td>";
	    echo "</tr>";
     }
     echo "</table>";
     echo "Total balance: $balance_info_sum[0]";
     mysqli_close($con);
}



}




?>