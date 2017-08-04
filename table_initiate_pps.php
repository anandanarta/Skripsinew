<?php

$SurveyName = "susenas2017";
$servername = "localhost:3306";	
$username = "root";
$password = "";
$dbname = $SurveyName;
$tablename = $dbname."_pps_preference"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
$sql = "CREATE TABLE IF NOT EXISTS $tablename (id int(1) NOT NULL AUTO_INCREMENT PRIMARY KEY,varid varchar(25), varsize varchar(25),Type int(1), Alocation int(1), Sample_size int(10), Status int(1))";
if ($conn->query($sql) == TRUE){
	//echo "Sukses";
}
else{
	die("Gagal Create Tabel");
}
?>