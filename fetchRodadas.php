<?php
//fetch.php
include 'api/api.php';
if(isset($_POST["post_id"]))
{
 $data_1=$_POST["post_id"]-1;
 $data_2=$_POST["post_id"]+1;
 $if_previous_disable='';
 $if_next_disable='';
 $output = '';
  if($_POST["post_id"]==1)
  {
   $if_previous_disable = 'disabled';
   $data_1=null;
  }
  if($_POST["post_id"]==38)
  {
   $if_next_disable = 'disabled';
   $data_2=null;
  }
    $const = 123754;
    $id_rodada=$_POST["post_id"];
    $data = json_decode($json);
    $rodada = json_decode(rodada($id_rodada),true);
    $id_partida = 123754+(($id_rodada-1)*10);
    $output .= '<div class="col-6 title-section">
        <h2 class="heading">Rodada '.$_POST["post_id"].'</h2>
        <input type="text" id="numrodada" name="'.$_POST["post_id"].'" style="display:none;"/>
      </div>
      <div class="col-6 text-right">
        <div class="custom-nav">
            <button type="button" name="pserase" class="btn btn-primary btn-sm pserase" id="'.$data_1.'" '.$if_previous_disable.'>Voltar</button>
            <button type="button" name="nserase" class="btn btn-primary btn-sm nserase" id="'.$data_2.'" '.$if_next_disable.'>Avançar</button>
        </div>
      </div>
    </div>
    
    <div class="row">';

    for($i = 0 ; $i < 10; $i++){
    $output .= "
    <div class='col-lg-6 mb-4'>
        <div class='bg-light p-4 rounded'>
            <div class='widget-body'>
                <div class='widget-vs'>
                <form id='f".$i."' name='".$id_partida."'>
                    <div class='d-flex align-items-center justify-content-around justify-content-between w-100'>
                        <div class='team-1 text-center'>
                            <img src='".str_replace('4', '6', json_decode(equipe($rodada[$id_partida]['time1']),true)['brasao'])."' alt='Image'>
                            <h3>".json_decode(equipe($rodada[$id_partida]['time1']),true)['sigla']."</h3>
                        </div>
                        <div>
                            <span class='vs'><span>VS</span></span>
                        </div>
                        <div class='team-2 text-center'>
                            <img src='".str_replace('4', '6',json_decode(equipe($rodada[$id_partida]['time2']),true)['brasao'])."' alt='Image'>
                            <h3>".json_decode(equipe($rodada[$id_partida]['time2']),true)['sigla']."</h3>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class='text-center widget-vs-contents mb-4'>
            <h4>Brasileirão Serie A</h4>
            <p class='mb-5'>
            <span class='d-block'>".$rodada[$id_partida]['data']."</span>
            <span class='d-block'>".$rodada[$id_partida]['horario']."</span>
            <strong class='text-primary'>".$rodada[$id_partida]['estadio']."</strong>
            </p>
        </div>
    </div>
    </div>
    ";
    $id_partida++;
    }
 echo $output;
}

?>