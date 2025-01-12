<?php 

require_once ("./src/database/Connection.php");

class Banco extends Connection {
    public function __construct () {
        parent::__construct ();
    }

    public function criarBanco () {
        $sql = "CREATE TABLE usuario (
            id SERIAL PRIMARY KEY,
            nome VARCHAR (255) UNIQUE,
            email VARCHAR (255) UNIQUE,
            senha VARCHAR (255)
        );";
        $this->connection->prepare ($sql)->execute();
    }
}

$banco = new Banco();
$banco->criarBanco();

?>