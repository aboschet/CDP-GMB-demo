<div class="container">
  <h2>Traçabilité</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>User Story</th>
        <th>Numéro du commit</th>
        <th></th>
      </tr>
    </thead>
    <tbody>

      <?php 
        foreach($userstories as $userstory) { ?>
          <tr>
            <td><?= $userstory->nom; ?></td>

            <?php if ($userstory->numCommit == NULL) { ?>
              <td>  <form class="form-inline" action="<?= BASE_URL.'UserStory/insertNumCommit/'.$userstory->id; ?>" method="POST">
                    <input class="form-control" id="numCommit" name="numCommit" placeholder="Numéro du commit">
                    <button type="submit" class="btn btn-default">Valider</button>
                   </form>
            </td>
            <td></td>
            <?php } else { ?>
                      <td><?= $userstory->numCommit ?></td>
                      <td>
                        <a href="<?= BASE_URL.'UserStory/deleteNumCommit/'.$userstory->id; ?>" class="icon">
                        <span class="glyphicon glyphicon-remove"></span>
                        </a>
                      </td>
            <?php } ?>
          </tr>
        <?php } ?>
    </tbody>
  </table>
</div>
