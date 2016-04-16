<?php

    abstract class database {     
        private $dbtype = "mysql";
        private $host = "127.0.0.1";
        private $user = "root";
        private $password = "abc123";
        private $db = "ead";
        private $conn = "";
        
        public function __construct() {
            $conexao = $this->getDbtype();
            $conexao .= ':host='.$this->getHost();
            $conexao .= ';dbname='.$this->getDb();
            $this->conn = new PDO($conexao, $this->getUser(), $this->getPassword());
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        
        public function consultar($sql, $param = array()){
            $query = $this->conn->prepare($sql);
            $query->execute($param);
            $result = $query->fetch(PDO::FETCH_OBJ);

            return $result;            
        }
        
        public function listar($sql, $param = array()){
            $query = $this->conn->prepare($sql);
            $query->execute($param);
            $result = $query->fetchAll(PDO::FETCH_OBJ);

            return $result;            
        }
        
        public function inserir($sql,$params=null){
            $query=$this->conn->prepare($sql);
            $query->execute($params);
            $rs = $this->conn->lastInsertId();
            return $rs;
        }
        
        public function alterar($sql,$params=null){
            $query=$this->conn->prepare($sql);
            $query->execute($params);
            $rs = $query->rowCount();
            return $rs;
        }
        
        public function deletar($sql,$params=null){
            $query=$this->conn->prepare($sql);
            $query->execute($params);
            $rs = $query->rowCount();
            return $rs;
        }
        
        public function getDbtype() {
            return $this->dbtype;
        }

        public function getHost() {
            return $this->host;
        }

        public function getUser() {
            return $this->user;
        }

        public function getPassword() {
            return $this->password;
        }

        public function getDb() {
            return $this->db;
        }

        public function setDbtype($dbtype) {
            $this->dbtype = $dbtype;
        }

        public function setHost($host) {
            $this->host = $host;
        }

        public function setUser($user) {
            $this->user = $user;
        }

        public function setPassword($password) {
            $this->password = $password;
        }

        public function setDb($db) {
            $this->db = $db;
        }


        
    }
