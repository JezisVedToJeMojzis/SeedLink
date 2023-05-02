<?php //NOT USED
//Program name: SeedLink
//Author: Samuel Mojžiš
//Description: This is a mobile-based program where users in Mali can call in and give or receive information on available seeds. The purpose of this program is to connect farmers to suppliers of seed as it can often be hard for them to establish such connections due to factors such as lack of internet and different mother tounges. -->

// retrieve the selected language from the POST request
$selectedLanguage = $_POST['selectedLanguage'];

// language validation
$response = '';
if ($selectedLanguage == '1' || $selectedLanguage == 'english') {
    $response = 'You selected English.';
    header('Location: ../english/get_or_post.xml');
    exit();
} elseif ($selectedLanguage == '2' || $selectedLanguage == 'spanish') {
    $response = 'Usted seleccionó Español.';
    header('Location: ../spanish/get_or_post.xml');
    exit();
} else {
    $response = 'Invalid choice.';
}

// output the response
header('Content-Type: text/plain');
echo $response;