<?php
  class appointements extends Controller {
    private $Appointement;
    public function __construct(){
      $this->Appointement = $this->model('Appointement');
    }
    public function read(){
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $Appointements_arr = $this->Appointement->getappointement();
    if($Appointements_arr){
       echo json_encode($Appointements_arr);
    }
    else{
      echo json_encode(
       array('message' => 'no Appointements founds')
      );
    }
    }
    public function addappointement(){
      header('Access-Control-Allow-Origin: *');
      header('Content-Type: application/json');
      header('Access-Control-Allow-Methods: POST');
      header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
      $data = json_decode(file_get_contents("php://input"));
      $Appointement = [
        'client_id' => $data->client_id,
        'date' => $data->date,
        'Heure' => $data->Heure
      ];
      if($this->Appointement->addappointement($Appointement)) {
          echo json_encode(
            array('message' => 'Appointement registered'
            ));
        } else {
          echo json_encode(
            array('message' => 'Appointement Not registered')
          );
        }
  }
  }