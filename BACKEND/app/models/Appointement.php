<?php
class Appointement
{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }
    public function getappointement(){
        $this->db->query('SELECT *  from appointments JOIN clients on appointments.client_id = clients.reference');
        $this->db->execute();
        return $this->db->resultSet();
    }
    public function addappointement($data){
        $this->db->query("INSERT INTO appointments(client_id , date , Heure) VALUES (:client_id , :date , :Heure)");
        $this->db->bind("client_id", $data['client_id']);
        $this->db->bind("date", $data['date']);
        $this->db->bind("Heure", $data['Heure']);
        $this->db->execute();
        if($this->db->rowCount() < 1){
            return false;
        }
        return true;
    }
}
