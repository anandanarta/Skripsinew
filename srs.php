<?php
include_once 'connection.php';
include_once 'gettablename.php';
$tablename = getTableName($form_id);
//$var_order = array("noruta");
//$var_id = 'bloksensus';
//$order = implode(", ", $var_order);
//$n=5;
//$id = "5201003";
//echo $order;

// $sql = "SELECT * FROM $tablename WHERE $var_id = $id  ORDER BY $order";
$sql = "SELECT * FROM $tablename WHERE $var_id = $id  ORDER BY $order";
$stmt = $conn_odk->prepare($sql);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$frame = $stmt->fetchAll();
// echo json_encode($result);
//echo $sql;
//echo json_encode($frame);
function srs($data){
	global $n;
	for($i=0;$i<$n;$i++){
		$pop = count($data);
		$ar = rand(1,$pop);
		$angka[$i] = $ar; 
		$hasil[$i] = $data[$ar-1];
		$hasil[$i]["NoUrutSampel"] = $i+1;
 		unset($data[$ar-1]);
		$data = array_values($data);
	}
	$hasil["AR"] = json_encode($angka);
	return $hasil;
}

function insertSample($hasil){
	global $n;
	global $form_id;
	global $id;
	global $conn_sample;
	for($i=0;$i<$n;$i++){
		$str[$i] = '('.'\''.$form_id.'\',\''.$id.'\',\''.$hasil[$i]["_URI"].'\',\''.$hasil[$i]["NoUrutSampel"].'\''.')';
	}
	$strnew = implode(",", $str);
	$sql = "INSERT INTO sample_list VALUES $strnew ";
	$conn_sample->exec($sql);
	$ar =  $hasil["AR"];
	$sql2 = "INSERT INTO sampling_ar VALUES ('$form_id','$id','$ar') ";
	$conn_sample->exec($sql2);
}

$hasil = srs($frame);
for($i=0;$i<$n;$i++){
	$uuid[$i]=$hasil[$i]["_URI"];
}
insertSample($hasil);
echo json_encode($uuid);








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