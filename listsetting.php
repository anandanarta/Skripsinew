<?php 
include_once 'connection.php';
$query = "SELECT * FROM sampling_pref";
$stmt = $conn_sample->prepare($query);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = $stmt->fetchAll();
foreach ($result as $value) {
	echo "<tr><td>".$value["form_id"]."</td><td>".$value["sampling_type"]."</td><td>".$value["date_str"]."</td>";
	//echo "<td><button id='btnshow' class='btn btn-success' data-toggle='modal' data-target='#modalshow'><i class='fa fa-fw fa-list'></i> Detail</button><span>    </span>";
	echo "<td><button id='btndelete' class='btn btn-danger remove' data-toggle='modal' data-target='#myModal'><i class='fa fa-bitbucket'></i> Hapus</button></td></tr>";
}

?>