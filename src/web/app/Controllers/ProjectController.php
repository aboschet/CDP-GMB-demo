<?php

namespace app\Controllers;
use app\Core\AppController;

use system\FormValidation\FormValidation;
class ProjectController extends AppController{

    public function __construct(){
        parent::__construct();
        if(!$this->data['isLogged']) {
          $this->redirect(dirname($_SERVER['PHP_SELF']).'/Home');
        }
        $this->loadModel('Projects');
    }
    public function index(){
       $this->notFound();
    }
    
    public function create(){
      //When user sending the form
      if(count($_POST)) {
        $rules = FormValidation::is_valid($_POST, array(
          'nom' => 'required|max_len,100|min_len,3',
          'description' => 'required|min_len,5',
          'estPublic' => 'required',
          'urlGitDev' => 'required',
          'urlGitDemo' => 'required',
          'dateFin' => 'required'
        ));
        if($rules === true) {          
          $_POST['dateFin'] = date('Y-m-d', strtotime($_POST['dateFin']));
          $_POST['idProprietaire'] =  $this->data['userInfo']->id;
          $idInsert = $this->Projects->insert($_POST);
          $this->redirect(BASE_URL.'Project/info/'.$idInsert);
        }
        else {
           $this->data['error'] = $rules;
        }
        
      }
      $this->data['js'] = array(
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js',
        BASE_URL.'assets/js/project_create.js'
      );
      $this->render('project/create', $this->data);
    }
    
    public function info($id) {
      $this->data['message'] = 'Not Implemented Yet';
      $this->render('project/info', $this->data);
    }
    public function all() {
      
      $this->data['projects'] = $this->Projects->listProjects($this->data['userInfo']->id);
      $this->data['css'][] = 'https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css';
      $this->data['js'] =  array(
        'https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js',
        BASE_URL.'assets/js/project_list.js'
      );
      $this->render('project/list', $this->data);
    }
}