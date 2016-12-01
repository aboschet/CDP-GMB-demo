<?php
namespace app\Entities;

use system\Entity\Entity;

class VelociteEntity extends Entity{
  
  function getdateFR() {
    return date('d/m/Y à H:i:s', strtotime($this->upload));
  }
  

}
