<?php

$SurveyName = "susenas2017";
$servername = "localhost:3306";	
$username = "root";
$password = "";
$dbname = $SurveyName;

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
$sql = "CREATE DATABASE IF NOT EXISTS $SurveyName;";
if ($conn->query($sql) == TRUE){
} 

else {
	die("Database Error");
}
?>