<?php


   #private $url_api = "http://jsuol.com.br/c/monaco/utils/gestor/commons.js?callback=simulador_dados_jsonp&file=commons.uol.com.br/sistemas/esporte/modalidades/futebol/campeonatos/dados/{ANO}/{CAMPEONATO}/dados.json";

    #function __construct($ano=0, $campeonato=0){
      #$json = file_get_contents("db_br.json");
      
      $json = file_get_contents("https://raw.githubusercontent.com/narcisoo1/cartoloucos/main/api/db_br.json");

      $data = json_decode($json);
    
      #echo classificacao(true);
      


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
          $tabela[$value->pos] = $value;
          #$tabela[$i] = $value;
          $i++;

        }

       return json_encode($tabela);

      }

    }



?>
