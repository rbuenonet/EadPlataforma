<?php
    include_once("../../controller/servicoController.php");
    $servicoController = new servicoController();
    
    $acao = $_REQUEST['acao'];

    switch ($acao) {
        case 'listarServico':
            $results = $servicoController->listar($_REQUEST);
            echo json_encode($results);
            break;
        case 'consultarServico':
            $results = $servicoController->consultar($_REQUEST);
            echo json_encode($results);
            break;
        case 'manutencaoServico':
            $results = $servicoController->salvar($_REQUEST);
            echo json_encode($results);
            break;
        case 'deletarServico':
            $results = $servicoController->deletar($_REQUEST);
            echo json_encode($results);
            break;
        default:
            $retorno['ok'] = 'S';  
            $retorno['msg'] = "Opção Inválida";
            echo json_encode($retorno);
            break;
    }
    
  