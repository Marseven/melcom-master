<div class="header-page-title our-agents-header">
    <div class="title-overlay"></div>
    <div class="container">
        <div class="title-breadcrumb clearfix">
            <h1>Paiment</h1>

            <ol class="breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'index']) ?>">Accueil</a></li>
                <li class="active">Postuler</li>
            </ol>
        </div> <!-- end .title-breadcrumb -->

    </div> <!-- end .container -->
</div> <!-- end .header-nav-bar -->

<div id="page-content" class="agent-profile">
    <div class="container">
        <div class="page-content mt60">
            <div class="row">
                <div class="col-md-3">
                    <div class="motijob-sidebar">
                        <div class="candidate-profile-picture">
                            <?= $this->Html->image('candidat/'.$candidat->image, ['fullBase' => true]) ?>
                        </div> <!-- end .agent-profile-picture -->

                        <div class="agent-details">
                            <div class="title clearfix">
                                <h6>Informations</h6>
                            </div> <!-- end .title -->

                            <div class="agent-address">
                                <p><i class="fa fa-map-marker"></i><?= $candidat->adresse ?></p>
                                <p><i class="fa fa-phone"></i><?= $candidat->telephone ?></p>
                                <p><i class="fa fa-envelope"></i><?= $candidat->email ?></p>
                                <p><i class="fa fa-facebook"></i><?= $candidat->facebook ?></p>
                            </div> <!-- end agent-address -->

                        </div> <!-- end agent-details -->

                        <div class="agent-details">
                            <div class="title">
                                <h6>Réferent</h6>
                            </div>

                            <div class="agent-address">
                                <p><i class="fa fa-user"></i><?= $candidat->referent ?></p>
                                <p><i class="fa fa-phone"></i><?= $candidat->telephone_ref ?></p>
                                <p><i class="fa fa-map-marker"></i><?= $candidat->adresse_ref ?></p>
                            </div> <!-- end agent-address -->
                        </div>

                    </div>

                </div> <!-- end 3rd grid .page-sidebar layout -->

                <div class="col-md-9">

                    <div class="candidate-description client-description applicants-content">

                        <div class="language-print client-des clearfix">
                            <div class="clearfix">
                                <div class="pull-left">
                                    <h5><?= $candidat->nom ?></h5>
                                    <a href="#">Poste visé : <?= empty($candidat->annonces) ? '' : $candidat->annonces[0]->titre ?> | </a>
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

                        <form action="https://mypvit.com/pvit-secure-full-api.kk" method="POST" id="payeForm" >
                            <input type="hidden" name="tel_marchand" value="077695468">
                            <input type="hidden" name="montant" value="3000">
                            <input type="hidden" name="ref" value="<?= $reference ?>">
                            <input type="hidden" name="service" value="WEB">
                            <input type="hidden" name="operateur" value="MC">
                            <input type="hidden" name="redirect" value="https://melcom.boostetoncv.com/callback/<?= $candidat->id ?>">
                            <div class="save-cancel-button ml20">
                                <input class="btn btn-default" type="submit" name="submitButton" value="PAYER"/>
                                <a href="<?= $this->Url->build(['controller' => 'Candidats', 'action' => 'edit', $candidat->id]) ?>"><button class="btn btn-black">Modifier</button></a>
                            </div> <!-- end .save-cancel-button -->
                        </form>

                    </div> <!-- end .candidate-description -->
                </div> <!-- end 9th grid layout -->
            </div> <!-- end .row -->
        </div> <!-- end container -->
    </div> <!-- end .page-content -->
</div> <!-- end #page-content -->
