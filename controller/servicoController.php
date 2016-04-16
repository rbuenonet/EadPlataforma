<?php


include_once '../../api/database.php';
include_once '../../model/dao/servicoDao.php';
include_once '../../model/servico.php';

class servicoController {
    
    private $campos_obrigatorios = array(
        array('nome' => 'nome', 'label' => 'Nome')
    );
   
    public function listar($request){
        $retorno['ok'] = 'N';
        $retorno['msg'] = 'Nenhum registro encontrado';            
            
        $servico = new servico();
        $servico->setId($request['id']);
        $servico->setNome($request['nome']);

        $servicoDao = new servicoDao();
        $results = $servicoDao->listar($servico);
        
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
        
        $servico = new servico();
        $servico->setId($request['id']);
        
        $servicoDao = new servicoDao();
        $results = $servicoDao->consultar($servico);
        
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
        
        $servico = new servico();
        $servico->setId($request['id']);
        $servico->setNome($request['nome']);
        
        $servicoDao = new servicoDao();
        if($request['id'] == 0){
            $results = $servicoDao->inserir($servico);
        }else{
            $results = $servicoDao->alterar($servico);
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
        
        $servico = new servico();
        $servico->setId($request['id']);
        
        $servicoDao = new servicoDao();
        $results = $servicoDao->deletar($servico);
        
        $retorno['data'] = $results;
        if($results){
            $retorno['ok'] = 'S';
            $retorno['msg'] = 'Registro deletado com sucesso';
        }
        
        return $retorno;
    }
}
