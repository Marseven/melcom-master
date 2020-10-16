<div class="header-page-title our-agents-header">
    <div class="title-overlay"></div>
    <div class="container">
        <div class="title-breadcrumb clearfix">
            <h1>Les catégories</h1>

            <ol class="breadcrumb">
                <li><a href="<?= $this->Url->build(['controller' => 'Melcom', 'action' => 'index']) ?>">Accueil</a></li>
                <li class="active">Les catégories</li>
            </ol>
        </div> <!-- end .title-breadcrumb -->

    </div> <!-- end .container -->
</div> <!-- end .header-nav-bar -->

<div id="page-content" class="agent-profile">
        <div class="container">
          <div class="page-content mt60">
            <div class="row">

              <div class="col-md-12">
                <div class="main-content">

                <h1> <?= $category->id_categorie != NULL ? 'Modifier' : 'Ajouter'; ?> une catégorie </h1>
                <div class="table-responsive">

                <?= $this->Flash->render() ?>
                <?php if($category->id_categorie != NULL){ ?>
                    <?= $this->Form->create($category, ['url' => ['Controller' => 'Categories','action' => 'edit']]); ?>
                <?php }else{ ?>
                    <?= $this->Form->create($category, ['url' => ['Controller' => 'Categories','action' => 'add']]); ?>
                <?php } ?>
                    <div class="form-banner-button  mt50 mb20">
                    <div class="css-table">
                        <div class="registration-detail css-table-cell">
                        <div class="pull-left">
                            <p>Une Catégorie</p>
                        </div>
                        </div> <!-- job-details -->
                    </div> <!-- end .css-table -->
                    </div> <!-- end .form-banner-button -->
                    <!-- start main form content -->
                    <div class="job-regi-single">
                    <div class="css-table">

                        <div class="css-table-cell">
                        <label><span>*</span>Libellé</label>
                        </div>

                        <div class="registration-detail css-table-cell">
                        <?= $this->Form->control('libelle', array(
                                'placeholder' => 'Libellé de la catégorie',
                                'type' => 'text',
                                'label' => '',
                                'required'
                            )); ?>
                        </div> <!-- end .registration-detail -->

                    </div> <!-- end .css-table -->
                    </div> <!-- end .job-regi-single -->

                    <?= $this->Form->control('id_user', array(
                        'value' => $user->id_user,
                        'type' => 'hidden',
                    )); ?>

                    <div class="save-cancel-button">
                    <button type="submit" class="btn btn-default"><?= $category->id_categorie != NULL ? 'Modifier' : 'Ajouter'; ?></button>
                    <button type="reset" class="btn btn-black">Annuler</button>
                    </div> <!-- end .save-cancel-button -->

                <?= $this->Form->end(); ?>
                </div>
                    <hr>
                  <div class="table-responsive-small">

                    <div class="clients-list">

                      <div class="table-heading">
                        <div class="css-table">

                          <div class="table-details css-table-cell">
                            <h5>Catégories</h5>
                          </div>

                          <div class="clients-job css-table-cell">
                            <h5>Action</h5>
                          </div>

                        </div> <!-- end .css-table -->
                      </div> <!-- end .table-heading -->

                    <?php foreach($categories as $categorie){ ?>
                      <div class="clients-job-single">
                        <div class="css-table">

                          <div class="table-details css-table-cell">
                            <div class="company-name">
                              <h4><?= $categorie->libelle ?></h4>
                            </div> <!-- end .company-name -->
                          </div> <!-- end .table-details -->

                          <div class="clients-job css-table-cell">
                                <a href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'index', $categorie->id_categorie]) ?>" class="btn btn-default">Modifier</a><br><br>
                                <a href="<?= $this->Url->build(['controller' => 'Categories', 'action' => 'delete', $categorie->id_categorie]) ?>" onclick="Êtes-vous sûr de vouloir supprimer cette catégorie ?" class="btn btn-black">Supprimer</a>
                          </div> <!-- end .days-left -->

                        </div> <!-- end .css-table -->
                      </div> <!-- end .clients-job-single -->
                    <?php } ?>


                    </div> <!-- end .assigned-job-list -->

                  </div>

                  <div class="pagination-content clearfix pb20">
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
                  </div> <!-- end .pagination -->

                </div> <!-- end .main-content -->
              </div> <!-- end 9th grid layout -->
            </div> <!-- end .row -->
          </div> <!-- end container -->
        </div> <!-- end .page-content -->
      </div> <!-- end #page-content -->
