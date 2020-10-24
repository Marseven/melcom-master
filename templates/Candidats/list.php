<div class="header-page-title our-agents-header">
    <div class="title-overlay"></div>
    <div class="container">
        <div class="title-breadcrumb clearfix">
            <h1>Les candidats</h1>

            <ol class="breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'index']) ?>">Accueil</a></li>
                <li class="active">Les candidats</li>
            </ol>
        </div> <!-- end .title-breadcrumb -->

    </div> <!-- end .container -->
</div> <!-- end .header-nav-bar -->

<div id="page-content" class="agent-profile">
    <div class="container">
        <div class="page-content mt60">
            <div class="row">

                <div class="col-md-12">
                    <div class="main-content">
                        <div class="view-sort">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="add-new-client">
                                        <a class="btn btn-green" href="<?= $this->Url->build(['controller' => 'Candidats', 'action' => 'add']) ?>"><i class="fa fa-plus"></i>Ajouter</a>
                                    </div>
                                </div>

                            </div> <!-- end .row -->
                        </div> <!-- end .view-sort div -->
                        <hr>

                        <div class="table-responsive-small">

                            <div class="clients-list">

                                <div class="table-heading">
                                    <div class="css-table">

                                        <div class="table-details css-table-cell">
                                            <h5>Candidats</h5>
                                        </div>

                                        <div class="clients-job css-table-cell">
                                            <h5>Action</h5>
                                        </div>

                                    </div> <!-- end .css-table -->
                                </div> <!-- end .table-heading -->

                                <?php foreach($candidats as $candidat){ ?>
                                    <div class="clients-job-single">
                                        <div class="css-table">

                                            <div class="company-logo-area css-table-cell">
                                                <img src="../img/candidat/<?= $candidat->image ?>" alt="">
                                            </div> <!-- end .company-logo-area -->

                                            <div class="table-details css-table-cell">

                                                <div class="company-name">
                                                    <h4><a href="<?= $this->Url->build(['controller' => 'Candidats', 'action' => 'view', $candidat->id]) ?>"><?= $candidat->nom ?></a></h4>
                                                </div> <!-- end .company-name -->

                                                <div class="company-description">
                                                    <h4>
                                                    <?php $competences = explode(',', $candidat->competences);
                                                    foreach($competences as $competence){
                                                        ?>
                                                        <a href="#"><?= $competence ?>, </a>
                                                    <?php } ?>
                                                   <a href="#"><?= $candidat->secteur ?></h4>
                                                </div> <!-- end .job-description -->

                                                <div class="job-location-stat">
                                                    <p><a href="#"><i class="fa fa-map-marker"></i><?= $candidat->adresse ?></a></p>

                                                    <ul class="list-inline pull-right">
                                                        <li>Tel: <strong><?= $candidat->telephone ?></strong></li>
                                                        <li>Email: <strong><?= $candidat->email ?></strong></li>
                                                        <li>Facebook: <strong><?= $candidat->facebook ?></strong></li>
                                                    </ul>
                                                </div> <!-- end .job-location-stat -->
                                            </div> <!-- end .table-details -->

                                            <div class="clients-job css-table-cell">
                                                <a href="<?= $this->Url->build(['controller' => 'Candidats', 'action' => 'edit', $candidat->id]) ?>" class="btn btn-default">Modifier</a><br><br>
                                                <a href="<?= $this->Url->build(['controller' => 'Candidats', 'action' => 'delete', $candidat->id]) ?>" onclick="return confirm('Êtes-vous sûr de voulir supprimer cette candidature');" class="btn btn-black">Supprimer</a>
                                            </div> <!-- end .days-left -->

                                        </div> <!-- end .css-table -->
                                    </div> <!-- end .clients-job-single -->
                                <?php } ?>

                                <?php if(count($candidats) == 0){ ?>
                                    <h3 style="text-align: center;">Aucune candidature pour le moment !</h3>
                                <?php } ?>

                            </div> <!-- end .assigned-job-list -->

                        </div>

                        <div class="pagination-content clearfix pb20">
                            <p><?= $this->Paginator->counter() ?></p>

                            <nav>
                                <ul class="list-inline">
                                    <li><?= $this->Paginator->first('Prem »') ?></li>
                                    <li><?= $this->Paginator->prev('« Prec') ?></li>
                                    <li class="active"><?= $this->Paginator->numbers() ?></li>
                                    <li><?= $this->Paginator->next('Sui »') ?></li>
                                    <li><?= $this->Paginator->last('Dern »') ?></li>
                                </ul>
                            </nav>
                        </div> <!-- end .pagination -->

                    </div> <!-- end .main-content -->
                </div> <!-- end 9th grid layout -->
            </div> <!-- end .row -->
        </div> <!-- end container -->
    </div> <!-- end .page-content -->
</div> <!-- end #page-content -->
