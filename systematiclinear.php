<?php
$SurveyName = "susenas2017";
$tablename = $SurveyName."_frame";
include_once 'connection.php';

$var_order = array("ID","BlokSensusBiasa");
$var_id = "ID";
$order = implode(", ", $var_order);
$n=120;
$id = "5208020003";


//echo $order;

$sql = "SELECT * FROM $tablename"; //WHERE `ID` = $id  ORDER BY $order";
$result = $conn->query($sql);
$frame = $result->fetch_all(MYSQLI_ASSOC);
$conn->close();

//echo $sql;
//echo json_encode($frame);

$sampel = systematic($frame);

function systematic($data){
	global $n;
	$pop = count($data);
	$k = $pop/$n;
	echo $k."<br>";
	$ar = rand(1,$k-1);
	echo $ar;
	$tmp;
	$index;
	$hasil = array(); 
	for($i=0;$i<$n;$i++){
		$tmp = $ar+($k*$i);
		$index = round($tmp)%($pop-1);
		$hasil[$i] = $data[$index-1];
		$hasil[$i]["NoUrutSampel"] = $i+1; 
	}
	var_dump($hasil);
	return $hasil;

}


$fp = fopen('file2.csv', 'w');

foreach ($sampel as $fields) {
    fputcsv($fp, $fields);
}

fclose($fp);

$temp="";
foreach ($sampel as $fields) {
	$temp .= "('".implode("','", $fields)."'), ";
}
echo $temp;
?>