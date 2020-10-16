<div class="header-page-title our-agents-header">
    <div class="title-overlay"></div>
    <div class="container">
        <div class="title-breadcrumb clearfix">
            <h1>Tableau de Bord</h1>

            <ol class="breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'index']) ?>">Accueil</a></li>
                <li class="active">Tableau de Bord</li>
            </ol>
        </div> <!-- end .title-breadcrumb -->

    </div> <!-- end .container -->
</div> <!-- end .header-nav-bar -->

<div id="page-content">
    <div class="container">
        <div class="page-content">
            <br><br><br>
            <div class="agents-details">

                <div class="row">

                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div style="min-height: 40px;" class="agent-single">

                            <ul>
                                <li><span class="title">Entreprises :</span><span class="title-des text-capitalize"><?= count($entreprises) ?></span></li>
                            </ul>

                            <div class="view-profile">
                                <a href="<?= $this->Url->build(['controller' => 'Entreprises', 'action' => 'list']) ?>" class="btn btn-default">Voir Plus</a>
                            </div>
                        </div> <!-- end .agent-single  -->
                    </div> <!-- end grid layout  -->

                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div style="min-height: 40px;" class="agent-single">

                            <ul>
                                <li><span class="title">Annonces :</span><span class="title-des text-capitalize"><?= count($annonces) ?></span></li>
                            </ul>

                            <div class="view-profile">
                                <a href="<?= $this->Url->build(['controller' => 'Annonces', 'action' => 'list']) ?>" class="btn btn-default">Voir Plus</a>
                            </div>
                        </div> <!-- end .agent-single  -->
                    </div> <!-- end grid layout  -->

                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div style="min-height: 40px;" class="agent-single">

                            <ul>
                                <li><span class="title">Candidats :</span><span class="title-des text-capitalize"><?= count($candidats) ?></span></li>
                            </ul>

                            <div class="view-profile">
                                <a href="<?= $this->Url->build(['controller' => 'Candidats', 'action' => 'list']) ?>" class="btn btn-default">Voir Plus</a>
                            </div>
                        </div> <!-- end .agent-single  -->
                    </div> <!-- end grid layout  -->

                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div style="min-height: 40px;" class="agent-single">

                            <ul>
                                <li><span class="title">Catégories :</span><span class="title-des text-capitalize"><?= count($categories) ?></span></li>
                            </ul>

                            <div class="view-profile">
                                <a href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'index']) ?>" class="btn btn-default">Voir Plus</a>
                            </div>
                        </div> <!-- end .agent-single  -->
                    </div> <!-- end grid layout  -->

                    <div class="col-md-3 col-sm-4 col-xs-6">
                        <div style="min-height: 40px;" class="agent-single">

                            <ul>
                                <li><span class="title">Utilisateurs :</span><span class="title-des text-capitalize"><?= count($users) ?></span></li>
                            </ul>

                            <div class="view-profile">
                                <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'list']) ?>" class="btn btn-default">Voir Plus</a>
                            </div>
                        </div> <!-- end .agent-single  -->
                    </div> <!-- end grid layout  -->

                </div> <!-- end .row -->

            </div> <!-- end .agents-details -->
        </div> <!-- end container -->
    </div> <!-- end .page-content -->

</div> <!-- end #page-content -->
