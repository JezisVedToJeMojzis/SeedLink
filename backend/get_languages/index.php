<?php
//Program name: SeedLink
//Author: Samuel Mojžiš
//Description: This is a mobile-based program where users in Mali can call in and give or receive information on available seeds. The purpose of this program is to connect farmers to suppliers of seed as it can often be hard for them to establish such connections due to factors such as lack of internet and different mother tounges. -->

//PHP endpoint for getting all languages from db/// can be used to offer selection of languages to user dynamically
header('Content-Type: application/json; charset=utf-8');
require_once "../PDODatabaseManager.php";

$config = require_once "../config.php";
$serverName = $config["host"];
$userName = $config["username"];
$userPassword = $config["password"];
$databaseName = $config["dbname"];

$languages = array(); //array with all languages from db

$pdo = new PDODatabaseManager($serverName, $userName, $userPassword, $databaseName);//connect to db
$result = $pdo->getLanguages(); //send them to PDO manager to work with db and save result of query into variable
if ($result != null) {
    // header("HTTP/1.1 200 OK");
    //  echo json_encode($result);
    if(is_array($result) || is_object($result)){
        foreach ($result as $r)
        {
            $languages[] = $r["language"]; //filling the array with languages from db in loop
            // var_dump($languageArray);
        }
        echo json_encode($languages); //echoing the values
    }
} else {
    header("HTTP/1.1 404 Not Found");
    echo "{} 404";
}

