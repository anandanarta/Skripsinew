<?php
session_start();
include_once 'connection.php';
include_once 'gettablename.php';
$form_id = $_SESSION["listing"];
$tablename = getTableName($form_id);

$query = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`= '$dbname_odk' AND `TABLE_NAME`= '$tablename';";
$stmt = $conn_odk->prepare($query);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = $stmt->fetchAll();

foreach ($result as $value) {
    	echo "<option value=".$value['COLUMN_NAME']." id=".$value['COLUMN_NAME'].">".$value['COLUMN_NAME']."</option>";
    }    

?>