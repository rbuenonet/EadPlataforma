function carregaCliente(){
    $.ajax({
        url:"view/cliente.php",
        success: function(data) {
            $("#conteiner").html(data);
            carregaListarClientes();
        }
    })
}

function carregaListarClientes(){
    var id = $("#filtroId").val();
    var nome = $("#filtroNome").val();
    var param = "&id="+id+"&nome="+nome;
    
    $("#listagem").html("");
    
    $.ajax({
        url:"ws/cliente.php?acao=listarCliente",
        type: 'POST',
        data: param,
        dataType:"json",
        success: function(data) {
            if(data.ok == "S"){
                data.data.forEach(
                    function(row){
                        var linha = "<tr>";
                        linha += "<td width='90%'>";
                        linha += "("+row.id+") "+row.nome;
                        linha += "</td>";
                        linha += "<td align='center'>";
                        linha += "<button type='button' class='btn btn-default' onclick='editarCliente("+row.id+")'>";
                        linha += "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>";
                        linha += "</button>";
                        linha += "</td>";
                        linha += "<td align='center'>";
                        linha += "<button type='button' class='btn btn-default'>";
                        linha += "<span class='glyphicon glyphicon-remove-sign' aria-hidden='true' onclick='excluirCliente("+row.id+")'></span>";
                        linha += "</button>";
                        linha += "</td>";
                        linha += "</tr>";  
                        $("#listagem").append(linha);
                    }
                )
            }else{
                var linha = "<tr>";
                linha += "<td colspan='4' align='center'>";
                linha += data.msg
                linha += "</td>"; 
                linha += "</tr>";  
                $("#listagem").append(linha);
            }
        }
    })
}

function editarCliente(id){    
    var param = "id="+id;    
    $.ajax({
        url:"ws/cliente.php?acao=consultarCliente",
        type: 'POST',
        data: param,
        dataType:"json",
        success: function(data) {
            if(data.ok=='S'){
                $("#titulo_modal").html("Alterar")
                $('#modalManutencao').modal('show')
                $("#id").val(data.data.id);
                $("#nome").val(data.data.nome);
                $("#email").val(data.data.email);
                $("#telefone").val(data.data.telefone);
            }else{
                alert(data.msg);
                $('#modalManutencao').modal('hide')
            }
        }
    })    
}

function salvarCliente(){
    $.ajax({
        url:"ws/cliente.php?acao=manutencaoCliente",
        type: 'POST',
        data: $("#manutencaoCliente").serialize(),
        dataType:"json",
        success: function(data) {
            if(data.ok=='S'){
                alert(data.msg);
                $('#modalManutencao').modal('hide')
                carregaListarClientes()
            }else{
                alert(data.msg);
            }
        }
    })
}

function excluirCliente(id){
    var msg = confirm("Deseja mesmo excluir esse cliente?");
    if(msg){
        $.ajax({
            url:"ws/cliente.php?acao=deletarCliente",
            type: 'POST',
            data: "id="+id,
            dataType:"json",
            success: function(data) {
                if(data.ok=='S'){
                    alert(data.msg);
                    $('#modalManutencao').modal('hide')
                    carregaListarClientes()
                }else{
                    alert(data.msg);
                    $('#modalManutencao').modal('hide')
                }
            }
        })
    }
}