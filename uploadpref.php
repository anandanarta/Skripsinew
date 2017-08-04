<?php
session_start();
include 'connection.php';

$listing = $_POST["listing"];
$cacah = $_POST["cacah"];
$metode = $_POST["metode"];
$_SESSION["listing"] = $listing;
$_SESSION["metode"] = $metode;
//$query="INSERT INTO sampling_pref (form_id, form_id_target, sampling_type, is_sampled)  VALUES('$listing', '$cacah', '$metode', 0)";
//$conn_sample->exec($query);

if($metode=="systematic"){
	header("Location: setting_sys.php");
}
else if($metode=="srs"){
	header("Location: setting_srs.php");
}
else if($metode=="pps"){
	header("Location: setting_pps.php");
}
?>