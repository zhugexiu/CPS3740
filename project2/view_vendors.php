<HTML>
<title>View all vendors</title>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      #map-canvas {
        height: 600px;
        margin: 0px;
        padding: 0px
      }
    </style>


<body>

<div style="margin:auto;  width: 720px; ">


<?php

$cookie_name = "user";
if(!isset($_COOKIE[$cookie_name])) {
echo "Please click <a href='index.html'>homepage</a> to login first.";
} 
else {
echo "<br><a href='logout.php'>Logout</a>";

    $servername = "imc.kean.edu";
    $username = "zhugex";
    $password = "0988199";
    $dbname = "CPS3740";

    $con = mysqli_connect($servername, $username, $password, $dbname);
      if(!$con){
         die("login failed");
      }
    $sql="select V_Id as ID,Name,Address,city as City,State,Zipcode,CONCAT('(',latitude, ' ', longitude,')') as Location from Vendors where state is not null and city is not null and address is not null and latitude is not null and longitude is not null;";
    $query="select V_ID, Name, latitude,longitude from Vendors where state is not null and city is not null and address is not null and latitude is not null and longitude is not null;";
    $result2 = mysqli_query($con,$query) or die($sql."<br/><br/>".mysqli_error());
    $count = mysqli_num_rows($result2);
    $sumlati=0;
    $sumlong=0;
    $i=0;

     while($row = mysqli_fetch_array($result2)){ 
     $vendorid[$i] = $row['V_ID'];
     $name[$i] = $row['Name'];
     $latitude[$i] = $row['latitude'];
     $longitude[$i] =  $row['longitude'];
     $i=$i+1;
     }
          
    for($i=0;$i<$count;$i++){
     $sumlati = $sumlati+$latitude[$i];
     $sumlong = $sumlong+$longitude[$i];
         }
     $avelati=$sumlati/$count;
     $avelong=$sumlong/$count;

     
      
    $result = mysqli_query($con,$sql) or die($sql."<br/><br/>".mysqli_error());
 
    echo "<div style='text-align:center'>";
    echo "<br>The following vendors are in the database.";
    echo "</div>";
    echo "<center><table border='1'>
     <tr>
     <th>ID</th>
     <th>Name</th>
     <th>Address</th>
     <th>City</th>
     <th>State</th>
     <th>Zipcode</th>
     <th>Location(Latitude,Longtitude)</th>
     </tr>";

     while ($row = mysqli_fetch_array($result))
     {
      echo "<tr>";
      echo "<td>".$row['ID']."</td>";
      echo "<td>".$row['Name']."</td>";
      echo "<td>".$row['Address']."</td>";
      echo "<td>".$row['City']."</td>";
      echo "<td>".$row['State']."</td>";
      echo "<td>".$row['Zipcode']."</td>";
      echo "<td>".$row['Location']."</td>";
      echo "</tr>";
     }
     echo "</table>";
     echo "</center>";
     mysqli_close($con);


  }
?>

 <head>

    <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>

    <script>

    var i = 0;
    var sum1=<?php echo $count; ?>;
    var avelong=<?php echo $avelong; ?>;
    var avelati=<?php echo $avelati; ?>;

    var vid = <?php echo json_encode($vendorid);?> ;
    var name2 = <?php echo json_encode($name);?> ;
    var lat =<?php echo json_encode($latitude);?> ;
    var lon = <?php echo json_encode($longitude);?> ;

  
    function initialize() {
        var mapOptions = {
                zoom: sum1,

                center: new google.maps.LatLng(avelati, avelong),
                mapTypeId: google.maps.MapTypeId.ROADMAP
       };

       var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

       var infowindow = new google.maps.InfoWindow();

  var markerIcon = {
      scaledSize: new google.maps.Size(80, 80),
      origin: new google.maps.Point(0, 0),
      anchor: new google.maps.Point(32,65),
      labelOrigin: new google.maps.Point(40,33)
  };
        var location;
        var mySymbol;
        var marker, m;

        
        var MarkerLocations = new Array(sum1);
        for(var i =0;i<sum1;i++){
          MarkerLocations[i]= new Array(4); 
        }

       for (var x = 0; x < sum1; x++) {
        MarkerLocations[x][0]= vid[x];
        MarkerLocations[x][1]= name2[x];
        MarkerLocations[x][2]= parseFloat(lat[x]);
        MarkerLocations[x][3]= parseFloat(lon[x]);
       }


for (m = 0; m < sum1; m++) {

        location = new google.maps.LatLng(MarkerLocations[m][2], MarkerLocations[m][3]),
        marker = new google.maps.Marker({ 
      map: map, 
      position: location, 
      icon: markerIcon, 
      label: {
      text: MarkerLocations[m][0] ,
    color: "black",
        fontSize: "16px",
        fontWeight: "bold"
      }
  });

      google.maps.event.addListener(marker, 'click', (function(marker, m) {
        return function() {
          infowindow.setContent("Vendor Name: " + MarkerLocations[m][1]);
          infowindow.open(map, marker);
        }
      })(marker, m));
 }
}
  google.maps.event.addDomListener(window, 'load', initialize);;

  </script>
  </head>
<br>
<div id="map-canvas" style="height: 400px; width: 720px;"></div>
</div>
</body>
</HTML>

