<?php 
require ("./src/model/UsuarioModel.php");
require_once ("./src/utilities/JWT.php");

class UsuarioController {
    private $UsuarioModel;

    public function __construct () {
        $this->UsuarioModel = new UsuarioModel ();
    }

    public function Login () {
        if (isset ($_POST ["email"]) && isset ($_POST ["senha"])) {
            $email = addslashes ($_POST ["email"]);
            $senha = addslashes ($_POST ["senha"]);
            $resultado = $this->UsuarioModel->Login($email, $senha);
            if ($resultado["status"]) {
                $payload = [
                    "sub"=>$resultado ["id"],
                    "email"=>$resultado ["email"],
                    "nome"=>$resultado ["nome"]
                ];
                $_SESSION["token"] = JWT::encode ($payload, getenv ("JWT_SECRET"));
                echo ("
                    <script>
                        window.alert ('Login Feito');
                        window.location.href = '/dashboard';
                    </script>
                ");
            } else {
                echo ("
                <script>
                    window.alert ('".$resultado ["mensagem"]."');
                </script>
            ");
            }
        }
        require_once ("./src/views/Login/Login.html");
    }

    public function Cadastro () {
        if (isset ($_POST ["email"]) && isset ($_POST ["senha"])) {
            $email = addslashes ($_POST ["email"]);
            $senha = addslashes ($_POST ["senha"]);
            $resultado = $this->UsuarioModel->Cadastro($email, $senha);
            if ($resultado["status"]) {
                echo ("
                    <script> 
                        window.alert ('".$resultado["message"]."');
                        window.location.href = 'login';
                    </script>
                ");
            } else {
                echo ("<script> window.alert ('" .$resultado ["message"]."') </script>");
            }
        }
        require_once ("./src/views/Cadastro/Cadastro.html");
    }

    public function Dashboard () {
        $resultado = $this->UsuarioModel->findAll ();
        if (isset($_POST ["excluir"])) {
            try {
                $resultado = $this->UsuarioModel->destroy ($_POST ["excluir"]);
                if ($resultado ["status"]) {
                    echo ("
                        <script>
                            window.alert ('".$resultado ["mensagem"]."');
                            window.location.href = '/dashboard';
                        </script>
                    ");
                } else {
                    echo ("
                        <script>
                            window.alert ('".$resultado ["mensagem"]."');
                        </script>
                    ");
                }
            } catch (Exception $exception) {
                echo ("
                        <script>
                            window.alert ('".$exception."');
                            window.location.href = '/dashboard';
                        </script>
                    ");
            }
            
        }

        if (isset ($_POST ["editar"])) {
            try {
                print_r ($_POST);
                $resultado = $this->UsuarioModel->edit (addslashes ($_POST ["usuario"]), $_POST ["id"]);
                if ($resultado ["status"]) {
                    echo ("
                        <script>
                            window.alert ('".$resultado ["mensagem"]."');
                            window.location.href = '/dashboard';
                        </script>
                    ");
                } else {
                    echo ("
                        <script>
                            window.alert ('".$resultado ["mensagem"]."');
                        </script>
                    ");
                }
            } catch (Exception $exception) {
                echo ("
                        <script>
                            window.alert ('".$exception."');
                        </script>
                    ");
            }
        }
        require_once ("./src/views/Dashboard/Dashboard.php");
    }
}

?>