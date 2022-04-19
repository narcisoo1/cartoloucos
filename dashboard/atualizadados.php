<html>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</html>
<?php
include '../conecta.php';
include('../pontuacao.php');
if(!isset($_SESSION["username"]) || !isset($_SESSION["id_usuario"])){
    header("Location: ../login.php");
exit;
}

$conn =  $connect;
    if(isset($_GET['dados'])){
        $username = $_POST['username'];
        $nomeFull = $_POST['nomeFull'];
        if($username == "" || $username == null || $nomeFull == "" || $nomeFull == null){
            $script = <<<EOT
            <script type="text/javascript">
                swal({
                    title: "Vazio!",
                    text: "Todos os dados devem ser preenchidos!",
                    icon: "error"
                }).then(function() {
                    window.location = "conta.php";
                });
            </script>
            EOT;
            echo $script;
            die();
        }else{
            $sql="UPDATE usuario SET usr_nome='$username', usr_nomeFull='$nomeFull' WHERE usr_nome='$_SESSION[username]'";
            $resultupdate = mysqli_query($conn, $sql);
            if($resultupdate){
                $_SESSION['username']=$username;
                $_SESSION["nome_usuario"] = explode(" ",$nomeFull)[0];
				$_SESSION["nome_usuarioFull"] = $nomeFull;
                $script = <<<EOT
                <script type="text/javascript">
                    swal({
                        title: "Boa!",
                        text: "Dados atualizados!",
                        icon: "success"
                    }).then(function() {
                        window.location = "conta.php";
                    });
                </script>
                EOT;
                echo $script;
                die();
            }else{
                $script = <<<EOT
                <script type="text/javascript">
                    swal({
                        title: "Vazio!",
                        text: "Todos os dados devem ser preenchidos!",
                        icon: "error"
                    }).then(function() {
                        window.location = "conta.php";
                    });
                </script>
                EOT;
                echo $script;
                die();
            }
        }
    }
    if(isset($_GET['password'])){
        $lastsenha = $_POST['lastpassword'];
        $senha = $_POST['newpassword'];
        $senha1 = $_POST['confirm_password'];
        if($lastsenha == "" || $lastsenha == null || $senha == "" || $senha == null || $senha1 == "" || $senha1 == null){
            $script = <<<EOT
            <script type="text/javascript">
                swal({
                    title: "Opa!",
                    text: "Todos os campos devem ser preenchidos!",
                    icon: "error"
                }).then(function() {
                    window.location = "conta.php";
                });
            </script>
            EOT;
            echo $script;
            die(); 
        }else{
            if($senha==$senha1){
                $sql = "SELECT * FROM usuario WHERE usr_nome='$_SESSION[username]'";
                $resultset = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($resultset);
                if((mysqli_num_rows($resultset) == 1) && (sha1($lastsenha) == $row['usr_senha'])){
                    $senhacrypt=sha1($senha);
                    $sql1="UPDATE usuario SET usr_senha='$senhacrypt' WHERE usr_nome='$_SESSION[username]'";
                    $resultupdate = mysqli_query($conn, $sql1);
                    if($resultupdate){
                        $script = <<<EOT
                        <script type="text/javascript">
                            swal({
                                title: "Boa!",
                                text: "Senha atualizada!",
                                icon: "success"
                            }).then(function() {
                                window.location = "conta.php";
                            });
                        </script>
                        EOT;
                        echo $script;
                        die();
                    }else{
                        $script = <<<EOT
                        <script type="text/javascript">
                            swal({
                                title: "Opa!",
                                text: "Falha ao atualizar senha!",
                                icon: "error"
                            }).then(function() {
                                window.location = "conta.php";
                            });
                        </script>
                        EOT;
                        echo $script;
                        die();
                    }
                }else{
                    $script = <<<EOT
                    <script type="text/javascript">
                        swal({
                            title: "Ops!",
                            text: "Senha incorreta!",
                            icon: "error"
                        }).then(function() {
                            window.location = "conta.php";
                        });
                    </script>
                    EOT;
                    echo $script;
                    die();
                }
            }else{
                $script = <<<EOT
                <script type="text/javascript">
                    swal({
                        title: "Diferentes!",
                        text: "Senhas não conferem!",
                        icon: "error"
                    }).then(function() {
                        window.location = "conta.php";
                    });
                </script>
                EOT;
                echo $script;
                die();
            }
        }
    }

?>