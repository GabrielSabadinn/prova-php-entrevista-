<?php

class Connection {
    private $host = 'localhost'; 
    private $port = '5432'; 
    private $dbname = 'crud_users'; 
    private $user = 'postgres'; 
    private $password = '1909';
    private $connection;

    public function __construct()
    {
        $this->connect();
    }

    private function connect()
    {
        try {
            $this->connection = new PDO("pgsql:host={$this->host};port={$this->port};dbname={$this->dbname}", $this->user, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erro de conexão: " . $e->getMessage();
            die();
        }
    }

    public function getConnection()
    {
        // Retorna a conexão
        return $this->connection;
    }

    public function query($query)
    {
        try {
            $result = $this->getConnection()->query($query);
            $result->setFetchMode(PDO::FETCH_OBJ);
            return $result;
        } catch (PDOException $e) {
            echo "error: " . $e->getMessage();
            return false;
        }
    }
}
?>
