<?php

namespace app\Controllers;
use app\Core\AppController;
use system\FormValidation\FormValidation;
use system\App;
use system\Auth\DBAuth;

class HomeController extends AppController{
    
    public function index(){
        if($this->data['isLogged']) {
          $this->redirect(BASE_URL.'Project/all');
        }
        else {
          $this->render('guest_home', $this->data);
        }
    }
    
    public function register() {

      if($this->data['isLogged']) {
        $this->redirect(BASE_URL.'Project/all');
      }
      
      $rules = FormValidation::is_valid($_POST, array(
        'pseudo' => 'required|alpha_numeric',
        'nom' => 'required|max_len,100|min_len,3',
        'prenom' => 'required|max_len,100|min_len,3',
        'email' => 'required|max_len,100|min_len,3|valid_email',
        'motDePasse' => 'required|min_len,3',
      ));
      
      $this->loadModel('Users');
      if($this->Users->userAlreadyRegisted($_POST['email'], $_POST['pseudo'])) {
        $this->data['error'][] = 'Cet utilisateur/email est déjà présent dans notre base de données';
      }
      else if($rules === true) {
        
        $_POST['motDePasse'] = sha1($_POST['motDePasse']);
        $this->Users->insert($_POST);
        $this->data['message'] = 'Votre inscription vient d\'être effectuée';
      } else {
          $this->data['error'] = $rules;
      }
      
      
      $this->render('guest_home', $this->data);
      
    }
    
    public function connect() {
      
      $rules = FormValidation::is_valid($_POST, array(
        'pseudo' => 'required|alpha_numeric',
        'motDePasse' => 'required|min_len,3',
      ));
      
      if($rules === true) {
        $auth = new DBAuth(App::getInstance()->getDb());
        if($auth->login($_POST['pseudo'], $_POST['motDePasse'])) {
           $this->redirect(BASE_URL.'Project/all');
        }
        else {
          $this->data['error'][] = 'Les identifiants ne sont pas reconnu';
        }
      } 
      else {
        $this->data['error'] = $rules;
      }
      
      $this->render('guest_home', $this->data);
      
    }

    public function disconnect(){
      session_unset();
      $this->redirect(BASE_URL.'Home');
    }
}
