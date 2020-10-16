<!-- process content -->
<div class="process-content">
        <div class="container">

          <!-- SIgn Up -->
          <div class="moti-sign">

            <div class="form-sec">
              <div class="process-num">

                <!-- Account SetUp -->
                <ul>
                  <li class="current">
                    <p><span>1</span>Mis à jour</p>
                  </li>
                </ul>
              </div>

              <!-- Sign Up Form -->
              <?= $this->Form->create($user_edit, ['type' => 'file']); ?>

                <ul class="row">
                  <li class="col-md-12">
                      <?= $this->Form->control('nom', array(
                          'class' => 'form-control',
                          'type' => 'text',
                          'placeholder' => 'Nom*',
                          'label' => '',
                          'required',
                      )); ?>
                  </li>
                  <li class="col-md-6">
                    <?= $this->Form->control('prenom', array(
                        'class' => 'form-control',
                        'type' => 'text',
                        'placeholder' => 'Prénom',
                        'label' => '',
                    )); ?>
                  </li>
                  <li class="col-md-6">
                    <?= $this->Form->control('telephone', array(
                        'class' => 'form-control',
                        'type' => 'text',
                        'placeholder' => 'Téléphone*',
                        'label' => '',
                        'required',
                    )); ?>
                  </li>
                  <li class="col-md-12">
                    <?= $this->Form->control('email', array(
                        'class' => 'form-control',
                        'type' => 'email',
                        'placeholder' => 'Email*',
                        'label' => '',
                        'required',
                    )); ?>
                  </li>
                    <li class="col-md-12">
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
                    </li>
                  <li class="col-md-6">
                    <?= $this->Form->control('password', array(
                        'class' => 'form-control',
                        'placeholder' => 'Mot de Passe*',
                        'type' => 'password',
                        'label' => '',
                        'required',
                    )); ?>
                  </li>
                  <li class="col-md-6">
                    <?= $this->Form->control('password_verify', array(
                        'class' => 'form-control',
                        'type' => 'password',
                        'placeholder' => 'Confirmer Mot de Passe*',
                        'label' => '',
                        'required',
                    )); ?>
                  </li>
                  <li class="col-md-6"> <button class="btn-new" type="submit">Créer le compte</button> </li>
                </ul>
              <?= $this->Form->end(); ?>
            </div>
          </div>
        </div>
      </div>

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
