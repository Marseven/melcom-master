<div class="header-page-title our-agents-header">
    <div class="title-overlay"></div>
    <div class="container">
        <div class="title-breadcrumb clearfix">
            <h1><?= $entreprise->nom ?></h1>

            <ol class="breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'index']) ?>">Accueil</a></li>
                <li class="active">Les annonces</li>
            </ol>
        </div> <!-- end .title-breadcrumb -->

    </div> <!-- end .container -->
</div> <!-- end .header-nav-bar -->

<div id="page-content" class="page-content pt60">
        <div class="container">
          <div class="row">

            <div class="col-sm-8 page-content">

            <?php foreach($annonces as $annonce) { ?>
              <div class="candidate-description client-description applicants-content">

                <div class="language-print client-des clearfix">
                  <div class="aplicants-pic pull-left">
                      <?= $this->Html->image('entreprise/'.$annonce->entreprise->image, ['fullBase' => true]) ?>
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

            <?php if(count($annonces) == 0){ ?>
                <h3 style="text-align: center;">Aucune candidature pour le moment !</h3>
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
          </div>
        </div> <!-- end .container -->
      </div> <!-- end #page-content -->
