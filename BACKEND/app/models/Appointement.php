<?php
class Appointement
{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }
    public function getappointement($id){
        $this->db->query('SELECT *  from appointments where client_id = :id');
        $this->db->bind('id',$id);
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
    public function updateappointement($data){
        $this->db->query("UPDATE appointments SET client_id = :client_id , date = :date ,Heure = :Heure WHERE `appointments`.`appointment_id` = :id");
        $this->db->bind("id", $data['appointment_id']);
        $this->db->bind("client_id", $data['client_id']);
        $this->db->bind("date", $data['date']);
        $this->db->bind("Heure", $data['Heure']);
        $this->db->execute();
        if($this->db->rowCount() < 1){
            return false;
        }
        return true;
    }
    public function deleteappointement($id){
        $this->db->query("DELETE from appointments where `appointments`.`appointment_id` = $id");
        $this->db->execute();
        if($this->db->rowCount() < 1){
            return false;
        }
        return true;
    }
}
