<?php
class Shop {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    /* Test (database and table needs to exist before this works)*/
    public function getShops() : array {
        $this->db->query("SELECT * FROM shops");
        $result = $this->db->resultSet();
        return $result;
    }

}