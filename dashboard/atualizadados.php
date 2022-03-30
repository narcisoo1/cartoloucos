<?php
include('../pontuacao.php');
if(!isset($_SESSION["username"]) || !isset($_SESSION["id_usuario"])){
    header("Location: ../login.php");
exit;
}

include '../conecta.php';
$db = new dbObj();
$conn =  $db->getConnstring();
    if(isset($_GET['dados'])){
        $username = $_POST['username'];
        $nomeFull = $_POST['nomeFull'];
        if($username == "" || $username == null || $nomeFull == "" || $nomeFull == null){
            $script = <<<EOT
            <script type="text/javascript">
                alert('Todos os dados devem ser preenchidos!');
                window.location.href="conta.php";
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
                    alert('Dados atualizados!');
                    window.location.href="conta.php";
                </script>
                EOT;
                echo $script;
                die();
            }else{
                $script = <<<EOT
                <script type="text/javascript">
                    alert('Erro ao atualizar seus dados!');
                    window.location.href="conta.php";
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
                alert('Todos os dados devem ser preenchidos!');
                window.location.href="conta.php";
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
                            alert('Senha atualizada!');
                            window.location.href="conta.php";
                        </script>
                        EOT;
                        echo $script;
                        die();
                    }else{
                        $script = <<<EOT
                        <script type="text/javascript">
                            alert('Falha ao atualizar senha!');
                            window.location.href="conta.php";
                        </script>
                        EOT;
                        echo $script;
                        die();
                    }
                }
            }else{
                $script = <<<EOT
                <script type="text/javascript">
                    alert('Senha e confirmação de senha divergem!');
                    window.location.href="conta.php";
                </script>
                EOT;
                echo $script;
                die();
            }
        }
    }

?>