<?php
  class clients extends Controller {
    
    private $client;
    public function __construct(){
     $this->client = $this->model('Client');
    }
    public function read(){
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    $clients_arr = $this->client->getclients();
    if($clients_arr){
       echo json_encode($clients_arr);
    }
    else{
      echo json_encode(
       array('message' => 'no clients founds')
      );
    }
    }
    public function readsingle(){
      header('Access-Control-Allow-Origin: *');
      header('Content-Type: application/json');
      header('Access-Control-Allow-Methods: POST');
      header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
      $id = json_decode(file_get_contents("php://input"));
      $clients_arr = $this->client->getclient($id->referrence);
      if($clients_arr){
         echo json_encode($clients_arr);
      }
      else{
        echo json_encode(
         array('message' => 'no client found')
        );
      }
      }
    public function register(){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        $data = json_decode(file_get_contents("php://input"));
        $client = [
          'first_name' => $data->first_name,
          'last_name' => $data->last_name,
          'phone_number' => $data->phone_number,
          'reference' => randomString(10)
        ];
        if($this->client->register($client)) {
            echo json_encode(
              array('message' => 'Client registered',
              'referrence' => $client['reference'])
            );
          } else {
            echo json_encode(
              array('message' => 'Client Not registered')
            );
          }
    }
    public function login(){
        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');
        header('Access-Control-Allow-Methods: POST');
        header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
        $data = json_decode(file_get_contents("php://input"));
        $ref = $data->referrence;
        if($client = $this->client->login($ref)){
          echo json_encode(array('message' => true,
        'client' => $client->reference,
      ));
        } else {
          echo json_encode(array(array('message' => false,
          'client' => null)));
        }
    }
    public function logout(){
        unset($_COOKIE['login']);
        echo 'Logged out succesfuly';
        die();
    }
} 