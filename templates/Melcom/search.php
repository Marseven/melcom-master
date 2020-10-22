<div class="header-page-title our-agents-header">
    <div class="title-overlay"></div>
    <div class="container">
        <div class="title-breadcrumb clearfix">
            <h1>Recherche</h1>

            <ol class="breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'index']) ?>">Accueil</a></li>
                <li class="active">Recherche</li>
            </ol>
        </div> <!-- end .title-breadcrumb -->

    </div> <!-- end .container -->
</div> <!-- end .header-nav-bar -->

<div id="page-content" class="page-content pt60">
        <div class="container">
          <div class="row">
            <div class="col-sm-4 page-sidebar">
              <aside>
                <div class="white-container mb0">
                  <div class="widget sidebar-widget jobs-filter-widget">
                    <h5 class="widget-title">Catégories</h5>

                    <div class="widget-content">
                      <div>
                        <ul class="filter-list">
                            <?php foreach($categories as $cat){ ?>
                                <li><a href="#"><?= $cat->libelle ?> <span>(<?= count($cat->annonces) ?>)</span></a></li>
                            <?php } ?>
                        </ul>
                        <a href="#" class="toggle"></a>
                      </div>

                    </div>
                  </div>
                </div>
              </aside>
            </div> <!-- end .page-sidebar -->

            <div class="col-sm-8 page-content">
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
                        <li class="share">PTGR:</li>
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

            </div> <!-- end .page-content -->
          </div>
        </div> <!-- end .container -->
      </div> <!-- end #page-content -->
