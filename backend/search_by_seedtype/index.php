<?php
header('Content-Type: application/json; charset=utf-8');
require_once "../PDOVxmlManager.php";

$config = require_once "../config.php";
$serverName = $config["host"];
$userName = $config["username"];
$userPassword = $config["password"];
$databaseName = $config["dbname"];

if (isset($_GET['seed_type'])) {
    $pdoVxmlManager = new PDOVxmlManager($serverName, $userName, $userPassword, $databaseName);
    echo "PDO";
    $result = $pdoVxmlManager->getRecordingsBySeedType($_GET['seed_type']);
    if ($result != null) {
        header("HTTP/1.1 200 OK");
        echo json_encode($result);
    } else {
        header("HTTP/1.1 404 Not Found");
        echo "{} 404";
    }
}else {
    header("HTTP/1.1 404 Not Found");
    echo "{}";
}