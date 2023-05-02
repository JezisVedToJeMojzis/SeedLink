<?php
//PHP endpoint for posting new english description of seed type into vxml table
header('Content-Type: application/json; charset=utf-8');
require_once "../PDODatabaseManager.php";

$config = require_once "../config.php";
$serverName = $config["host"];
$userName = $config["username"];
$userPassword = $config["password"];
$databaseName = $config["dbname"];

//$description = "Again posted new description about rice in english";
//$seed_type = "rice";

if (isset($_GET['seed_type'], $_GET['description'])) {
    $pdo = new PDODatabaseManager($serverName, $userName, $userPassword, $databaseName);
    $result = $pdo->postEnglishDescription($_GET['seed_type'], $_GET['description']);
    if ($result != null) {
        header("HTTP/1.1 200 OK");
        //echo json_encode($result);
    } else {
        header("HTTP/1.1 400 Bad Request");
        echo "{} 400";
    }
}else {
    header("HTTP/1.1 400 Bad Request");
    echo "{}";
}