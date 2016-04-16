<div class="panel panel-default">
    <div class="panel-heading topo-painel">
        <h4>
            Serviço
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
                    <input type="text" class="form-control" id="filtroId" onkeyup="carregaListarServicos()">
                </div>
                <div class="input-group form-group">
                    <div class="input-group-addon">Nome</div>
                    <input type="text" class="form-control" id="filtroNome" onkeyup="carregaListarServicos()">
                </div>
            </div>
        </form>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th width='90%'>(Código) Nome</th>
                <th align="center">Editar</th>
                <th align="center">Excluir</th>
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
                <h4 class="modal-title" id="myModalLabel"><span id="titulo_modal">Inserir</span> Serviço</h4>
            </div>
            <div class="modal-body">
                <form id="manutencaoServico" name="manutencaoServico">
                    <input type="hidden" id="id" name="id" value="0" />
                    <div class="input-group">
                        <span class="input-group-addon" id="basic-addon1">Nome</span>
                        <input type="text" class="form-control" aria-describedby="basic-addon1" id="nome" name="nome">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="salvarServico()">Salvar</button>
            </div>
        </div>
    </div>
</div>
<script>
    $('#modalManutencao').on('hidden.bs.modal', function (e) {
        $("#titulo_modal").html("Inserir");
        $("#id").val('0');
        $("#nome").val('');
    })
</script>
