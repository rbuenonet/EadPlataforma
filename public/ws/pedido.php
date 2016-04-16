<?php
    include_once("../../controller/pedidoController.php");
    $pedidoController = new pedidoController();
    
    $acao = $_REQUEST['acao'];

    switch ($acao) {
        case 'listarPedido':
            $results = $pedidoController->listar($_REQUEST);
            echo json_encode($results);
            break;
        case 'consultarPedido':
            $results = $pedidoController->consultar($_REQUEST);
            echo json_encode($results);
            break;
        case 'manutencaoPedido':
            $results = $pedidoController->salvar($_REQUEST);
            echo json_encode($results);
            break;
        case 'deletarPedido':
            $results = $pedidoController->deletar($_REQUEST);
            echo json_encode($results);
            break;
        default:
            $retorno['ok'] = 'S';  
            $retorno['msg'] = "Opção Inválida";
            echo json_encode($retorno);
            break;
    }
    
  