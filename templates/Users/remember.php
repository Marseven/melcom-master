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
                    <p><span>1</span>Mot de Passe Oublié ?</p>
                  </li>
                </ul>
              </div>

              <!-- Sign Up Form -->
              <?= $this->Form->create($user, ['url' => ['Controller' => 'Users','action' => 'remember']]); ?>

                <ul class="row">
                  <li class="col-md-12">
                    <?= $this->Form->control('email', array(
                        'class' => 'form-control',
                        'placeholder' => 'abc@xyz.com',
                        'type' => 'email',
                        'label' => '',
                        'required'
                    )); ?>
                  </li>

                  <li class="col-md-12">
                    <p><a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'login']) ?>" class="text-info small">Connexion</a></p>
                  </li>
                  <li class="col-md-6">
                    <?= $this->Form->control('Envoyer', array(
                        'class' => 'btn-new',
                        'id'    => 'connexion',
                        'type'  => 'submit',
                        'label' => ''
                    )); ?>
                  </li>
                </ul>
            <?= $this->Form->end(); ?>
            </div>
          </div>
        </div>
      </div>

