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
            alert('Todos os campos devem ser preenchidos!');
            window.location.href="cadastro.php";
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
                    alert('Nome de usuário já cadastrado!');
                    window.location.href="cadastro.php";
                </script>
                EOT;
                echo $script;
                //header('Location: /paginadestino.php');
                die();
        }else{
            if($senha != $senha1){
                $script = <<<EOT
                <script type="text/javascript">
                    alert('Senhas não conferem!');
                    window.location.href="cadastro.php";
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
                        alert('Cadastro realizado!');
                        window.location.href="login.php";
                    </script>
                    EOT;
                    echo $script;
                    die();
                }else{
                    $script = <<<EOT
                    <script type="text/javascript">
                        alert('Erro ao cadastrar seus dados!');
                        window.location.href="cadastro.php";
                    </script>
                    EOT;
                    echo $script;
                    die();
                }
            }
        }
        
    }
?>