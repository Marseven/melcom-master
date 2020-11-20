<div class="header-page-title our-agents-header">
    <div class="title-overlay"></div>
    <div class="container">
        <div class="title-breadcrumb clearfix">
            <h1>Ajouter une entreprise</h1>

            <ol class="breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Rh', 'action' => 'index']) ?>">Accueil</a></li>
                <li class="active">Les entreprises</li>
            </ol>
        </div> <!-- end .title-breadcrumb -->

    </div> <!-- end .container -->
</div> <!-- end .header-nav-bar -->

<div id="page-content" class="job-registration full-width">
        <div class="container">
          <div class="page-content">

            <div class="table-responsive">

            <?= $this->Flash->render() ?>
              <?= $this->Form->create($entreprise, ['type' => 'file', 'url' => ['Controller' => 'Entreprises','action' => 'add'], 'class' => 'default-form']); ?>
                <div class="form-banner-button  mt50 mb20">

                  <div class="css-table">
                    <div class="registration-detail css-table-cell">
                      <div class="pull-left">
                        <p>Une Entreprise</p>
                      </div>

                    </div> <!-- job-details -->

                  </div> <!-- end .css-table -->


                </div> <!-- end .form-banner-button -->

                <!-- start main form content -->


                <div class="job-regi-single">
                  <div class="css-table">

                    <div class="css-table-cell">
                      <label><span>*</span>Nom de l'entreprise</label>
                    </div>

                    <div class="registration-detail css-table-cell">
                    <?= $this->Form->control('nom', array(
                            'placeholder' => 'Nom de l\'entreprise',
                            'type' => 'text',
                            'label' => '',
                            'required'
                        )); ?>
                    </div> <!-- end .registration-detail -->

                  </div> <!-- end .css-table -->
                </div> <!-- end .job-regi-single -->

                <div class="job-regi-single">
                  <div class="css-table">

                    <div class="css-table-cell">
                      <label><span>*</span>Secteur d'activité</label>
                    </div>

                    <div class="registration-detail css-table-cell">
                    <?= $this->Form->control('secteur', array(
                            'placeholder' => 'Secteur d\'activité',
                            'type' => 'text',
                            'label' => '',
                            'required'
                        )); ?>
                    </div> <!-- end .registration-detail -->

                  </div> <!-- end .css-table -->
                </div> <!-- end .job-regi-single -->

                <div class="job-regi-single">
                  <div class="css-table">

                    <div class="css-table-cell">
                      <label><span>*</span>Adresse de l'entreprise</label>
                    </div>

                    <div class="registration-detail css-table-cell">
                    <?= $this->Form->control('adresse', array(
                                    'placeholder' => 'Adresse de l\'entreprise',
                                    'class' => 'input-location pull-left',
                                    'type' => 'text',
                                    'label' => '',
                                    'required'
                                )); ?>
                    </div> <!-- end .registration-detail -->

                  </div> <!-- end .css-table -->
                </div> <!-- end .job-regi-single -->

                <div class="job-regi-single">
                  <div class="css-table">

                    <div class="css-table-cell">
                      <label><span>*</span>Contact de l'entreprise</label>
                    </div>

                    <div class="registration-detail css-table-cell">
                    <?= $this->Form->control('referent', array(
                                    'placeholder' => 'Contact de l\'entreprise',
                                    'type' => 'text',
                                    'label' => '',
                                    'required'
                                )); ?>
                    </div> <!-- end .registration-detail -->

                  </div> <!-- end .css-table -->
                </div> <!-- end .job-regi-single -->

                <div class="job-regi-single">
                  <div class="css-table">

                    <div class="css-table-cell">
                      <label><span>*</span>Téléphone</label>
                    </div>

                    <div class="registration-detail css-table-cell">
                    <?= $this->Form->control('telephone', array(
                                    'placeholder' => 'Téléphone',
                                    'type' => 'text',
                                    'label' => '',
                                    'required'
                                )); ?>
                    </div> <!-- end .registration-detail -->

                  </div> <!-- end .css-table -->
                </div> <!-- end .job-regi-single -->

                <div class="job-regi-single">
                  <div class="css-table">

                    <div class="css-table-cell">
                      <label><span>*</span>Email</label>
                    </div>

                    <div class="registration-detail css-table-cell">
                    <?= $this->Form->control('email', array(
                                    'placeholder' => 'Email',
                                    'type' => 'email',
                                    'label' => '',
                                    'required'
                                )); ?>
                    </div> <!-- end .registration-detail -->

                  </div> <!-- end .css-table -->
                </div> <!-- end .job-regi-single -->

                <div class="job-regi-single">
                  <div class="css-table">

                    <div class="css-table-cell">
                      <label><span>*</span>Logo de l'entreprise</label>
                    </div>

                    <div class="registration-detail css-table-cell">
                        <div id="image_preview">
                            <?= $this->Html->image('content/upload-image-bg.jpg', ['alt' => 'img-thumbnail', 'style' => "width: 25%; height:auto; "]); ?>
                            <h5 style="text-align:left;"></h5>
                            <div class="row">
                                <div class="col-sm-9">
                                    <?= $this->Form->control('image', array(
                                        'type' => 'file',
                                        'label' => '',
                                        'id' => 'picture',
                                        'accept' => 'image/*'
                                    )); ?>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input file">
                                        <button style="margin-top: 15px" class="btn btn-black" type="button">Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end .registration-detail -->

                  </div> <!-- end .css-table -->
                </div> <!-- end .job-regi-single -->

                <?= $this->Form->control('id_user', array(
                    'value' => $user->id,
                    'type' => 'hidden',
                )); ?>

                <div class="save-cancel-button">
                  <button type="submit" class="btn btn-default">Ajouter</button>
                  <button type="reset" class="btn btn-black">Annuler</button>
                </div> <!-- end .save-cancel-button -->

             <?= $this->Form->end(); ?>
            </div>
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
