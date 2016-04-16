<div class="panel panel-default">
    <div class="panel-heading topo-painel">
        <h4>
            Pedido
        </h4>
        <div class="btn-group alinhar-direita" role="group" aria-label="...">
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalManutencao">Novo</button>
        </div>
        <div class="limpar"></div>
    </div>
    <div class="panel-body centro">
        <form class="form-inline">
            <div class="form-group">
                <div class="input-group form-group">
                    <div class="input-group-addon">Código</div>
                    <input type="text" class="form-control" id="filtroId" onkeyup="carregaListarPedidos()">
                </div>
                <div class="input-group form-group input-margin">
                    <div class="input-group-addon">Cliente</div>
                    <select class="form-control" name="filtroCliente" id="filtroCliente" onchange="carregaListarPedidos()">
                        <option value="0"> - Selecione - </option>
                    </select>                    
                </div>
                <div class="input-group form-group input-margin">
                    <div class="input-group-addon">Serviço</div>
                    <select class="form-control" name="filtroServico" id="filtroServico" onchange="carregaListarPedidos()">
                        <option value="0"> - Selecione - </option>
                    </select>  
                </div>
            </div>
        </form>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th align="center">Código</th>
                <th>Cliente</th>
                <th>Serviço</th>
                <th>Prazo</th>
                <th align="center" width="5%">Editar</th>
                <th align="center" width="5%">Excluir</th>
            </tr>
        </thead>
        <tbody id="listagem">

        </tbody>
    </table>
</div>

<div class="modal fade" id="modalManutencao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><span id="titulo_modal">Inserir</span> Pedido</h4>
            </div>
            <div class="modal-body">
                <form id="manutencaoPedido" name="manutencaoPedido">
                    <input type="hidden" id="id" name="id" value="0" />
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Cliente</span>
                        <select class="form-control" name="cliente" id="cliente">
                            <option value="0"> - Selecione - </option>
                        </select>  
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Serviço</span>
                        <select class="form-control" name="servico" id="servico">
                            <option value="0"> - Selecione - </option>
                        </select>  
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Data Inicio</span>
                        <input type="text" class="form-control" aria-describedby="basic-addon1" id="data_inicio" name="data_inicio" onKeyPress="_mascara('data', event, this)">
                    </div>
                    <br />
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Data Fim</span>
                        <input type="text" class="form-control" aria-describedby="basic-addon1" id="data_fim" name="data_fim" onKeyPress="_mascara('data', event, this)">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="salvarPedido()">Salvar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#modalManutencao').on('hidden.bs.modal', function (e) {
        $("#titulo_modal").html("Inserir");
        $("#id").val('0');
        $("#cliente").val('0')
        $("#servico").val('0')
        $("#data_inicio").val('')
        $("#data_fim").val('')

    })
</script>
