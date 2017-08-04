<?php
$SurveyName = "odk_prod";
$tablename = "skripsicontoh_core";
include_once 'connection.php';

$var_order = array("noruta");
$var_id = 'bloksensus';
$order = implode(", ", $var_order);
$n=5;
$id = "5201003";
//echo $order;

// $sql = "SELECT * FROM $tablename WHERE $var_id = $id  ORDER BY $order";

$sql = "SELECT _URI FROM $tablename WHERE $var_id = $id  ORDER BY $order";
$result = $conn->query($sql);
$frame = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();

// echo json_encode($result);
//echo $sql;
//echo json_encode($frame);

$sampel = systematic($frame);

function systematic($data){
	global $n;
	$pop = count($data);
	$k = $pop/$n;
	//echo $k."<br>";
	$ar = rand(1,$pop-1);
	//echo $ar;
	$tmp;
	$index;
	$send = array();
	$uuid = array();
	$hasil = array(); 
	for($i=0;$i<$n;$i++){
		$tmp = $ar+($k*$i);
		$index = round($tmp)%($pop);
		$hasil[$i] = $data[$index];
		$hasil[$i]["NoUrutSampel"] = $i+1;
		$uuid[$i]=$hasil[$i]["_URI"];
	}

	//var_dump($uuid);

	//aji
	//format outputnya dibenerin de,biar formatnya standar json, liat contohnya di POSTMAN(ada ditab bawah)...cba searching2 ubah array to json
	// $send['data'] = $uuid;
	$send['status'] ='success';
	$u['aku'] ='aji';
	$u['kamu'] = 'kam';

	echo json_encode($uuid);
}

$var_order = array("noruta");
echo json_encode($var_order);



// $fp = fopen('file.csv', 'w');

// foreach ($sampel as $value) {
//     fputcsv($fp, $value);
// }

// fclose($fp);

// $temp="";
// foreach ($sampel as $fields) {
// 	$temp .= "('".implode("','", $fields)."'), ";
// }
// echo $temp;
?>