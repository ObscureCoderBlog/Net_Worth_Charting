<?php
$servername = "localhost";
$username = "mint_read";
$password = "mypass";
$dbname = "customscripts_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Gather the data
$sql = "SELECT SUM(`accountValue`) as 'AccountValue',DATE_FORMAT(`insertedts`, '%m-%d-%Y') AS 'InsertedDate' FROM `mintinfo` group by DATE_FORMAT(`insertedts`, '%m-%d-%Y');";
$result = $conn->query($sql);
$num_rows = mysql_num_rows($result);

// DateArray for titles
$dateTitleArray[] = array();
$priceArray[] = array();

// Add data to an arrays
if ($result->num_rows > 0) {

	// output data of each row
    while($row = $result->fetch_assoc()) {
        $dateTitleArray[] = $row["InsertedDate"];
		$priceArray[]  = $row["AccountValue"];
    }
} else {
    echo "0 results";
}

// PRINT TO USER IN PROPER FORMAT
echo "{\"labels\": [";
unset($dateTitleArray[0]);
echo "\"";
echo implode('","', $dateTitleArray);
echo "\"";
echo "]";
echo ",";
echo "\"datasets\":[{ \"label\": \"My First dataset\",\"fillColor\": \"rgba(50,255,50,0.5)\",\"strokeColor\": \"rgba(220,220,220,1)\",\"pointColor\": \"rgba(220,220,220,1)\",\"pointStrokeColor\": \"#fff\",\"pointHighlightFill\": \"#fff\",\"pointHighlightStroke\": \"rgba(220,220,220,1)\",\"data\": [";
unset($priceArray[0]);
echo "\"";
echo implode('","', $priceArray);
echo "\"]";
echo "}]";
echo "}";	

// Close the connection
$conn->close();

?>
