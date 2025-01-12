<?php 

class Connection {
    private string $host;
    private string $port;
    private string $dbname;
    private string $user;
    private string $password;
    protected $connection;

    public function __construct () {
        $this->connect ();
    }

    private function connect () {
        try {
            $this->host = getenv ("DB_HOST");
            $this->port = getenv ("DB_PORT");
            $this->dbname = getenv ("DB_NAME");
            $this->user = getenv ("DB_USER");
            $this->password = getenv ("DB_PASSWORD");
            $this->connection = new PDO ("pgsql:host=$this->host;port=$this->port;dbname=$this->dbname", $this->user, $this->password);
        } catch (PDOException $exception) {
            echo ("Erro na conexão" . $exception);
        }
    }
}
?>