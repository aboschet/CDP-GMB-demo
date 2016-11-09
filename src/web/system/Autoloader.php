<?php
namespace system;
/**
 * Class Autoloader
 * @package Tutoriel
 */
class Autoloader {

    /**
     * Enregistre notre autoloader
     */
    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    /**
     * Inclue le fichier correspondant à notre classe
     * @param $class string Le nom de la classe à charger
     */
    static function autoload($class){

        try {
            if (strpos($class, __NAMESPACE__ . '\\') === 0){
                $class = str_replace(__NAMESPACE__ . '\\', '', $class);
                $class = str_replace('\\', '/', $class);
                if (!file_exists(__DIR__ . '/' . $class .'.php' ))
                    throw new \Exception ('notFound');
                else
                    require __DIR__ . '/' . $class . '.php';
            }
            else if (strpos($class, 'app' . '\\') === 0){
                $class = str_replace('app' . '\\', '', $class);
                $class = str_replace('\\', '/', $class);
                if (!file_exists(APP_PATH . '' . $class .'.php' ))
                    throw new \Exception ('notFound');
                else {
                    require APP_PATH . '' . $class . '.php';
                }
            }
        } catch(\Exception $e) {
            require_once __DIR__ .'/Controller/Controller.php';
            $error = new Controller\Controller();
            $action = $e->getMessage();
            $error->$action();

            //$error->{$e->getMessage()};
        }
    }

}
