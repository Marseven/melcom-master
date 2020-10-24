<div class="header-page-title our-agents-header">
    <div class="title-overlay"></div>
    <div class="container">
        <div class="title-breadcrumb clearfix">
            <h1>Mes Candidatures</h1>

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
            <div class="col-sm-4 page-sidebar">
                <aside>
                    <div class="white-container mb0">
                        <div class="widget sidebar-widget jobs-search-widget">
                            <h5 class="widget-title">Recheche</h5>

                            <div class="widget-content">
                                <span class="search-tex">Je cherche ...</span>
                                <form action="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'search']) ?>" method="GET">
                                    <input type="text" required name="q" class="form-control mt10" placeholder="Mot Clé">
                                    <br>
                                    <select name="cat" required class="form-control mt10 mb10">
                                        <?php foreach($categories as $cat){ ?>
                                            <option value="<?= $cat->id ?>"><?= $cat->libelle ?></option>
                                        <?php } ?>
                                    </select>
                                    <span class="search-tex">à</span>
                                    <select name="ville" required class="form-control mt10 mb10">
                                        <option>Libreville</option>
                                        <option>Port-Gentil</option>
                                        <option>Franceville</option>
                                        <option>Oyem</option>
                                    </select>
                                    <br>
                                    <input type="submit" class="btn btn-default" value="Rechercher">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="white-container mb0">
                        <div class="widget sidebar-widget jobs-filter-widget">
                            <div class="widget-content">
                                <img src="" class="" >
                                <?= $this->Html->image('pub-v.png', ['fullBase' => true, 'width'=> "360", 'height' => "auto"]) ?>
                            </div>
                        </div>
                    </div>
                </aside>
            </div> <!-- end .page-sidebar -->

            <div class="col-sm-8 page-content">

                <div class="view-sort clearfix mb20">
                    <div class="row">

                        <div class="col-sm-7 main-title">
                            <h4 class="client-registration-title">Mes Candidatures</h4>
                        </div>

                    </div> <!-- end .row -->
                </div> <!-- end .view-sort div -->

                <?php foreach($candidats as $cdt){ ?>
                    <?php foreach($cdt->annonces as $annonce){ ?>
                        <div class="candidate-description client-description applicants-content">

                            <div class="language-print client-des clearfix">
                                <div class="aplicants-pic pull-left">
                                    <?= $this->Html->image('annonce/'.$annonce->image, ['fullBase' => true]) ?>
                                </div>
                                <!-- end .aplicants-pic -->
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h5><?= $annonce->titre ?></h5>
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
                <?php } ?>

                <?php if(count($candidats) == 0){ ?>
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
