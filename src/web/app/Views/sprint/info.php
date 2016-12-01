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
    <?php if($isOwner) { ?>
    <div class="row">
      <div class="pull-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createSprint">
          Créer un sprint
        </button>
      </div>
    </div>
    <hr>
    <?php } ?>
    <div class="row">
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
            <b>Date fin du projet</b>
          </div>
          <div class="col-md-10">
            <?= $projectInfo->dateFin_fr; ?>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="col-md-12">
      <table class="table table-hover">
        <thead>
          <th>Sprint</th>
          <th>Date de début</th>
          <th>Date de fin</th>
          <th>Kanban</th>
          <?php if($isOwner) { ?>
          <th>Action</th>
          <?php } ?>
        </thead>
        <?php 
        $i = 1;
        foreach($sprints as $sprint) { ?>
          <tr>
            <td>Sprint <?= $i; ?></td>
            <td><?= $sprint->dateDebutSprint; ?></td>
            <td><?= $sprint->dateFinSprint; ?></td>
            <td><?= $sprint->kanban; ?></td>
            <?php if($isOwner) { ?>
            <td><a href="<?= BASE_URL.'Sprint/delete/'.$sprint->id; ?>">Supprimer</a></td>
            <?php } ?>
          </tr>
        <?php $i++; } ?>
      </table>
    </div>
  </div>
  
  
  <div class="modal fade" id="createSprint" tabindex="-1" role="dialog" aria-labelledby="createSprintLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="createSprintLabel">Créer un Sprint</h4>
      </div>
      <form action="<?= BASE_URL.'Sprint/create'; ?>" method="POST" class="form-horizontal">
      <div class="modal-body">
        <div class="col-md-12">
          <div class="form-group">
            <label for="dateDebut" class="control-label col-sm-2" style ="font-size : 85%" >Date de debut</label>
            <div class="col-sm-10">
                <div class='input-group date' id='datetimepicker1'>
                    <input type='text' name="dateDebut" class="form-control" value=""/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
          </div> 
        </div>
        <div class="col-md-12">
          <div class="form-group">
            <label for="dateFin" class="control-label col-sm-2" style ="font-size : 85%" >Date de Fin</label>
            <div class="col-sm-10">
                <div class='input-group date' id='datetimepicker2'>
                    <input type='text' name="dateFin" class="form-control" value=""/>
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
            </div>
          </div>
        </div>
        <div style="clear:both;"></div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary">Ajouter</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
      </form>
    </div>
  </div>
</div>

