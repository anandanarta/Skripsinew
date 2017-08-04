<?php
$SurveyName = "susenas2017";
$servername = "localhost:3306";	
$username = "root";
$password = "";
$dbname = $SurveyName;
$tablename = $dbname."_pps_preference";
$tablenameframe = $dbname."_frame"; 
$tablenamesample = $dbname."_pps_sampel"
$varid;
$varsize;
$vartype;
$alocation;
$sampel_size;
$status;
$columnname=array();
$dataframe=array();
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//Ambil preferences

function getcolumn($colname){
	global $servername,$username,$password,$dbname,$tablenameframe;
	$conn = new mysqli($servername, $username, $password, $dbname);
	$i=0;
	$sql = "SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`= '$dbname' AND `TABLE_NAME`= '$tablenameframe';";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$colname[$i]=$row["COLUMN_NAME"];
			$i++;
		}
	}
	else{
		die("0 result from the columnname");
	}
	return $colname;
}
$sql = "SELECT * FROM $tablename;";
$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$varid = $row["varid"];
		$varsize = $row["varsize"];
		$vartype = $row["Type"];
		$alocation = $row["Alocation"];
		$sampel_size = $row["Sample_size"];
		$status = $row["Status"];
	}

	else{
		die("0 result");
	}

$sql2 = "SELECT * FROM $tablenameframe";
$result2 = $conn->query($sql2);
	$columnname = getcolumn($columnname);
	$arrlength=count($columnname);
	$a = 0;
	$row2 = $result2->fetch_assoc();
	while($row2 = $result2->fetch_assoc()) {
		for($x=0;$x<$arrlength;$x++)
		{
			$dataframe[$columnname[$x]][$a] = $row2[$columnname[$x]];
			$dataframe2[$a][$columnname[$x]] = $row2[$columnname[$x]];
		}

		$a++;

	}

function ppswor($data, $n, $hasil) 
	{
		global $arlist, $x, $masalah, $json, $index, $columnname;
		
		if($n <= 0)
		{
			$i = 0;
			$temp = "";
			foreach ($hasil as $datum)
			{
				$i += $datum["ar"];
				$temp .= '\''.$datum[$columnname[0]].str_pad($datum[$columnname[3]], 3, '0', STR_PAD_LEFT).'B\', ';
			}
			
			$json[$index] = $temp;
			$masalah[$index] = $i;
			return $hasil;			
		}
		else 
		{
			$temp = array();
			$data = makeKum($data);
			$ar = rand(1, $x);
			$arlist[$index][] = $ar;
			
			$exindex = cariSampel($data, $ar);
			$data[$exindex]["ar"] = $ar; //tambahin kolom baru berisi ar
			$data[$exindex]["nosampel"] = 37 - $n;  //tambahin kolom baru berisi urutan sampel
			$hasil[] = $data[$exindex];

			unset($data[$exindex]);
			$data = array_values($data);
			return ppswor($data, $n-1, $hasil);
		}
	}
	
	function makeKum($data) 
	{
		global $x,$varsize,$columnname;
		
		$data[0]["Kumulatif"] = $data[0][$varsize];
		
		for($i = 1; $i < count($data); $i++) 
		{
			$data[$i]["Kumulatif"] = $data[$i][$varsize] + $data[$i-1]["Kumulatif"];
		}
		$x = $data[count($data)-1]["Kumulatif"];
		
		return $data;
	}
	
	function cariSampel($data, $ar) //return baris sample tepilih
	{
		$i = 1;
		
		while($ar > $data[$i]["Kumulatif"])
		{
			$i++;
		}
		return $i;
	}

	function inputsampel($data)
	{

	global $conn, $tablenameframe, $tablenamesample;
		$countsuccess = 0;
		$sql = "SELECT * INTO $tablenamesample FROM $tablenameframe WHERE 1 = 2 ";
		if ($conn->query($sql) == TRUE)
		{
			$sql = "ALTER TABLE $tablenamesample ADD 'AR' varchar() NOT NULL ";
			$sql2 = "ALTER TABLE $tablenamesample ADD 'NoSampel' varchar() NOT NULL ";
			if ($conn->query($sql)&&$conn->query($sql2) == TRUE){
				$countsuccess = 1;
			}


		}
		else
		{		
			$sql = "DROP TABLE $tablenamesample"
			if ($conn->query($sql) == TRUE )
			{

			}
			header("Location: setting.php");
			die("Gagal Create Tabel");
		}

		if ($countsuccess=1) {
			
		}
		else


	}

	$index = 0;
	$temp = array();
	$list_hasil = ppswor($dataframe2, 36, $temp);



?>