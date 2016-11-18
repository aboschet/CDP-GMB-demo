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
 
 <div class="container">
    <h4 style= "text-align: center;"> User Stories </h4>
    
    <?php if($isOwner) { ?>
    <div class="row">
      <div class="pull-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createUserStory">
          Créer une US
        </button>
      </div>
    </div>
    <hr>
    <?php } ?>
    <div class="col-md-12">
      <table class="table table-hover">
        <thead>
          <th>Numero</th>
          <th>Nom</th>
          <th>Etat</th>
          <th>Chiffrage</th>
          <th>Priorite</th>
          <?php if($isOwner) { ?>
            <th>Action</th>
          <?php } ?>
        </thead>
        <?php 
        $i = 1;
        foreach($userstories as $userstory) { ?>
          <tr>
            <td>User Story <?= $i; ?></td>
            <td><?= $userstory->nom; ?></td>
            <td><?= $userstory->etat; ?></td>
            <td><?= $userstory->chiffrage; ?></td>
            <td><?= $userstory->priorite; ?></td>
            <?php if($isOwner) { ?>
              <td><a href="<?= BASE_URL.'UserStory/delete/'.$userstory->id; ?>" class="btn btn-danger">Supprimer</a></td>
            <?php } ?>
          </tr>
        <?php $i++; } ?>
      </table>
    </div>
  </div>
  
  
  <div class="modal fade" id="createUserStory" tabindex="-1" role="dialog" aria-labelledby="createUserStoryLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="createUserStoryLabel">Créer un User Story</h4>
      </div>
      <form action="<?= BASE_URL.'UserStory/create'; ?>" method="POST" class="form-horizontal">
      <div class="modal-body">
	  
		<div class="col-md-12">
			<div class="form-group">
				<label for="nom" class="control-label col-sm-2" style ="font-size : 85%">Nom</label>
				<div class="col-sm-10">
					<textarea class="form-control" class="col-sm-10" id="nom" name="nom" placeholder="En temps que ... je souhaite ... afin de ..."> <?php if(isset($_POST['nom'])) { echo $_POST['nom']; } ?></textarea>
                </div>
			</div>
		</div>
				
		
		<div class="col-md-12">
			<div class="form-group">
				<label for="chiffrage" class="control-label col-sm-2" style ="font-size : 85%" >Chiffrage</label>
				<div class="col-sm-10">
					<input class="form-control" id="chiffrage" name="chiffrage" value="<?php if(isset($_POST['chiffrage'])) { echo $_POST['chiffrage']; } ?>">
				</div>
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="form-group">
				<label for="priorite" class="control-label col-sm-2" style ="font-size : 85%" >Priorite</label>
				<div class="col-sm-10">
					<input class="form-control" id="priorite" name="priorite" value="<?php if(isset($_POST['priorite'])) { echo $_POST['priorite']; } ?>">
				</div>
			</div>
		</div>
		
		<div style="clear:both;"></div>
      </div>
	  
      <div class="modal-footer">
        <button class="btn btn-primary">Ajouter</button>
		<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
		
      </div>
      </form>
    </div>
  </div>
</div>

