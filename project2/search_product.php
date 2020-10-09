<?php

$key = $_GET['keywords'];

if(empty($key)){
	die ("no keywords entered");
}else{
	$servername = "imc.kean.edu";
    $username = "zhugex";
    $password = "0988199";
    $dbname = "CPS3740_2018S";

    $con = mysqli_connect($servername, $username, $password, $dbname);
      if(!$con){
         die("login failed");
      }

     if($key == "*"){
     $sql = "SELECT * from Products_zhugex;";
     }else{
     $sql = "SELECT * from Products_zhugex where name like '%$key%' or description like '%$key%';";
     }

     $result = mysqli_query($con,$sql) or die($sql."<br/><br/>".mysqli_error());
     $count = mysqli_num_rows($result);
     while($count == 0){
        die ("No record found with the search keywords: $key;");
     }
     $i = 0;

     echo "<br>The search result for keywords: $key";

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
	    echo "<td>{$row['user_id']}<input type='hidden' name='user_id[$i]' value='{$row['user_id']}' /></td>";
	    echo "<td>{$row['vendor_id']}<input type='hidden' name='vendor_id[$i]' value='{$row['vendor_id']}' /></td>";
	    echo "</tr>";
	    ++$i;
     }
        echo '<tr>';
        echo '</tr>';
        echo "</form>";
        echo '</table>';

        mysqli_close($con);

}

?>