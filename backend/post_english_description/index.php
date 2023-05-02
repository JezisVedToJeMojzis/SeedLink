<?php
//Program name: SeedLink
//Author: Samuel Mojžiš
//Description: This is a mobile-based program where users in Mali can call in and give or receive information on available seeds. The purpose of this program is to connect farmers to suppliers of seed as it can often be hard for them to establish such connections due to factors such as lack of internet and different mother tounges. -->

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

if (isset($_GET['seed_type'], $_GET['description'])) { //check if we received the needed values
    $pdo = new PDODatabaseManager($serverName, $userName, $userPassword, $databaseName); //connect to db
    $result = $pdo->postEnglishDescription($_GET['seed_type'], $_GET['description']); //send them to PDO manager to work with db
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