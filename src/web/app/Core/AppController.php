<?php

namespace app\Core;
use system\App;
use system\Controller\Controller;


class AppController extends Controller{

    protected  $template = 'default';
    protected $data = [];

    public function __construct(){
        $this->viewPath = APP_PATH . 'Views/';
        $this->data['isLogged'] = isset($_SESSION['auth']);
        $this->data['userInfo'] = isset($_SESSION['userInfo']) ? $_SESSION['userInfo'] : null;
        $this->data['js'] = array();
        $this->data['css'] = array();

    }

    protected function loadModel($model_name){
        $this->$model_name = App::getInstance()->getTable($model_name);
    }


   
}
