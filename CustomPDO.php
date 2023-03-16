<?php

class CustomPDO extends PDO
{
    private string $host = "127.0.0.1";
    private string $dbName = "test";
    private string $username = "root";
    private string $password = "root";

    public function __construct(?string $host = null, ?string $username = null, ?string $password = null, ?string $dbName = null)
    {
//        $this->setHost($host);
//        $this->setUsername($username);
//        $this->setPassword($password);
//        $this->setDbName($dbName);

        try {
            parent::__construct("mysql:host=$this->host;dbname=$this->dbName", $this->username, $this->password);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection failed" . $exception->getMessage();
            die();
        }
    }

    public function setHost(string $host): void
    {
        $this->host = $host;
    }

    public function setDbName(string $dbName): void
    {
        $this->dbName = $dbName;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getDbName(): string
    {
        return $this->dbName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
}