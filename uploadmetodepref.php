<?php
session_start();
include 'connection.php';
date_default_timezone_set('Asia/Bangkok'); 
$date = date("F j, Y, g:i a");
$listing = $_SESSION["listing"];
$metode = $_SESSION["metode"];
$var_id = $_POST["var_id"];
$jumlah = $_POST["jumlah"];
$form_id = $_SESSION["listing"];
$order_id = $_POST["order_id"];
$query="INSERT INTO sampling_pref (form_id, sampling_type, date_Str, is_sampled)  VALUES('$listing', '$metode','$date', 0)";
$conn_sample->exec($query);
$query="INSERT INTO sampling_id (form_id, order_id, var_id)  VALUES('$form_id', '$order_id', '$var_id')";
$conn_sample->exec($query);
if($metode=='srs'){
	$query1="INSERT INTO srs_pref (form_id, jumlah)  VALUES('$form_id', '$jumlah')";
	$conn_sample->exec($query1);
}
else if($metode=='pps'){
	$size = $_POST["var_size"];
	$query1="INSERT INTO pps_pref (form_id,var_size,jumlah)  VALUES('$form_id','$size', '$jumlah')";
	$conn_sample->exec($query1);
}
else if($metode=="systematic"){
	$var_order = $_POST["var_order"];
	$circular = $_POST["circular"];
	$order = json_encode($var_order);
	$query1="INSERT INTO systematic_pref (form_id, is_circular, var_order, jumlah)  VALUES('$form_id','$circular', '$order', '$jumlah')";
	$conn_sample->exec($query1);

}

$isdone = 1;
if($isdone=1){
header("Location: manage.php");
}

?>