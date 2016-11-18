<?php
namespace app\Models;

use system\Table\Table;

class MembersprojectTable extends Table{
    protected $table = 'membreprojet';
    const TABLE_USER = 'utilisateur';
    
    public function getMembers($project_id) {
      $result = $this->query('
          SELECT '.$this->table.'.* , 
                 '.self::TABLE_USER.'.pseudo, '.self::TABLE_USER.'.email, 
                 '.self::TABLE_USER.'.nom, '.self::TABLE_USER.'.prenom
          
          FROM '.$this->table.' 
          INNER JOIN '.self::TABLE_USER.' ON
            '.self::TABLE_USER.'.id = '.$this->table.'.idDeveloppeur
          WHERE '.$this->table.'.idProjet = ? ',
        [$project_id]);
      
      return $result;
    }
    
    public function getMembersIsNotInTheProject($project_id) {
      $sql = 'SELECT '.self::TABLE_USER.'.* 
              FROM '.self::TABLE_USER.'
              LEFT JOIN '.$this->table.'
                ON '.self::TABLE_USER.'.id = '.$this->table.'.idDeveloppeur AND idProjet = ?  
              WHERE '.$this->table.'.idDeveloppeur IS NULL';
      $result = $this->query($sql, [$project_id]);
      return $result;
    }
  
}
