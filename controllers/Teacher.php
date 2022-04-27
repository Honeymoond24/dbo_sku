<?php
    require_once '../libraries/Database.php';

    class Teacher {
        private $db;

        public function __construct() {
            $this->db = new Database;
        }

        public function saveTickets() {
            $this->db->query('INSERT INTO ');
        }
    }
    

    echo json_encode($_POST);
