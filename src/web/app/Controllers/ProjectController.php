<?php

namespace app\Controllers;
use app\Core\AppController;

use system\FormValidation\FormValidation;
class ProjectController extends AppController{

    public function __construct(){
        parent::__construct();
        if(!$this->data['isLogged']) {
          $this->redirect(BASE_URL.'Home');
        }
        $this->loadModel('Projects');
        $this->loadModel('Membersproject');
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
          
          $this->loadModel('Velocite');
          $this->Velocite->insert(array('idProjet' => $idInsert));
          
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
    
    public function calculateVelocite() {
      
      $id = $_SESSION['project_id'];
      $project = $this->Projects->getInfoProject($id);
      if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
        unset($_SESSION['project_id']);
        $this->redirect(BASE_URL.'Project/all');
      }
      
      $this->loadModel('Velocite');
      $velocite = $this->Velocite->getAll($id);
      $effort = $velocite[0]->effortAttendu;
      unset($velocite[0]);
      
      $wanted = [$effort];
      $done = [$effort];
      $name = ["'Sprint 0'"];
      $lastEffort = $effort;
      $i = 1;
      foreach($velocite as $v) {
        $name[] = "'Sprint ".$i."'";
        $wanted[] = $lastEffort-$v->effortAttendu;
        $lastEffort = $lastEffort-$v->effortFait;
        $done[] = $lastEffort;
        $i++;
      }
      
      return array(
        'wanted' => implode(',', $wanted), 
        'done' => implode(',', $done), 
        'name' => implode(',', $name));

  
    }
    
    public function info($id, $action = null) {
      $project = $this->Projects->getInfoProject($id);
      if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
        $this->redirect(BASE_URL.'Project/all');
      }
      
      $_SESSION['project_id'] = $id;
      
      if(!is_null($action)) {
       
        if($this->Projects->isOwner($id)) {
          if($action == 'addMember' && isset($_POST['idDeveloppeur'])) {
            $this->Membersproject->insert(array('idProjet' => $id, 'idDeveloppeur' => $_POST['idDeveloppeur']));
            $this->data['message'] = 'Ajout du membre effectué avec succès';
          }
          else if($action == 'removeMember' && isset($_POST['idDeveloppeur'])) {
            $this->Membersproject->delete(array('idProjet' => $id, 'idDeveloppeur' => $_POST['idDeveloppeur']));
            $this->data['message'] = 'Suppression du membre effectuée avec succès';
          }
        }
      }
      
      $this->data['velociteInfo'] = $this->calculateVelocite();
      
      $this->data['isOwner'] = $this->Projects->isOwner($id);
      $this->data['showMemberTab'] = !is_null($action);
      $this->data['membersNotInProject'] = $this->Membersproject->getMembersIsNotInTheProject($id);
      $this->data['membersProject'] = $this->Membersproject->getMembers($id);
      
      $this->data['projectInfo'] = $project[0];
       
      $this->render('project/info', $this->data);



    }
    
    public function parameters() {
      $idProject = $_SESSION['project_id'];
      $project = $this->Projects->getInfoProject($idProject);

      $this->data['js'] = array(
        'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js',
        BASE_URL.'assets/js/project_create.js'
      );
      $this->data['projectInfo'] = $project[0];
      $this->render('project/parameters', $this->data);
    }
    
    public function deleteTest($idTest) {
      $id = $_SESSION['project_id'];
      $project = $this->Projects->getInfoProject($id);
      if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
        unset($_SESSION['project_id']);
        $this->redirect(BASE_URL.'Project/all');
      }
      $this->loadModel('Tests');
      $info = $this->Tests->find($idTest);
      unlink(ROOT_PATH.'/'.$info->lien);
      $this->Tests->delete(array('id' => $idTest));
      
      $_SESSION['message'] = 'Test delete';
      $this->redirect(BASE_URL.'Project/tests');
    }
    
  public function tests() {
     $id = $_SESSION['project_id'];
     $project = $this->Projects->getInfoProject($id);
     if(!$project || !$this->Projects->haveAccess($id, $_SESSION['auth'])) {
      unset($_SESSION['project_id']);
      $this->redirect(BASE_URL.'Project/all');
     }
     
    $this->loadModel('Tests');
    $this->loadModel('UserStories');
    if(count($_POST)) {
      $uploaddir = ROOT_PATH.'/assets/tests/';
      $urlFile = uniqid(). basename($_FILES['userfile']['name']);
      $uploadfile = $uploaddir.$urlFile;
      if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        $data = array('idProjet' => $id, 'idUS' => $_POST['idUS'], 'lien' => 'assets/tests/'.$urlFile);
        $this->Tests->insert($data);
        $this->data['message'] = 'Ajout effectué';
      }
      else {
       $this->data['error'][] = 'Une erreur est survenue lors de l\'upload'; 
      }
    }
    
    if(isset($_SESSION['message'])) {
      $this->data['message'] = $_SESSION['message'];
      unset($_SESSION['message']);
    }
     
   $this->data['userstories'] = $this->UserStories->getUS($id);
   $this->data['tests'] = $this->Tests->getTests($id);
   
   $this->render('project/tests', $this->data);
  }
    
    public function all() {
      unset($_SESSION['project_id']);
      $this->data['projects'] = $this->Projects->listProjects($this->data['userInfo']->id);
      $this->data['css'][] = 'https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css';
      $this->data['js'] =  array(
        'https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js',
        BASE_URL.'assets/js/project_list.js'
      );
      $this->render('project/list', $this->data);
    }

   

    public function setParameterProject ()
    {
      $idProject = $_SESSION['project_id'];
      if ($this->Projects->isOwner($idProject))
      {
        $rules = FormValidation::is_valid($_POST, array(
            'nom' => 'required|max_len,100|min_len,3',
            'description' => 'required|min_len,5',
            'estPublic' => 'required',
            'urlGitDev' => 'required',
            'urlGitDemo' => 'required'/*,
            'dateFin' => 'required'*/
          ));
        if ($rules == true) {
            $this->Projects->update(array('id'=>$idProject), $_POST);
        }
      }

      $this->redirect(BASE_URL.'Project/info/'.$idProject);
    } 
}
