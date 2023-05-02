<?php
//PHP endpoint for searching descriptions of seed type in spanish
header('Content-Type: application/json; charset=utf-8');
require_once "../PDODatabaseManager.php";

$config = require_once "../config.php";
$serverName = $config["host"];
$userName = $config["username"];
$userPassword = $config["password"];
$databaseName = $config["dbname"];

//testing values
//$language = "spanish";
//$seed_type = "rice";

$descriptionsArray = array(); //array to be filled

if (isset($_GET['seed_type'])) {
    $pdo = new PDODatabaseManager($serverName, $userName, $userPassword, $databaseName);
    $result = $pdo->getSeedTypeDescriptionsEs($_GET['seed_type']);
    if ($result != null) {
        header("HTTP/1.1 200 OK");
        // echo json_encode($result);
        if(is_array($result) || is_object($result)){
            foreach ($result as $r)
            {
                $descriptionsArray[] = $r["recording_description"]; //filling the array with descriptions about selected seeds in selected language from db
                //var_dump($r);
            }
            echo json_encode($descriptionsArray);
        }
    } else {
        header("HTTP/1.1 404 Not Found");
        echo "{} 404";
    }
}else {
    header("HTTP/1.1 404 Not Found");
    echo "{}";
}