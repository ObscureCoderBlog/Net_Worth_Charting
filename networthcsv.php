<?php
$servername = "localhost";
$username = "mint_read";
$password = "mypass";
$dbname = "customscripts_db";

// Accounts to Decode string
// Decodes account names to the name you want to display
$accountDict = array(7700444 => "Checking",7700445 => "Savings",7700446 => "401k",7700447 => "Roth IRA",7700448 => "MMChecking",7700449 => "Brokerage",7700410 => "Old401k",7700411 => "CC1",7700412 => "CC2", 7700413 => "401kBrokerageLink");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Gather data from the database
$sql = "SELECT `insertedts`,`id`, `accountId`,`accountValue` FROM `mintinfo` order by `insertedts` desc";
$result = $conn->query($sql);

// output and format the data
if ($result->num_rows > 0) {
	// add header row
    echo "date,string,number<br>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo date_format(date_create($row["insertedts"]),'Y-m-d') . "," . $accountDict[(int)$row["accountId"]] . "," . $row["accountValue"] . "<br>";
    }
} else {
    echo "0 results";
}
// Close the connection
$conn->close();

?>
