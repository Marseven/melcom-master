<div class="page-container ">

<div class="page-content-wrapper ">

<div class="content sm-gutter">

<div data-pages="parallax">
<div class=" container no-padding    container-fixed-lg">
<div class="inner">

<ol class="breadcrumb">
<li class="breadcrumb-item"><a href="#">Accueil</a></li>
<li class="breadcrumb-item"><a href="#">Utilisateurs</a></li>
<li class="breadcrumb-item active">Profil</li>
</ol>
</div>
</div>
</div>

<div class="container    container-fixed-lg">
<div class="d-flex justify-content-center flex-column full-height ">
<h3> Profil</h3>
<?= $this->Flash->render() ?>
<?= $this->Form->create($user, ['type' => 'file', 'class' => 'p-t-15', 'id' => 'form-register']); ?>
<div class="row">
<div class="col-md-6">
<div class="form-group form-group-default">
<label>Prénom</label>
<?= $this->Form->control('prenom', array(
    'class' => 'form-control',
    'type' => 'text',
    'placeholder' => 'Prenom',
    'label' => '',
)); ?>
</div>
</div>
<div class="col-md-6">
<div class="form-group form-group-default">
<label>Nom</label>
<?= $this->Form->control('nom', array(
    'class' => 'form-control',
    'type' => 'text',
    'placeholder' => 'Nom*',
    'label' => '',
    'required',
)); ?>
</div>
</div>
</div>
<div class="row">
 <div class="col-md-12">
<div class="form-group form-group-default">
<label>Email</label>
<?= $this->Form->control('email', array(
    'class' => 'form-control',
    'type' => 'email',
    'placeholder' => 'Email*',
    'label' => '',
    'required',
)); ?>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group form-group-default">
<label>Téléphone</label>
<?= $this->Form->control('telephone', array(
    'class' => 'form-control',
    'type' => 'text',
    'placeholder' => 'Téléphone*',
    'label' => '',
    'required',
)); ?>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group form-group-default">
<label>Photo de profil</label>
<div id="image_preview">
    <?= $this->Html->image('user/'.$user->picture, ['alt' => 'img-thumbnail', 'width' => '200', 'height' => '200']); ?>
    <h5></h5>
    <div class="row">
        <div class="col-sm-6">
            <?= $this->Form->control('picture', array(
                'type' => 'file',
                'label' => '',
                'id' => 'picture',
                'accept' => 'image/*'
            )); ?>
        </div>
        <div class="col-sm-6">
            <div class="input file">
                <button style="margin-top: 15px" class="btn btn-danger" type="button">Annuler</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group form-group-default">
<label>Mot de passe</label>
<?= $this->Form->control('password', array(
    'class' => 'form-control',
    'placeholder' => 'Mot de Passe*',
    'type' => 'password',
    'label' => '',
    'required',
)); ?>
</div>
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="form-group form-group-default">
<label>Confirmer Mot de passe</label>
<?= $this->Form->control('password_verify', array(
    'class' => 'form-control',
    'type' => 'password',
    'placeholder' => 'Confirmer Mot de Passe*',
    'label' => '',
    'required',
)); ?>
</div>
</div>
</div>
<button class="btn btn-primary btn-cons m-t-10" type="submit">Enregistrer</button>
<?= $this->Form->end(); ?>
</div>
</div>

</div>

</div>

</div>
