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
 
 
 <div>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" <?php if(!$showMemberTab) { echo 'class="active"'; }?>><a href="#project" aria-controls="project" role="tab" data-toggle="tab">Projet</a></li>
    <li role="presentation" <?php if($showMemberTab) { echo 'class="active"'; }?>><a href="#members" aria-controls="members" role="tab" data-toggle="tab">Membres</a></li>
    <li role="presentation"><a href="#details" aria-controls="details" role="tab" data-toggle="tab">Détails</a></li>
  </ul>
      <br /><br />
  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane <?php if(!$showMemberTab) { echo 'active'; }?>" id="project">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-2">
            <b>Nom du projet</b>
          </div>
          <div class="col-md-10">
            <?= $projectInfo->nom; ?>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-2">
            <b>Propriétaire du projet</b>
          </div>
          <div class="col-md-10">
            <?= $projectInfo->pseudo; ?>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-2">
            <b>Statut du projet</b>
          </div>
          <div class="col-md-10">
            <?= $projectInfo->statut; ?>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-2">
            <b>Fin du projet</b>
          </div>
          <div class="col-md-10">
            <?= $projectInfo->dateFin_fr; ?>
          </div>
        </div>
        
        <div class="row">
          <div class="col-md-2">
            <b>Description du projet</b>
          </div>
          <div class="col-md-10">
            <?= $projectInfo->description; ?>
          </div>
        </div>
      </div>
    </div>
    <div role="tabpanel" class="tab-pane <?php if($showMemberTab) { echo 'active'; }?>" id="members">
      <?php include(APP_PATH.'Views/project/members.php'); ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="details">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-2">
            <b>Lien github demo</b>
          </div>
          <div class="col-md-10">
            <?= url($projectInfo->urlGitDemo); ?>
          </div>
        </div>
        <div class="row">
          <div class="col-md-2">
            <b>Lien github dev</b>
          </div>
          <div class="col-md-10">
            <?= url($projectInfo->urlGitDev); ?>
          </div>
        </div>
        
      </div>
    </div>
  </div>

</div>
 
