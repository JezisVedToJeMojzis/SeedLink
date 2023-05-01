<?php

class PDOVxmlManager
{
    private string $serverName;
    private string $userName;
    private string $userPassword;
    private string $databaseName;

    public function __construct($serverName, $userName, $userPassword, $databaseName)
    {
        $this->serverName = $serverName;
        $this->userName = $userName;
        $this->userPassword = $userPassword;
        $this->databaseName = $databaseName;
        echo "db connected successfully";
    }

    public function getRecordingsBySeedType($seedType)
    {
        try {
            $connection = new PDO(
                "mysql:host=$this->serverName;dbname=$this->databaseName",
                $this->userName,
                $this->userPassword
            );

            $statement = $connection->prepare(
                "SELECT * FROM vxml_table WHERE seed_type = :seedType");
            $statement->bindParam(":seedType", $seedType);
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
