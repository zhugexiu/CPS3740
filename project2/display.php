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

$sql = "SELECT p.id,p.name,p.description,p.sell_price,p.cost,p.quantity,u.login as Login_ID,v.name as Vendor from Products_zhugex p, CPS3740.Users u, CPS3740.Vendors v where p.user_id = u.id and p.vendor_id = v.V_Id order by Login_ID;";

$result = mysqli_query($con,$sql) or die($sql."<br/><br/>".mysqli_error());

$i = 0;

     echo "<br>Product list";

     echo "<table border='1'>
     <tr>
     <th>id</th>
     <th>name</th>
     <th>description</th>
     <th>sell_price</th>
     <th>cost</th>
     <th>quantity</th>
     <th>user_id</th>
     <th>vendor_id</th>
     </tr>";


     while ($row = mysqli_fetch_array($result))
     {
     	echo "<tr>";
	    echo "<td>{$row['id']}<input type='hidden' name='id[$i]' value='{$row['id']}' /></td>";
	    echo "<td>{$row['name']}</td>";
	    echo "<td>{$row['description']}<input type='hidden' name='description[$i]' value='{$row['description']}' /></td>";
	    echo "<td>{$row['sell_price']}<input type='hidden' name='sell_price[$i]' value='{$row['sell_price']}' /></td>";
	    echo "<td>{$row['cost']}<input type='hidden' name='cost[$i]' value='{$row['cost']}' /></td>";
	    echo "<td>{$row['quantity']}<input type='hidden' name='quantity[$i]' value='{$row['quantity']}' /></td>";
	    echo "<td>{$row['Login_ID']}<input type='hidden' name='Login_ID[$i]' value='{$row['Login_ID']}' /></td>";
	    echo "<td>{$row['Vendor']}<input type='hidden' name='Vendor[$i]' value='{$row['Vendor']}' /></td>";
	    echo "</tr>";
	    ++$i;
     }
        echo '</table>';

        mysqli_close($con);

}
?>


