<?php

namespace app\Controllers;
use app\Core\AppController;

use system\FormValidation\FormValidation;
class SprintController extends AppController{

    public function __construct(){
        parent::__construct();
        if(!$this->data['isLogged']) {
          $this->redirect(BASE_URL.'Home');
        }
            
        if(!isset($_SESSION['project_id'])) {
          $this->redirect(BASE_URL.'Project/all');
        }
        $this->loadModel('Projects');    
        $this->loadModel('UserStories');    
        $this->loadModel('Sprints');    
        
    }
    public function index(){
        
       $this->notFound();
    }
    
    public function delete($idSprint) {
      $id = $_SESSION['project_id'];
      if(!$this->Projects->isOwner($id)) {
        $this->redirect(BASE_URL.'Sprint/info');
      }
      
      $this->loadModel('UserStories');    
      $this->UserStories->update(array('idSprint' => $idSprint), array('idSprint' => NULL, 'etat' => 0));
      
      $this->loadModel('Tasks');
      $this->Tasks->delete(array('idSprint' => $idSprint));
      
      $this->Sprints->delete(array('id' => $idSprint));
      
      $this->loadModel('Velocite');
      $this->Velocite->delete(array('idProjet' => $id, 'idSprint' => $idSprint));      
      $_SESSION["message"] = "Le sprint a bien été supprimé";
      $this->redirect(BASE_URL.'Sprint/info');
    }
    
    public function create() {
      $id = $_SESSION['project_id'];
      if(!$this->Projects->isOwner($id)) {
        $this->redirect(BASE_URL.'Sprint/info');
      }
      $project = $this->Projects->getInfoProject($id)[0];
      $rules = FormValidation::is_valid($_POST, array(
          'dateDebut' => 'required',
          'dateFin' => 'required',
        ));
        if($rules === true) {
          if(strtotime($_POST['dateFin']) < strtotime($_POST['dateDebut'])){
            $error = ['La date de fin doit être supérieur à la date de début'];
          }
          else if(!$this->Sprints->dateIsNotInConflict($id, $_POST['dateFin'], $_POST['dateDebut'])) {
            $error = ['Un sprint est déjà dans cet intervalle de date'];
          }
          else if(date('Y-m-d', strtotime($_POST['dateFin'])) > $project->dateFin) {
            $error = ['La date de fin ne peut pas dépasser la date limite du projet'];
          }
          else {
            $postData = array(
              'idProjet' => $id,
              'dateDebut' => date('Y-m-d', strtotime($_POST['dateDebut'])),
              'dateFin' => date('Y-m-d', strtotime($_POST['dateFin']))
            );
            
            
            $_SESSION["message"] = "Le sprint a bien été ajouté";
            $idSprint = $this->Sprints->insert($postData);
            $this->loadModel('Velocite');
            //$veloAttendu = $this->Velocite->getInfoAdd($id);
            $this->Velocite->insert(array('idProjet' => $id, 'idSprint' => $idSprint, 'effortAttendu' => 0 /*$veloAttendu*/ ));       
          }
        }
        else {
          $error = $rules;
        }
        
        if(isset($error)) {
          $_SESSION["error"] = $error;
        }
        $this->redirect(BASE_URL.'Sprint/info');
    }
    
    public function info() {
      $id = $_SESSION['project_id'];
      $project = $this->Projects->getInfoProject($id);
      if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
        unset($_SESSION['project_id']);
        $this->redirect(BASE_URL.'Project/all');
      }
      
     
      if(isset($_SESSION['message'])) {
        $this->data['message'] = $_SESSION['message'];
        unset($_SESSION['message']);
      }
      
      if(isset($_SESSION['error'])) {
        $this->data['error'] = $_SESSION['error'];
        unset($_SESSION['error']);
      }
      
  
      
      $this->data['projectInfo'] = $project[0];
      $this->data['isOwner'] = $this->Projects->isOwner($id);
      $this->data['sprints'] = $this->Sprints->select($id);
      $this->data['js'] = array(
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js',
        BASE_URL.'assets/js/sprint_create.js'
      );
      $this->render('sprint/info', $this->data);
    }
        
    
}
