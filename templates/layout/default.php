<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->fetch('meta') ?>

    <!-- Stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600" rel="stylesheet">

    <?= $this->Html->css(['bootstrap', 'font-awesome.min', 'jquery.tagsinput', 'owl.carousel', 'styles', 'responsive']) ?>

    <?= $this->fetch('css') ?>

    <!--[if IE 9]>
    <script src="js/media.match.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div id="main-wrapper" class="our-agents-content">

      <!-- HEADER -->
      <header id="header">
        <div class="header-top-bar">

          <!--
          HEADER TOP BAR WITH NOTIFICATION FOR REGISTER USER
          -->

          <div class="header-notification-bar" style="display:none;">
            <div class="register-user">
              <div class="container">
                <div class="row">
                  <div class="col-md-3 col-sm-3">
                    <div class="logo-section">
                        <a href="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'index']) ?>"><?= $this->Html->image('logo-melcom.png', ['fullBase' => true]) ?></a>
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-5">
                    <div class="search-form">
                        <form action="<?= $this->Url->build(['controller' => 'Search', 'action' => 'index']) ?>" method="GET">
                            <button type='reset' class="dropdown-search"><i class="fa fa-bars"></i></button>
                            <input name='q' type="search" placeholder="Rechercher..." class="topbar-search-input">
                            <button type='submit' class="search-button"><i class="fa fa-search"></i></button>
                        </form>

                    </div>
                  </div>

                  <div class="col-md-3 col-sm-4">

                  </div>

                </div> <!-- end .row -->
              </div> <!-- end .container -->
            </div> <!-- end .register-user -->
          </div> <!-- end. header-notification-bar  -->

          <!--
          END HEADER NOTIFICATION TOP BAR
          -->

          <!--
          HEADER TOP BAR FOR NON REGISTER USER
          -->

          <div class="header-notification-bar">
            <div class="non-register-user">

              <div class="container">
                <div class="row">

                  <div class="col-md-3 col-sm-3">
                    <div class="logo-section">
                      <a href="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'index']) ?>"><?= $this->Html->image('logo-melcom.png', ['fullBase' => true]) ?></a>
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-5">
                    <div class="search-form">

                      <form action="<?= $this->Url->build(['controller' => 'Search', 'action' => 'index']) ?>" method="GET">
                        <button type='reset' class="dropdown-search"><i class="fa fa-bars"></i></button>
                        <input name='q' type="search" placeholder="Rechercher..." class="topbar-search-input">
                        <button type='submit' class="search-button"><i class="fa fa-search"></i></button>
                      </form>

                    </div>
                  </div>

                  <div class="col-md-3 col-sm-4">
                    <div class="notification-section text-right">

                      <ul class="list-inline">
                        <?php if(isset($user) && $user->id != null && $user->role == 'Admin'){ ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $user->nom ?> <?= $user->prenom ?>
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'index']) ?>">Tableau de Bord</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Entreprises', 'action' => 'list']) ?>">Liste des entreprises</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Candidats', 'action' => 'list']) ?>">Liste des Candidats</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Annonces', 'action' => 'list']) ?>">Liste des annonces</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'index']) ?>">Liste des catégories</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">Déconnexion</a></li>
                                </ul>
                            </li>
                        <?php }elseif(isset($user) && $user->id != null && $user->role != 'Admin'){ ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $user->nom ?> <?= $user->prenom ?>
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'resetPassword']) ?>">Réinitialiser le Mot de passe</a></li>
                                    <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'logout']) ?>">Déconnexion</a></li>
                                </ul>
                            </li>
                        <?php }else{ ?>
                          <li><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>">Connexion</a></li>
                          <?php } ?>
                      </ul>
                    </div>
                  </div>

                </div> <!-- end .row -->
              </div> <!-- end .container -->
            </div> <!-- end .visitors-top-bar -->
          </div> <!-- end. header-notification-bar  -->


          <!--
          END HEADER TOP BAR FOR WITHOUT LOGIN USER
          -->

          <!-- Navigation -->
          <div class="main-navbar">

            <nav class="navbar navbar-default">
              <div class="container">

                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'index']) ?>"><?= $this->Html->image('logo-melcom.png', ['style' => 'width:50%; heigth:auto;','fullBase' => true]) ?></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                  <ul class="nav navbar-nav">
                    <li class="<?= $home ?>"><a href="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'index']) ?>">Accueil</a></li>
                    <li class="<?= $about ?>"><a href="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'apropos']) ?>">À Propos</a></li>
                    <li class="dropdown <?= $ance ?>">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Annonces
                        <span class="caret"></span></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?= $this->Url->build(['controller' => 'Annonces', 'action' => 'index']) ?>">Liste des Annonces</a></li>
                          <?php if(isset($user) && $user->id != null && $user->role == 'Admin'){ ?>
                            <li><a href="<?= $this->Url->build(['controller' => 'Candidats', 'action' => 'index']) ?>">Liste des Candidats</a></li>
                          <?php } ?>
                        <li><a href="<?= $this->Url->build(['controller' => 'Entreprises', 'action' => 'index']) ?>">Entreprises Partenaires</a></li>
                      </ul>
                    </li>

                      <?php if(!isset($user) || (isset($user) && $user->role != 'Entreprise')){ ?>
                        <li class="<?= $postuler ?>"><a href="<?= $this->Url->build(['controller' => 'Candidats', 'action' => 'add']) ?>">Postuler</a></li>
                      <?php } ?>

                      <?php if(isset($user) && $user->id != null && $user->role == 'Candidat'){ ?>
                          <li class="dropdown <?= $ance ?>">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Candidat
                                  <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                  <li><a href="<?= $this->Url->build(['controller' => 'Candidats', 'action' => 'annonceByCandidat', $user->candidats[0]->id]) ?>">Mes Candidatures</a></li>
                              </ul>
                          </li>
                      <?php } ?>

                      <?php if(isset($user) && $user->id != null && $user->role == 'Entreprise'){ ?>
                          <li class="dropdown <?= $ance ?>">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Entreprise
                                  <span class="caret"></span></a>
                              <ul class="dropdown-menu">
                                  <li><a href="<?= $this->Url->build(['controller' => 'Entreprises', 'action' => 'annonceByEntreprise', $user->entreprises[0]->id]) ?>">Les Annonces</a></li>
                                  <li><a href="<?= $this->Url->build(['controller' => 'Entreprises', 'action' => 'candidatByAnnonce', $user->entreprises[0]->id]) ?>">Les Candidats</a></li>
                              </ul>
                          </li>
                      <?php } ?>

                      <li class="<?= $contacter ?>"><a href="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'contact']) ?>">Contact</a></li>

                  </ul>

                </div><!-- /.navbar-collapse -->
              </div><!-- /.container -->
            </nav>
          </div> <!-- main-navbar -->
          <!-- end .header-top-bar -->
        </div>


      </header>
      <!-- end #header -->

      <!-- header Search bar -->

      <!-- end .header-banner -->

      <?= $this->Flash->render() ?>
      <?= $this->fetch('content') ?>

      <!-- Footer Start -->
      <footer id="footer">
        <div class="copyright">
          <div class="container">
            <p>2020 Mel Com &copy; Tout Droits Réservés. Développé par  <a href="#">Mel Com</a></p>

            <ul class="list-inline">
              <li><a href="#"><i class="fa fa-facebook"></i></a></li>
              <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
            </ul>
          </div>
        </div>
      </footer>
      <!-- end #footer -->

    </div>
    <!-- end #main-wrapper -->

    <!-- Scripts -->
    <?= $this->Html->script(['jquery-3.1.1.min', 'bootstrap', 'jquery.tagsinput', 'jquery.ba-outside-events.min', 'jquery.responsive-tabs', 'jquery.flexslider-min',
      'jquery.fitvids', 'jquery-ui-1.10.4.custom.min', 'jquery.inview.min', 'jquery-ui-1.10.4.custom.min', 'owl.carousel.min', 'scripts']) ?>

      <?= $this->fetch('script') ?>
    </body>

</html>
