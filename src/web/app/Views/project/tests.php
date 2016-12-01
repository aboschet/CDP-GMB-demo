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
 
 <div class="col-md-12 alert alert-info">
    <form action="<?= $_SERVER['REQUEST_URI']; ?>" method="POST" enctype="multipart/form-data">
    
    <div class="form-group">
      <label for="US">UserStory</label>
      <select name="idUS" id="US">
        <?php foreach($userstories as $us) { ?>
          <option value="<?= $us->id; ?>"><?= $us->nom; ?></option>
        <?php } ?>
      </select>
     </div>
     
     <div class="form-group">
        <label for="exampleInputFile">Fichier test</label>
        <input type="file" class="form-control-file" id="exampleInputFile" name="userfile" aria-describedby="fileHelp">
        <small id="fileHelp" class="form-text text-muted">Interface permettant l'upload des différents tests.</small>
      </div>
      
      <div class="form-group">
       <button class="btn btn-primary">
          <span class="glyphicon glyphicon-ok" style="font-size: 2em"></span>
        </button>
      </div>
    </form>
    
  </div>
  
  <div class="col-md-12">
  
    <table class="table table-bordered table-striped">
      <tr>
        <th>UserStories</th>
        <th>Lien de téléchargement</th>
        <th>Date</th>
        <th>Action</th>
      </tr>
      <?php foreach($tests as $key => $t) { ?>
        <tr>
          <td><?= $t->nom; ?></td>
          <td><?= $t->lienclic; ?></td>
          <td><?= $t->dateFr; ?></td>
          <td><?= $t->deleteLink; ?></td>
        </tr>
      <?php } ?>
    </table>
  
  </div>
