<?php session_start();
//$query="INSERT INTO sampling_pref (form_id, form_id_target, sampling_type, is_sampled)  VALUES('$listing', '$cacah', '$metode', 0)";
//$conn_sample->exec($query);

if( isset($_SESSION["listing"]) AND isset($_SESSION["metode"]))
{
    if($_SESSION["metode"]=="systematic"){
      header("Location: setting_sys.php");
    }
    else if($_SESSION["metode"]=="srs"){
      header("Location: setting_srs.php");
    }
    else if($_SESSION["metode"]=="pps"){
      header("Location: setting_pps.php");
    }
}
else{
    header("Location: starter.php");
}
?>
