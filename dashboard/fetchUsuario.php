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
                    swal({
                        title: "Boa!",
                        text: "Usuário Bloqueado!",
                        icon: "success"
                    }).then(function() {
                        window.location = "usuarios.php";
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
                        text: "Erro ao Bloquear Usuário!",
                        icon: "error"
                    }).then(function() {
                        window.location = "usuarios.php";
                    });
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
                        swal({
                            title: "Boa!",
                            text: "Usuário Bloqueado!",
                            icon: "success"
                        }).then(function() {
                            window.location = "usuarios.php";
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
                            text: "Erro ao Desbloquear Usuário!",
                            icon: "error"
                        }).then(function() {
                            window.location = "usuarios.php";
                        });
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
                            swal({
                                title: "Redefinida!",
                                text: "Senha Atualizada!",
                                icon: "success"
                            }).then(function() {
                                window.location = "usuarios.php";
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
                                text: "Erro ao Reestabelecer Senha!",
                                icon: "error"
                            }).then(function() {
                                window.location = "usuarios.php";
                            });
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
                                swal({
                                    title: "Feito!",
                                    text: "Admin Ativado!",
                                    icon: "success"
                                }).then(function() {
                                    window.location = "usuarios.php";
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
                                    text: "Erro ao Ativar Administrador!",
                                    icon: "error"
                                }).then(function() {
                                    window.location = "usuarios.php";
                                });
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
                                    swal({
                                        title: "Boa!",
                                        text: "Admin Desativado!",
                                        icon: "success"
                                    }).then(function() {
                                        window.location = "usuarios.php";
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
                                        text: "Erro ao Desativar Administrador!",
                                        icon: "error"
                                    }).then(function() {
                                        window.location = "usuarios.php";
                                    });
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