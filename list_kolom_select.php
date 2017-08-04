<?php
$SurveyName = "Susenas2017";
$servername = "localhost:3306";	
$username = "root";
$password = "";
$dbname = $SurveyName;
$tablename = $dbname."_frame";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$sql = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`= '$dbname' AND `TABLE_NAME`= '$tablename';";
$sql2 = "SELECT * FROM $tablename";
$result = $conn->query($sql);
$result2 = $conn->query($sql2);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			echo "<option value=".$row["COLUMN_NAME"]." id=".$row["COLUMN_NAME"].">".$row["COLUMN_NAME"]."</option>";
		}
	}
	else {
		die("0 result");
	}
$result3 = $result2->fetch_all(MYSQLI_ASSOC);
//var_dump($result3);
echo $result3[0]["ID"];

?>