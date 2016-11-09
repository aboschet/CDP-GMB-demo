<div class="row">
  <div class="pull-right">
    <a href="<?= BASE_URL.'Project/create'; ?>" class="btn btn-primary">Créer un projet</a><br />
  </div>
</div>
<br />
<div class="container">
  <div class="col-md-12">
    <table class="table" id="projectList">
      <thead>
        <tr>
          <th>Nom du projet</th>
          <th>Propriétaire du projet</th>
          <th>Statut</th>
          <th>Date de fin du projet</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach($projects as $project){ ?>
        <tr <?php if($project->myProject) { echo "class='bg-blue'"; } ?>>
          <td><a href="<?= $project->urlInfo; ?>"><?= $project->nom; ?></a></td>
          <td><?= $project->pseudo; ?></td>
          <td><?= $project->statut; ?></td>
          <td><?= $project->dateFin_fr; ?></td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
  </div>
</div>
