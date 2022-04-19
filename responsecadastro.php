<?php
include 'conecta.php';

$db = new dbObj();
$conn =  $db->getConnstring();

$nome = $_POST['nomeFull'];
$login = $_POST['username'];
$senha = $_POST['password'];
$senha1 = $_POST['confirm_password'];



$connect = $conn;

    if($login == "" || $login == null || $nome == "" || $nome == null || $senha == "" || $senha == null || $senha1 == "" || $senha1 == null){
        $script = <<<EOT
        <script type="text/javascript">
            swal({
                title: "Ops!",
                text: "Todos os campos devem ser preenchidos!",
                icon: "error"
            }).then(function() {
                window.location = "cadastro.php";
            });
        </script>
        EOT;
        echo $script;
        die();
    }else{
        $query_select = "SELECT * FROM usuario WHERE usr_nome = '$login'";
        $select = mysqli_query($connect,$query_select);
        $array = mysqli_fetch_array($select);
        if($array != null){
                $script = <<<EOT
                <script type="text/javascript">
                    swal({
                        title: "Duplicado!",
                        text: "Usuário já cadastrado!",
                        icon: "error"
                    }).then(function() {
                        window.location = "cadastro.php";
                    });
                </script>
                EOT;
                echo $script;
                //header('Location: /paginadestino.php');
                die();
        }else{
            if($senha != $senha1){
                $script = <<<EOT
                <script type="text/javascript">
                    swal({
                        title: "Diferentes!",
                        text: "Senhas não conferem!",
                        icon: "error"
                    }).then(function() {
                        window.location = "cadastro.php";
                    });
                </script>
                EOT;
                echo $script;
                die();
            }else{
                $senhacript=sha1($senha);
                $query = "INSERT INTO usuario (usr_nome,usr_senha,usr_nomeFull) VALUES ('$login','$senhacript','$nome')";
                $insert = mysqli_query($connect,$query);
                if($insert){
                    $script = <<<EOT
                    <script type="text/javascript">
                        swal({
                            title: "Boa!",
                            text: "Cadastro realizado!",
                            icon: "success"
                        }).then(function() {
                            window.location = "login.php";
                        });
                    </script>
                    EOT;
                    echo $script;
                    die();
                }else{
                    $script = <<<EOT
                    <script type="text/javascript">
                        swal({
                            title: "Ops!",
                            text: "Erro ao cadastrar seus dados!",
                            icon: "error"
                        }).then(function() {
                            window.location = "cadastro.php";
                        });
                    </script>
                    EOT;
                    echo $script;
                    die();
                }
            }
        }
        
    }
?>