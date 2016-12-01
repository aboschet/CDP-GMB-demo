<?php

namespace app\Controllers;
use app\Core\AppController;

use system\FormValidation\FormValidation;
class UserController extends AppController{


    public function __construct(){
        parent::__construct();
        if(!$this->data['isLogged']) {
          $this->redirect(BASE_URL.'Home');
        }
        $this->loadModel('Users');
    }
    
    public function profil() {
      
      if(count($_POST)) {
        $rules = FormValidation::is_valid($_POST, array(
          'nom' => 'required|max_len,100|min_len,3',
          'prenom' => 'required|max_len,100|min_len,3',
          'email' => 'required|max_len,100|min_len,3|valid_email',
        ));
        
        
        if($rules === true) {
          if(empty($_POST['motDePasse'])) {
            unset($_POST['motDePasse']);
          }
          else {
            $_POST['motDePasse'] = sha1($_POST['motDePasse']);
          }
          
          $this->Users->update(array('id'=> $_SESSION['auth']), $_POST);
          $this->data['message'] = 'Votre profil vient d\'être modifié';
        } else {
            $this->data['error'] = $rules;
        }
      }
      
      $this->render('user/profil', $this->data);
    }
    
  
    
    public function index(){
      $this->notFound();
    }
   
        
    
}
