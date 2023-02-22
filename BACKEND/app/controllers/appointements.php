<?php
  class appointements extends Controller {
    private $Appointement;
    public function __construct(){
      if(!isset($_COOKIE['login'])){
        echo 'Log In First';
        die();
      }
      $this->Appointement = $this->model('Appointement');
    }
    public function readclient(){
      header('Access-Control-Allow-Origin: *');
      header('Content-Type: application/json');
      header('Access-Control-Allow-Methods: POST');
      header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
      $id = json_decode(file_get_contents("php://input"));
      $Appointements_arr = $this->Appointement->getappointement($id->referrence);
      if($Appointements_arr){
      echo json_encode($Appointements_arr);
    }
    else{
      echo json_encode(null);
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
      public function update($id){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: PUT');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        $data = json_decode(file_get_contents("php://input"));
        $Appointement = [
          'appointment_id' => $id,
          'client_id' => $data->client_id,
          'date' => $data->date,
          'Heure' => $data->Heure
        ];
        if($this->Appointement->updateappointement($Appointement)) {
            echo json_encode(
              array('message' => 'Appointement updated'
              ));
          } else {
            echo json_encode(
              array('message' => 'Appointement Not updated')
            );
          }
      }
      public function delete($id){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: DELETE');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        if($this->Appointement->deleteappointement($id)) {
            echo json_encode(
              array('message' => 'Appointement deleted'
              ));
          } else {
            echo json_encode(
              array('message' => 'Appointement Not deleted')
            );
          }
      }
  }