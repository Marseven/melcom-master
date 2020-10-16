<div class="header-page-title our-agents-header">
    <div class="title-overlay"></div>
    <div class="container">
        <div class="title-breadcrumb clearfix">
            <h1>Les candidats</h1>

            <ol class="breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'index']) ?>">Accueil</a></li>
                <li class="active">Les candidtas</li>
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
                  <div class="widget sidebar-widget jobs-search-widget">
                    <h5 class="widget-title">Recheche</h5>
                  </div>
                </div>
              </aside>
            </div> <!-- end .page-sidebar -->

            <div class="col-sm-8 page-content">

            <?php foreach($candidats as $candidat){ ?>
              <div class="candidate-description client-description applicants-content">

                <div class="language-print client-des clearfix">
                  <div class="aplicants-pic pull-left">
                    <img src="img/candidat/<?= $candidat->image ?>" alt="">
                  </div>
                  <!-- end .aplicants-pic -->
                  <div class="clearfix">
                    <div class="pull-left">
                      <h5><?= $candidat->nom ?></h5>
                      <a> <i class="fa fa-map-marker"></i> <?= $candidat->adresse ?></a>
                    </div>

                  </div>

                  <div class="aplicant-details-show clearfix">
                    <ul class="list-unstyled pull-left">
                      <li><span>Expériences :</span></li>
                        <?php $experiences = explode(';', $candidat->experiences);
                            foreach($experiences as $experience){
                        ?>
                            <li><span><b class="aplicant-detail"><?= $experience ?></b></span></li>
                        <?php } ?>
                    </ul>

                    <ul class="list-unstyled pull-left">
                        <li><span>Formations :</span></li>
                        <?php $formations = explode(';', $candidat->formations);
                            foreach($formations as $formation){
                        ?>
                            <li><span><b class="aplicant-detail"><?= $formation ?></b></span></li>
                        <?php } ?>
                    </ul>

                    <ul class="list-unstyled pull-left">
                        <li><span>Expériences Bénévoles :</span></li>
                        <?php $organisations = explode(';', $candidat->organisations);
                            foreach($organisations as $organisation){
                        ?>
                            <li><span><b class="aplicant-detail"><?= $organisation ?></b></span></li>
                        <?php } ?>
                    </ul>

                  </div>
                  <!-- end .aplicant-details-show -->
                </div> <!-- end .language-print -->

                <div class="candidate-details">

                  <div class="toggle-content-client">
                    <div class="candidate-title">
                      <h5>Salut, mon nom est <span><?= $candidat->nom ?></span></h5>
                    </div>

                    <p><?= $candidat->description ?></p>

                    <div class="additional-skills">
                    <div class="candidate-title mt40">
                        <h5>Les Compétences</h5>
                    </div>

                    <ul class="list-inline">
                        <?php $competences = explode(',', $candidat->competences);
                            foreach($competences as $competence){
                        ?>
                            <li><a href="#"><?= $competence ?></a></li>
                        <?php } ?>
                    </ul>
                    </div> <!-- end .addintional-skills -->

                    <div class="apply-share clearfix">

                    </div>
                    <!-- end .apply-share -->
                  </div>
                  <!-- end .toggle-content-client -->


                  <div class="toggle-details text-right">
                    <a class="btn btn-toggle" href="#">Info</a>

                    <a class="btn btn-default" href="#">Contacter le Candidat</a>

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
          </div>
        </div> <!-- end .container -->
      </div> <!-- end #page-content -->
