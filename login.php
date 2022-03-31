<?php
session_start();
if(isset($_SESSION["username"]) || isset($_SESSION["id_usuario"])){
    header("Location: logout.php");
exit;
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

  <script type="text/javascript" charset="utf8" src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.3.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
  


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
                    echo '<li><a href="bolao.php" class="nav-link">Bolão</a></li>';
                  }
                ?>
                <li class="has-children">
                  <a>Classificação</a>
                  <ul class="dropdown">
                    <li><a href="teamPositions.html">Brasileirão</a></li>
                    <li><a href="playerPosition.html">Competidores</a></li>
                  </ul>
                </li>
                <li><a href="contact.php" class="nav-link">Contact</a></li>
                <li class="active"><a href="login.php" class="btn btn-dark border-width-2 d-lg-inline-block"><span class="mr-2 icon-lock_outline"></span>Log In</a></li>
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
          <div class="col-lg-9 mx-auto text-center">
            <h1 class="text-white">Login</h1>
            <div class="panel-body">
             <div class="site-section">
              <div class="container">
                <div class="row">
                  <div class="col-lg-9 mx-auto text-center">
                    <div <div class="col-lg-5 mx-auto text-center">
                      <div class="alert alert-danger" role="alert" id="error" style="display: none;">...</div>
                    </div>
                    <form id="login-form" name="login_form" role="form" style="display: block;" method="post">
                      <div class="form-group">
                      <input type="text" name="username" id="username" tabindex="1" class="form-controllogin" placeholder="Username">
                      </div>
                      <div class="form-group">
                      <input type="password" name="password" id="password" tabindex="2" class="form-controllogin" placeholder="Password"> 
                      </div>
                      <div class="form-group">     
                        <button type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-controllogin btn btn-primary">
                        <span class="spinner"><i class="icon-spin icon-refresh" id="spinner"></i></span> Log In</button>
                        <button type="button" onclick="location.href='cadastro.php';" name="cadastro" id="cadastro" tabindex="4" class="form-controllogin btn btn-primary">Cadastrar-se</button>
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
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

  <script type="text/javascript" src="libs/common.js"></script>


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