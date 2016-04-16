<!DOCTYPE html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Wise Madness</title>
        <link rel="stylesheet" href="front/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="front/css/bootstrap-theme.min.css"/>
        <link rel="stylesheet" href="front/css/style.css"/>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                        EAD
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="javascript:carregaCliente()">Cliente</a></li>
                        <li><a href="javascript:carregaServico()">Serviço</a></li>
                        <li><a href="javascript:carregaPedido()">Pedido</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid" id="conteiner">
        </div>
        
        <script src="front/js/jquery.min.js"></script>
        <script src="front/js/bootstrap.min.js"></script>
        <script src="front/js/all.js"></script>
        <script src="front/js/cliente.js"></script>
        <script src="front/js/servico.js"></script>
        <script src="front/js/pedido.js"></script>
        
        <script>carregaPedido()</script>
    </body>
</html>