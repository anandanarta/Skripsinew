<?php
include_once 'connection.php';
$form_id = $_POST["form_id"];
$sql[0] = "DELETE FROM sampling_id WHERE form_id = '$form_id' ";  //HARUSNYA GAPERLU KAYA GINI KALO BIKIN TABELNYA DENGAN FOREIGN KEY, CUKUP DELETE
$sql[1] = "DELETE FROM sampling_pref WHERE form_id = '$form_id' "; //ON CASCADE
$sql[2] = "DELETE FROM srs_pref WHERE form_id = '$form_id' ";
$sql[3] = "DELETE FROM systematic_pref WHERE form_id = '$form_id' ";
$sql[4] = "DELETE FROM pps_pref WHERE form_id = '$form_id' ";

foreach ($sql as $value) {
	$conn_sample->exec($value);
}

header("Location: manage.php"); ?>