<?php
class Horaire
{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }
    public function getHoraires(){
        $this->db->query('SELECT *  from horaires');
        $this->db->execute();
        return $this->db->resultSet();
    }
}