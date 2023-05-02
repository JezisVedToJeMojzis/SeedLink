<?php

class PDODatabaseManager
{
    private string $serverName;
    private string $userName;
    private string $userPassword;
    private string $databaseName;

    //connect to db
    public function __construct($serverName, $userName, $userPassword, $databaseName)
    {
        $this->serverName = $serverName;
        $this->userName = $userName;
        $this->userPassword = $userPassword;
        $this->databaseName = $databaseName;
        //echo "db connected successfully";
    }

    //upload new spanish description about some seed type
    public function postSpanishDescription($seed_type,$description){
        try {
            $connection = new PDO(
                "mysql:host=$this->serverName;dbname=$this->databaseName",
                $this->userName,
                $this->userPassword
            );

            $statement = $connection->prepare(
                "INSERT INTO vxml_table (language_id, seed_type_id, recording_description)
                    SELECT t1.id, t2.id, :descr
                    FROM languages t1, seed_types t2
                    WHERE t1.language = 'spanish' AND t2.seed_type = :seedT");
            $statement->bindParam(":seedT", $seed_type);
            $statement->bindParam(":descr", $description);
            $statement->execute();
            //$statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = "ADDED";

            if ($result == false) {
                $result = null;
            }
            $connection = null;
        } catch (PDOException $exception) {
            return null;
        }
        return $result;
    }

    //upload new english description about some seed type
    public function postEnglishDescription($seed_type,$description){
        try {
            $connection = new PDO(
                "mysql:host=$this->serverName;dbname=$this->databaseName",
                $this->userName,
                $this->userPassword
            );

            $statement = $connection->prepare(
                "INSERT INTO vxml_table (language_id, seed_type_id, recording_description)
                    SELECT t1.id, t2.id, :descr
                    FROM languages t1, seed_types t2
                    WHERE t1.language = 'english' AND t2.seed_type = :seedT");
            $statement->bindParam(":seedT", $seed_type);
            $statement->bindParam(":descr", $description);
            $statement->execute();
            //$statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = "ADDED";

            if ($result == false) {
                $result = null;
            }
            $connection = null;
        } catch (PDOException $exception) {
            return null;
        }
        return $result;
    }

    //spanish descriptions of selected seed type
    public function getSeedTypeDescriptionsEs($seedType){
        try {
            $connection = new PDO(
                "mysql:host=$this->serverName;dbname=$this->databaseName",
                $this->userName,
                $this->userPassword
            );

            $statement = $connection->prepare(
                "SELECT vxml_table.*
                        FROM vxml_table
                        JOIN languages ON vxml_table.language_id = languages.id
                        JOIN seed_types ON vxml_table.seed_type_id = seed_types.id
                        WHERE languages.language = 'spanish'
                        AND seed_types.seed_type = :seedT");
            $statement->bindParam(":seedT", $seedType);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = $statement->fetchAll();

            if ($result == false) {
                $result = null;
            }
            $connection = null;
        } catch (PDOException $exception) {
            return null;
        }
        return $result;
    }


    //english descriptions of selected seed type
    public function getSeedTypeDescriptionsEn($seedType){
        try {
            $connection = new PDO(
                "mysql:host=$this->serverName;dbname=$this->databaseName",
                $this->userName,
                $this->userPassword
            );

            $statement = $connection->prepare(
                "SELECT vxml_table.*
                        FROM vxml_table
                        JOIN languages ON vxml_table.language_id = languages.id
                        JOIN seed_types ON vxml_table.seed_type_id = seed_types.id
                        WHERE languages.language = 'english'
                        AND seed_types.seed_type = :seedT");
            $statement->bindParam(":seedT", $seedType);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = $statement->fetchAll();

            if ($result == false) {
                $result = null;
            }
            $connection = null;
        } catch (PDOException $exception) {
            return null;
        }
        return $result;
    }

    //get all languages from db
    public function getLanguages(){
        try {
            $connection = new PDO(
                "mysql:host=$this->serverName;dbname=$this->databaseName",
                $this->userName,
                $this->userPassword
            );

            $statement = $connection->prepare(
                "SELECT * FROM languages"); //all languages
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = $statement->fetchAll();

            if ($result == false) {
                $result = null;
            }
            $connection = null;
        } catch (PDOException $exception) {
            return null;
        }
        return $result;
    }

    //get all seed types from db
    public function getSeedTypes()
    {
        try {
            $connection = new PDO(
                "mysql:host=$this->serverName;dbname=$this->databaseName",
                $this->userName,
                $this->userPassword
            );

            $statement = $connection->prepare(
                "SELECT * FROM seed_types"); //all seed types
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = $statement->fetchAll();

            if ($result == false) {
                $result = null;
            }
            $connection = null;
        } catch (PDOException $exception) {
            return null;
        }
        return $result;
    }

    // get all recordings by selected language and seed type
    public function getRecordingsByLanguageAndSeedType($language,$seedType)
    {
        try {
            $connection = new PDO(
                "mysql:host=$this->serverName;dbname=$this->databaseName",
                $this->userName,
                $this->userPassword
            );

            $statement = $connection->prepare(
                "SELECT vxml_table.*
                        FROM vxml_table
                        JOIN languages ON vxml_table.language_id = languages.id
                        JOIN seed_types ON vxml_table.seed_type_id = seed_types.id
                        WHERE languages.language = :languageT
                        AND seed_types.seed_type = :seedT");
            $statement->bindParam(":languageT", $language);
            $statement->bindParam(":seedT", $seedType);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = $statement->fetchAll();

            if ($result == false) {
                $result = null;
            }
            $connection = null;
        } catch (PDOException $exception) {
            return null;
        }
        return $result;
    }
}
