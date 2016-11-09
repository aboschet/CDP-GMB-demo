<?php
namespace system;

use system\Database\MysqlDatabase;

class App{

    public $title;
    private $db_instance;
    private static $_instance;

    public function setTitle($title) {
        $this->title = $title;
    }
    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public static function load(){
        session_start();
        require SYSTEM_PATH . 'Form/FormValidation.php';
        require SYSTEM_PATH . 'Autoloader.php';
        Autoloader::register();
    }

    public function getTable($name){
        $class_name = '\\app\\Models\\' . ucfirst($name) . 'Table';
        return new $class_name($this->getDb());
    }

    public function getDb(){
        $config = Config::getInstance(APP_PATH . '/config/database.php');
        if(is_null($this->db_instance)){
            $this->db_instance = new MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
        }
        return $this->db_instance;
    }


    public static function getConfig($name) {
        $config = Config::getInstance(APP_PATH . '/config/config.php');
        return $config->get($name);
    }


}
