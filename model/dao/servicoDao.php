<?php

    class servicoDao extends database{
        
        public function __construct() {
            parent::__construct();
        }
        
        public function listar(servico $servico = NULL){
            $sql = "SELECT * FROM servico WHERE 1=1";     
            
            if(isset($servico)){
                if($servico->getId()){
                    $sql .= " AND id = :id";
                    $param['id'] = $servico->getId();
                }  
                
                if($servico->getNome()){
                    $sql .= " AND nome LIKE :nome";
                    $param['nome'] = "%".$servico->getNome()."%";
                }                
            }
            $sql .= " ORDER BY nome";
            
            return parent::listar($sql, $param);
        }
        
        public function consultar(servico $servico){
            $sql = "SELECT * FROM servico WHERE id = ? ORDER BY nome";
            $param = array($servico->getId());
            return parent::consultar($sql, $param);
        }
        
        public function inserir(servico $servico){
            $sql = "INSERT INTO servico ( nome ) VALUES ";
            $sql .="( :nome )";            
            
            $param['nome'] = $servico->getNome();            
            
            return parent::inserir($sql, $param);
        }
        
        public function alterar(servico $servico){
            $sql = "UPDATE servico SET";
            $sql .=" nome = :nome";
            $sql .=" WHERE";
            $sql .=" id = :id";
            
            $param['id'] = $servico->getId();
            $param['nome'] = $servico->getNome();         
            
            return parent::alterar($sql, $param);
        }
        
        public function deletar(servico $servico){
            $sql = "DELETE FROM servico WHERE id = :id";
            $param['id'] = $servico->getId();
            
            return parent::deletar($sql, $param);
        }
    }
