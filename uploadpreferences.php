<?php
$SurveyName = "susenas2017";
$servername = "localhost:3306";	
$username = "root";
$password = "";
$dbname = $SurveyName;
$tablename = $dbname."_pps_preference";

//Set variabel hasil Post
$type = $_POST['sel-type'];
$alocation = $_POST['sel-alocation'];
if(isset($_POST['total-sampel'])){
    $totalsampel = $_POST['total-sampel'];
}
if(isset($_POST['framealokasi'])){
    $framealokasi = $_POST['framealokasi'];
}
$varid = $_POST['sel-id']; 
$varsize = $_POST['sel-size']; 

//create connection
$conn = new mysqli($servername, $username, $password, $dbname);//create connection

if ($conn->connect_error) { 
	die("Connection failed: " . $conn->connect_error);
}
	
$sql = "INSERT INTO $tablename VALUES (1,'$varid', '$varsize', $type, $alocation, $totalsampel, 0);";

if ($conn->query($sql) == TRUE){
	echo "Sukses";
}
else{
	die("Gagal Create Tabel");
}
 

//table preferences pps
//
//type 0 WOR 1 WR 
//alokasi 0 same alocation 1 different
//jumlah sampel >> total sampel if same
//varid >> kolom yang digunakan sebagai ID
//varsize >> kolom ukuran
//status penarikan sampel >> 0 belum 1 sudah
?>