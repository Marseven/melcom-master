<div class="header-page-title our-agents-header">
    <div class="title-overlay"></div>
    <div class="container">
        <div class="title-breadcrumb clearfix">
            <h1><?= $annonce->titre ?></h1>

            <ol class="breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'index']) ?>">Accueil</a></li>
                <li class="active">Annonce</li>
            </ol>
        </div> <!-- end .title-breadcrumb -->

    </div> <!-- end .container -->
</div> <!-- end .header-nav-bar -->

<div id="page-content" class="candidate-profile">
        <div class="container">
          <div class="page-content mt50">

            <div class="row">
              <div class="col-md-4">
                <div class="motijob-sidebar">
                <div class="candidate-profile-picture">
                  <?= $this->Html->image('annonce/'.$annonce->image, ['fullBase' => true]) ?>

                  <a href="#" class="job-name"><?= $annonce->titre ?></a>
                </div> <!-- end .agent-profile-picture -->

                <div class="job-general-info">
                  <div class="title">
                    <h6>Détails de l'annonce</h6>
                  </div> <!-- end .end .title -->

                  <ul class="list-unstyled job-regi-preview">
                    <li><strong>Secteur :</strong><?= $annonce->categories[0]->libelle ?></li>
                    <li><strong>Ville :</strong><?= $annonce->ville ?></li>
                    <li><strong>Statut :</strong><?= $annonce->statut ?></li>
                    <li><strong>Type de contrat :</strong><?= $annonce->type ?></li>
                    <li><strong>Durée :</strong><?= $annonce->duree ?></li>
                    <li><strong>Expérience :</strong><?= $annonce->experience ?> an(s)</li>

                  </ul>

                  <!-- social link -->



                </div> <!-- end .candidate-general-info -->
              </div>
              </div> <!-- end .3col grid layout -->

              <div class="col-md-8">
                <div class="candidate-description">

                  <div class="language-print text-right">
                  </div> <!-- end .language-print -->

                  <div class="candidate-details">
                    <div class="candidate-title">
                      <h5>Description</h5>
                    </div>

                    <div class="videoWrapper">
                      <?= $this->Html->image('annonce/'.$annonce->image, ['fullBase' => true, 'width'=> "560", 'height' => "auto"]) ?>
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

                    </div> <!-- end .candidate-skills -->

                  </div> <!-- end .candidate-details -->



                </div> <!-- end .candidate-description -->

                <ul class="list-inline job-preview-social-link mt20">
                  <li class="share">PTGR:</li>
                  <li class="facebook-color"><a href="#"><i class="fa fa-facebook"></i></a></li>
                  <li class="twitt-color"><a href="#"><i class="fa fa-twitter"></i></a></li>
                </ul>

              </div> <!-- end .9col grid layout -->

            </div> <!-- end .row -->

          </div> <!-- end .page-content -->
        </div> <!-- end .container -->
      </div> <!-- end #page-content -->
