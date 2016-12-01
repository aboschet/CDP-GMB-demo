<?php

namespace app\Controllers;
use app\Core\AppController;

use system\FormValidation\FormValidation;
class KanbanController extends AppController{

    public function __construct(){
        parent::__construct();
        if(!$this->data['isLogged']) {
          $this->redirect(BASE_URL.'Home');
        }
            
        if(!isset($_SESSION['project_id'])) {
          $this->redirect(BASE_URL.'Project/all');
        }
        $this->loadModel('Projects');    
        $this->loadModel('Tasks');    
        $this->loadModel('Sprints'); 
        $this->loadModel('UserStories');   
        
    }
    public function index(){
       $this->notFound();
    }
    
    public function addStory() {
       $id = $_SESSION['project_id'];
       $project = $this->Projects->getInfoProject($id);
       if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
        unset($_SESSION['project_id']);
        $this->redirect(BASE_URL.'Project/all');
       }
       if($this->Projects->isOwner($id)) {
        $this->loadModel('UserStories'); 
        $this->loadModel('Velocite'); 
        
        $usInfo = $this->UserStories->find($_POST['id']);
        $this->Velocite->updateEffort($id, $usInfo->chiffrage, $_POST['idSprint']);
        $_SESSION["message"] = "L'US à bien été ajouté au Sprint";
        $this->UserStories->update(array('id' => $_POST['id']), array('etat' => 1, 'idSprint' => $_POST['idSprint']));
       }
      
       $this->redirect(BASE_URL.'Kanban/info/'.$_POST['idSprint']);
      
    }
    
    public function updateDev() {
      $this->Tasks->update(array('id' => $_POST['id']), array('idDeveloppeur' => $_POST['idDeveloppeur']));
      $_SESSION["message"] = 'La tâche vient d\'être affecté à un autre développeur';
      $this->redirect(BASE_URL.'Kanban/info/'.$_POST['idSprint']);
    }
    
    public function addTask() {
       $id = $_SESSION['project_id'];
       $project = $this->Projects->getInfoProject($id);
       if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
        unset($_SESSION['project_id']);
        $this->redirect(BASE_URL.'Project/all');
       }
       
       if(!empty($_POST['nom'])) {
         $_SESSION["message"] = "La tâche a bien été ajoutée";
         $_POST['idDeveloppeur'] = $_SESSION['auth'];
         $_POST['etat'] = 'nonFait';
         if(empty($_POST['idUserStory'])) {
            unset($_POST['idUserStory']);
         }
         $this->Tasks->insert($_POST);
       }
       
       $this->redirect(BASE_URL.'Kanban/info/'.$_POST['idSprint']);
    }
    
    public function deleteTask($idSprint, $idTask) {
       $id = $_SESSION['project_id'];
       $project = $this->Projects->getInfoProject($id);
       if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
        unset($_SESSION['project_id']);
        $this->redirect(BASE_URL.'Project/all');
       }
       $taskInfo = $this->Tasks->find($idTask);
       $_SESSION["message"] = "La tâche a bien été supprimé";
       $this->Tasks->delete(array('id' => $idTask));
       $nbTache = $this->Tasks->nbTask(array('idUserStory' => $taskInfo->idUserStory));
       $usInfo = $this->UserStories->find($taskInfo->idUserStory);
       if(count($nbTache) == 1 && $nbTache[0]->etat == 'fait') {
         $this->loadModel('Velocite');
         $this->Velocite->updateDone($id, $usInfo->chiffrage, $_POST['idSprint']);
         $this->UserStories->update(array('id' => $taskInfo->idUserStory), array('etat' => 2));
       }
       
       $this->redirect(BASE_URL.'Kanban/info/'.$idSprint);
    }
    
    
    public function deleteStory($idSprint, $idStory) {
       $id = $_SESSION['project_id'];
       $project = $this->Projects->getInfoProject($id);
       if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
        unset($_SESSION['project_id']);
        $this->redirect(BASE_URL.'Project/all');
       }
       $_SESSION["message"] = "L'US a été supprimé de ce sprint";
       $this->loadModel('UserStories'); 
       $this->loadModel('Velocite'); 
        
       $usInfo = $this->UserStories->find($idStory);
       $sprintInfo = $this->Sprints->find($idSprint);
       
       if($sprintInfo->dateFin > date('Y-m-d')) {
        $this->Velocite->updateEffort($id, $usInfo->chiffrage*-1, $idSprint);
       }
       $this->UserStories->update(array('id' => $idStory), array('etat' => 0, 'idSprint' => NULL));
       
       
       $this->redirect(BASE_URL.'Kanban/info/'.$idSprint);
    }
    
    public function nextTask($etat, $idSprint, $idStory) {
      $id = $_SESSION['project_id'];
       $project = $this->Projects->getInfoProject($id);
       if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
        unset($_SESSION['project_id']);
        $this->redirect(BASE_URL.'Project/all');
       }
        $this->Tasks->update(array('id' => $idStory), array('etat' => $etat));
       $_SESSION["message"] = "La tâche vient de changé d'état";
       $idUs = $this->Tasks->find($idStory)->idUserStory;
       
       $nbTache = $this->Tasks->nbTask($idUs);

       $usInfo = $this->UserStories->find($idUs);
       
       if(count($nbTache) == 1 && $nbTache[0]->etat == 'fait') {
         $this->loadModel('Velocite');
         
         $this->Velocite->updateDone($id, $usInfo->chiffrage, $idSprint);
         $this->UserStories->update(array('id' => $idUs), array('etat' => 2));
       }
      
       $this->redirect(BASE_URL.'Kanban/info/'.$idSprint);
    }
    
    public function info($idSprint) {
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
      
      $this->loadModel('Membersproject'); 
      $this->data['membersProject'] = $this->Membersproject->getMembers($id);
           
      $this->loadModel('UserStories');      
      $this->data['userstories'] = $this->UserStories->getNotAffectedUS($id);
      $USofSprint = $this->UserStories->getUsOfSprint($idSprint);
      $tasks[] = array("name" => "ALL", 'etat' => NULL, "id" => NULL, "data" => $this->Tasks->getTasksOfAll($idSprint));
      foreach($USofSprint as $idUS) {
        $tasks[] = array("name" => $idUS->nom, "etat" => $idUS->etat, "id" => $idUS->id, "data" => $this->Tasks->getTasksOfUS($idSprint, $idUS->id));
      }
      $this->data['tasks'] = $tasks;
      
      $this->data['projectInfo'] = $project[0];
      $this->data['isOwner'] = $this->Projects->isOwner($id);
      $this->data['sprintId'] = $idSprint;
      $this->data['sprintInfo'] = $this->Sprints->find($idSprint);
      $this->data['js'] = array(
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js',
        BASE_URL.'assets/js/sprint_create.js'
      );
      $this->render('kanban/info', $this->data);
      echo $_SESSION['project_id'];
    }
        
    
}
