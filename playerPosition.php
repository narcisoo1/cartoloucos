<?php
include ("conecta.php");
include ("pontuacao.php");

$db = new dbObj();
$conn =  $db->getConnstring();

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
                <?php
                  if(isset($_SESSION["username"]) || isset($_SESSION["id_usuario"])){
                    echo '<li><a href="bolao.php" class="nav-link">Bol??o</a></li>';
                  }
                ?>
                <li class="has-children">
                  <a>Classifica????o</a>
                  <ul class="dropdown">
                    <li><a href="teamPositions.php">Brasileir??o</a></li>
                    <li class="active"><a href="playerPosition.php">Competidores</a></li>
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
            <h1 class="text-white">Classifica????o</h1>
            <p>Tela de classifica????o dos competidores em duas vertentes, Pontua????o da ??ltima Rodada e Anual.</p>
          </div>
        </div>
      </div>
    </div>

    
    
    <div class="site-section bg-dark">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <strong class="text-white">Pontua????o Anual</strong>
            <div class="widget-next-match">
              <table class="table custom-table">
                <thead>
                  <tr>
                    <th>P</th>
                    <th>Competidor</th>
                    <th>PTS</th>
                    <th>Acertos</th>
                    <th>Parcial</th>
                    <th>Erros</th>
                    
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $control=0;
                    $array=array();
                    $participantes=array();
                    $aux=array();
                    $queryuser = "SELECT * FROM usuario WHERE usr_tipo!=5";
                    $resultuser = mysqli_query($conn, $queryuser);
                    $qtd = mysqli_num_rows($resultuser);
                    if ($resultuser->num_rows > 0) {
                      while($rowuser = $resultuser->fetch_assoc()){
                        $participantes[$control]=pontosGerais($rowuser);
                        $control++;
                      }
                    }
                    $control=0;
                    for($i=0;$i<count($participantes);$i++){
                      for($j=0;$j<count($participantes)-1;$j++){
                        if($participantes[$j+1]['pontos']<=$participantes[$j]['pontos']){
                          $aux=$participantes[$j];
                          $participantes[$j]=$participantes[$j+1];
                          $participantes[$j+1]=$aux;
                        }
                      }
                    }

                    for($i=0;$i<count($participantes);$i++){
                      for($j=0;$j<count($participantes)-1;$j++){
                        if($participantes[$j+1]['pontos']==$participantes[$j]['pontos']){
                          if($participantes[$j+1]['t']<=$participantes[$j]['t']){
                            $aux=$participantes[$j];
                            $participantes[$j]=$participantes[$j+1];
                            $participantes[$j+1]=$aux;
                          }
                        }
                      }
                    }

                    for($i=0;$i<count($participantes);$i++){
                      for($j=0;$j<count($participantes)-1;$j++){
                        if($participantes[$j+1]['pontos']==$participantes[$j]['pontos']){
                          if($participantes[$j+1]['t']==$participantes[$j]['t']){
                            if($participantes[$j+1]['p']<=$participantes[$j]['p']){
                              $aux=$participantes[$j];
                              $participantes[$j]=$participantes[$j+1];
                              $participantes[$j+1]=$aux;
                            }
                          }
                        }
                      }
                    }

                    for($i=0;$i<count($participantes);$i++){
                      for($j=0;$j<count($participantes)-1;$j++){
                        if($participantes[$j+1]['pontos']==$participantes[$j]['pontos']){
                          if($participantes[$j+1]['t']==$participantes[$j]['t']){
                            if($participantes[$j+1]['p']==$participantes[$j]['p']){
                              if($participantes[$j+1]['e']>=$participantes[$j]['e']){
                                $aux=$participantes[$j];
                                $participantes[$j]=$participantes[$j+1];
                                $participantes[$j+1]=$aux;
                              }
                            }
                          }
                        }
                      }
                    }

                    $p=1;
                    for($i=count($participantes)-1;$i>=0;$i--){
                      echo '
                        <tr>
                          <td>'.$p.'</td>
                          <td><strong class="text-white">'.$participantes[$i]['usr_nomeFull'].'</strong></td>
                          <td><strong class="text-white">'.$participantes[$i]['pontos'].'</strong></td>
                          <td>'.$participantes[$i]['t'].'</td>
                          <td>'.$participantes[$i]['p'].'</td>
                          <td>'.$participantes[$i]['e'].'</td>
                        </tr>
                      ';
                      $p++;
                    }

                  ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="col-lg-6">
            <strong class="text-white">Pontua????o ??ltima Rodada</strong>
            <div class="widget-next-match">
              <table class="table custom-table">
                <thead>
                  <tr>
                    <th>P</th>
                    <th>Competidor</th>
                    <th>PTS</th>
                    <th>Acertos</th>
                    <th>Parcial</th>
                    <th>Erros</th>
                    
                  </tr>
                </thead>
                <tbody>
                <?php
                    $control=0;
                    $array=array();
                    $participantes=array();
                    $aux=array();
                    $queryuser = "SELECT * FROM usuario WHERE usr_tipo!=5";
                    $resultuser = mysqli_query($conn, $queryuser);
                    $qtd = mysqli_num_rows($resultuser);
                    if ($resultuser->num_rows > 0) {
                      while($rowuser = $resultuser->fetch_assoc()){
                        $rowuser['rodada']=ultimaRodada();
                        $participantes[$control]=pontosGeraisRodada($rowuser);
                        $control++;
                      }
                    }
                    $control=0;
                    for($i=0;$i<count($participantes);$i++){
                      for($j=0;$j<count($participantes)-1;$j++){
                        if($participantes[$j+1]['pontos']<=$participantes[$j]['pontos']){
                          $aux=$participantes[$j];
                          $participantes[$j]=$participantes[$j+1];
                          $participantes[$j+1]=$aux;
                        }
                      }
                    }

                    for($i=0;$i<count($participantes);$i++){
                      for($j=0;$j<count($participantes)-1;$j++){
                        if($participantes[$j+1]['pontos']==$participantes[$j]['pontos']){
                          if($participantes[$j+1]['t']<=$participantes[$j]['t']){
                            $aux=$participantes[$j];
                            $participantes[$j]=$participantes[$j+1];
                            $participantes[$j+1]=$aux;
                          }
                        }
                      }
                    }

                    for($i=0;$i<count($participantes);$i++){
                      for($j=0;$j<count($participantes)-1;$j++){
                        if($participantes[$j+1]['pontos']==$participantes[$j]['pontos']){
                          if($participantes[$j+1]['t']==$participantes[$j]['t']){
                            if($participantes[$j+1]['p']<=$participantes[$j]['p']){
                              $aux=$participantes[$j];
                              $participantes[$j]=$participantes[$j+1];
                              $participantes[$j+1]=$aux;
                            }
                          }
                        }
                      }
                    }

                    for($i=0;$i<count($participantes);$i++){
                      for($j=0;$j<count($participantes)-1;$j++){
                        if($participantes[$j+1]['pontos']==$participantes[$j]['pontos']){
                          if($participantes[$j+1]['t']==$participantes[$j]['t']){
                            if($participantes[$j+1]['p']==$participantes[$j]['p']){
                              if($participantes[$j+1]['e']>=$participantes[$j]['e']){
                                $aux=$participantes[$j];
                                $participantes[$j]=$participantes[$j+1];
                                $participantes[$j+1]=$aux;
                              }
                            }
                          }
                        }
                      }
                    }

                    $p=1;
                    for($i=count($participantes)-1;$i>=0;$i--){
                      echo '
                        <tr>
                          <td>'.$p.'</td>
                          <td><strong class="text-white">'.$participantes[$i]['usr_nomeFull'].'</strong></td>
                          <td><strong class="text-white">'.$participantes[$i]['pontos'].'</strong></td>
                          <td>'.$participantes[$i]['t'].'</td>
                          <td>'.$participantes[$i]['p'].'</td>
                          <td>'.$participantes[$i]['e'].'</td>
                        </tr>
                      ';
                      $p++;
                    }

                  ?>
                </tbody>
              </table>
            </div>

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