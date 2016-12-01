<?php
namespace app\Models;

use system\Table\Table;

class VelociteTable extends Table{
    protected $table = 'velocite';
    const TABLE_SPRINT = 'sprint';
    
    public function getVelocite($id){
      $req = 'SELECT v.*, s.dateDebut FROM '.$this->table.' v
      LEFT JOIN '.self::TABLE_SPRINT .' s ON s.id = v.idSprint
      WHERE v.idProjet = ?
      ORDER BY dateDebut ASC';
      $result = $this->query($req, [$id]);
      return $result;
    }
    
     public function getAll($id){
      $req = 'SELECT v.*, s.* FROM '.$this->table.' v
      LEFT JOIN '.self::TABLE_SPRINT .' s ON s.id = v.idSprint
      WHERE v.idProjet = ?
      ORDER BY dateDebut ASC';
      $result = $this->query($req, [$id]);
      return $result;
    }
    
    
    public function updateEffort($id, $effort, $idSprint = null) {
      $sql = 'UPDATE '.$this->table.' SET
              effortAttendu = effortAttendu + ? 
              WHERE idProjet = ?';
      $where = array($effort, $id);
      if(!is_null($idSprint)) {
       $sql .= ' AND idSprint = ?';
       $where[] = $idSprint; 
      }
      $this->query($sql, $where);      
    }
    
    public function updateEffortDeleteStory($id, $effort, $idSprint) {
      $sql = 'UPDATE '.$this->table.' SET
              effortAttendu = effortAttendu + ? 
              WHERE idProjet = ? AND (idSprint IS NULL';
      $where = array($effort, $id);
      if(!is_null($idSprint)) {
       $sql .= ' OR idSprint = ?';
       $where[] = $idSprint; 
      }
      $sql .= ')';
      $this->query($sql, $where);      
    }
    
    public function updateEffortAddStory($id, $effort) {
      $sql = 'UPDATE '.$this->table.' SET
              effortAttendu = effortAttendu + ? 
              WHERE idProjet = ? AND idSprint IS NULL';
      $where = array($effort, $id);
     
      $this->query($sql, $where);      
    }
    
    
    public function updateDone($id, $effort, $idSprint = null) {
      $sql = 'UPDATE '.$this->table.' SET
              effortFait = effortFait + ? 
              WHERE idProjet = ?';
      $where = array($effort, $id);
      if(!is_null($idSprint)) {
       $sql .= ' AND idSprint = ?';
       $where[] = $idSprint; 
      }
      $this->query($sql, $where);      
    }
    
    public function getInfoAdd($idProjet) {
       $sql = 'SELECT effortAttendu  FROM '.$this->table.'
              WHERE idProjet = ? AND idSprint IS NULL';
       $result =  $this->query($sql, [$idProjet], true);
       $totalEffort = $result->effortAttendu;

       $sql = 'SELECT SUM(effortFait) as done  FROM '.$this->table.'  v
              INNER JOIN '.self::TABLE_SPRINT .' s ON s.id = v.idSprint
              WHERE v.idProjet = ? AND dateFin < NOW()';
       $result =  $this->query($sql, [$idProjet], true);
       $totalDone = $result->done;
       
       return $totalEffort-$totalDone;
      
    }
}
