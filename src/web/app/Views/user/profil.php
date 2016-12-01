 <?php if(isset($error)) : ?>
  <div class="col-md-12 alert alert-danger">
    <?php 
    foreach($error as $value) {
        echo "<p>".$value."</p>";
     }?>
  </div>
 <?php endif; ?>
 <?php if(isset($message)) : ?>
  <div class="col-md-12 alert alert-success">
    <?= $message; ?>
  </div>
 <?php endif; ?>

 <div class="col-md-12">
  <h2  style="text-align:center">Gestion de son profil</h2>
  <hr />
   <form class="form-horizontal" action="<?= BASE_URL.'User/profil'; ?>" method="POST">

    <div class="form-group">
      <label class="control-label col-sm-2" >Pseudo :</label>
      <div class="col-sm-10">
        <?= $userInfo->pseudo; ?>
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-2" >Nom :</label>
      <div class="col-sm-10">
        <input class="form-control" id="nom" name="nom" placeholder="" value="<?= $userInfo->nom; ?>">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-2" >Prénom :</label>
      <div class="col-sm-10">
        <input class="form-control" id="prenom" name="prenom" placeholder="" value="<?= $userInfo->prenom; ?>">
      </div>
    </div>

     <div class="form-group">
      <label class="control-label col-sm-2" >Email :</label>
      <div class="col-sm-10">
        <input class="form-control" id="email" name="email" placeholder="" value="<?= $userInfo->email; ?>">
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" >Mot de passe :</label>
      <div class="col-sm-10">
        <input class="form-control" id="motDePasse" name="motDePasse" type="password" placeholder="">
      </div>
    </div>


    <div class="form-group">
      <div class="col-sm-offset-6 col-sm-10">
       <button class="btn btn-primary">
          <span class="glyphicon glyphicon-ok" style="font-size: 2em"></span>
        </button>
      </div>
    </div>

  </form>
</div>
