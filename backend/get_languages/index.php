<?php
//PHP endpoint for getting all languages from db/// can be used to offer selection of languages to user dynamically
header('Content-Type: application/json; charset=utf-8');
require_once "../PDODatabaseManager.php";

$config = require_once "../config.php";
$serverName = $config["host"];
$userName = $config["username"];
$userPassword = $config["password"];
$databaseName = $config["dbname"];

$languages = array(); //array with all languages from db

$pdo = new PDODatabaseManager($serverName, $userName, $userPassword, $databaseName);
$result = $pdo->getLanguages();
if ($result != null) {
    // header("HTTP/1.1 200 OK");
    //  echo json_encode($result);
    if(is_array($result) || is_object($result)){
        foreach ($result as $r)
        {
            $languages[] = $r["language"]; //filling the array with languages from db in loop
            // var_dump($languageArray);
        }
        echo json_encode($languages);
    }
} else {
    header("HTTP/1.1 404 Not Found");
    echo "{} 404";
}

