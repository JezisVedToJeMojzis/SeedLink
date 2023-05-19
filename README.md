# SeedLink
App for ICT4D course at VU Amsterdam 2023   
**Contributors:** Samuel Mojžiš, Marcelo Audibert

**Backend:** PHP    
**Database:** MySQL   
**Database interface:** PhpMyAdmin   
**Server:** 000webhost.com   

## Contents: 
- [Key idea](#keyidea)
- [Folder structure](#folderstructure)

## Key idea:  
Currently, in rural Mali, lack of knowledge and information on food tree seeds systems holds back proper management of seeds. On top of that, lack of access to value chains leads to difficulties in accessing markets which in turn holds back farmers' entrepreneurship and adoption of quality seeds, especially for women and youth. Mali contains a lot of drylands that could benefit from the combination of trees and cultivated seeds. Not only would it benefit the people but it would also benefit the planet. Farmers require access to information to be able to make informed decisions on what to grow and thus increase crop yields and agricultural efficiency. In rural Mali there is a big deficiency of communication channels that enable sharing of information on available seeds. This deficiency stems from factors such as lack of internet, diversity of local languages, and weak literacy skills. Therefore, our idea is to create a voice-based application where suppliers of seed in Mali can call in and report the type of seeds they have, along with the amount and price. The reason why this would work is that Mali has a lot of cellphone coverage and most people have at least GSM phones. This business idea would bring value to farmers looking to buy seeds to cultivate, as it would allow them to access a wider range of potential suppliers and compare prices. It would provide them with a more efficient and transparent way of accessing information about seeds. Additionally, by gaining valuable market insights, farmers and other parties would be able to get a better understanding of current market demands and make more informed decisions about what to grow in the future. Using voice technology, the application would reach a wider audience of farmers that do not have access to traditional computer based systems or don't possess skills of literacy.

## Folder structure:
``` bash
├── backend
│   ├── get_descriptions_by_language_and_seed_type
│       └── index.php
│   ├── get_descriptions_by_seed_type_english
│       └── index.php
│   ├── get_descriptions_by_seed_type_spanish
│       └── index.php
│   ├── get_languages
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
├── vxml
│    ├── english
│        ├── get_or_post.xml
│       ├── get_seed_info.xml
│       └── post_seed_info.xml
│   ├── php_scripts - unused
│   ├── spanish
│       ├── get_or_post.xml
│       ├── get_seed_info.xml
│       └── post_seed_info.xml
│   ├── choose_language.xml
│   └── choose_language_php_validation.xml - unused
└── README.md
```

**Documentation:**
