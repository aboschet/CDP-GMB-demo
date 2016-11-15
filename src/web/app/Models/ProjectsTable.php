<?php
namespace app\Models;

use system\Table\Table;

class ProjectsTable extends Table{
    protected $table = 'projet';
    const TABLE_USER = 'utilisateur';
    
    public function listProjects($userId) {
      $result = $this->query('
          SELECT '.$this->table.'.* , '.self::TABLE_USER.'.pseudo
          FROM '.$this->table.' 
          INNER JOIN '.self::TABLE_USER.' ON
            '.self::TABLE_USER.'.id = '.$this->table.'.idProprietaire
          WHERE idProprietaire = ? OR estPublic = 1',
        [$userId]);
      return $result;
      
    }
    
    public function getInfoProject($id) {
      $result = $this->query('
          SELECT '.$this->table.'.* , '.self::TABLE_USER.'.pseudo
          FROM '.$this->table.' 
          INNER JOIN '.self::TABLE_USER.' ON
            '.self::TABLE_USER.'.id = '.$this->table.'.idProprietaire
          WHERE '.$this->table.'.id = ?',
        [$id]);
      return $result;
      
    }
    
    public function haveAccess($project_id, $user_id) {
      return true;
    }
}
