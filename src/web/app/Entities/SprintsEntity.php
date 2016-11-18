<?php
namespace app\Entities;

use system\Entity\Entity;

class SprintsEntity extends Entity{

  public function getDateDebutSprint() {
    return date('d/m/Y' , strtotime($this->dateDebut));
  }
  
  public function getDateFinSprint() {
    return date('d/m/Y' , strtotime($this->dateFin));
  }
  
  public function getKanban() {
    return "<a href=".BASE_URL.'Sprint/kanban/'.$this->id.">Kanban</a>";
  }
}
