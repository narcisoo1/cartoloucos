<?php


   #private $url_api = "http://jsuol.com.br/c/monaco/utils/gestor/commons.js?callback=simulador_dados_jsonp&file=commons.uol.com.br/sistemas/esporte/modalidades/futebol/campeonatos/dados/{ANO}/{CAMPEONATO}/dados.json";

    #function __construct($ano=0, $campeonato=0){
      #$json = file_get_contents("db_br.json");
      
      $url_api = "http://jsuol.com.br/c/monaco/utils/gestor/commons.js?callback=simulador_dados_jsonp&file=commons.uol.com.br/sistemas/esporte/modalidades/futebol/campeonatos/dados/2022/30/dados.json";

      $json_dados  = json_decode(substr(trim(str_replace('simulador_dados_jsonp(','',file_get_contents($url_api))),0,-2));

      $json = file_get_contents("https://raw.githubusercontent.com/narcisoo1/cartoloucos/main/api/db_br.json");

      $data = $json_dados;
          

    #print_r (proximojogo());

    // retorna dados da equipe
    function equipe($id_time){

      if(!isset($id_time)){
        return json_encode(array('erro' => '401', 'msg' => 'id is required'));
      }

      if(is_numeric($id_time)){
        global $data;
        $obj = $data;
        $id  = $id_time;
        return json_encode($obj->equipes->$id);
      }else{
        return false;
      }

    }


    // retorna todos os jogos de determinada rodada
    function rodada($rodada){

      if(!isset($rodada)){
        return json_encode(array('erro' => '401', 'msg' => 'rodada is required'));
      }
      global $data;
      $obj = $data;
      $rodada = $rodada;

      foreach ($obj->fases as $key => $value) {
        $jogos = $value->jogos;

        $jogo = array();

        foreach ($jogos->rodada->$rodada as $key => $value) {
          $idjogo = $value;
          $jogo[$idjogo] = $jogos->id->$idjogo;

        }

        return json_encode($jogo);

      }

    }

    // retorna o inteiro da ultima rodada
    function ultimaRodada(){
      global $data;
      $obj = $data;
      foreach ($obj->fases as $key => $value) {
        $rodada = $value->rodada->atual;
      }
      if ($rodada==null){
        return 0;
      }else{
        $rodada = intval($rodada);
        return $rodada;
      }
    }

    // retorna as informações do campeonato
    function campeonato(){
      global $data;
      $obj = $data;
      return json_encode($obj);
    }

    // retorna as equipes
    function equipes($request){
      $obj = $this->json_dados;
      return json_encode($obj->equipes);
    }


    // retorna a classificacao
    function classificacao($request){
      global $data;
      $obj = $data;
      $i=0;
      $j=0;
      foreach ($obj->fases as $key => $value) {
        $classificacao = $value->classificacao;
        $tabela = array();

        foreach ($classificacao->equipe as $key => $value) {
          $control=(-1);
          for ($i=0;$i<20;$i++){
            if($classificacao->grupo->Único[$i]==$key){
              $control=$i;
            }
          }
          $tabela[$control+1] = $value;
          #$tabela[$i] = $value;
          $i++;

        }
        
       return json_encode($tabela);

      }

    }

    function ultimoJogo(){
      $rodada=ultimaRodada();
      if(!isset($rodada)){
        return json_encode(array('erro' => '401', 'msg' => 'rodada is required'));
      }
      global $data;
      $obj = $data;
      $rodada = $rodada;
      $control = 0;
      $ultimoJogo = null;

      foreach ($obj->fases as $key => $value) {
        $jogos = $value->jogos;

        $jogo = array();

        foreach ($jogos->rodada->$rodada as $key => $value) {
          $idjogo = $value;
          $jogo[$idjogo] = $jogos->id->$idjogo;
          if ($control==0){
            $ultimoJogo=$jogo[$idjogo];
          }else{
            if($jogo[$idjogo]['data']>=$ultimoJogo['data']){
              if($jogo[$idjogo]['horario']>$ultimoJogo['horario']){
                $ultimoJogo=$jogo[$idjogo];
              }
            }
          }
          
        }
        
        return json_encode($ultimoJogo);

      }
    }

    function proximoJogo(){
      date_default_timezone_set('America/Sao_Paulo');
      $today = date("Y-m-d");

      $rodada=ultimaRodada();
      global $data;
      $obj = $data;
      $rodada = $rodada;
      $control = 0;
      $proximojogo = null;

      foreach ($obj->fases as $key => $value) {
        $jogos = $value->jogos;

        $jogo = array();
        foreach ($jogos->data as $key => $value) {
          if($key>$today){
              $idjogo=$jogos->data->$key[0];
              if ($control==0){
                $jogo=json_decode(json_encode($jogos->id->$idjogo), true);
                $proximojogo=$jogo;
                $control++;
              }else{
                if($jogo['data']>=$proximojogo['data']){
                  if($jogo['horario']<$proximojogo['horario']){
                    $proximojogo=$jogo;
                  }
                }
              }
            }
        }
        
        return json_encode($proximojogo);

      }
    }
?>
