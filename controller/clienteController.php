<?php


include_once '../../api/database.php';
include_once '../../model/dao/clienteDao.php';
include_once '../../model/cliente.php';

class clienteController {
    
    private $campos_obrigatorios = array(
        array('nome' => 'nome', 'label' => 'Nome')
    );
   
    public function listar($request){
        $retorno['ok'] = 'N';
        $retorno['msg'] = 'Nenhum registro encontrado';            
            
        $cliente = new cliente();
        $cliente->setId($request['id']);
        $cliente->setNome($request['nome']);

        $clienteDao = new clienteDao();
        $results = $clienteDao->listar($cliente);
        
        $retorno['data'] = $results;
        if(count($results)){
            $retorno['ok'] = 'S';
            $retorno['msg'] = '';
        }
        
        return $retorno;
    }   
    
    public function consultar($request){
        $retorno['ok'] = 'N';
        $retorno['msg'] = 'Nenhum dado encontrado';

        if(!isset($request['id'])){
            $retorno['msg'] = 'Código inválido';
            return $retorno;
        }
        
        $cliente = new cliente();
        $cliente->setId($request['id']);
        
        $clienteDao = new clienteDao();
        $results = $clienteDao->consultar($cliente);
        
        $retorno['data'] = $results;
        if(count($results) && $results){
            $retorno['ok'] = 'S';
            $retorno['msg'] = '';
        }
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
        
        $cliente = new cliente();
        $cliente->setId($request['id']);
        $cliente->setNome($request['nome']);
        $cliente->setEmail($request['email']);
        $cliente->setTelefone($request['telefone']);
        
        $clienteDao = new clienteDao();
        if($request['id'] == 0){
            $results = $clienteDao->inserir($cliente);
        }else{
            $results = $clienteDao->alterar($cliente);
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
        
        $cliente = new cliente();
        $cliente->setId($request['id']);
        
        $clienteDao = new clienteDao();
        $results = $clienteDao->deletar($cliente);
        
        $retorno['data'] = $results;
        if($results){
            $retorno['ok'] = 'S';
            $retorno['msg'] = 'Registro deletado com sucesso';
        }
        
        return $retorno;
    }
}
