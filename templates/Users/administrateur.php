<?= $this->Flash->render() ?>
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
                    <p><span>1</span>Administrateur</p>
                  </li>
                </ul>
              </div>

              <!-- Sign Up Form -->
              <?= $this->Form->create($usr, ['url' => ['Controller' => 'Users','action' => 'administrateur', $usr->email]]); ?>

                <ul class="row">
                  <li class="col-md-12">
                    <?= $this->Form->control('email', array(
                        'value' => $usr->email,
                        'type' => 'hidden',
                    )); ?>
                  </li>
                  <li class="col-md-12">
                    <?= $this->Form->control('code', array(
                        'class' => 'form-control',
                        'placeholder' => 'Votre code secret',
                        'type' => 'text',
                        'label' => '',
                        'required'
                    )); ?>
                  </li>
                  <li class="col-md-6">
                    <?= $this->Form->control('Connexion', array(
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
