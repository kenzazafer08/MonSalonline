<?php
  class appointements extends Controller {

    private $Appointement;
    public function __construct(){
      header('Access-Control-Allow-Origin: *');
      header('Content-Type: application/json');
      header('Access-Control-Allow-Methods: POST');
      header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
      $this->Appointement = $this->model('Appointement');
    }
    public function read(){
      header('Access-Control-Allow-Origin: *');
      header('Content-Type: application/json');
      header('Access-Control-Allow-Methods: GET');
      header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
      $Appointements_arr = $this->Appointement->appointement();
      if($Appointements_arr){
      echo json_encode($Appointements_arr);
    }else{
      echo json_encode(null);
    }
  }
  public function readsingle($id){
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
    $Appointements_arr = $this->Appointement->singleappointement($id);
    if($Appointements_arr){
    echo json_encode($Appointements_arr);
  }else{
    echo json_encode(null);
  }
}
    public function readclient($id){
      header('Access-Control-Allow-Origin: *');
      header('Content-Type: application/json');
      header('Access-Control-Allow-Methods: GET');
      header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
      $Appointements_arr = $this->Appointement->getappointement($id);
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
      header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
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
              null
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
              $message = 'Appointement deleted'
              );
          } else {
            echo json_encode(
              null
            );
          }
      }
  }