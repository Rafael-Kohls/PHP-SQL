<?php

class Connection {

    private $databaseFile;
    private $connection;

    public function __construct()
    {
        $this->databaseFile = realpath(__DIR__ . "/../database/db.sqlite");
        $this->connect();
    }

    private function connect()
    {
        try {
            $this->connection = new PDO("sqlite:{$this->databaseFile}");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
            exit();
        }
    }

    public function getConnection()
    {
        return $this->connection ?: $this->connection = $this->connect();
    }

    public function query($query)
    {
        try {
            $result = $this->getConnection()->query($query);
            if ($result === false) {
                throw new Exception("Erro na consulta SQL: " . $this->getConnection()->errorInfo()[2]);
            }
            $result->setFetchMode(PDO::FETCH_OBJ);
            return $result;
        } catch(Exception $e) {
            echo "Erro: " . $e->getMessage();
            exit();
        }
    }

    public function prepare($query)
    {
        try {
            $statement = $this->getConnection()->prepare($query);
            if ($statement === false) {
                throw new Exception("Erro na preparação da consulta SQL: " . $this->getConnection()->errorInfo()[2]);
            }
            return $statement;
        } catch(Exception $e) {
            echo "Erro: " . $e->getMessage();
            exit();
        }
    }
}
?>
