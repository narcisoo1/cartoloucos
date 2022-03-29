<?php
//fetch.php
include '../conecta.php';
$db = new dbObj();
$conn =  $db->getConnstring();
if(isset($_POST["post_id"])){
    if($_POST["opcao"]==1){
        $query = "UPDATE usuario SET usr_tipo=5 where usr_id='$_POST[post_id]'";
        if($conn -> query($query) === TRUE){
            $script = <<<EOT
                <script type="text/javascript">
                    alert('Usuário Bloqueado!');
                    window.location.href="usuarios.php";
                </script>
            EOT;
            echo $script;
            die();
        }else{
            $script = <<<EOT
                <script type="text/javascript">
                    alert('Erro ao Bloquear Usuário!');
                    window.location.href="usuarios.php";
                </script>
            EOT;
            echo $script;
            die();
        }
    }else{
        if($_POST["opcao"]==2){
            $query = "UPDATE usuario SET usr_tipo=0 where usr_id='$_POST[post_id]'";
            if($conn -> query($query) === TRUE){
                $script = <<<EOT
                    <script type="text/javascript">
                        alert('Usuário Desbloqueado!');
                        window.location.href="usuarios.php";
                    </script>
                EOT;
                echo $script;
                die();
            }else{
                $script = <<<EOT
                    <script type="text/javascript">
                        alert('Erro ao Desbloquear Usuário!');
                        window.location.href="usuarios.php";
                    </script>
                EOT;
                echo $script;
                die();
            }
        }
        else{
            if($_POST["opcao"]==3){
                $query = "UPDATE usuario SET usr_senha='cf825a1b6b106428e8a0b09390c2fe58bc731a68' where usr_id='$_POST[post_id]'";
                if($conn -> query($query) === TRUE){
                    $script = <<<EOT
                        <script type="text/javascript">
                            alert('Senha Reestabelecida!');
                            window.location.href="usuarios.php";
                        </script>
                    EOT;
                    echo $script;
                    die();
                }else{
                    $script = <<<EOT
                        <script type="text/javascript">
                            alert('Erro ao Reestabelecer Senha!');
                            window.location.href="usuarios.php";
                        </script>
                    EOT;
                    echo $script;
                    die();
                }
            }else{
                if($_POST["opcao"]==4){
                    $query = "UPDATE usuario SET usr_tipo=2 where usr_id='$_POST[post_id]'";
                    if($conn -> query($query) === TRUE){
                        $script = <<<EOT
                            <script type="text/javascript">
                                alert('Admin Ativado!');
                                window.location.href="usuarios.php";
                            </script>
                        EOT;
                        echo $script;
                        die();
                    }else{
                        $script = <<<EOT
                            <script type="text/javascript">
                                alert('Erro ao Ativar Administrador!');
                                window.location.href="usuarios.php";
                            </script>
                        EOT;
                        echo $script;
                        die();
                    }
                }else{
                    if($_POST["opcao"]==5){
                        $query = "UPDATE usuario SET usr_tipo=0 where usr_id='$_POST[post_id]'";
                        if($conn -> query($query) === TRUE){
                            $script = <<<EOT
                                <script type="text/javascript">
                                    alert('Admin Desativado!');
                                    window.location.href="usuarios.php";
                                </script>
                            EOT;
                            echo $script;
                            die();
                        }else{
                            $script = <<<EOT
                                <script type="text/javascript">
                                    alert('Erro ao Desativar Administrador!');
                                    window.location.href="usuarios.php";
                                </script>
                            EOT;
                            echo $script;
                            die();
                        }
                    }
                }
            }
        }
    }


}
?>