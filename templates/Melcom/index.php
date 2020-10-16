<div id="page-content" class="page-content pt60">
    <div class="container">
        <div class="row">

            <div class="col-sm-8 page-content">

                <h2 style="text-align: center">Trouver l'emploi qui vous correspond !</h2>

                <hr>

                <div id="header-search">
                    <div class="header-search-bar">
                        <div class="">
                            <form action="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'search']) ?>" method="GET">
                                <div class="basic-form clearfix">
                                    <div class="hsb-input-1">
                                        <input name="q" type="text" class="form-control" placeholder="Mots Clés" required>
                                    </div>
                                    <div class="hsb-container">
                                        <div class="hsb-input-2">
                                            <select name="ville" class="form-control" required>
                                                <option value="0">Selectionnez une Ville</option>
                                                <option value="">Libreville</option>
                                                <option value="">Port-Gentil</option>
                                                <option value="">Franceville</option>
                                                <option value="">Oyem</option>
                                            </select>
                                        </div>
                                        <div class="hsb-select">
                                            <select name="cat" class="form-control" required>
                                                <option value="0">Selectionnez une catégorie</option>
                                                <?php foreach($categories as $cat){ ?>
                                                    <option value="<?= $cat->id_categorie ?>"><?= $cat->libelle ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="hsb-submit">
                                        <button type="submit" class="btn btn-default btn-block"><i style="margin: 5px;" class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <hr>

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

            <div class="col-sm-4 page-sidebar">
                <aside>
                    <div class="white-container mb0">
                        <div class="widget sidebar-widget jobs-filter-widget">
                            <h5 class="widget-title">Catégories</h5>

                            <div class="widget-content">
                                <div>
                                    <ul class="filter-list">
                                        <?php foreach($categories as $cat){ ?>
                                            <li><a href="<?= $this->Url->build(['controller' => 'Search', 'action' => 'annonceByCategory', $cat->id_categorie])?>"><?= $cat->libelle ?> <span>(<?= count($cat->annonces) ?>)</span></a></li>
                                        <?php } ?>
                                    </ul>
                                    <a href="#" class="toggle"></a>
                                </div>

                            </div>
                        </div>
                    </div>
                </aside>
            </div> <!-- end .page-sidebar -->
        </div>
    </div> <!-- end .container -->
</div> <!-- end #page-content -->

