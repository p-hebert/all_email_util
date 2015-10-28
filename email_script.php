<?php
/**
*	Script generating all possible emails for a said person
*	Doesn't include reverted emails (last.first @ example.com)
**/


$options = getopt("f:l:d:");

$first = strtolower(trim($options["f"]));
$last = strtolower(trim($options["l"]));
$domain = strtolower(trim($options["d"]));

$emails = [];

$allFirsts = cleanName($first);
$allLasts = cleanName($last);

//Full name

foreach($allFirsts as $fname){
	foreach($allLasts as $lname){
		$emails[] = $fname . "." . $lname . "@" . $domain;
		$emails[] = $fname . "_" . $lname . "@" . $domain;
		$emails[] = $fname . "-" . $lname . "@" . $domain;
		$emails[] = $fname . $lname . "@" . $domain;
	}
}

//First name
foreach($allFirsts as $fname){
	$emails[] = $fname . "@" . $domain;
}

//Last name
foreach($allLasts as $fname){
	$emails[] = $lname . "@" . $domain;
}



$aFindex = count($allFirsts) -1;
$aLindex = count($allLasts) -1;
$flen = strlen($allFirsts[$aFindex]);
$llen = strlen($allLasts[$aLindex]);

//First 4 letters of first name + last name
for($i = 1 ; $i < 5 && $i < $flen; $i++){
	$fsub = substr($allFirsts[$aFindex], 0, $i);
	foreach($allLasts as $lname){
		$emails[] = $fsub . $lname . "@" . $domain;
		$emails[] = $fsub . "." . $lname . "@" . $domain;
		$emails[] = $fsub . "_" . $lname . "@" . $domain;
		$emails[] = $fsub . "-" . $lname . "@" . $domain;
	}	
}

//First 4 letters of first name + 6 letters of last name
for($i = 1 ; $i < 5 && $i < $flen ; $i++){
	$fsub = substr($allFirsts[$aFindex], 0, $i);
	for($j = 1 ; $j < 7 && $j < $llen ; $j++){
		$lsub = substr($allLasts[$aLindex], 0, $j);
		$emails[] = $fsub . $lsub . "@" . $domain;
		$emails[] = $fsub . "." . $lsub . "@" . $domain;
		$emails[] = $fsub . "_" . $lsub . "@" . $domain;
		$emails[] = $fsub . "-" . $lsub . "@" . $domain;
	}
}

$eStr = "";
for($i = 0 ; $i < count($emails) - 1 ; $i++){
	$eStr .= $emails[$i] . ", ";
}
$eStr .= $emails[count($emails) -1] ."\n";
echo $eStr;

function cleanName($name){
	$arr = [];
	$newname = $name;
	//if has space
	if(strpos($name, " ") !== false){
		//Only first part of name
		$arr[] = substr($name, 0, strpos($name, " ")) ;
		//Full name without spaces
		$newname = str_replace(' ', '' ,$name);	
	}

	//if has hyphen
	if(strpos($name, "-") !== false){
		//Full name without hyphens
		$arr[] = str_replace('-', '' ,$name);
		//Only first part of name
		$arr[] = substr($name, 0, strpos($name, "-")) ;
	}

	//Full first name with hyphens/without spaces
	$arr[] = $newname;

	return $arr;

}
	
?>
