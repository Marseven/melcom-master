<div class="header-page-title our-agents-header">
    <div class="title-overlay"></div>
    <div class="container">
        <div class="title-breadcrumb clearfix">
            <h1>A Propos</h1>

            <ol class="breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'index']) ?>">Accueil</a></li>
                <li class="active">A Propos</li>
            </ol>
        </div> <!-- end .title-breadcrumb -->

    </div> <!-- end .container -->
</div> <!-- end .header-nav-bar -->

<div id="page-content" class="candidate-profile client-bg-color">
    <div class="container">
        <div class="page-content">
            <div class="responsive-tabs dashboard-tabs">
                <hr>
                <div class="tab-pane" id="client-profile">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="motijob-sidebar">
                                    <div class="candidate-profile-picture">
                                        <img src="img/content/client-profile-logo.jpg" alt="">
                                        <?= $this->Html->image('logo-melcom.png', ['fullBase' => true]) ?>

                                        <a href="#">RH</a>
                                    </div> <!-- end .agent-profile-picture -->

                                    <div class="client-profile-deatils">
                                        <div class="title clearfix">
                                            <h6>Nos Infos</h6>
                                        </div> <!-- end .end .title -->

                                        <div class="client-sidebar-area">
                                            <h5>Specialties</h5>
                                            <p>RH est une agence de communication marketing, de placement du personnel et stage, nous faisons a votre place les démarches de recherche d'emploi ou de stage, et vous proposons le meilleur personnel.
                                            </p>

                                            <h5>Domine</h5>
                                            <p>Communication, Marketing et Ressources Humaines</p>

                                            <h5>Bureaux</h5>
                                            <p>318, Rue Luc Marc Ivanga, Montagne-Sainte, Libreville, Gabon</p>

                                        </div>
                                        <!-- end .client-sidebar-area -->

                                        <div class="title clearfix">
                                            <h6>Contactez Nous</h6>
                                        </div> <!-- end .end .title -->

                                        <div class="client-sidebar-area">
                                            <h5>Website</h5>
                                            <p>https://www.rh.com</p>

                                            <h5>Téléphone</h5>
                                            <p>+241 74 36 63 11</p>

                                            <h5>Email</h5>
                                            <p>rh@gmail.com</p>
                                        </div>
                                        <!-- end .client-sidebar-area -->

                                    </div> <!-- end .cient-sidebar-info -->
                                </div>
                            </div> <!-- end .3col grid layout -->

                            <div class="col-md-8">
                                <div class="candidate-description client-description mb30">

                                    <div class="language-print text-right">
                                        <ul class="list-inline">
                                            <li class="print"><a href="#"><i class="fa fa-print"></i></a></li>
                                            <li class="star-rating"><a href="#"><i class="fa fa-star"></i></a></li>
                                        </ul>
                                    </div> <!-- end .language-print -->

                                    <div class="candidate-details">
                                        <div class="candidate-title">
                                            <h5>A Propos de RH</h5>
                                        </div>

                                        <p> est une agence de communication marketing, de placement du personnel et stage, nous faisons a votre place les démarches de recherche d'emploi ou de stage, et vous proposons le meilleur personnel.
                                            </p>

                                    </div> <!-- end .candidate-details -->

                                </div> <!-- end .candidate-description -->

                            </div> <!-- end .9col grid layout -->

                        </div> <!-- end .row -->
                    </div> <!-- end .tabe pane -->

            </div> <!-- end .responsive-tabs.dashboard-tabs -->

        </div> <!-- end .page-content -->
    </div> <!-- end .container -->
</div> <!-- end #page-content -->
