<?php
  class horaires extends Controller {
    private $horaires;
    public function __construct(){
     $this->horaires = $this->model('Horaire');
    }
    public function read(){
      header('Access-Control-Allow-Origin: *');
      header('Content-Type: application/json');
     $horaires_arr = $this->horaires->getHoraires();
     if($horaires_arr){
       echo json_encode($horaires_arr);
     }
    else{
      echo json_encode(
       array('message' => 'no horaires founds')
      );
      }
    }
  }