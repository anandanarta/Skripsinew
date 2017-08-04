<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname_sample = "sampling_module";
$dbname_odk = "odk_prod";
$conn_sample = new PDO("mysql:host=$servername;dbname=$dbname_sample", $username, $password);
$conn_odk = new PDO("mysql:host=$servername;dbname=$dbname_odk", $username, $password);

$conn_sample->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$conn_odk->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>