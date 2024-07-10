<?php
$servername = "192.168.0.164";
$username = "ehosxp";
$password = "wanorn";
$dbname = "hosxp";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
mysqli_set_charset($conn,"utf8");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$hn1=000006216;
$sql = "SELECT fname,lname from patient where hn='000006216'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_row()) {
        for($i=0;$i<2;$i++){
            $text = $row[$i];
            //echo $text;
            $ptname[] = $text;

        }
        
    }
} else {
    echo " 0 results";
}
print_r($ptname);
echo '<br>';
echo $ptname[0].'<br>';
echo $ptname[1];


?> 