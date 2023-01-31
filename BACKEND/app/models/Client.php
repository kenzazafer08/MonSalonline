<?php
class Client
{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }
    public function getclients(){
        $this->db->query('SELECT *  from clients');
        $this->db->execute();
        return $this->db->resultSet();
    }
    public function register($data){
        $this->db->query("INSERT INTO clients(first_name , last_name , phone_number, reference) VALUES (:first_name , :last_name , :phone_number, :reference)");
        $this->db->bind("first_name", $data['first_name']);
        $this->db->bind("last_name", $data['last_name']);
        $this->db->bind("phone_number", $data['phone_number']);
        $this->db->bind("reference", $data['reference']);
        $this->db->execute();
        if($this->db->rowCount() < 1){
            return false;
        }
        return true;
    }
    public function login($ref){
        $this->db->query("SELECT * FROM Clients WHERE reference = :reference");
        $this->db->bind('reference', $ref);

        $this->db->execute();
        $row = $this->db->single();
        if($row){
           return $row;
        }else{
           return null;
        }
    }
}    