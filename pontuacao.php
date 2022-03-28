<?php
//include connection file 
include_once("conecta.php");
include_once("api/api.php");

$db = new dbObj();
$connString =  $db->getConnstring();
$connect=$connString;
#echo pontosAnual(4);

#echo pontosRodada(4,2);
function pontosRodada($id,$id_rodada){
    $pontos=0;
    $control=false;
    global $connect;
    $query = "SELECT * FROM palpite WHERE usuario_usr_id = '$id' AND rodada='$id_rodada'";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($result);
    if(mysqli_num_rows($result) == 1){
        $control=true;
        $jogos=json_decode(rodada($id_rodada),true);
        $id_partida = 123754+(($id_rodada-1)*10);
        for($i=1;$i<=10;$i++){
            if($jogos[$id_partida]['placar1']==$row['j'.$i.'_t1'] && $jogos[$id_partida]['placar2']==$row['j'.$i.'_t2']){
                $pontos+=3;
            }else{
                if($jogos[$id_partida]['placar1'] != '' && $jogos[$id_partida]['placar2'] != '' && ((($jogos[$id_partida]['placar1']>$jogos[$id_partida]['placar2']) && ($row['j'.$i.'_t1']>$row['j'.$i.'_t2'])) || (($jogos[$id_partida]['placar1']<$jogos[$id_partida]['placar2']) && ($row['j'.$i.'_t1']<$row['j'.$i.'_t2'])) || (($jogos[$id_partida]['placar1']==$jogos[$id_partida]['placar2']) && ($row['j'.$i.'_t1']==$row['j'.$i.'_t2'])))){
                    $pontos+=1;
                }
            }
            $id_partida++;
        }
    }
    if($control){
        return $pontos;
    }else{
        return 0;
    }
}

function pontosAnual($id){
    $control=-1;
    $c1=-1;
    $pontos=0;
    for($i=1;$i<=38;$i++){
        $control=pontosRodada($id,$i);
        if($control!=-1){
            $pontos+=$control;
            $c1++;
        }
        $control=-1;
    }
    if($c1==-1){
        return -1;
    }else{
        return $pontos;
    }
}

?>