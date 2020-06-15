<?php
session_start();
include_once 'dbconnect.php';

$history_id = $_POST['history_id'];
$share = $_POST['checked'];

$sql = "UPDATE history SET share =".$share." WHERE history_id=?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("i", $history_id);
$stmt->execute(); 

header('Content-type: application/json');