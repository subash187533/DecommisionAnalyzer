<?php
ob_start();
session_start();

$m = new MongoClient();
$db = $m->test_decommission_analyzer;
$collection =$db->users;

$result = $collection->findOne(array("userId" => $_POST["inputUserId"],"password" => $_POST["inputPassword"]));

print_r($result);

if($result){
	$_SESSION["userId"] = $result["userId"];
	$_SESSION["firstName"] = $result["firstName"];
	$_SESSION["lastName"] = $result["lastName"];
	$_SESSION["name"] = $result["name"];
    $_SESSION["access"] = $result["access"];
    header('Location: http:../../index.php');
}else{
	header('Location: http:../../login.php');
}


?>