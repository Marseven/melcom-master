<div class="header-page-title our-agents-header">
    <div class="title-overlay"></div>
    <div class="container">
        <div class="title-breadcrumb clearfix">
            <h1>Postuler</h1>

            <ol class="breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Rh', 'action' => 'index']) ?>">Accueil</a></li>
                <li class="active">Postuler</li>
            </ol>
        </div> <!-- end .title-breadcrumb -->

    </div> <!-- end .container -->
</div> <!-- end .header-nav-bar -->

<div id="page-content">
        <div class="container">
          <div class="page-content">
            <div class="">

              <?= $this->Flash->render() ?>

              <div class="tab-content">
                <div class="tab-pane active mt20" id="candidate-profile">
                <?= $this->Form->create($candidat, ['type' => 'file', 'url' => ['Controller' => 'Candidats','action' => 'add']]); ?>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="motijob-sidebar">
                      <div class="candidate-profile-picture">
                        <div id="image_preview">
                            <?= $this->Html->image('content/upload-image.jpg', ['alt' => 'img-thumbnail', 'style' => "width: 100%; height:auto; "]); ?>
                            <h5 style="text-align:left;"></h5>
                            <div class="row">
                                <div class="col-sm-7">
                                    <?= $this->Form->control('image', array(
                                        'type' => 'file',
                                        'label' => '',
                                        'id' => 'picture',
                                        'accept' => 'image/*',
                                        'required' => 'required'
                                    )); ?>
                                </div>
                                <div class="col-sm-2">
                                    <div class="input file">
                                        <button class="btn btn-black" type="button">Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </div> <!-- end .agent-profile-picture -->

                      <div class="candidate-general-info">

                          <div class="title clearfix">
                            <h6>Vos Informations</h6>
                          </div> <!-- end .end .title -->

                          <ul class="list-unstyled candidate-registration">
                            <li><strong>Nom :</strong><?= $this->Form->control('nom', array(
                                                            'placeholder' => '[nom][prénom]',
                                                            'type' => 'text',
                                                            'label' => '',
                                                            'required'
                                                        )); ?></li>
                            <li><strong>Adresse :</strong><?= $this->Form->control('adresse', array(
                                                            'placeholder' => '[Adresse]',
                                                            'type' => 'text',
                                                            'label' => '',
                                                            'required'
                                                        )); ?></li>
                            <li><strong>Tel - What :</strong><?= $this->Form->control('telephone', array(
                                                            'placeholder' => '[Téléphone/WhatsApp]',
                                                            'type' => 'text',
                                                            'label' => '',
                                                            'required'
                                                        )); ?></li>
                            <li><strong>Email :</strong><?= $this->Form->control('email', array(
                                                            'placeholder' => '[Email]',
                                                            'type' => 'email',
                                                            'label' => '',
                                                            'required'
                                                        )); ?></li>
                            <li><strong>Facebook :</strong><?= $this->Form->control('facebook', array(
                                                            'placeholder' => '[Facebook]',
                                                            'type' => 'text',
                                                            'label' => '',
                                                            'required'
                                                        )); ?></li>
                          </ul>

                          <hr>

                          <div class="title clearfix">
                            <h6>Votre Référence</h6>
                          </div> <!-- end .end .title -->

                          <ul class="list-unstyled candidate-registration">
                            <li><strong>Nom :</strong><?= $this->Form->control('referent', array(
                                                            'placeholder' => '[nom][prénom]',
                                                            'type' => 'text',
                                                            'label' => '',
                                                            'required'
                                                        )); ?></li>
                            <li><strong>Adresse :</strong><?= $this->Form->control('adresse_ref', array(
                                                            'placeholder' => '[Adresse]',
                                                            'type' => 'text',
                                                            'label' => '',
                                                            'required'
                                                        )); ?></li>
                            <li><strong>Tel - What :</strong><?= $this->Form->control('telephone_ref', array(
                                                            'placeholder' => '[Téléphone/WhatsApp]',
                                                            'type' => 'text',
                                                            'label' => '',
                                                            'required'
                                                        )); ?></li>
                          </ul>


                      </div> <!-- end .candidate-general-info -->
                    </div>
                    </div> <!-- end .3col grid layout -->

                    <div class="col-md-8">

                      <div class="job-reg-form">
                        <div style="padding: 0 20px 0 20px;">
                            <h2><strong>[IMPORTANT]</strong></h2>
                            <p>
                                Le dépôt d’un dossier de candidature à un poste publié par la structure  est automatiquement actionné par un coaching prévu avant l’entretient (lorsque le postulant est retenue), le postulant reçoit un coaching sur en rapport avec la structure partenaire.
                                En cas d’embauche, l’ex postulant à le devoir de fournir une photo de lui à son poste de travail a  pour l’archivage numérique (Facebook).
                                Ce partage ne garantit en rien l’emploi du candidat, mais une maîtrise de base au sujet de l'entreprise a là qu’elle il veut appartenir.
                                Les frais de coaching sont à 3000 mille francs CFA non remboursables, et ne sont  pas les frais de dossier.
                                Les frais de dossier de stage sont de : 25 000f CFA, payable après un entretien concluant.
                                Suite à la remarque de nos clients, la formation est obligatoire pour tout postulant à .
                            </p>
                        </div>
                      </div>

                      <div class="job-reg-form">

                          <div class="candidate-single-content mt20">
                            <div class="row">
                              <div class="col-md-4">
                                <label><span>*</span>Vous postulez pour quel annonce ?</label>
                              </div> <!-- end .4th grid-layout -->

                              <div class="col-md-8">
                                <div class="candidate-des-editore">
                                  <div class="skill-selectbox mb10">
                                  <?= $this->Form->select('id_annonce', array(
                                        'options' => $annonces,
                                        'label' => '',
                                    )); ?>
                                  </div> <!-- end textarea-editor -->
                                </div> <!-- end .condidate-description -->
                              </div> <!-- end .8th grid layout -->

                            </div> <!-- end nasted .row -->
                          </div> <!-- end .candidate-single-content -->

                          <div class="candidate-single-content mt20">
                            <div class="row">
                              <div class="col-md-4">
                                <label><span>*</span>Décrivez vous </label>
                              </div> <!-- end .4th grid-layout -->

                              <div class="col-md-8">
                                <div class="candidate-des-editore">
                                  <div class="textarea-editor">
                                    <?= $this->Form->textarea('description', array(
                                        'placeholder' => 'Décrivez-vous...',
                                        'cols' => '40',
                                        'id' => 'myNicEditor',
                                        'label' => '',
                                        'required'
                                    )); ?>
                                  </div> <!-- end textarea-editor -->
                                </div> <!-- end .condidate-description -->
                              </div> <!-- end .8th grid layout -->

                            </div> <!-- end nasted .row -->
                          </div> <!-- end .candidate-single-content -->

                          <div class="candidate-single-content">
                            <div class="row">
                              <div class="col-md-4">
                                <label><span>*</span>Vos Compétences clés</label>
                              </div> <!-- end .4th grid-layout -->

                              <div class="col-md-8">
                                <div class="candidate-skill-single clearfix">

                                  <div class="skill-edit-content">
                                    <div class="skill-selectbox mb10">
                                    <?= $this->Form->control('competences', array(
                                        'placeholder' => 'Sage, Word, ...',
                                        'type' => 'text',
                                        'label' => '',
                                        'required'
                                    )); ?>
                                    </div> <!-- end .skill-selectbox -->

                                  </div> <!-- end .skill-edit-content -->
                                </div> <!-- end .candidate-skills-single -->

                              </div> <!-- end .8th grid layout -->
                            </div> <!-- end nasted .row -->
                          </div> <!-- end .candidate-single-content -->

                          <div class="candidate-single-content">
                            <div class="row">
                              <div class="col-md-4">
                                <label><span>*</span>Votre Expérience</label>
                              </div> <!-- end .4th grid-layout -->

                              <div class="col-md-8">
                                <div class="add-skills-field">
                                  <?= $this->Form->control('experiences[]', array(
                                        'placeholder' => 'Entreprises, Debut-Fin',
                                        'type' => 'text',
                                        'label' => '',
                                        'required'
                                    )); ?>
                                </div>
                                <div class="add-skills-field">
                                    <?= $this->Form->control('experiences[]', array(
                                        'placeholder' => 'Entreprises, Debut-Fin',
                                        'type' => 'text',
                                        'label' => '',
                                        'required'
                                    )); ?>
                                </div>
                                <div class="add-skills-field">
                                    <?= $this->Form->control('experiences[]', array(
                                        'placeholder' => 'Entreprises, Debut-Fin',
                                        'type' => 'text',
                                        'label' => '',
                                        'required'
                                    )); ?>
                                </div>
                              </div> <!-- end .8th grid layout -->
                            </div> <!-- end .nasted .row -->
                          </div> <!-- end .candidate-single-content -->

                          <div class="candidate-single-content">
                            <div class="row">
                              <div class="col-md-4">
                                <label><span>*</span>Votre Formation</label>
                              </div> <!-- end .4th grid-layout -->

                              <div class="col-md-8">
                                <div class="add-skills-field">
                                    <?= $this->Form->control('formations[]', array(
                                        'placeholder' => 'Diplome, Année',
                                        'type' => 'text',
                                        'label' => '',
                                        'required'
                                    )); ?>
                                </div>
                                <div class="add-skills-field">
                                    <?= $this->Form->control('formations[]', array(
                                        'placeholder' => 'Diplome, Année',
                                        'type' => 'text',
                                        'label' => '',
                                        'required'
                                    )); ?>
                                </div>
                                <div class="add-skills-field">
                                    <?= $this->Form->control('formations[]', array(
                                        'placeholder' => 'Diplome, Année',
                                        'type' => 'text',
                                        'label' => '',
                                        'required'
                                    )); ?>
                                </div>
                              </div> <!-- end .8th grid layout -->
                            </div> <!-- end .nasted .row -->
                          </div> <!-- end .candidate-single-content -->

                          <div class="candidate-single-content">
                            <div class="row">
                              <div class="col-md-4">
                                <label><span>*</span>Votre Expérience de bénévolat ou d'animation</label>
                              </div> <!-- end .4th grid-layout -->

                              <div class="col-md-8">
                                <div class="add-skills-field">
                                    <?= $this->Form->control('organisations[]', array(
                                        'placeholder' => 'Organisation, Année',
                                        'type' => 'text',
                                        'label' => '',
                                        'required'
                                    )); ?>
                                </div>
                                <div class="add-skills-field">
                                    <?= $this->Form->control('organisations[]', array(
                                        'placeholder' => 'Organisation, Année',
                                        'type' => 'text',
                                        'label' => '',
                                        'required'
                                    )); ?>
                                </div>
                                <div class="add-skills-field">
                                    <?= $this->Form->control('organisations[]', array(
                                        'placeholder' => 'Organisation, Année',
                                        'type' => 'text',
                                        'label' => '',
                                        'required'
                                    )); ?>
                                </div>
                              </div> <!-- end .8th grid layout -->
                            </div> <!-- end .nasted .row -->
                          </div> <!-- end .candidate-single-content -->

                          <div class="save-cancel-button ml20">
                            <button type="submit" class="btn btn-default">Postuler</button>
                            <button type="reset" class="btn btn-black">Annuler</button>
                          </div> <!-- end .save-cancel-button -->
                        <?= $this->Form->end(); ?>
                      </div> <!-- end .candidate-reg-form -->
                    </div> <!-- end .9col grid layout -->

                  </div> <!-- end .row -->
                </div> <!-- end .tabe pane -->

              </div> <!-- end .tab-content -->
            </div> <!-- end .responsive-tabs.dashboard-tabs -->

          </div> <!-- end .page-content -->
        </div> <!-- end .container -->
      </div> <!-- end #page-content -->
      <?= $this->Html->scriptStart(['block' => true]) ?>
            jQuery(function($) {

                //preview picture
                $('#picture').on('change', function (e) {
                var files = $(this)[0].files;
                if (files.length > 0) {
                // On part du principe qu'il n'y qu'un seul fichier
                // Ã©tant donnÃ© que l'on a pas renseignÃ© l'attribut "multiple"
                var file = files[0], $image_preview = $('#image_preview');

                // Ici on injecte les informations recoltÃ©es sur le fichier pour l'utilisateur
                $image_preview.find('.img-thumbnail').removeClass('hidden');
                $image_preview.find('img').attr('src', window.URL.createObjectURL(file));
                $image_preview.find('h5').html(file.name);
                $image_preview.find('h6').html(file.size +' bytes');
                }

                // Bouton "Annuler" pour vider le champ d'upload
                $image_preview.find('button[type="button"]').on('click', function (e) {
                e.preventDefault();
                $('#picture').val('');
                $image_preview.find('img').attr('src', '/img/default-avatar.png');
                $image_preview.find('h5').html(' ');
                $image_preview.find('h6').html(' ');
                });
                });
            });
        <?= $this->Html->scriptEnd()?>
