<div class="header-page-title our-agents-header">
    <div class="title-overlay"></div>
    <div class="container">
        <div class="title-breadcrumb clearfix">
            <h1>Contact</h1>

            <ol class="breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Rh', 'action' => 'index']) ?>">Accueil</a></li>
                <li class="active">Contact</li>
            </ol>
        </div> <!-- end .title-breadcrumb -->

    </div> <!-- end .container -->
</div> <!-- end .header-nav-bar -->

<!-- Page Content -->
<div id="page-content" class="pt50">
        <div class="container">
          <div class="row">
            <div class="col-sm-8 page-content">
              <div id="contact-page-map" class="white-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1793.7204125913254!2d9.442976794066977!3d0.3972881491218859!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa1f38fbdab364aa5!2sG-Lab!5e0!3m2!1sfr!2sga!4v1596757871130!5m2!1sfr!2sga" width="740" height="290" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
              </div>

              <div class="white-container mb0">
                <div class="row">
                  <div class="col-sm-12">
                    <h5 class="bottom-line mt10">Siège</h5>

                    <address>
                      328 Rue Luc Marc Ivaga, Libreville <br>
                      Gabon <br>
                     RH
                    </address>

                    <p>
                      Téléphone : <a href="tel:+11234567890">+241 74 36 63 11</a> <br>
                      Email : <a href="mailto:Rhservices@gmail.com">rh@gmail.com</a>
                    </p>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-sm-4 page-sidebar">
              <aside>
                <div class="widget sidebar-widget white-container contact-form-widget">
                  <h5 class="widget-title">Entrer en Contact !</h5>

                  <div class="widget-content">
                    <p>
                        Pour plus d'informations n'hésitez pas à nous écrire :)
                    </p>

                    <?= $this->Form->create($contact, ['class' => 'mt30', 'url' => ['controller' => 'Contact', 'action' => 'index'], 'class' => 'contact-form']) ?>
                      <div class="form-group">
                        <?= $this->Form->input('name', ['class' => 'form-control', 'label' => '', 'placeholder' => 'Nom', 'required', 'data-error' => 'Le nom est obligatoire', 'id'=>'form_name', 'type'  => 'text']); ?>
                      </div>

                      <div class="form-group">
                        <?= $this->Form->input('email', ['class' => 'form-control', 'label' => '', 'placeholder' => 'Email', 'required', 'data-error' => 'L\'email est obligatoire', 'id'=>'form_email', 'type'  => 'email']); ?>
                      </div>

                      <div class="form-group">
                        <?= $this->Form->input('phone', ['class' => 'form-control', 'label' => '', 'placeholder' => 'Téléphone', 'required', 'data-error' => 'Le téléphone est obligatoire', 'id'=>'form_phone', 'type'  => 'tel']); ?>
                      </div>

                      <div class="form-group">
                        <?= $this->Form->textarea('body', ['class' => 'form-control', 'label' => '', 'placeholder' => 'Message', 'required', 'data-error' => 'Le message est obligatoire', 'id'=>'form_message', 'rows' => '4']); ?>
                      </div>

                      <?= $this->Form->input('Envoyer le Message', array(
      								'class' => 'btn btn-default',
      								'type'  => 'submit',
      						)); ?>
                    <?= $this->Form->end(); ?>
                  </div>
                </div>
              </aside>
            </div>
          </div>
        </div> <!-- end .container -->

        <!-- end .container -->


      </div>

