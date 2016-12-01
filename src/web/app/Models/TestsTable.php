<?php
namespace app\Models;

use system\Table\Table;

class TestsTable extends Table{
    protected $table = 'tests';
    const TABLE_US = 'userstory';
    
    public function getTests($id){
      $req = 'SELECT t.*, u.nom FROM '.$this->table.' t
      INNER JOIN '.self::TABLE_US .' u ON u.id = t.idUS
      WHERE t.idProjet = ?';
      $result = $this->query($req, [$id]);
      return $result;
    }
    
}
