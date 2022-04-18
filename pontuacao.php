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

function pontosGerais($array1){
    $ultima=ultimaRodada();
    $array=array();
    $array['usr_id']=$array1['usr_id'];
    $array['usr_nomeFull']=$array1['usr_nomeFull'];
    $array['pontos']=0;
    $array['t']=0;
    $array['p']=0;
    $array['e']=0;
    $control=false;
    global $connect;
    $query = "SELECT * FROM palpite WHERE usuario_usr_id = '$array1[usr_id]' and rodada<='$ultima'";
    $result = mysqli_query($connect, $query);
    $qtd = mysqli_num_rows($result);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $jogos=json_decode(rodada($row['rodada']),true);
            $id_partida = 123754+(($row['rodada']-1)*10);
            for($i=1;$i<=10;$i++){
                if($jogos[$id_partida]['placar1']==$row['j'.$i.'_t1'] && $jogos[$id_partida]['placar2']==$row['j'.$i.'_t2']){
                    $array['pontos']+=3;
                    $array['t']+=1;
                }else{
                    if($jogos[$id_partida]['placar1'] != '' && $jogos[$id_partida]['placar2'] != '' && ((($jogos[$id_partida]['placar1']>$jogos[$id_partida]['placar2']) && ($row['j'.$i.'_t1']>$row['j'.$i.'_t2'])) || (($jogos[$id_partida]['placar1']<$jogos[$id_partida]['placar2']) && ($row['j'.$i.'_t1']<$row['j'.$i.'_t2'])) || (($jogos[$id_partida]['placar1']==$jogos[$id_partida]['placar2']) && ($row['j'.$i.'_t1']==$row['j'.$i.'_t2'])))){
                        $array['pontos']+=1;
                        $array['p']+=1;
                    }else{
                        $array['e']+=1;
                    }
                }
                $id_partida++;
            }
        }
    }

    return $array;    
}

function pontosGeraisRodada($array1){
    $array=array();
    $array['usr_id']=$array1['usr_id'];
    $array['usr_nomeFull']=$array1['usr_nomeFull'];
    $array['pontos']=0;
    $array['t']=0;
    $array['p']=0;
    $array['e']=0;
    $control=false;
    global $connect;
    $query = "SELECT * FROM palpite WHERE usuario_usr_id = '$array1[usr_id]' AND rodada='$array1[rodada]'";
    $result = mysqli_query($connect, $query);
    $qtd = mysqli_num_rows($result);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()){
            $jogos=json_decode(rodada($row['rodada']),true);
            $id_partida = 123754+(($row['rodada']-1)*10);
            for($i=1;$i<=10;$i++){
                if($jogos[$id_partida]['placar1']==$row['j'.$i.'_t1'] && $jogos[$id_partida]['placar2']==$row['j'.$i.'_t2']){
                    $array['pontos']+=3;
                    $array['t']+=1;
                }else{
                    if($jogos[$id_partida]['placar1'] != '' && $jogos[$id_partida]['placar2'] != '' && ((($jogos[$id_partida]['placar1']>$jogos[$id_partida]['placar2']) && ($row['j'.$i.'_t1']>$row['j'.$i.'_t2'])) || (($jogos[$id_partida]['placar1']<$jogos[$id_partida]['placar2']) && ($row['j'.$i.'_t1']<$row['j'.$i.'_t2'])) || (($jogos[$id_partida]['placar1']==$jogos[$id_partida]['placar2']) && ($row['j'.$i.'_t1']==$row['j'.$i.'_t2'])))){
                        $array['pontos']+=1;
                        $array['p']+=1;
                    }else{
                        $array['e']+=1;
                    }
                }
                $id_partida++;
            }
        }
    }

    return $array;    
}

?>