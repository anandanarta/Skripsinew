<?php 
include 'connection.php';

$query = "SELECT form_id FROM _form_info";
$stmt = $conn_odk->prepare($query);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = $stmt->fetchAll();
for($i=0;$i<count($result);$i++){								//TRANSFORM ARRAY KE BENTUK NON ASSOSIATIF
	$newresult[$i]=$result[$i]["form_id"];
}


$query = "SELECT form_id FROM sampling_pref";
$stmt = $conn_sample->prepare($query);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);
$result2 = $stmt->fetchAll();
for($i=0;$i<count($result2);$i++){  							 //TRANSFORM ARRAY KE BENTUK NON ASSOSIATIF
	$newresult2[$i]=$result2[$i]["form_id"];
}
//for($i=0;$i<count($result);$i++){                              DEPRECATED KARENA TIDAK EFISIEN
//		for($j=0;$j<count($result2);$j++){
//			if(array_diff($result[$i],$result2[$j])!=null){
//				$result3[$i]["form_id"] = array_diff($result[$i],$result2[$j]);
//			}
//		}
//	}
if($result2==NULL){
	foreach ($newresult as $value) {
		echo "<option value=".$value." id=".$value.">".$value."</option>";
	}	
}
else if($newresult2!=NULL){
	$result3 = array_diff($newresult, $newresult2);
	foreach ($result3 as $value) {
		echo "<option value=".$value." id=".$value.">".$value."</option>";
	}
}
?>