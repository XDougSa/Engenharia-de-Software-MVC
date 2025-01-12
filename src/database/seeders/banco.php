<?php 

require_once ("./src/database/Connection.php");

class Banco extends Connection {
    public function __construct () {
        parent::__construct ();
    }

    public function popularBanco () {
        $sql = "INSERT INTO usuario (nome, email, senha) VALUES (:nome, :email, :senha);";
        $query = $this->connection->prepare($sql);

        $usuarios = [
            ["nome" => "João", "email" => "teste@mail.com", "senha" => "12345678"],
            ["nome" => "Pedro", "email" => "pedro@mail.com", "senha" => "12345678"],
            ["nome" => "Tiago", "email" => "tiago@mail.com", "senha" => "12345678"],
        ];

        foreach ($usuarios as $usuario) {
            $query->execute([
                "nome" => $usuario["nome"],
                "email" => $usuario["email"],
                "senha" => password_hash($usuario["senha"], PASSWORD_BCRYPT)
            ]);
        }
    }
}

$banco = new Banco();
$banco->popularBanco();

?>