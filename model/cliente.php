<?php

    class cliente {
        private $id;
        private $nome;
        private $email;
        private $telefone;
                
        function getId() {
            return $this->id;
        }

        function getNome() {
            return $this->nome;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setNome($nome) {
            $this->nome = $nome;
        }
        
        function getEmail() {
            return $this->email;
        }

        function getTelefone() {
            return $this->telefone;
        }

        function setEmail($email) {
            $this->email = $email;
        }

        function setTelefone($telefone) {
            $this->telefone = $telefone;
        }
    }
