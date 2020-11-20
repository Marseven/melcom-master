<div class="header-page-title our-agents-header">
    <div class="title-overlay"></div>
    <div class="container">
        <div class="title-breadcrumb clearfix">
            <h1>Recherche</h1>

            <ol class="breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Rh', 'action' => 'index']) ?>">Accueil</a></li>
                <li class="active">Recherche</li>
            </ol>
        </div> <!-- end .title-breadcrumb -->

    </div> <!-- end .container -->
</div> <!-- end .header-nav-bar -->

<div id="page-content" class="agent-profile">
        <div class="container">
          <div class="page-content mt60">
            <div class="row">

            <div class="col-sm-12 page-content">
              <div class="view-sort clearfix mb20">
                <div class="row">

                  <div class="col-sm-5 main-title">
                    <h3 class="client-registration-title">Les Annonces</h3>
                  </div>

                </div> <!-- end .row -->
              </div> <!-- end .view-sort div -->

            <?php foreach($annonces as $annonce) { ?>
              <div class="candidate-description client-description applicants-content">

                <div class="language-print client-des clearfix">
                  <div class="aplicants-pic pull-left">
                    <img src="img/entreprise/<?= $annonce->entreprise->image ?>" alt="">
                  </div>
                  <!-- end .aplicants-pic -->
                  <div class="clearfix">
                    <div class="pull-left">
                      <h5><?= $annonce->titre ?></h5>
                      <a href="#"><?= $annonce->categories[0]->libelle ?> | <?= $annonce->entreprise->nom ?></a>
                    </div>
                  </div>

                  <div class="aplicant-details-show clearfix">
                    <p><a href="#"><i class="fa fa-map-marker"></i> <?= $annonce->ville ?> | <?= $annonce->statut ?></a></p>
                    <p>Type de contrat : <strong><?= $annonce->type ?></strong> | Durée : <strong><?= $annonce->duree ?></strong> | Expérience : <strong><?= $annonce->experience ?></strong> an(s)</p>
                  </div>
                  <!-- end .aplicant-details-show -->
                </div> <!-- end .language-print -->

                <div class="candidate-details">

                  <div class="toggle-content-client">
                    <div class="candidate-title">
                      <h5>Description</h5>
                    </div>

                    <p><?= $annonce->description ?></p>

                    <div class="additional-skills">
                        <div class="candidate-title mt40">
                            <h5>Les Compétences Requises</h5>
                        </div>

                        <ul class="list-inline">
                            <?php $competences = explode(',', $annonce->competences);
                                foreach($competences as $competence){
                            ?>
                            <li><a href="#"><?= $competence ?></a></li>
                            <?php } ?>
                        </ul>
                    </div> <!-- end .addintional-skills -->

                    <div class="apply-share clearfix">
                      <ul class="list-inline pull-left job-preview-social-link ">
                        <li class="share">Share:</li>
                        <li class="facebook-color"><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li class="twitt-color"><a href="#"><i class="fa fa-twitter"></i></a></li>
                      </ul>
                    </div>
                    <!-- end .apply-share -->
                  </div>
                  <!-- end .toggle-content-client -->


                  <div class="toggle-details text-right">
                    <a class="btn btn-toggle" href="#">Info</a>
                  </div>
                  <!-- end .toggle-details -->
                </div> <!-- end .candidate-details -->

              </div> <!-- end .candidate-description -->

            <?php } ?>

              <div class="pagination-content clearfix">
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
              </div>

            </div> <!-- end .page-content -->
            </div> <!-- end .row -->


            <div class="row">

              <div class="col-md-12">
                <div class="main-content">

                    <div class="view-sort clearfix mb20">
                    <div class="row">

                        <div class="col-sm-7 main-title">
                        <h4 class="client-registration-title">Les Entreprises</h4>
                        </div>

                    </div> <!-- end .row -->
                    </div> <!-- end .view-sort div -->

                  <div class="table-responsive-small">

                    <div class="clients-list">

                      <div class="table-heading">
                        <div class="css-table">

                          <div class="table-details css-table-cell">
                            <h5>Entreprises</h5>
                          </div>

                          <div class="clients-job css-table-cell">
                            <h5>Annonces</h5>
                          </div>

                        </div> <!-- end .css-table -->
                      </div> <!-- end .table-heading -->

                    <?php foreach($entreprises as $entreprise){ ?>
                      <div class="clients-job-single">
                        <div class="css-table">

                          <div class="company-logo-area css-table-cell">
                            <img src="img/entreprise/<?= $entreprise->image ?>" alt="">
                          </div> <!-- end .company-logo-area -->

                          <div class="table-details css-table-cell">

                            <div class="company-name">
                              <h4><a href="#"><?= $entreprise->nom ?></a></h4>
                            </div> <!-- end .company-name -->

                            <div class="company-description">
                              <h4><a href="#"><?= $entreprise->secteur ?></a></h4>
                            </div> <!-- end .job-description -->

                            <div class="job-location-stat">
                              <p><a href="#"><i class="fa fa-map-marker"></i><?= $entreprise->adresse ?></a></p>

                              <ul class="list-inline pull-right">
                                <li>Contact: <strong><?= $entreprise->referent ?></strong></li>
                                <li>Tel: <strong><?= $entreprise->telephone ?></strong></li>
                                <li>Email: <strong><?= $entreprise->email ?></strong></li>
                              </ul>
                            </div> <!-- end .job-location-stat -->
                          </div> <!-- end .table-details -->

                          <div class="clients-job css-table-cell">
                            <h4><a href="#"><?= count($entreprise->annonces) ?> </a></h4>
                          </div> <!-- end .days-left -->

                        </div> <!-- end .css-table -->
                      </div> <!-- end .clients-job-single -->
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
