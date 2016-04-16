function carregaServico(){
    $.ajax({
        url:"view/servico.php",
        success: function(data) {
            $("#conteiner").html(data);
            carregaListarServicos();
        }
    })
}

function carregaListarServicos(){
    var id = $("#filtroId").val();
    var nome = $("#filtroNome").val();
    var param = "&id="+id+"&nome="+nome;
    
    $("#listagem").html("");
    
    $.ajax({
        url:"ws/servico.php?acao=listarServico",
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
                        linha += "<button type='button' class='btn btn-default' onclick='editarServico("+row.id+")'>";
                        linha += "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>";
                        linha += "</button>";
                        linha += "</td>";
                        linha += "<td align='center'>";
                        linha += "<button type='button' class='btn btn-default'>";
                        linha += "<span class='glyphicon glyphicon-remove-sign' aria-hidden='true' onclick='excluirServico("+row.id+")'></span>";
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

function editarServico(id){    
    var param = "id="+id;    
    $.ajax({
        url:"ws/servico.php?acao=consultarServico",
        type: 'POST',
        data: param,
        dataType:"json",
        success: function(data) {
            if(data.ok=='S'){
                $("#titulo_modal").html("Alterar")
                $('#modalManutencao').modal('show')
                $("#id").val(data.data.id);
                $("#nome").val(data.data.nome);
            }else{
                alert(data.msg);
                $('#modalManutencao').modal('hide')
            }
        }
    })    
}

function salvarServico(){
    $.ajax({
        url:"ws/servico.php?acao=manutencaoServico",
        type: 'POST',
        data: $("#manutencaoServico").serialize(),
        dataType:"json",
        success: function(data) {
            if(data.ok=='S'){
                alert(data.msg);
                $('#modalManutencao').modal('hide')
                carregaListarServicos()
            }else{
                alert(data.msg);
            }
        }
    })
}

function excluirServico(id){
    var msg = confirm("Deseja mesmo excluir esse serviço?");
    if(msg){
        $.ajax({
            url:"ws/servico.php?acao=deletarServico",
            type: 'POST',
            data: "id="+id,
            dataType:"json",
            success: function(data) {
                if(data.ok=='S'){
                    alert(data.msg);
                    $('#modalManutencao').modal('hide')
                    carregaListarServicos()
                }else{
                    alert(data.msg);
                    $('#modalManutencao').modal('hide')
                }
            }
        })
    }
}