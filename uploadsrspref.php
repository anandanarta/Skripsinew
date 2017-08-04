<?php
session_start();
include 'connection.php';

$listing = $_SESSION["listing"];
$metode = $_SESSION["metode"];
$query="INSERT INTO sampling_pref (form_id, sampling_type, is_sampled)  VALUES('$listing', '$metode', 0)";
$conn_sample->exec($query);

//$listing = $_POST["listing"];
$var_id = $_POST["var_id"];
$jumlah = $_POST["jumlah"];
$form_id = $_SESSION["listing"];
$order_id = $_POST["order_id"];
$query1="INSERT INTO srs_pref (form_id, jumlah)  VALUES('$form_id', '$jumlah')";
$query="INSERT INTO sampling_id (form_id, order_id, var_id)  VALUES('$form_id', '$order_id', '$var_id')";
$conn_sample->exec($query1);
$conn_sample->exec($query);
$isdone = 1;
if($isdone=1){
header("Location: starter.php");
}

?>