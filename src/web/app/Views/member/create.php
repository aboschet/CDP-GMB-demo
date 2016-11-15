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


<div id="main-content">
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				
				
			</div>
		</div>
		<div class="row-fluid">
			<div class="span12 sortable">
				<div class="widget">
					<div class="widget-title">
						<h4>DEVELOPPEUR -- AJOUT</h4>
						
				
					</div>
					<div class="widget-body">
						<form action="<?= $_SERVER['REQUEST_URI']; ?>"  method="POST" class="form-horizontal" >
						<div class="control-group">
							
							<div class="controls">
								<input type="text" value="<?php if(isset($_POST['nom'])) { echo $_POST['nom']; } ?>" placeholder="Nom" class="input-xlarge" />
								
							</div>
						</div>
						
						<div class="control-group">
							
							<div class="controls">
								<input type="text" value="<?php if(isset($_POST['prenom'])) { echo $_POST['prenom']; } ?>"  placeholder="Prenom" class="input-xlarge" />
								
							</div>
						</div>
						
						<div class="control-group">
							
							<div class="controls">
								<input type="email" value="<?php if(isset($_POST['email'])) { echo $_POST['email']; } ?>"   placeholder="Email" class="input-xlarge" />
								
							</div>
						</div>
						
						<div class="control-group">
							
							<div class="controls">
								<input type="text" value= "<?php if(isset($_POST['entreprise'])) { echo $_POST['entreprise']; } ?>"   placeholder="Entreprise" class="input-xlarge" />
								
							</div>
						</div>
						
						<div class="controls">
							<textarea class="input-xlarge" value="<?php if(isset($_POST['bio'])) { echo $_POST['bio']; } ?>"   rows="3" placeholder="Decrivez le parcours de ce developpeur"></textarea>
						</div>
					
						
						<div class="form-actions">
							<button type="submit" class="btn blue">
								<i class="icon-ok"></i> Ajouter
							</button>
							<button type="button" class="btn">
								<i class=" icon-remove"></i> Annuler
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

</div>
