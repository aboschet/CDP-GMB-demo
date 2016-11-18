<?php
namespace app\Entities;

use system\Entity\Entity;

class ProjectsEntity extends Entity{

  public function getUrlInfo(){
    return BASE_URL.'Project/info/' . $this->id;
  }
  
  public function getStatut() {
    $return = $this->estPublic ? 'public' : 'private';
    return $return;
  }
  
  public function getDateFin_fr() {
    return date('d/m/Y' , strtotime($this->dateFin));
  }

  public function getMyProject() {
    return ($this->idProprietaire == $_SESSION['auth']);
  }
}
