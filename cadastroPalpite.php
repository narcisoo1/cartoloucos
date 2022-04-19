<?php
include_once("conecta.php");
if(isset($_POST["idjogador"]))
{   
    $db = new dbObj();
    $connString =  $db->getConnstring();
    $connect=$connString;
    #$connect = mysqli_connect('us-cdbr-east-05.cleardb.net','b486c2ce39e1e0','5632fdf3', 'heroku_4e16bdc658af346');
    $jogador=$_POST["idjogador"];
    $rodada=$_POST["rodada"];
    $query='';
    #$query = "UPDATE usuario SET usr_tipo=5 where usr_id='$_POST[post_id]'";
    $query1 = "SELECT * FROM palpite WHERE usuario_usr_id='$jogador' and rodada='$rodada'";
    $result1 = mysqli_query($connect, $query1);
    if ($result1->num_rows > 0) {
        $query="UPDATE palpite SET ";
        for($i=0;$i<10;$i++){
            $query.='j'.($i+1).'_t1='.$_POST["j".$i."t1"].' , ';
            $query.='j'.($i+1).'_t2='.$_POST["j".$i."t2"];
            if($i!=9){
                $query.=' , ';
            }
        } 
        $query.= " WHERE usuario_usr_id='$jogador' and rodada='$rodada'";
    }else{
        $my_array=array();
        for($i=0;$i<10;$i++){
            $my_array[$i.'_1']=$_POST["j".$i."t1"];
            $my_array[$i.'_2']=$_POST["j".$i."t2"];
        }
        $query = "INSERT INTO palpite (usuario_usr_id,rodada,
        j1_t1,j1_t2,j2_t1,j2_t2,j3_t1,j3_t2,j4_t1,j4_t2,j5_t1,j5_t2,
        j6_t1,j6_t2,j7_t1,j7_t2,j8_t1,j8_t2,j9_t1,j9_t2,j10_t1,j10_t2) VALUES ('$jogador','$rodada'";
        
        for($i=0;$i<10;$i++){
            $query .= ",".$my_array[$i.'_1'];
            $query .= ",".$my_array[$i.'_2'];
        }
        $query .= ")";
    }
    $insert = mysqli_query($connect,$query);
                if($insert){
                    $script = <<<EOT
                    <script type="text/javascript">
                        swal('Boa!','Palpite realizado!','success');
                        window.location.href="bolao.php";
                    </script>
                    EOT;
                    echo $script;
                    die();
                }else{
                    $script = <<<EOT
                    <script type="text/javascript">
                        swal('Opa!','Erro ao computar seus palpites!','error');
                        window.location.href="bolao.php";
                    </script>
                    EOT;
                    echo $script;
                    die();
                }
}
?>