<?php
    class Model {
        protected $db;

        function __construct() {
          $this->db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
          //$this->deploy();
        }
        
    }