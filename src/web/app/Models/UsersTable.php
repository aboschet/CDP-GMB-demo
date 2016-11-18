<?php
namespace app\Models;

use system\Table\Table;

class UsersTable extends Table{

    protected $table = 'utilisateur';
    
    public function userAlreadyRegisted($email, $pseudo) {
      $result = $this->query('
          SELECT id 
          FROM '.$this->table.' 
          WHERE email = ? OR pseudo = ?',
        [$email, $pseudo], true);
      return $result;
      
    }

}
