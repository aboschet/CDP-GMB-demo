<?php
namespace app\Models;

use system\Table\Table;

class ProjectsTable extends Table{
    protected $table = 'projet';
    const TABLE_USER = 'utilisateur';
    const TABLE_MEMBERS_PROJECT = 'membreprojet';
    
    public function listProjects($userId) {
      $result = $this->query('
          SELECT '.$this->table.'.* , '.self::TABLE_USER.'.pseudo
          FROM '.$this->table.' 
          INNER JOIN '.self::TABLE_USER.' ON
            '.self::TABLE_USER.'.id = '.$this->table.'.idProprietaire
          LEFT JOIN '.self::TABLE_MEMBERS_PROJECT.' ON '.$this->table.'.id = idProjet
          WHERE idProprietaire = ? OR idDeveloppeur = ? OR estPublic = 1',
        [$userId,$userId]);
      return $result;
      
    }
    
    public function getInfoProject($id) {
      $result = $this->query('
          SELECT '.$this->table.'.* , 
          '.self::TABLE_USER.'.pseudo, '.self::TABLE_USER.'.nom as prop_name, '.self::TABLE_USER.'.prenom as prop_surname,
          '.self::TABLE_USER.'.email as prop_email
          FROM '.$this->table.' 
          INNER JOIN '.self::TABLE_USER.' ON
            '.self::TABLE_USER.'.id = '.$this->table.'.idProprietaire
          WHERE '.$this->table.'.id = ?',
        [$id]);
      return $result;
      
    }
    
    public function haveAccess($project_id, $user_id) {
      $sql = 'SELECT '.$this->table.'.id, idProprietaire, idDeveloppeur, estPublic
              FROM '.$this->table.'
              LEFT JOIN '.self::TABLE_MEMBERS_PROJECT.' ON
               '.$this->table.'.id = idProjet
              WHERE '.$this->table.'.id = ? AND (estPublic = 1 OR idDeveloppeur = ? OR idProprietaire = ?)';

      $result = $this->query($sql, [$project_id,$user_id, $user_id], true);
      return ($result !== false);
    }
    
    public function isOwner($project_id, $user_id = null){
      $user_id = is_null($user_id) ? $_SESSION['auth'] : $user_id;
      $sql = 'SELECT id FROM '.$this->table.' WHERE id = ? AND idProprietaire = ?';
      $result = $this->query($sql, [$project_id,$user_id], true);
      return ($result !== false);
    }
    
  
}
