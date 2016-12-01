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
 
 
  <h2 style="text-align:center">Modification des paramètres du projet</h2>
  <hr />
   <form class="form-horizontal" action="<?= BASE_URL.'Project/setParameterProject'; ?>" method="POST">
    <fieldset> 
       <legend>Informations de base :</legend>
    <div class="form-group">
      <label for="nom" class="control-label col-sm-2" style ="font-size : 85%" >Nom </label>
      <div class="col-sm-10">
        <input class="form-control" id="nom" name="nom" value="<?= $projectInfo->nom; ?>" placeholder="">
      </div>
    </div>

    <div class="form-group">
      <label for="description" class="control-label col-sm-2" style ="font-size : 85%">Description</label>
       <div class="col-sm-10">
      <textarea class="form-control" class="col-sm-10" id="desciption" name="description" rows="10"><?php echo $projectInfo->description; ?></textarea>
    </div>
 
    <div class="col-md-12" style="margin-top: 10px;">
      <div class="form-group">
        <label for="estPublic" class="control-label col-sm-2" style ="font-size : 85%" >Statut</label>
        <div class="col-sm-10">
          <div class="form-control">
            <input type="radio" value="0" id="estPublic" name="estPublic" placeholder="" <?php if( $projectInfo->estPublic == 0) { echo  'checked'; } ?>>Private
            <input type="radio" value="1" id="estPublic" name="estPublic" <?php if( $projectInfo->estPublic == 1) { echo  'checked'; } ?> placeholder=""> Public
          </div>
        </div>
      </div>
    </div>
  </fieldset>


  <fieldset> 
    <legend>Détails du projet:</legend>
    <div class="row">
       <div class="col-md-6">
        <div class="form-group">
          <label for="urlGitDev" class="control-label col-sm-2" style ="font-size : 85%" >URL Github Dev</label>
          <div class="col-sm-10">
            <input class="form-control" id="urlGitDev" name="urlGitDev" value="<?= $projectInfo->urlGitDev; ?>" placeholder="">
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="urlGitDemo" class="control-label col-sm-2" style ="font-size : 85%" >URL Github Demo</label>
          <div class="col-sm-10">
            <input class="form-control" id="urlGitDemo" name="urlGitDemo" value="<?= $projectInfo->urlGitDemo; ?>" placeholder="">
          </div>
        </div>
      </div>
    </div>
    
    <!--<div class="row">
       <div class="col-md-6">
        <div class="form-group">
          <label for="dateFin" class="control-label col-sm-2" style ="font-size : 85%" >Date de Fin</label>
          <div class="col-sm-10">
              <div class='input-group date' id='datetimepicker1'>
                  <input type='text' name="dateFin" class="form-control" value="<?php $projectInfo->dateFin; ?>"/>
                  <span class="input-group-addon">
                      <span class="glyphicon glyphicon-calendar"></span>
                  </span>
              </div>
          </div>
        </div>
      </div>
      
    </div>            BLOC A DECOMMENTER AFIN D'INSERER LE CHAMPS DATE ET DE POUVOIR LE MODIFIER --> 
    
  </fieldset>
  
  
   <div class="form-group">
      <div class="col-sm-offset-6 col-sm-10">
       <button class="btn btn-primary">Sauvegarder</button>
      </div>
    </div>



    </form>
  </div>
