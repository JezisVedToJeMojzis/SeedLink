# SeedLink
VXML/PHP app for ICT4D course at VU Amsterdam 2023   

**Contributors:** Samuel Mojžiš, Marcelo Audibert

- [SeedLink](#seedlink)
  - [Key idea](#seedlink/#keyidea)
  - [Prototype description](#prototypedescription)
  - [Features](#features)
  - [Folder structure](#folderstructure)
  - [API](#api)
    - [Dependencies](#dependencies)
    - [GET endpoints](#getendpoints)
    - [POST endpoints](#postendpoints)
    

## Key idea  
Currently, in rural Mali, lack of knowledge and information on food tree seeds systems holds back proper management of seeds. On top of that, lack of access to value chains leads to difficulties in accessing markets which in turn holds back farmers' entrepreneurship and adoption of quality seeds, especially for women and youth. Mali contains a lot of drylands that could benefit from the combination of trees and cultivated seeds. Not only would it benefit the people but it would also benefit the planet. Farmers require access to information to be able to make informed decisions on what to grow and thus increase crop yields and agricultural efficiency. In rural Mali there is a big deficiency of communication channels that enable sharing of information on available seeds. This deficiency stems from factors such as lack of internet, diversity of local languages, and weak literacy skills. Therefore, our idea is to create a voice-based application where suppliers of seed in Mali can call in and report the type of seeds they have, along with the amount and price. The reason why this would work is that Mali has a lot of cellphone coverage and most people have at least GSM phones. This business idea would bring value to farmers looking to buy seeds to cultivate, as it would allow them to access a wider range of potential suppliers and compare prices. It would provide them with a more efficient and transparent way of accessing information about seeds. Additionally, by gaining valuable market insights, farmers and other parties would be able to get a better understanding of current market demands and make more informed decisions about what to grow in the future. Using voice technology, the application would reach a wider audience of farmers that do not have access to traditional computer based systems or don't possess skills of literacy.

## Prototype description
The SeedLink application consists of VXML files that handle interactions with users, and custom RESTful API written in PHP (version 7.4) together with a MySQL (version 5.1) database that is running on an Apache web server (in our case we have used a free external web server called 000webhost). For the API, we have designed and implemented RESTful endpoints that handle incoming HTTP requests from VXML files and provide appropriate responses (Further information about the API can be found in the documentation here ). The database consists of two tables: languages (contains all languages that can be chosen by the users) and seed types (contains all seed types about which users can retrieve information). The voice recordings are stored in a local directory on the server. VXML can either retrieve them by making GET requests or upload new recordings by making POST requests.

## Features
- Users are able to choose between english and spanish language.
- Users are able to choose from provided seed types.
- Users are able to either get or post information (voice recording) about selected seed type.

## Folder structure
``` bash
├── backend
│   ├── get_descriptions_by_language_and_seed_type - not used
│       └── index.php
│   ├── get_descriptions_by_seed_type_english
│       └── index.php
│   ├── get_descriptions_by_seed_type_spanish
│       └── index.php
│   ├── get_languages - not used
│       └── index.php
│   ├── get_seed_types
│       └── index.php
│   ├── post_english_description
│       └── index.php
│   ├── post_spanish_description
│       └── index.php
│   ├── PDODatabaseManager.php
│   ├── config.php
│   └── index.php
├── old - contains old vxml used for first submission and old screenshots of db
│   ├── screenshots_of_database
│   └── vxml
├── recordings - directory for future recordings
│   ├── english
│   └── spanish
├── vxml - contains all VXML files used to interact with user and send request to API
│   ├── english
│       ├── get_or_post.xml
│       ├── get_seed_info.xml
│       └── post_seed_info.xml
│   ├── php_scripts - not used
│   ├── spanish
│       ├── get_or_post.xml
│       ├── get_seed_info.xml
│       └── post_seed_info.xml
│   ├── choose_language.xml
│   └── choose_language_php_validation.xml - not used
└── README.md
```

## API
This is a RESTful API written in PHP. The API cooperates with MySQL database and local directories.

### Dependencies   
- Web server that supports PHP and MySQL.  
- MySQL database version 5.1 or later.
- PHP version 7.4 or later.    

Below are discussed all the endpoints which are used to work with vxml.

### GET endpoints
 - **/backend/get_seed_types/index.php**  
   
   Get method to retrieve all seed types from database.
   - **Request**
    ``` bash
    curl https://seedlinkvu.000webhostapp.com/backend/get_seed_types/index.php
    ```
    - **Response 200**
    ``` bash
    ["rice","cotton","sorghum"]
    ```
    - **Response 404**
    ``` bash
    "{} 404"
    ```
    
 - **/backend/get_descriptions_by_seed_type_english/index.php**  
   
   Get method to retrieve all english recordings from a directory specified by selected seed type.
   - **Request**
    ``` bash
    curl https://seedlinkvu.000webhostapp.com/backend/get_descriptions_by_seed_type_english/index.php?seed_type=rice
    ```
    - **Response 200**
    ``` bash
    <?xml version="1.0" encoding="UTF-8"?>
    <vxml version="2.1">
        <form>
            <block>
        foreach ($files as $file) {
                  <prompt>
                    <audio src="' . $recordings . $file . '" />
                  </prompt>
        }
            </block>
        </form>
    </vxml>
    ```
    - **Reponse 404**
    ``` bash
    <?xml version="1.0" encoding="UTF-8"?>
    <vxml version="2.1">
          <form>
            <block>
              <prompt>I am sorry, there are no voice recordings available</prompt>
            </block>
          </form>
    </vxml>
    ```
    
 - **/backend/get_descriptions_by_seed_type_spanish/index.php**  
   
   Get method to retrieve all spanish recordings from a directory specified by selected seed type.
   - **Request**
    ``` bash
    curl https://seedlinkvu.000webhostapp.com/backend/get_descriptions_by_seed_type_spanish/index.php?seed_type=rice
    ```
    - **Response 200**
    ``` bash
    <?xml version="1.0" encoding="UTF-8"?>
    <vxml version="2.1">
        <form>
            <block>
        foreach ($files as $file) {
                  <prompt>
                    <audio src="' . $recordings . $file . '" />
                  </prompt>
        }
            </block>
        </form>
    </vxml>
    ```
    - **Reponse 404**
    ``` bash
    <?xml version="1.0" encoding="UTF-8"?>
    <vxml version="2.1">
          <form>
            <block>
              <prompt>Lo siento, no hay grabaciones de voz disponibles</prompt>
            </block>
          </form>
    </vxml>
    ```


 
### POST endpoints
- **/backend/post_english_description/index.php**  
  
  Post method to save a new recording about selected seed type to directory with english recordings.
  - **Request**
  ``` bash
  curl -d "seed_type=rice&description=recorded_voice" /backend/post_english_description/index.php
  ```
  - **Response 200**
  ``` bash
  "Voice recording saved successfully"
  ```
  - **Response 204**
  ``` bash
  "Error, voice recording not found"
  ```
- **/backend/post_spanish_description/index.php**  
  
  Post method to save a new recording about selected seed type to directory with spanish recordings.
  - **Request**
  ``` bash
  curl -d "seed_type=rice&description=recorded_voice" /backend/post_english_description/index.php
  ```
  - **Response 200**
  ``` bash
  "Voice recording saved successfully"
  ```
  - **Response 204**
  ``` bash
  "Error, voice recording not found"
  ```
