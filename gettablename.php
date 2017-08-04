<?php
function getTableName($form_id){
	$str = $form_id;
	$pieces = preg_split('/(?=[A-Z])/',$str);
	foreach ($pieces as $value) {
		$cleanpiece[] = strtolower($value);
	}
	if(ctype_upper($str{0})){
		$cleanpiece1 = array_shift($cleanpiece);
		$table = implode("_",$cleanpiece);
		$tablename = $table."_core";
		return $tablename;
	}
	else{
		$table = implode("_",$cleanpiece);
		$tablename = $table."_core";
		return $tablename;	
	}

}

?>