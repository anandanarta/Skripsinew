<?php
session_start();
include 'connection.php';

$listing = $_SESSION["listing"];
$metode = $_SESSION["metode"];
$query="INSERT INTO sampling_pref (form_id, sampling_type, is_sampled)  VALUES('$listing', '$metode', 0)";
$conn_sample->exec($query);


$var_id = $_POST["var_id"];
$var_order = $_POST["var_order"];
$order = json_encode($var_order);
$jumlah = $_POST["jumlah"];
$circular = $_POST["circular"];
$order_id = $_POST["order_id"];
$form_id = $_SESSION["listing"];
$query1="INSERT INTO systematic_pref (form_id, is_circular, var_order, jumlah)  VALUES('$form_id','$circular', '$order', '$jumlah')";
$query="INSERT INTO sampling_id (form_id, order_id, var_id)  VALUES('$form_id', '$order_id', '$var_id')";
$conn_sample->exec($query1);
$conn_sample->exec($query);
$isdone = 1;
if($isdone=1){
header("Location: starter.php");
}

?>