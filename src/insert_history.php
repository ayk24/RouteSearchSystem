<?php
session_start();
include_once 'dbconnect.php';

$historyid = 0;
$userid = $_POST['userid'];
$share = 0;
$origin = $_POST['origin'];
$destination = $_POST['destination'];
$travelMode = $_POST['travelMode'];
$time = $_POST['time'];
$distance = $_POST['distance'];

$sql = "INSERT INTO history VALUES (".$historyid.",".$userid.",".$share.",'".$origin."','".$destination."','".$travelMode."','".$time."','".$distance."')";
$result = $mysqli->query($sql);

header('Content-type: application/json');
echo json_encode($sql);
echo json_encode($result);