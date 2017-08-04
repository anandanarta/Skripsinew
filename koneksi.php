<?php
include 'connection.php';

date_default_timezone_set("Asia/Bangkok");

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname_sample", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if(($_POST['type'])=="sampling"){
    	$form_id = $_POST['form_id'];
    	$id = $_POST['id'];
        $query = "SELECT uuid FROM sample_list WHERE form_id = '$form_id' AND var_id = '$id'";
        $stmt = $conn_sample->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        if($result!=null){
            $n = count($result);
            for($i=0;$i<$n;$i++){
                $uuid[$i]=$result[$i]["uuid"];
            }
            // array('respon'=>$result)
            echo json_encode($uuid);
        }
        else if($result==null){
    	    $query = "SELECT sp.*,si.var_id,si.order_id FROM sampling_pref sp INNER JOIN sampling_id si ON sp.form_id = si.form_id WHERE sp.form_id = '$form_id'";
    	    $stmt = $conn_sample->prepare($query);
    	    $stmt->execute();
    	    $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
    	    $var_id = $result[0]['var_id'];
            $order_id = $result[0]['order_id'];
    	    $type = $result[0]['sampling_type'];
    	    if($type == "systematic"){
                 $query = "SELECT * FROM systematic_pref WHERE form_id = '$form_id'";
                 $stmt = $conn_sample->prepare($query);
    		     $stmt->execute();
    		     $result = $stmt->fetchAll();
                 // var_dump($result);
    		     $var_order = $result[0]['var_order'];
    		     $order = json_decode($var_order);
    		     $order = $order_id.','.implode(", ", $order);
    		     $n = $result[0]['jumlah'];
                 $circular = $result[0]['is_circular'];
    		     include "systematicnew.php"; 
            
            }
            else if($type == "srs"){
                 $query = "SELECT * FROM srs_pref WHERE form_id = '$form_id'";
                 $stmt = $conn_sample->prepare($query);
                 $stmt->execute();
                 $result = $stmt->fetchAll();
                 // var_dump($result);
                 $order = $order_id;
                 $n = $result[0]['jumlah'];
                 include "srs.php";
            }
            else if($type == "pps"){
                $query = "SELECT * FROM pps_pref WHERE form_id = '$form_id'";
                $stmt = $conn_sample->prepare($query);
                $stmt->execute();
                $result = $stmt->fetchAll();
                $order = $order_id;
                $n = $result[0]['jumlah'];
                $size = $result[0]['var_size'];
                include "pps.php";
            }
        }
    }
    else if($_POST['type']=="getFormId"){
        //$user_id = $_POST['user_id'];
        $user_id = 90; 
        $query = "SELECT form_id FROM sampling_pref";
        $query2 = "SELECT form_id FROM userid_formid_id WHERE user_id = '$user_id'";
        $stmt = $conn_sample->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();
        for($i=0;$i<count($result);$i++){                               //TRANSFORM ARRAY KE BENTUK NON ASSOSIATIF
           $newresult[$i]=$result[$i]["form_id"];
        }
        $stmt = $conn_sample->prepare($query2);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result2 = $stmt->fetchAll();
        for($i=0;$i<count($result2);$i++){                               //TRANSFORM ARRAY KE BENTUK NON ASSOSIATIF
           $newresult2[$i]=$result2[$i]["form_id"];
        }
        $newresult3 = array_intersect($newresult, $newresult2);
        for($i=0;$i<count($newresult3);$i++){                               //TRANSFORM ARRAY KE BENTUK ASSOSIATIF
           $result3[$i]["form_id"]=$newresult3[$i];
        }       
        echo json_encode(array('respon'=>$result3));
    }
    else if($_POST['type']=="getID"){
        $form_id = $_POST['form_id'];
        $user_id = $_POST['user_id'];
        $query = "SELECT var_id FROM userid_formid_id WHERE form_id = '$form_id' AND user_id = '$user_id' ";
        $stmt = $conn_sample->prepare($query);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->fetchAll();        
        echo json_encode(array('respon'=>$result));
    }        
}catch(PDOException $e)
    {
    $e->getMessage();
    }
$conn = null;
?> 



