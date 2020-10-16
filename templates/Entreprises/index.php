<div class="header-page-title our-agents-header">
    <div class="title-overlay"></div>
    <div class="container">
        <div class="title-breadcrumb clearfix">
            <h1>Les entreprises</h1>

            <ol class="breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'index']) ?>">Accueil</a></li>
                <li class="active">Les entreprises</li>
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

                    <?php if(isset($user)){ ?>
                      <div class="col-sm-6">
                        <div class="add-new-client">
                          <a class="btn btn-green" href="<?= $this->Url->build(['controller' => 'Entreprises', 'action' => 'add']) ?>"><i class="fa fa-plus"></i>Ajouter</a>
                        </div>
                      </div>
                    <?php } ?>

                    </div> <!-- end .row -->
                  </div> <!-- end .view-sort div -->
                    <hr>
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

                              <!--ul class="list-inline pull-right">
                                <li>Contact: <strong><?= $entreprise->referent ?></strong></li>
                                <li>Tel: <strong><?= $entreprise->telephone ?></strong></li>
                                <li>Email: <strong><?= $entreprise->email ?></strong></li>
                              </ul-->
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
