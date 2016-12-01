<?php
namespace app\Entities;

use system\Entity\Entity;

class TestsEntity extends Entity{

  function getlienclic() {
    return "<a href='".BASE_URL.$this->lien."'>".BASE_URL.$this->lien."</a>";
  }
  
  function getdateFR() {
    return date('d/m/Y à H:i:s', strtotime($this->upload));
  }
  
  function getdeleteLink() {
    return "<a href='".BASE_URL."Project/deleteTest/".$this->id."'> Supprimer</a>";
  }
}
