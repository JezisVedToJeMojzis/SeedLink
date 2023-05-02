<?php
//Program name: SeedLink
//Author: Samuel Mojžiš
//Description: This is a mobile-based program where users in Mali can call in and give or receive information on available seeds. The purpose of this program is to connect farmers to suppliers of seed as it can often be hard for them to establish such connections due to factors such as lack of internet and different mother tounges. -->

//PHP endpoint for searching descriptions of seed type in english
header('Content-Type: application/json; charset=utf-8');
require_once "../PDODatabaseManager.php";

$config = require_once "../config.php";
$serverName = $config["host"];
$userName = $config["username"];
$userPassword = $config["password"];
$databaseName = $config["dbname"];

//testing values
//$language = "english";
//$seed_type = "rice";

$descriptionsArray = array(); //array to be filled

if (isset($_GET['seed_type'])) { //check if we received needed values
    $pdo = new PDODatabaseManager($serverName, $userName, $userPassword, $databaseName); //connect to db
    $result = $pdo->getSeedTypeDescriptionsEn($_GET['seed_type']); //send them to PDO manager to work with db and save result of query into variable
    if ($result != null) {
        header("HTTP/1.1 200 OK");
        // echo json_encode($result);
        if(is_array($result) || is_object($result)){
            foreach ($result as $r)
            {
                $descriptionsArray[] = $r["recording_description"]; //filling the array with descriptions about selected seeds in selected language from db
                //var_dump($r);
            }
            echo json_encode($descriptionsArray); //echoing the values
        }
    } else {
        header("HTTP/1.1 404 Not Found");
        echo "{} 404";
    }
}else {
    header("HTTP/1.1 404 Not Found");
    echo "{}";
}