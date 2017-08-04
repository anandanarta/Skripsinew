<?php
include_once 'connection.php';
include_once 'gettablename.php';
$tablename = getTableName($form_id);
$sql = "SELECT * FROM $tablename WHERE $var_id = $id  ORDER BY $order";
$stmt = $conn_odk->prepare($sql);
$stmt->execute();
$frame = $stmt->fetchAll();

function pps($frame,$n,$size){
	global $x;
	for($i=0;$i<$n;$i++){
		$frame = makekum($frame);
		$ar = rand(1,$x);
		$angka[$i] = $ar;
		$index = getSample($frame,$ar);
		$hasil[$i] = $frame[$index];
		$hasil[$i]["NoUrutSampel"] = $i+1;
		unset($frame[$index]);
		$frame = array_values($frame);
	}
	$hasil["AR"] = json_encode($angka);
	return $hasil;
}
function makekum($data){
	global $x,$size;
	$data[0]["Kumulatif"] = $data[0][$size];
	for($i=1;$i<count($data);$i++){
		$data[$i]["Kumulatif"] = $data[$i-1]["Kumulatif"] + $data[$i][$size];
	}
	$x = $data[count($data)-1]["Kumulatif"];
	return $data;
}
function getSample($data,$ar){
	$i = 0;
	while($ar>$data[$i]["Kumulatif"]){
		$i++;
	}
	return $i;

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

$hasil = pps($frame,$n,$size);
for($i=0;$i<$n;$i++){
	$uuid[$i]=$hasil[$i]["_URI"];
}
insertSample($hasil);
echo json_encode($uuid);

?>