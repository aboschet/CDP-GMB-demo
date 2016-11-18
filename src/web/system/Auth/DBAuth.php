<?php
namespace system\Auth;

use system\Database\Database;

class DBAuth {

    private $db;

    public function __construct(Database $db){
        $this->db = $db;
    }

    public function getUserId(){
        if($this->logged()){
            return $_SESSION['auth'];
        }
        return false;
    }

    /**
     * @param $username
     * @param $password
     * @return boolean
     */
    public function login($username, $password){
        $user = $this->db->prepare('SELECT * FROM utilisateur WHERE pseudo = ?', [$username], null, true);
        if($user){
            if($user->motDePasse === sha1($password)){
                $_SESSION['auth'] = $user->id;
                $_SESSION['userInfo'] = $user;
                return true;
            }
        }
        return false;
    }

    public function logged(){
        return isset($_SESSION['auth']);
    }

}
