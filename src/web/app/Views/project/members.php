  <form action="<?= BASE_URL.'Project/Info/'.$projectInfo->id.'/addMember'; ?>" method="POST">
    <div class="col-md-4 col-offset-md-8">
      <?php if(count($membersNotInProject) > 1 && $isOwner) { ?>
        <select name="idDeveloppeur">
          <?php foreach($membersNotInProject as $member) {
            if($member->id != $projectInfo->idProprietaire) { ?>
              <option value="<?= $member->id; ?>"><?= $member->pseudo; ?></option>
            <?php
              }
            }
            ?>
        </select>
        
            <button class="btn btn-primary">Ajouter</button>
        
      <?php }
       ?>
    </div>
  </form>
  
  <table class="table table-hover">
    <thead>
      <tr>
        <th>Pseudo</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?= $projectInfo->pseudo; ?></td>
        <td><?= $projectInfo->prop_name; ?></td>
        <td><?= $projectInfo->prop_surname; ?></td>
        <td><?= $projectInfo->prop_email; ?></td>
        <td>Owner du projet</td>
      </tr>
      
      <?php foreach($membersProject as $member) {?>
        <tr>
        <td><?= $projectInfo->pseudo; ?></td>
        <td><?= $member->nom; ?></td>
        <td><?= $member->prenom; ?></td>
        <td><?= $member->email; ?></td>
        <td>
          <?php if($isOwner) : ?>
          <form action="<?= BASE_URL.'Project/Info/'.$projectInfo->id.'/removeMember'; ?>" method="POST">
            <input type="hidden" name="idDeveloppeur" value="<?= $member->idDeveloppeur; ?>">
            <button class="btn btn-danger">x</button>
          </form>
          <?php endif; ?>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
