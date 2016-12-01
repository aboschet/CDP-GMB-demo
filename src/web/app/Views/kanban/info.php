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
    <?php if($isOwner && $sprintInfo->dateFin > date('Y-m-d')) { ?>
    <div class="row">
      <div class="pull-right">
        <form action="<?= BASE_URL.'Kanban/addStory'; ?>" method="POST">
          <input type="hidden" name="idSprint" value="<?= $sprintId; ?>">
          <select name="id">
            <?php foreach($userstories as $us) { ?>
                <option value="<?= $us->id; ?>"><?= $us->nom; ?></option>
              <?php
              }
              ?>
          </select>
          <button class="btn btn-primary">Ajouter</button>
        </form>
      </div>
    </div>
    <hr>
    <?php } ?>

    <div class="col-md-12">
      <table class="table table-bordered table-striped">
        <thead>
          <th>US</th>
          <th>TODO</th>
          <th>ON DOING</th>
          <th>TEST</th>
          <th>DONE</th>
          <th>Action</th>
        </thead>
        <tbody>
        <?php foreach($tasks as $task) { ?>
          <tr <?php if(isset($task['data'][0]->idDeveloppeur) &&  $task['data'][0]->idDeveloppeur == $_SESSION['auth']) { echo "class='bg-blue'"; } ?> >
            <?php 
              $number = count($task["data"])+1;
              $number = $number == 1 ? 2 : $number;
            ?>
            <td rowspan="<?= $number; ?>">
              <?= $task["name"]; ?><br />
              
              <?php if($isOwner && !is_null($task["id"]) && $task["etat"] != 2) { ?>
                <a href="<?= BASE_URL.'Kanban/deleteStory/'.$sprintId.'/'.$task['id']; ?>" class="btn btn-danger">x</a>
              <?php } ?>
            </td>
            <?php 
            $i = 0;
            foreach($task["data"] as $t) { 
              if($i != 0) { 
                if($t->idDeveloppeur == $_SESSION['auth']) {
                  echo "<tr class='bg-blue'>"; 
                }
                else {
                  echo "<tr>"; 
                }
              }
              $i++;
              switch($t->etat) {
                case 'nonFait' :
                  echo "<td>"
                          .$t->nom;
                  if($isOwner || $t->idDeveloppeur == $_SESSION['auth']) {
                          echo "<a href='".BASE_URL.'Kanban/nextTask/enCours/'.$sprintId.'/'.$t->id."' class='btn btn-xs btn-success'>-></a>";
                          echo "<form action='".BASE_URL.'Kanban/updateDev'."' method='POST'>";
                          echo "<input type='hidden' name='idSprint' value='".$sprintId."'>";
                          echo "<input type='hidden' name='id' value='".$t->id."'>";
                          echo "<select name='idDeveloppeur'>
                            <option value='".$projectInfo->idProprietaire."'>".$projectInfo->pseudo."</option>
                          ";
                            foreach($membersProject as $m) {
                              echo "<option value='".$m->idDeveloppeur."'";
                              if($m->idDeveloppeur == $t->idDeveloppeur) {
                                echo "selected='selected'";
                              }
                              echo ">";
                              echo $m->pseudo;
                              echo "</option>";
                            }
                          echo "</select>     
                          <button class='btn btn-xs'>Modifier</button>                     
                          </form>";
                  }
                  echo "</td>
                        <td></td>
                        <td></td>
                        <td></td>";
                  break;
                case 'enCours' :
                  echo "<td></td>
                        <td>"
                          .$t->nom;
                  if($isOwner || $t->idDeveloppeur == $_SESSION['auth']) {
                          echo "<a href='".BASE_URL.'Kanban/nextTask/test/'.$sprintId.'/'.$t->id."' class='btn btn-xs btn-success'>-></a>";
                          echo "<form action='".BASE_URL.'Kanban/updateDev'."' method='POST'>";
                          echo "<input type='hidden' name='idSprint' value='".$sprintId."'>";
                          echo "<input type='hidden' name='id' value='".$t->id."'>";
                          echo "<select name='idDeveloppeur'>
                            <option value='".$projectInfo->idProprietaire."'>".$projectInfo->pseudo."</option>
                          ";
                            foreach($membersProject as $m) {
                              echo "<option value='".$m->idDeveloppeur."'";
                              if($m->idDeveloppeur == $t->idDeveloppeur) {
                                echo "selected='selected'";
                              }
                              echo ">";
                              echo $m->pseudo;
                              echo "</option>";
                            }
                          echo "</select>     
                          <button class='btn btn-xs'>Modifier</button>                     
                          </form>";
                  }
                  
                  
                  
                  echo "</td>
                        <td></td>
                        <td></td>";
                  break;
                case 'test' :
                  echo "<td></td>
                        <td></td>
                        <td>"
                          .$t->nom;
                  if($isOwner || $t->idDeveloppeur == $_SESSION['auth']) {
                          echo "<a href='".BASE_URL.'Kanban/nextTask/fait/'.$sprintId.'/'.$t->id."' class='btn btn-xs btn-success'>-></a>";
                          echo "<form action='".BASE_URL.'Kanban/updateDev'."' method='POST'>";
                          echo "<input type='hidden' name='idSprint' value='".$sprintId."'>";
                          echo "<input type='hidden' name='id' value='".$t->id."'>";
                          echo "<select name='idDeveloppeur'>
                            <option value='".$projectInfo->idProprietaire."'>".$projectInfo->pseudo."</option>
                          ";
                            foreach($membersProject as $m) {
                              echo "<option value='".$m->idDeveloppeur."'";
                              if($m->idDeveloppeur == $t->idDeveloppeur) {
                                echo "selected='selected'";
                              }
                              echo ">";
                              echo $m->pseudo;
                              echo "</option>";
                            }
                          echo "</select>     
                          <button class='btn btn-xs'>Modifier</button>                     
                          </form>";
                  }      
                  echo "</td>
                        <td></td>";
                  break;
                case 'fait' :
                  echo "<td></td>
                        <td></td>
                        <td></td>
                        <td>"
                          .$t->nom;
                  if(!$task['etat'] == 2 && ($isOwner || $t->idDeveloppeur == $_SESSION['auth'])) {
                    echo  "<a href='".BASE_URL.'Kanban/nextTask/nonFait/'.$sprintId.'/'.$t->id."' class='btn btn-xs btn-danger'>R</a>";
                     echo "<form action='".BASE_URL.'Kanban/updateDev'."' method='POST'>";
                          echo "<input type='hidden' name='idSprint' value='".$sprintId."'>";
                          echo "<input type='hidden' name='id' value='".$t->id."'>";
                          echo "<select name='idDeveloppeur'>
                            <option value='".$projectInfo->idProprietaire."'>".$projectInfo->pseudo."</option>
                          ";
                            foreach($membersProject as $m) {
                              echo "<option value='".$m->idDeveloppeur."'";
                              if($m->idDeveloppeur == $t->idDeveloppeur) {
                                echo "selected='selected'";
                              }
                              echo ">";
                              echo $m->pseudo;
                              echo "</option>";
                            }
                          echo "</select>     
                          <button class='btn btn-xs'>Modifier</button>                     
                          </form>";
                  }
                  
                   echo "</td>";
                  break;
              }
             
            ?>
            
            <td>
             <?php if(($isOwner || $t->idDeveloppeur == $_SESSION['auth']) && $task['etat'] != 2) { ?>
                <a href="<?= BASE_URL.'Kanban/deleteTask/'.$sprintId.'/'.$t->id; ?>">Supprimer</a>
             <?php } ?> 
            </td>
           
            </tr>
           <?php } ?>
           </tr>
           
            <tr>
               <?php if($task['etat'] != 2) { ?>
              <td>
                <form action="<?= BASE_URL.'Kanban/addTask'; ?>" method="POST">
                  <input type="hidden" name="idUserStory" value="<?= $task["id"]; ?>">
                  <input type="hidden" name="idSprint" value="<?= $sprintId; ?>">
                  <input type="text" name="nom" placeholder="Nom de la tâche">
                  <button class="btn">Ajouter</button>
                </form>
              </td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <?php } ?>
            </tr>
        <?php
        } ?>
        </tbody>
      </table>
    </div>
  </div>
  
</div>

