<?php

include 'api/api.php';
include 'conecta.php';

$db = new dbObj();
$conn =  $db->getConnstring();
if(!isset($_SESSION["username"]) || !isset($_SESSION["id_usuario"])){
  header("Location: login.php");
exit;
}
if($_SESSION["permissao"]==5){
  header("Location: logout.php");
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <title>Cartoloucos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/bootstrap/bootstrap.css">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">

  <link rel="stylesheet" href="css/jquery.fancybox.min.css">

  <link rel="stylesheet" href="css/bootstrap-datepicker.css">

  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

  <link rel="stylesheet" href="css/aos.css">

  <link rel="stylesheet" href="css/style.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


</head>

<body>

  <div class="site-wrap">

    <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div>


    <header class="site-navbar py-4" role="banner">

      <div class="container">
        <div class="d-flex align-items-center">
          <div class="site-logo">
            <a href="index.php">
              <img src="images/logo.png" alt="Logo">
            </a>
          </div>
          <div class="ml-auto">
            <nav class="site-navigation position-relative text-right" role="navigation">
              <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
                <li><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="matches.php" class="nav-link">Partidas</a></li>
                <li class="active"><a href="bolao.php" class="nav-link">Bol??o</a></li>
                <li class="has-children">
                  <a>Classifica????o</a>
                  <ul class="dropdown">
                    <li><a href="teamPositions.php">Brasileir??o</a></li>
                    <li><a href="playerPosition.php">Competidores</a></li>
                  </ul>
                </li>
                <li><a href="contact.php" class="nav-link">Contato</a></li>
                <?php
                  if(!isset($_SESSION["username"]) || !isset($_SESSION["id_usuario"])){
                    echo '<li><a href="login.php" class="btn btn-primary border-width-2 d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Log In</a></li>';
                  }else{
                    echo '<li class="has-children">
                            <a class="btn btn-dark border-width-2 d-lg-inline-block">'.$_SESSION["nome_usuario"].'</a>
                            <ul class="dropdown">
                              <li><a href="logout.php">Sair</a></li>
                              <li><a href="dashboard/index.php">Dashboard</a></li>
                            </ul>
                          </li>';
                  }
                ?>
              </ul>
            </nav>

            <a href="#" class="d-inline-block d-lg-none site-menu-toggle js-menu-toggle text-black float-right text-white"><span
                class="icon-menu h3 text-white"></span></a>
          </div>
        </div>
      </div>

    </header>

    <div class="hero overlay" style="background-image: url('images/bg_3.jpg');">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-5 mx-auto text-center">
            <h1 class="text-white">Bol??o</h1>
            <p>Bem vindo ao bol??o cartoloucos. Deposite seu placar e entre na brincadeira. Boa sorte!</p>
          </div>
        </div>
      </div>
    </div>

    
    <div class="site-section bg-dark">
      <div class="container">
      <div class="row" id="serase">
          <div class="col-6 title-section">
            <h2 class="heading">Rodada <?php echo ultimaRodada();?></h2>
            <input type="text" id="numrodada" name=<?php echo ultimaRodada();?> style="display:none;"/>
          </div>
          <div class="col-6 text-right">
            <div class="custom-nav">
            <?php
              $rodadaat=ultimaRodada();
                if(ultimaRodada()==1){  
                  echo '<button type="button" name="pserase" class="btn btn-primary btn-sm pserase" id="0" disabled>Voltar</button>
                  <button type="button" name="nserase" class="btn btn-primary btn-sm nserase" id="2">Avan??ar</button>';
                }else{
                  echo '<button type="button" name="pserase" class="btn btn-primary btn-sm pserase" id="'.($rodadaat-1).'">Voltar</button>
                  <button type="button" name="nserase" class="btn btn-primary btn-sm nserase" id="'.($rodadaat+1).'">Avan??ar</button>';
                }
              ?>
            </div>
          </div>
        
        <div class="row">
          <?php
            $id_rodada=ultimaRodada();
            $control=false;
            $countdate=0;
            $bloqdate=0;
            $p1=null;
            $p2=null;
            $query = "SELECT * FROM palpite where usuario_usr_id='$_SESSION[id_usuario]' and rodada=1";
            $result = mysqli_query($conn, $query);
            $qtd = mysqli_num_rows($result);
            if ($result->num_rows > 0) {
              $control=true;
              $row = $result->fetch_assoc();
            }
            $const = 123754;
            
            #$data = json_decode($json);
            $rodada = json_decode(rodada($id_rodada),true);
            $id_partida = 123754+(($id_rodada-1)*10);
            for($i = 0 ; $i < 10; $i++){
              $teste="enabled";
              if($control){
                $p1=$row['j'.($i+1).'_t1'];
                $p2=$row['j'.($i+1).'_t2'];
              }
              date_default_timezone_set('America/Sao_Paulo');
              if(date("Y-m-d") >= $rodada[$id_partida]['data']){
                if(date("Y-m-d") > $rodada[$id_partida]['data']){
                  #echo date("Y-m-d"). '>=' . $rodada[$id_partida]['data'];
                  $bloqdate=1;
                  $teste="disabled";
                  $countdate++;
                }else{
                  if(date('H:m', strtotime('+1 hour', strtotime(date('H:m:s'))))>=str_replace('h', ':', ($rodada[$id_partida]['horario']))){
                    #echo str_replace('h', ':', ($rodada[$id_partida]['horario'])).'>='.date('H:m', strtotime('+0 hour', strtotime(date('H:m:s')))).'<br>';
                    $bloqdate=1;
                    $teste="disabled";
                    $countdate++;
                  }
                }
              }
              echo "
            <div class='col-lg-6 mb-4'>
              <div class='bg-light p-4 rounded'>
                <div class='widget-body'>
                  <div class='widget-vs'>
                  <form id='f".$i."' name='".$id_partida."'>
                    <div class='d-flex align-items-center justify-content-around justify-content-between w-100'>
                      <div class='team-1 text-center'>
                        <img src='".str_replace('4', '6', json_decode(equipe($rodada[$id_partida]['time1']),true)['brasao'])."' alt='Image'>
                        <h3>".json_decode(equipe($rodada[$id_partida]['time1']),true)['sigla']."</h3>
                        <input value='".$p1."' type='number' id='".$i."_1' style='width: 40px; text-align:center;'".$teste."/>
                      </div>
                      <div>
                        <span class='vs'><span>VS</span></span>
                      </div>
                      <div class='team-2 text-center'>
                        <img src='".str_replace('4', '6',json_decode(equipe($rodada[$id_partida]['time2']),true)['brasao'])."' alt='Image'>
                        <h3>".json_decode(equipe($rodada[$id_partida]['time2']),true)['sigla']."</h3>
                        <input value='".$p2."' type='number' id='".$i."_2' style='width: 40px; text-align:center;'".$teste."/>
                      </div>
                    </div>
                  </form>
                  </div>
                </div>
                <div class='text-center widget-vs-contents mb-4'>
                  <h4>Brasileir??o Serie A</h4>
                  <p class='mb-5'>
                    <span class='d-block'>".$rodada[$id_partida]['data']."</span>
                    <span class='d-block'>".$rodada[$id_partida]['horario']."</span>
                    <strong class='text-primary'>".$rodada[$id_partida]['estadio']."</strong>
                  </p>
                </div>
              </div>
            </div>";
            $id_partida++;
          }
            
            ?>
        <div class="col-12 text-right">
          <div class="custom-nav">
            <button type="button" name="submitserase" class="btn btn-primary btn-sm submitserase"<?php if($countdate==10){echo "disabled";}else{echo "enabled";}?>>Enviar</button>
            <button type="button" name="reset" class="btn btn-primary btn-sm reset">Cancelar</button>
          </div>
          <input type='text' id='teste' name=<?php echo '"'.$bloqdate.'"'; ?> style='display:none;'/>
        </div>                    
      </div>
      </div>
    </div> <!-- .site-section -->

    <footer class="footer-section">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-12">
            <div class=" pt-5">
              <p>
                Copyright &copy;
                <script>
                  document.write(new Date().getFullYear());
                </script> All rights reserved <i class="icon-heart"
                  aria-hidden="true"></i> by <a href="https://instagram.com/narcisoo1/" target="_blank">Narciso</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </footer>



  </div>
  <!-- .site-wrap -->
  <script>
    $(document).ready(function(){

    function fetch_post_dataserase(post_id)
    {
      $.ajax({
      url:"fetchRodadasBolao.php",
      method:"POST",
      data:{post_id:post_id},
      success:function(data)
      {
        //$('#post_modal').modal('show');
        $('#serase').html(data);
      }
      });
    }

    function submitbolao(idjogador,my_array,rodada)
    {
      //alert(my_array['0_1']);
      $.ajax({
      url:"cadastroPalpite.php",
      method:"POST",
      data:{idjogador:idjogador,
            rodada:rodada,
            j0t1:my_array['0_1'],
            j0t2:my_array['0_2'],
            j1t1:my_array['1_1'],
            j1t2:my_array['1_2'],
            j2t1:my_array['2_1'],
            j2t2:my_array['2_2'],
            j3t1:my_array['3_1'],
            j3t2:my_array['3_2'],
            j4t1:my_array['4_1'],
            j4t2:my_array['4_2'],
            j5t1:my_array['5_1'],
            j5t2:my_array['5_2'],
            j6t1:my_array['6_1'],
            j6t2:my_array['6_2'],
            j7t1:my_array['7_1'],
            j7t2:my_array['7_2'],
            j8t1:my_array['8_1'],
            j8t2:my_array['8_2'],
            j9t1:my_array['9_1'],
            j9t2:my_array['9_2']},
      success:function(data)
      {
        //$('#post_modal').modal('show');
        $('#serase').html(data);
      }
      });
    }

    $(document).on('click', '.submitserase', function(){
      var controldate= document.getElementById('teste').name;
      if (false){
        alert("Opa, rodada em andamento, palpites DESATIVADOS!!");
      }else{
        var my_array = new Array();
        var control = 1;
        var rodada = document.getElementById('numrodada').name;
        for(var i=0;i<10;i++){
          my_array[i+'_1'] = document.getElementById(i+'_1').value;
          my_array[i+'_2'] = document.getElementById(i+'_2').value;
        }
        for(var i=0;i<10;i++){
          if(my_array[i+'_1']=='' || my_array[i+'_2']==''){
            my_array[i+'_1']=-1;
            my_array[i+'_2']=-1;
          }
        }
        if(control==1){
          var userID = "<?php echo $_SESSION['id_usuario'] ?>";
          submitbolao(userID,my_array, rodada);
        }
      }
      
      //alert(my_array['0_1']);
      /*
      var form_values = $('form').serialize();
      var f0 = document.getElementById("f0").name;
      var j0t1 = document.getElementById("0_1").value;
      var j0t2 = document.getElementById("0_2").value;
      var f1 = document.getElementById("f1").name;
      var j1t1 = document.getElementById("1_1").value;
      var j1t2 = document.getElementById("1_2").value;
      var f2 = document.getElementById("f2").name;
      var j2t1 = document.getElementById("2_1").value;
      var j2t2 = document.getElementById("2_2").value;
      var f3 = document.getElementById("f3").name;
      var j3t1 = document.getElementById("3_1").value;
      var j3t2 = document.getElementById("3_2").value;
      var f4 = document.getElementById("f4").name;
      var j4t1 = document.getElementById("4_1").value;
      var j4t2 = document.getElementById("4_2").value;
      var f5 = document.getElementById("f5").name;
      var j5t1 = document.getElementById("5_1").value;
      var j5t2 = document.getElementById("5_2").value;
      var f6 = document.getElementById("f6").name;
      var j6t1 = document.getElementById("6_1").value;
      var j6t2 = document.getElementById("6_2").value;
      var f7 = document.getElementById("f7").name;
      var j7t1 = document.getElementById("7_1").value;
      var j7t2 = document.getElementById("7_2").value;
      var f8 = document.getElementById("f8").name;
      var j8t1 = document.getElementById("8_1").value;
      var j8t2 = document.getElementById("8_2").value;
      var f9 = document.getElementById("f9").name;
      var j9t1 = document.getElementById("9_1").value;
      var j9t2 = document.getElementById("9_2").value;
      
      if(j0t1 != '' && j0t2 != ''){
      //if(j0t1 != '' && j0t2 != '' && j1t1 != '' && j1t2 != '' && j2t1 != '' && j2t2 != '' && j3t1 != '' && j3t2 != '' && j4t1 != '' && j4t2 != '' && j5t1 != '' && j5t2 != '' && j6t1 != '' && j6t2 != '' && j7t1 != '' && j7t2 != '' && j8t1 != '' && j8t2 != '' && j9t1 != '' && j9t2 != ''){
        if(j0t1 >= 0 && j0t2 >= 0){
        //if(j0t1 >= 0 && j0t2 >= 0 && j1t1 >= 0 && j1t2 >= 0 && j2t1 >= 0 && j2t2 >= 0 && j3t1 >= 0 && j3t2 >= 0 && j4t1 >= 0 && j4t2 >= 0 && j5t1 >= 0 && j5t2 >= 0 && j6t1 >= 0 && j6t2 >= 0 && j7t1 >= 0 && j7t2 >= 0 && j8t1 >= 0 && j8t2 >= 0 && j9t1 >= 0 && j9t2 >= 0){
          submitbolao("teste",f0,j0t1,j0t2);
          //submitbolao("teste",f0,j0t1,j0t2,j1t1,j1t2,j2t1,j2t2,j3t1,j3t2,j4t1,j4t2,j5t1,j5t2,j6t1,j6t2,,j7t1,j7t2);
        }else{
          alert('Somente valores positivos!');
        }
      }else{
        alert('Preencha todos os campos!');
      }*/
    });
    
    $(document).on('click', '.pserase', function(){
      var post_id = $(this).attr("id");
      fetch_post_dataserase(post_id);
    });

    $(document).on('click', '.nserase', function(){
      var post_id = $(this).attr("id");
      fetch_post_dataserase(post_id);
    });

    });
  </script>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.mb.YTPlayer.min.js"></script>


  <script src="js/main.js"></script>

</body>

</html>