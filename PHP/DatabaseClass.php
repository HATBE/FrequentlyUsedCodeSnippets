<?php
    class Database {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $password = DB_PASS;
        private $name = DB_NAME;

        private $stmt;
        private $handler;
        private $error;

        public function __construct() {
            $conn = "mysql:host={$this->host};dbname={$this->name};";
            $opt = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );
            try {
                $this->handler = new PDO($conn, $this->user, $this->password, $opt);
            } catch(PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
                exit();
            }
        }

        public function query($sql) {
            $this->stmt = $this->handler->prepare($sql);
        }

        public function bind($param, $value, $type = null) {
            switch (is_null($type)) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
            $this->stmt->bindValue($param, $value, $type);
        }

        public function execute() {
            return $this->stmt->execute();
        }
        
        public function resultSet() {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        public function single() {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        public function rowCount() {
            return $this->stmt->rowCount();
        }

        public function lastId() {
            return $this->handler->lastInsertId();
        }
    }