<div class="header-page-title our-agents-header">
    <div class="title-overlay"></div>
    <div class="container">
        <div class="title-breadcrumb clearfix">
            <h1>Modifier une annonce</h1>

            <ol class="breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Rh', 'action' => 'index']) ?>">Accueil</a></li>
                <li class="active">Modifier une annonce</li>
            </ol>
        </div> <!-- end .title-breadcrumb -->

    </div> <!-- end .container -->
</div> <!-- end .header-nav-bar -->

<div id="page-content" class="job-registration full-width">
        <div class="container">
          <div class="page-content">
            <h1> Modifier une Annonce </h1>
            <div class="table-responsive">

            <?= $this->Flash->render() ?>
              <?= $this->Form->create($edit_annonce, ['type' => 'file', 'url' => ['Controller' => 'Annonces','action' => 'edit', $edit_annonce->id], 'class' => 'default-form']); ?>
                <div class="form-banner-button  mt50 mb20">

                  <div class="css-table">
                    <div class="registration-detail css-table-cell">
                      <div class="pull-left">
                        <p>Une Annonce</p>
                      </div>

                    </div> <!-- job-details -->

                  </div> <!-- end .css-table -->


                </div> <!-- end .form-banner-button -->

                <!-- start main form content -->


                <!--div class="job-regi-single">
                  <div class="css-table">

                    <div class="css-table-cell">
                      <label><span>*</span>Publié</label>
                    </div>

                    <div class="registration-detail css-table-cell">

                      <div class="radio-inputs">
                        <span class="radio-input active">
                          <input id="published-yes" type="radio" name="published" value="contact form" checked="checked">
                          <label for="published-yes">Yes</label>
                        </span>

                        <span class="radio-input">
                          <input id="published-no" type="radio" name="published" value="Email">
                          <label for="published-no">No</label>
                        </span>
                      </div> <!-- end .radio-inputs ->

                    </div> <!-- end .registration-detail ->

                  </div> <!-- end .css-table ->
                </div> <!-- end .job-regi-single -->


                <div class="job-regi-single">
                  <div class="css-table">

                    <div class="css-table-cell">
                      <label><span>*</span>Titre</label>
                    </div>

                    <div class="registration-detail css-table-cell">
                        <?= $this->Form->control('titre', array(
                            'placeholder' => 'XXXXXXXXX',
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
                      <label><span>*</span>Entreprise</label>
                    </div>

                    <div class="registration-detail css-table-cell">
                      <div class="sector-of-activity">
                        <?= $this->Form->select('id_entreprise', array(
                            'options' => $entreprises,
                            'label' => '',
                        )); ?>
                      </div>
                    </div> <!-- end .registration-detail -->

                  </div> <!-- end .css-table -->
                </div> <!-- end .job-regi-single -->

                <div class="job-regi-single">
                  <div class="css-table">

                    <div class="css-table-cell">
                      <label><span>*</span>Secteur d'activité</label>
                    </div>

                    <div class="registration-detail css-table-cell">
                      <div class="sector-of-activity">
                        <?= $this->Form->select('id_categorie', array(
                            'options' => $categories,
                            'label' => '',
                        )); ?>
                      </div>
                    </div> <!-- end .registration-detail -->

                  </div> <!-- end .css-table -->
                </div> <!-- end .job-regi-single -->

                <div class="job-regi-single">
                  <div class="css-table">

                    <div class="css-table-cell">
                      <label><span>*</span>Statut</label>
                    </div>

                    <div class="registration-detail css-table-cell">

                     <div class="radio-inputs"
                        <?=
                          $this->Form->radio(
                            'statut',
                            [
                              ['value' => 'Emploi', 'text' => 'Emploi'],
                              ['value' => 'Stage', 'text' => 'Stage'],
                            ]
                          );
                        ?>
                      </div> <!-- end .radio-inputs -->

                    </div> <!-- end .registration-detail -->

                  </div> <!-- end .css-table -->
                </div> <!-- end .job-regi-single -->

                <div class="job-regi-single">
                  <div class="css-table">

                    <div class="css-table-cell">
                      <label><span>*</span>Durée</label>
                    </div>

                    <div class="registration-detail css-table-cell">
                      <div class="age-range">
                        <?= $this->Form->select('duree', array(
                            'options' => ['3 mois' => '3 mois',
                                          '6 mois'=> '6 mois',
                                          '12 mois' => '12 mois',
                                          '1 an' => '1 an',
                                          '2 an' => '2 an',
                                          'Indéterminée' => 'Indéterminée'],
                            'label' => '',
                        )); ?>
                      </div>
                    </div> <!-- end .registration-detail -->

                  </div> <!-- end .css-table -->
                </div> <!-- end .job-regi-single -->

                <div class="job-regi-single">
                  <div class="css-table">

                    <div class="css-table-cell">
                      <label><span>*</span>Type d'emploi</label>
                    </div>

                    <div class="registration-detail css-table-cell">

                    <div class="radio-inputs">
                        <?=
                          $this->Form->radio(
                            'type',
                            [
                              ['value' => 'Temps partiel', 'text' => 'Temps Partiel'],
                              ['value' => 'Temps plein', 'text' => 'Temps Plein'],
                              ['value' => 'Freelancer', 'text' => 'Freelance'],
                            ]
                          );
                        ?>
                      </div> <!-- end .radio-inputs -->

                    </div> <!-- end .registration-detail -->

                  </div> <!-- end .css-table -->
                </div> <!-- end .job-regi-single -->

                <div class="job-regi-single">
                  <div class="css-table">

                    <div class="css-table-cell">
                      <label><span>*</span>La Ville</label>
                    </div>

                    <div class="registration-detail css-table-cell">
                      <div class="nationality">
                        <?= $this->Form->select('ville', array(
                            'options' => ['Libreville' => 'Libreville',
                                          'Port-Gentil' => 'Port-Gentil',
                                          'Franceville' => 'Franceville',
                                          'Oyem' => 'Oyem'],
                            'label' => '',
                        )); ?>
                      </div>
                    </div> <!-- end .registration-detail -->

                  </div> <!-- end .css-table -->
                </div> <!-- end .job-regi-single -->

                <div class="job-regi-single">
                  <div class="css-table">

                    <div class="css-table-cell">
                      <label><span>*</span>Années d'expérience</label>
                    </div>

                    <div class="registration-detail css-table-cell">
                    <?= $this->Form->control('experience', array(
                            'placeholder' => '2 ans',
                            'type' => 'number',
                            'label' => '',
                            'required'
                        )); ?>
                    </div> <!-- end .registration-detail -->

                  </div> <!-- end .css-table -->
                </div> <!-- end .job-regi-single -->

                <div class="job-regi-single">
                  <div class="css-table">

                    <div class="">
                      <label><span>*</span>Description</label>
                    </div>

                    <div class="registration-detail css-table-cell">
                      <div class="textarea-editor">
                        <?= $this->Form->textarea('description', array(
                            'placeholder' => 'La description du poste',
                            'cols' => '40',
                            'id' => 'editor',
                            'label' => '',
                            'required'
                        )); ?>
                      </div>
                    </div> <!-- end .registration-detail -->

                  </div> <!-- end .css-table -->
                </div> <!-- end .job-regi-single -->

                <div class="job-regi-single">
                  <div class="css-table">

                    <div class="css-table-cell">
                      <label><span>*</span>Les compétences</label>
                    </div>

                    <div class="registration-detail css-table-cell">
                        <?= $this->Form->control('competences', array(
                            'placeholder' => 'Sage, Word, ...',
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
                          <label><span>*</span>Image de l'annonce</label>
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
                  <button type="submit" class="btn btn-default">Poster</button>
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
