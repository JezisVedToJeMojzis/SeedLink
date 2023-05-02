<?php
//PHP endpoint for getting all seed types from db
header('Content-Type: application/json; charset=utf-8');
require_once "../PDODatabaseManager.php";

$config = require_once "../config.php";
$serverName = $config["host"];
$userName = $config["username"];
$userPassword = $config["password"];
$databaseName = $config["dbname"];

$seedTypesArray = array(); //array with all seed types from db

$pdo = new PDODatabaseManager($serverName, $userName, $userPassword, $databaseName);
$result = $pdo->getSeedTypes();
if ($result != null) {
    header("HTTP/1.1 200 OK");
    //  echo json_encode($result);
    if(is_array($result) || is_object($result)){
        foreach ($result as $r)
        {
            $seedTypesArray["seed_types"][] = $r["seed_type"]; //filling the array with seed types from db in loop
            // var_dump($seedTypesArray);
        }
        echo json_encode($seedTypesArray);
    }
} else {
    header("HTTP/1.1 404 Not Found");
    echo "{} 404";
}
