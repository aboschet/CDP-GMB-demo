<?php
namespace app\Models;

use system\Table\Table;

class SprintsTable extends Table{
    protected $table = 'sprint';
    
    public function dateIsNotInConflict($id, $deb, $end) {
      $deb = date('Y-m-d', strtotime($deb));
      $end = date('Y-m-d', strtotime($end));
      $sql = 'SELECT id FROM '.$this->table.'
      WHERE ( dateDebut >= ? AND dateFin >= ? ) OR ( dateDebut >= ? AND dateFin >= ? )';
      $result = $this->query($sql, [$deb,$deb,$end,$end], true);
      return ($result === false);
    }
  
    public function select($id){
      $sql = 'SELECT * FROM '.$this->table.'
      WHERE idProjet = ? ORDER BY dateDebut ASC';
      $result = $this->query($sql, [$id]);
      return $result;
    }
}
