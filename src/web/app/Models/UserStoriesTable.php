<?php
namespace app\Models;

use system\Table\Table;
class UserStoriesTable extends Table{
    protected $table = 'userstory';
   
    public function getUS($id){
      $req = 'SELECT * FROM '.$this->table.'
      WHERE idProjet = ?';
      $result = $this->query($req, [$id]);
      return $result;
    }
    
    public function getNotAffectedUS($idProjet) {
      $req = 'SELECT * FROM '.$this->table.'
      WHERE etat = 0 AND idProjet = ?';
      $result = $this->query($req, [$idProjet]);
      return $result;
    }
    
    public function getUsOfSprint($sprintId) {
      $req = 'SELECT id, nom, etat FROM '.$this->table.'
      WHERE idSprint = ?';
      $result = $this->query($req, [$sprintId]);
      return $result;
    }
}
