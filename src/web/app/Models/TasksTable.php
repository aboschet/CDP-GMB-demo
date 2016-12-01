<?php
namespace app\Models;

use system\Table\Table;

class TasksTable extends Table{
    protected $table = 'tache';
    
    
    public function getTasksOfUS($sprintId, $usId){
      $sql = 'SELECT * FROM '.$this->table.'
      WHERE idSprint = ? 
        AND idUserStory = ?
      ORDER BY id';
      $result = $this->query($sql, [$sprintId, $usId]);
      return $result;
    }
    
     public function getTasksOfAll($sprintId){
      $sql = 'SELECT * FROM '.$this->table.'
      WHERE idSprint = ? 
        AND idUserStory IS NULL
      ORDER BY id';
      $result = $this->query($sql, [$sprintId]);
      return $result;
    }
    
    public function nbTask($usId) {
      $sql = 'SELECT COUNT(*) as nb, etat FROM '.$this->table.'
      WHERE idUserStory = ?
      GROUP BY etat';
      $result = $this->query($sql, [$usId]);
      return $result;
    }
}
