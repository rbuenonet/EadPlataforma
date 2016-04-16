<?php

    class clienteDao extends database{
        
        public function __construct() {
            parent::__construct();
        }
        
        public function listar(cliente $cliente = NULL){
            $sql = "SELECT * FROM cliente WHERE 1=1";     
            
            if(isset($cliente)){
                if($cliente->getId()){
                    $sql .= " AND id = :id";
                    $param['id'] = $cliente->getId();
                }  
                
                if($cliente->getNome()){
                    $sql .= " AND nome LIKE :nome";
                    $param['nome'] = "%".$cliente->getNome()."%";
                }                
            }
            $sql .= " ORDER BY nome";
            
            return parent::listar($sql, $param);
        }
        
        public function consultar(cliente $cliente){
            $sql = "SELECT * FROM cliente WHERE id = ? ORDER BY nome";
            $param = array($cliente->getId());
            return parent::consultar($sql, $param);
        }
        
        public function inserir(cliente $cliente){
            $sql = "INSERT INTO cliente ( nome, email, telefone ) VALUES ";
            $sql .="( :nome, :email, :telefone )";            
            
            $param['nome'] = $cliente->getNome();
            $param['email'] = $cliente->getEmail();
            $param['telefone'] = $cliente->getTelefone();            
            
            return parent::inserir($sql, $param);
        }
        
        public function alterar(cliente $cliente){
            $sql = "UPDATE cliente SET";
            $sql .=" nome = :nome";
            $sql .=", email = :email";
            $sql .=", telefone = :telefone";
            $sql .=" WHERE";
            $sql .=" id = :id";
            
            $param['id'] = $cliente->getId();
            $param['nome'] = $cliente->getNome();
            $param['email'] = $cliente->getEmail();
            $param['telefone'] = $cliente->getTelefone();            
            
            return parent::alterar($sql, $param);
        }
        
        public function deletar(cliente $cliente){
            $sql = "DELETE FROM cliente WHERE id = :id";
            $param['id'] = $cliente->getId();
            
            return parent::deletar($sql, $param);
        }
    }
