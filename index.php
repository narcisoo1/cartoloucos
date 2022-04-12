<?php
session_start();
include 'api/api.php';
$classificacao = json_decode(classificacao(true),true);
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


    <header class="site-navbar mt-4" role="banner">

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
                <li class="active"><a href="index.php" class="nav-link">Home</a></li>
                <li><a href="matches.php" class="nav-link">Partidas</a></li>
                <?php
                  if(isset($_SESSION["username"]) || isset($_SESSION["id_usuario"])){
                    echo '<li><a href="bolao.php" class="nav-link">Bolão</a></li>';
                  }
                ?>
                <li class="has-children">
                  <a>Classificação</a>
                  <ul class="dropdown">
                    <li><a href="teamPositions.php">Brasileirão</a></li>
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
                <!-- <li><a href="login.php" class="btn btn-primary border-width-2 d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Log In</a></li> -->
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
          <div class="col-lg-5 ml-auto">
            <h1 class="text-white">Início do bolão Cartoloucos</h1>
            <p>Seja bem vindo à família cartoloucos. Faça seu cadastro grátis e participe conosco desta brincadeira.</p>
            <div id="date-countdown"></div>
            <p>
              <a href="cadastro.php" class="btn btn-primary py-3 px-4 mr-3">Cadastro</a>
              <a href="login.php" class="more light">Login</a>
            </p>  
          </div>
        </div>
      </div>
    </div>

    
    
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          
          <div class="d-flex team-vs">
            <span class="score">2-0</span>
            <div class="team-1 w-50">
              <div class="team-details w-100 text-center">
                <img src="http://e.imguol.com/futebol/brasoes/100x100/atletico-mg.png" alt="Image" class="img-fluid">
                <h3>Atlético-MG <span>(loss)</span></h3>
              </div>
            </div>
            <div class="team-2 w-50">
              <div class="team-details w-100 text-center">
                <img src="http://e.imguol.com/futebol/brasoes/100x100/internacional.png" alt="Image" class="img-fluid">
                <h3>Internacional <span>(loss)</span></h3>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="site-section bg-dark">
      <div class="container">
        <div class="row">
        <div class="col-lg-6">
            <div class="widget-next-match">
              <div class="widget-title">
                <h3>Próxima Partida</h3>
              </div>
              <div class="widget-body mb-3">
                <div class="widget-vs">
                  <div class="d-flex align-items-center justify-content-around justify-content-between w-100">
                    <div class="team-1 text-center">
                      <img src="http://e.imguol.com/futebol/brasoes/60x60/flamengo.png" alt="Image">
                      <h3>Flamengo</h3>
                    </div>
                    <div>
                      <span class="vs"><span>VS</span></span>
                    </div>
                    <div class="team-2 text-center">
                      <img src="http://e.imguol.com/futebol/brasoes/60x60/sao-paulo.png" alt="Image">
                      <h3>São Paulo</h3>
                    </div>
                  </div>
                </div>
              </div>

              <div class="text-center widget-vs-contents mb-4">
                <h4>Brasileirão Série A</h4>
                <p class="mb-5">
                  <span class="d-block">Abril 17th, 2022</span>
                  <span class="d-block">16:00</span>
                  <strong class="text-primary">Maracanã</strong>
                </p>

                <div id="date-countdown2" class="pb-1"></div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            
            <div class="widget-next-match">
            <table class="table custom-table">
                <thead>
                  <tr>
                    <th>P</th>
                    <th>Team</th>
                    <th>V</th>
                    <th>E</th>
                    <th>D</th>
                    <th>PTS</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for($i=1;$i<=8;$i++){
                    echo '
                    <tr>
                      <td>'.$i.'</td>
                      <td><img src="'.json_decode(equipe(($classificacao[$i]['id'])),true)['brasao'].'" width="25px"/><strong class="text-white">'.json_decode(equipe(($classificacao[$i]['id'])),true)['nome-comum'].'</strong></td>
                      <td>'.$classificacao[$i]['v']['total'].'</td>
                      <td>'.$classificacao[$i]['e']['total'].'</td>
                      <td>'.$classificacao[$i]['d']['total'].'</td>
                      <td>'.$classificacao[$i]['pg']['total'].'</td>
                    </tr>';
                  }
                 
                  ?>
                </tbody>
              </table>
            </div>

          </div>
        </div>
      </div>
    </div> <!-- .site-section -->

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-6 title-section">
            <h2 class="heading">Videos</h2>
          </div>
          <div class="col-6 text-right">
            <div class="custom-nav">
            <a href="#" class="js-custom-prev-v2"><span class="icon-keyboard_arrow_left"></span></a>
            <span></span>
            <a href="#" class="js-custom-next-v2"><span class="icon-keyboard_arrow_right"></span></a>
            </div>
          </div>
        </div>


        <div class="owl-4-slider owl-carousel">
          <div class="item">
            <div class="video-media">
              <img src="images/img_01.png" alt="Image" class="img-fluid">
              <a href="https://www.youtube.com/watch?v=BtYoB_Oh6kQ&ab_channel=FLATV" class="d-flex play-button align-items-center" data-fancybox>
                <span class="icon mr-3">
                  <span class="icon-play"></span>
                </span>
                <div class="caption">
                  <h3 class="m-3">Flamengo de 2022, forte candidato ao título?</h3>
                </div>
              </a>
            </div>
          </div>
          <div class="item">
            <div class="video-media">
              <img src="images/img_02.png" alt="Image" class="img-fluid">
              <a href="https://youtu.be/7RRFrclBb34" class="d-flex play-button align-items-center" data-fancybox>
                <span class="icon mr-3">
                  <span class="icon-play"></span>
                </span>
                <div class="caption">
                  <h3 class="m-3">O Palmeiras ainda tem potencial de se equiparar ao Flamengo e o Galo?</h3>
                </div>
              </a>
            </div>
          </div>
          <div class="item">
            <div class="video-media">
              <img src="images/img_03.png" alt="Image" class="img-fluid">
              <a href="https://youtu.be/v4RPSw7Of3o" class="d-flex play-button align-items-center" data-fancybox>
                <span class="icon mr-3">
                  <span class="icon-play"></span>
                </span>
                <div class="caption">
                  <h3 class="m-3">Rumo à mais uma tríplice coroa, o clube tem força o suficiente?</h3>
                </div>
              </a>
            </div>
          </div>

          <div class="item">
            <div class="video-media">
              <img src="images/img_04.png" alt="Image" class="img-fluid">
              <a href="https://youtu.be/QOdx_qrDYBs" class="d-flex play-button align-items-center" data-fancybox>
                <span class="icon mr-3">
                  <span class="icon-play"></span>
                </span>
                <div class="caption">
                  <h3 class="m-3">Evolução dia a dia, seria o Corinthians de volta a glória?</h3>
                </div>
              </a>
            </div>
          </div>
          <div class="item">
            <div class="video-media">
              <img src="images/img_05.png" alt="Image" class="img-fluid">
              <a href="https://youtu.be/BE1fsXFwJb4" class="d-flex play-button align-items-center" data-fancybox>
                <span class="icon mr-3">
                  <span class="icon-play"></span>
                </span>
                <div class="caption">
                  <h3 class="m-3">O subestimado Internacional teria potencial para disputa?</h3>
                </div>
              </a>
            </div>
          </div>
          <div class="item">
            <div class="video-media">
              <img src="images/img_06.png" alt="Image" class="img-fluid">
              <a href="https://www.youtube.com/watch?v=BtYoB_Oh6kQ&ab_channel=FLATV" class="d-flex play-button align-items-center" data-fancybox>
                <span class="icon mr-3">
                  <span class="icon-play"></span>
                </span>
                <div class="caption">
                  <h3 class="m-3">O tímido Fluminense, tem capacidade de surpreender?</h3>
                </div>
              </a>
            </div>
          </div>

        </div>

      </div>

      </div>
    </div>

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