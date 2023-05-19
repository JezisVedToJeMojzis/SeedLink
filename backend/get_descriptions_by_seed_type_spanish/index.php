<?php
//Program name: SeedLink
//Author: Samuel Mojžiš
//Description: This is a mobile-based program where users in Mali can call in and give or receive information on available seeds. The purpose of this program is to connect farmers to suppliers of seed as it can often be hard for them to establish such connections due to factors such as lack of internet and different mother tounges. -->

//Send voice recordings of specific seed type in spanish to vxml
if (isset($_GET['seed_type'])) { //check if we received seed type

    $seedType = $_GET['seed_type'];
    $recordings =  '../../recordings/spanish/' . $seedType; //directory with recordings

    // get the recordings
    $files = scandir($recordings);
    $files = array_diff($files, array('.', '..'));

    header('Content-Type: text/xml');
    // check if the directory is empty
    if (empty($files)) {
        header("HTTP/1.1 404 Not found");
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<vxml version="2.1">';
        echo '  <form>';
        echo '    <block>';
        echo '      <prompt>Lo siento, no hay grabaciones de voz disponibles</prompt>';
        echo '    </block>';
        echo '  </form>';
        echo '</vxml>';
    } else {
        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<vxml version="2.1">';
        echo '  <form>';
        echo '    <block>';

        foreach ($files as $file) {
            echo '      <prompt>';
            echo '        <audio src="' . $recordings . $file . '" />';
            echo '      </prompt>';
        }

        echo '    </block>';
        echo '  </form>';
        echo '</vxml>';
    }
}