<?php
$SurveyName = "Susenas2017";
$servername = "localhost:3306";	
$username = "root";
$password = "";
$dbname = $SurveyName;
$tablenameframe = $dbname."_frame";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`= '$dbname' AND `TABLE_NAME`= '$tablenameframe';";

$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<option value=".$row["COLUMN_NAME"]." id=".$row["COLUMN_NAME"]."2".">".$row["COLUMN_NAME"]."</option>";
		}
	}
	else {
		die("0 result");
	}

?>