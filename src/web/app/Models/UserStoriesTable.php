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
}
