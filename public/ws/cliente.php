<?php
    include_once("../../controller/clienteController.php");
    $clienteController = new clienteController();
    
    $acao = $_REQUEST['acao'];

    switch ($acao) {
        case 'listarCliente':
            $results = $clienteController->listar($_REQUEST);
            echo json_encode($results);
            break;
        case 'consultarCliente':
            $results = $clienteController->consultar($_REQUEST);
            echo json_encode($results);
            break;
        case 'manutencaoCliente':
            $results = $clienteController->salvar($_REQUEST);
            echo json_encode($results);
            break;
        case 'deletarCliente':
            $results = $clienteController->deletar($_REQUEST);
            echo json_encode($results);
            break;
        default:
            $retorno['ok'] = 'S';  
            $retorno['msg'] = "Opção Inválida";
            echo json_encode($retorno);
            break;
    }
    
  