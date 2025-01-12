<?php 
require_once ("./src/database/Connection.php");

class UsuarioModel extends Connection {
    public function __construct () {
        parent::__construct();
    }

    public function Login (string $email, string $senha) {
        $sql = "SELECT * FROM usuario WHERE email=?";
        $query = $this->connection->prepare($sql);
        $query->execute([$email]);
        $linha = $query->fetch();
        if ($linha && password_verify ($senha, $linha ["senha"])) {
            $data = [
                "status"=>true,
                "id"=>$linha["id"],
                "nome"=>$linha["nome"],
                "email"=>$linha["email"]
            ];
            return $data;
        } else {
            return ([ 
                "status"=> false,
                "menssagem"=>"Usuário não encontrado" 
            ]);
        }
    }

    public function Cadastro (string $email, string $senha) {
            try{
                $sql = "INSERT INTO usuario (email, senha) VALUES (?, ?)";
                $query = $this->connection->prepare($sql);
                $query->execute([$email, password_hash($senha, PASSWORD_BCRYPT)]);
                return ([
                    "status"=>true,
                    "message"=>"Usuário Cadastrado"
                ]);
            } catch (Exception $exception) {
                return ([
                    "status"=>false,
                    "message"=>"Email já existe",
                    "error"=>$exception
                ]);
            }
    }

    public function findAll () {
        $sql = "SELECT * FROM usuario;";
        $query = $this->connection->prepare($sql);
        $query->execute ();

        if ($query->rowCount () > 0) {
            $data = array ();

            while ($linha = $query->fetch (\PDO::FETCH_ASSOC)) {
                $resultado = [
                    "id"=>$linha ["id"],
                    "email"=>$linha ["email"],
                    "nome"=>$linha ["nome"]
                ];
                array_push ($data, $resultado);
            }

            return json_encode ($data);
        } else {
            return json_encode ([]);
        }
    }

    public function destroy (string $id) {
        $sql = "DELETE FROM usuario WHERE id = ?;";
        $query = $this->connection->prepare($sql);
        $query->execute ([$id]);

        if ($query->rowCount () > 0) {
            $resultado = [
                "mensagem"=> "Usuário Excluído",
                "status"=> true
            ];

            return $resultado;
        } else {
            return ([
                "mensagem" => "usuário não existe",
                "status" => false
            ]);
        }
    }
    
    public function edit (string $nome, string $id) {
        $sql = "UPDATE usuario SET nome = ? WHERE id = ?;";
        $query = $this->connection->prepare($sql);
        $query->execute ([$nome, $id]);

        if ($query->rowCount () > 0) {
            $resultado = [
                "mensagem" => "Nome Mudado",
                "status" => true
            ];

            return $resultado;
        } else {
            $resultado = [
                "mensagem" => "Usuário não encontrado",
                "status" => false
            ];

            return $resultado;
        }
    }
}

?>