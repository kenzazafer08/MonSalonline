<?php

  class clients extends Controller {
    private $client;
    public function __construct(){
     $this->client = $this->model('Client');
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
} 