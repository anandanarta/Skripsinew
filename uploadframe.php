<?php
//Persiapan variabel
$SurveyName = "reni";
$servername = "localhost:3306";	
$username = "root";
$password = "";
$dbname = $SurveyName;

set_time_limit(90);
$tablenameframe = $SurveyName."_frame";
$tablename = $tablenameframe;	
$tablenamesample = $SurveyName."_sample";
$metode = $_POST["sel-metode"];
$tmpName = ($_FILES["frameurl"]["tmp_name"]);//mendapatkan nama file
$csvAsArray = array_map('str_getcsv', file($tmpName));//membuat array dari csv yang sudah di input
$arrayID;//array untuk menyimpan ID
$arrayLength;//array untuk menyimpan panjang
$newarray = transpose($csvAsArray);//mentranspose array untuk mendapatkan jumlah column dan panjang masing masing column yang akan di buat

//Mempersiapkan array ID dan Length
function transpose($array) {//fungsi transpose array
    array_unshift($array, null);
    return call_user_func_array('array_map', $array);
}


for($i=0;$i<count($newarray);$i++)//pengulangan untuk mendapatkan nama kolom dan length maximal tiap kolom
{
	$cleanedstr = preg_replace(
    "/(\t|\n|\v|\f|\r| |\xC2\x85|\xc2\xa0|\xe1\xa0\x8e|\xe2\x80[\x80-\x8D]|\xe2\x80\xa8|\xe2\x80\xa9|\xe2\x80\xaF|\xe2\x81\x9f|\xe2\x81\xa0|\xe3\x80\x80|\xef\xbb\xbf)+/",
    "",
    $newarray[$i][0]);//menghilangkan whitespaces
	$arrayID[$i] = $cleanedstr;
	$maxlen = max(array_map('strlen', $newarray[$i]));
	$arrayLength[$i]= $maxlen;
	
}

//Mengenerate tabel baru
$conn = new mysqli($servername, $username, $password, $dbname);//create connection

if ($conn->connect_error) { //check if connection error
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "CREATE TABLE IF NOT EXISTS $tablenameframe ($arrayID[0] varchar($arrayLength[0]) NOT NULL)";
if ($conn->query($sql) == TRUE){
	echo "Sukses";
}
else{
	die("Gagal Create Tabel");
}

for($i=1;$i<count($arrayID);$i++){
	$sql2 = "ALTER TABLE $tablename ADD $arrayID[$i] varchar($arrayLength[$i]) NOT NULL";
	if($conn->query($sql2)==TRUE){
		echo "Sukses";
	}
	else {
		$sql4 = "DROP TABLE $tablename";
		if($conn->query($sql4)==TRUE){
		header("Location: starter.php");
		die("Gagal Tambah Tabel");
		}
	}
}

$countsuccess=0;
for($i=1;$i<count($csvAsArray);$i++){
	$strarray = implode("','", $csvAsArray[$i]);
	$sql3 = "INSERT INTO $tablename VALUES ('$strarray')";
	if($conn->query($sql3)==TRUE){
		$countsuccess = $countsuccess + 1;
	}
	else {
		$sql4 = "DROP TABLE $tablename";
		if($conn->query($sql4)==TRUE){
			header("Location: starter.php");
			die("Gagal Input Frame");
		}
	}
}
if ($countsuccess==(count($csvAsArray)-1)){ //redirect jika berhasil
	echo ("Input Berhasil");
	if($metode=="1"){
	header("Location: setting.php");
	exit();
	}
	else{
		
	}
}
else {
	$sql4 = "DROP TABLE $tablename";
	if($conn->query($sql4)==TRUE){
		header("Location: starter.php");
		die();
	}
}

?>