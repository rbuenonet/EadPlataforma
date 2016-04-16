function carregaPedido(){
    $.ajax({
        url:"view/pedido.php",
        success: function(data) {
            $("#conteiner").html(data);
            carregaFiltroCliente();
            carregaFiltroServico();
            carregaListarPedidos();
        }
    })
}

function carregaFiltroCliente(){
    $.ajax({
        url:"ws/cliente.php?acao=listarCliente",
        dataType:"json",
        success: function(data) {
            if(data.ok == "S"){             
                data.data.forEach(
                    function(row){
                        var linha = "<option value='"+row.id+"'> "+row.nome+" </option>";
                        $("#filtroCliente").append(linha);
                        $("#cliente").append(linha);
                    }
                )
            }else{
                alert(data.msg);
            }
        }
    })
}

function carregaFiltroServico(){
    $.ajax({
        url:"ws/servico.php?acao=listarServico",
        dataType:"json",
        success: function(data) {
            if(data.ok == "S"){               
                data.data.forEach(
                    function(row){
                        var linha = "<option value='"+row.id+"'> "+row.nome+" </option>";
                        $("#filtroServico").append(linha);
                        $("#servico").append(linha);
                    }
                )
            }else{
                alert(data.msg);
            }
        }
    })
}

function carregaListarPedidos(){
    var id = $("#filtroId").val();
    var cliente = $("#filtroCliente").val();
    var servico = $("#filtroServico").val();
    
    var param = "&id="+id+"&cliente="+cliente+"&servico="+servico;
    
    $("#listagem").html("");
    
    $.ajax({
        url:"ws/pedido.php?acao=listarPedido",
        type: 'POST',
        data: param,
        dataType:"json",
        success: function(data) {
            if(data.ok == "S"){
                data.data.forEach(
                    function(row){                        
                        var data_fim = row.data_fim.split("-");
                        data2 = new Date(data_fim[0] + "/" + data_fim[1] + "/" + data_fim[2]);
                        var data1 = new Date();                        
                        var total = dateDiferencaEmDias( data1, data2 );
    
    
                        var linha = "<tr>";
                        linha += "<td>";
                        linha += row.id;
                        linha += "</td>";
                        linha += "<td>";
                        linha += row.cliente.nome;
                        linha += "</td>";
                        linha += "<td>";
                        linha += row.servico.nome;
                        linha += "</td>";
                        linha += "<td>Faltam ";
                        linha += total;
                        linha += " dias ("+data_fim.reverse().join('/')+")</td>";
                        linha += "<td align='center'>";
                        linha += "<button type='button' class='btn btn-default' onclick='editarPedido("+row.id+")'>";
                        linha += "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>";
                        linha += "</button>";
                        linha += "</td>";
                        linha += "<td align='center'>";
                        linha += "<button type='button' class='btn btn-default'>";
                        linha += "<span class='glyphicon glyphicon-remove-sign' aria-hidden='true' onclick='excluirPedido("+row.id+")'></span>";
                        linha += "</button>";
                        linha += "</td>";
                        linha += "</tr>";  
                        $("#listagem").append(linha);
                    }
                )
            }else{
                var linha = "<tr>";
                linha += "<td colspan='6' align='center'>";
                linha += data.msg
                linha += "</td>"; 
                linha += "</tr>";  
                $("#listagem").append(linha);
            }
        }
    })
}

function editarPedido(id){    
    var param = "id="+id;    
    $.ajax({
        url:"ws/pedido.php?acao=consultarPedido",
        type: 'POST',
        data: param,
        dataType:"json",
        success: function(data) {
            if(data.ok=='S'){
                var data_inicio = data.data.data_inicio.split('-').reverse().join('/');
                var data_fim = data.data.data_fim.split('-').reverse().join('/');
                
                $("#titulo_modal").html("Alterar")
                $('#modalManutencao').modal('show')
                $("#id").val(data.data.id);
                $("#cliente").val(data.data.cliente.id);
                $("#servico").val(data.data.servico.id);
                $("#data_inicio").val(data_inicio);
                $("#data_fim").val(data_fim);
            }else{
                alert(data.msg);
                $('#modalManutencao').modal('hide')
            }
        }
    })    
}

function salvarPedido(){
    $.ajax({
        url:"ws/pedido.php?acao=manutencaoPedido",
        type: 'POST',
        data: $("#manutencaoPedido").serialize(),
        dataType:"json",
        success: function(data) {
            if(data.ok=='S'){
                alert(data.msg);
                $('#modalManutencao').modal('hide')
                carregaListarPedidos()
            }else{
                alert(data.msg);
            }
        }
    })
}

function excluirPedido(id){
    var msg = confirm("Deseja mesmo excluir esse pedido?");
    if(msg){
        $.ajax({
            url:"ws/pedido.php?acao=deletarPedido",
            type: 'POST',
            data: "id="+id,
            dataType:"json",
            success: function(data) {
                if(data.ok=='S'){
                    alert(data.msg);
                    $('#modalManutencao').modal('hide')
                    carregaListarPedidos()
                }else{
                    alert(data.msg);
                    $('#modalManutencao').modal('hide')
                }
            }
        })
    }
}