<?php

    class pedidoDao extends database{
        
        public function __construct() {
            parent::__construct();
        }
        
        public function listar(pedido $pedido = NULL){
            $sql = "SELECT * FROM pedido WHERE 1=1";    
            
            if(isset($pedido)){
                if($pedido->getId()){
                    $sql .= " AND id = :id";
                    $param['id'] = $pedido->getId();
                } 
                
                if($pedido->getCliente()->getId()){
                    $sql .= " AND cliente = :cliente";
                    $param['cliente'] = $pedido->getCliente()->getId();
                } 
                
                if($pedido->getServico()->getId()){
                    $sql .= " AND servico = :servico";
                    $param['servico'] = $pedido->getServico()->getId();
                }               
                               
            }
            
            return parent::listar($sql, $param);
        }
        
        public function consultar(pedido $pedido){
            $sql = "SELECT * FROM pedido WHERE id = ?";
            $param = array($pedido->getId());
            return parent::consultar($sql, $param);
        }
        
        public function inserir(pedido $pedido){
            $sql = "INSERT INTO pedido ( cliente, servico, data_inicio, data_fim ) VALUES ";
            $sql .="( :cliente, :servico, :data_inicio, :data_fim )";            
            
            $param['cliente'] = $pedido->getCliente()->getId();
            $param['servico'] = $pedido->getServico()->getId();
            $param['data_inicio'] = $pedido->getDataInicio();            
            $param['data_fim'] = $pedido->getDataFim();         
            
            return parent::inserir($sql, $param);
        }
        
        public function alterar(pedido $pedido){
            $sql = "UPDATE pedido SET";
            $sql .=" cliente = :cliente";
            $sql .=" , servico = :servico";
            $sql .=" , data_inicio = :data_inicio";
            $sql .=" , data_fim = :data_fim";
            $sql .=" WHERE";
            $sql .=" id = :id";
            
            $param['id'] = $pedido->getId();
            $param['cliente'] = $pedido->getCliente()->getId();
            $param['servico'] = $pedido->getServico()->getId();
            $param['data_inicio'] = $pedido->getDataInicio();            
            $param['data_fim'] = $pedido->getDataFim();  
            
            return parent::alterar($sql, $param);
        }
        
        public function deletar(pedido $pedido){
            $sql = "DELETE FROM pedido WHERE id = :id";
            $param['id'] = $pedido->getId();
            
            return parent::deletar($sql, $param);
        }
    }
