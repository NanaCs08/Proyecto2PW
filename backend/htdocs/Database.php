<?php

class Database {
    private static $instance = null;
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('sqlite:bd_proyecto.db');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }


    public function getDb() {
        if ($this->db != null) {
            return $this->db;
        }
    }
}

?>