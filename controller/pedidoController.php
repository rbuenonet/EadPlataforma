<?php

date_default_timezone_set('Brazil/East');

include_once '../../api/database.php';
include_once '../../model/dao/clienteDao.php';
include_once '../../model/cliente.php';
include_once '../../model/dao/servicoDao.php';
include_once '../../model/servico.php';
include_once '../../model/dao/pedidoDao.php';
include_once '../../model/pedido.php';

class pedidoController {
    
    private $campos_obrigatorios = array(
        array('nome' => 'cliente', 'label' => 'Cliente'), 
        array('nome' => 'servico', 'label' => 'Serviço'),
        array('nome' => 'data_inicio', 'label' => 'Data Inicio'),
        array('nome' => 'data_fim', 'label' => 'Data Fim')
    );
   
    public function listar($request){
        $retorno['ok'] = 'N';
        $retorno['msg'] = 'Nenhum registro encontrado';    

        $cliente = new cliente();
        $cliente->setId($request['cliente']);
        
        $servico = new servico();
        $servico->setId($request['servico']);
            
        $pedido = new pedido();
        $pedido->setId($request['id']);
        $pedido->setCliente($cliente);
        $pedido->setServico($servico);
        
        $pedidoDao = new pedidoDao();
        $results = $pedidoDao->listar($pedido);
        
        if(count($results)){
            $retorno['ok'] = 'S';
            $retorno['msg'] = '';
            
            foreach ($results as $key => $result) {
                $cliente = new cliente();
                $cliente->setId($result->cliente);

                $clienteDao = new clienteDao();
                $resultsCliente = $clienteDao->consultar($cliente);
                
                $results[$key]->cliente = $resultsCliente;
                
                $servico = new servico();
                $servico->setId($result->servico);

                $servicoDao = new servicoDao();
                $resultsServico = $servicoDao->consultar($servico);
                
                $results[$key]->servico = $resultsServico;
            }
        }
        $retorno['data'] = $results;
        
        return $retorno;
    }   
    
    public function consultar($request){
        $retorno['ok'] = 'N';
        $retorno['msg'] = 'Nenhum dado encontrado';

        if(!isset($request['id'])){
            $retorno['msg'] = 'Código inválido';
            return $retorno;
        }
        
        $pedido = new pedido();
        $pedido->setId($request['id']);
        
        $pedidoDao = new pedidoDao();
        $results = $pedidoDao->consultar($pedido);
        
        if(count($results) && $results){
            $retorno['ok'] = 'S';
            $retorno['msg'] = '';
            
            $cliente = new cliente();
            $cliente->setId($results->cliente);

            $clienteDao = new clienteDao();
            $resultsCliente = $clienteDao->consultar($cliente);

            $results->cliente = $resultsCliente;

            $servico = new servico();
            $servico->setId($results->servico);

            $servicoDao = new servicoDao();
            $resultsServico = $servicoDao->consultar($servico);

            $results->servico = $resultsServico;
        }
        $retorno['data'] = $results;
        return $retorno;
    }
    
    public function salvar($request){
        $retorno['ok'] = 'N';
        $retorno['msg'] = 'Nenhum dado alterado';
        
        foreach ($this->campos_obrigatorios as $value) {
            if(!isset($request[$value['nome']]) || !$request[$value['nome']]){
                $retorno['msg'] = "Campo {$value['label']} é obrigatório";
                return $retorno;
            }
        }
        
        $data_hoje = date('Y-m-d');
        $data_inicio = implode('-', array_reverse(explode('/', $request['data_inicio'])));
        $data_fim = implode('-', array_reverse(explode('/', $request['data_fim'])));
        
        if(strtotime($data_hoje) > strtotime($data_inicio)){
            $retorno['msg'] = "Data Inicio precisa ser maior ou igual que a data de hoje";
            return $retorno;
        }
        
        if(strtotime($data_inicio) > strtotime($data_fim)){
            $retorno['msg'] = "Data Fim precisa ser maior ou igual a Data Inicio";
            return $retorno;
        }
        
        $cliente = new cliente();
        $cliente->setId($request['cliente']);
        
        $servico = new servico();
        $servico->setId($request['servico']);
            
        $pedido = new pedido();
        $pedido->setId($request['id']);
        $pedido->setCliente($cliente);
        $pedido->setServico($servico);
        $pedido->setDataInicio($data_inicio);
        $pedido->setDataFim($data_fim);
        
        $pedidoDao = new pedidoDao();
        if($request['id'] == 0){
            $results = $pedidoDao->inserir($pedido);
        }else{
            $results = $pedidoDao->alterar($pedido);
        }
        
        $retorno['data'] = $results;
        if($results){
            $retorno['ok'] = 'S';
            $retorno['msg'] = 'Registro salvo com sucesso';
        }
        
        return $retorno;
    }
    
    public function deletar($request){
        $retorno['ok'] = 'N';
        $retorno['msg'] = 'Nenhum dado alterado';
        
        if(!isset($request['id']) || !is_numeric($request['id']) ){
            $retorno['msg'] = 'Código inválido';
            return $retorno;
        }
        
        $pedido = new pedido();
        $pedido->setId($request['id']);
        
        $pedidoDao = new pedidoDao();
        $results = $pedidoDao->deletar($pedido);
        
        $retorno['data'] = $results;
        if($results){
            $retorno['ok'] = 'S';
            $retorno['msg'] = 'Registro deletado com sucesso';
        }
        
        return $retorno;
    }
}
