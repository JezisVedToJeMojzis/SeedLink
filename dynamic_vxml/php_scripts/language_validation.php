<?php //NOT USED
// retrieve the selected language from the POST request
$selectedLanguage = $_POST['selectedLanguage'];

// language validation
$response = '';
if ($selectedLanguage == '1' || $selectedLanguage == 'english') {
    $response = 'You selected English.';
    header('Location: ../english/give_or_receive.xml');
    exit();
} elseif ($selectedLanguage == '2' || $selectedLanguage == 'spanish') {
    $response = 'Usted seleccionó Español.';
    header('Location: ../spanish/give_or_receive.xml');
    exit();
} else {
    $response = 'Invalid choice.';
}

// output the response
header('Content-Type: text/plain');
echo $response;