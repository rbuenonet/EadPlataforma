# Desafio Ead Plataforma

Criar uma aplicação PHP web onde o usuário da aplicação poderá:
Cadastrar os clientes da minha empresa (incluir, listar, alterar e excluir)
Cadastrar os serviços que minha empresa oferece (aqui pode ser somente o cadastro mesmo, sem a necessidade de fazer toda manutenção do cadastro)
Registrar que meu cliente contratou um serviço da minha empresa onde possa definir a data de início de e fim do serviço
Visualizar quais serviços meu cliente tem contratado e quantos dias faltam para atingir a data final do serviço
Além disso gostaria de disponibilizar um serviço (WS) que retorne um JSON contendo os dados de todos os serviços da minha empresa. Esse serviço poderá ser consumido por uma outra aplicação.

Requisitos técnicos:
-Backend em PHP5, utilizando POO, arquitetura MVC
-Deverá utilizar PDO para persistência dos dados
-Banco de dados MySQL
-Frontend pode ser feito da forma que quiser (não se preocupe com layout), apenas aplique CSS básico para alinhar os elementos

### Instalação ###

Configure o vhost do apache para apontar para a pasta **public** do projeto.

```html
<VirtualHost *:80>
    ServerName dev
	ServerAlias ead.dev
	UseCanonicalName Off
	VirtualDocumentRoot /Sites/ead/public/
    <Directory />
    	DirectoryIndex index.php
		AllowOverride All
		Order allow,deny
		Allow from all
		Options Indexes MultiViews FollowSymLinks
		Require all granted
    </Directory>
</VirtualHost>
```
### Ws ###

* **Chamadas**
    - **ead.dev/ws/cliente.php**
      - **?acao=listarCliente:** Carrega o JSON com todos os Clientes cadastrados
        - **&id=INT&nome=STRING:** Parametros para realizar filtragem dos Clientes
      - **?acao=consultarCliente:** Carrega o JSON com os dado de um determinado Cliente
        - **&id=INT:** Parametro obrigatório para encontrar o Cliente
      - **?acao=manutencaoCliente:** Salva o formulario de Cliente (INSERT e UPDATE)
        - **&id=INT:** Enviar zero para INSERT ou algum código existente para UPDATE
        - **&nome=STRING:** Parametro contendo o nome desejado para salvar no banco de dados
        - **&email=STRING:** Parametro contendo o email desejado para salvar no banco de dados
        - **&telefone=STRING:** Parametro contendo o telefone desejado para salvar no banco de dados
      - **?acao=deletarCliente:** Deleta um determinado Cliente
        - **&id=INT:** Parametro obrigatório para deletar o Cliente

    - **ead.dev/ws/servico.php**
      - **?acao=listarServico:** Carrega o JSON com todos os Serviço cadastrados
        - **&id=INT&nome=STRING:** Parametros para realizar filtragem dos Serviço
      - **?acao=consultarServico:** Carrega o JSON com os dado de um determinado Serviço
        - **&id=INT:** Parametro obrigatório para encontrar o Serviço
      - **?acao=manutencaoServico:** Salva o formulario de Serviço (INSERT e UPDATE)
        - **&id=INT:** Enviar zero para INSERT ou algum código existente para UPDATE
        - **&nome=STRING:** Parametro contendo o nome desejado para salvar no banco de dados
      - **?acao=deletarServico:** Deleta um determinado Serviço
        - **&id=INT:** Parametro obrigatório para deletar o Serviço

    - **ead.dev/ws/pedido.php**
      - **?acao=listarPedido:** Carrega o JSON com todos os Pedido cadastrados
        - **&id=INT&cliente=INT&servico=INT:** Parametros para realizar filtragem dos Pedido
      - **?acao=consultarPedido:** Carrega o JSON com os dado de um determinado Pedido
        - **&id=INT:** Parametro obrigatório para encontrar o Pedido
      - **?acao=manutencaoPedido:** Salva o formulario de Pedido (INSERT e UPDATE)
        - **&id=INT:** Enviar zero para INSERT ou algum código existente para UPDATE
        - **&cliente=INT:** Parametro contendo o código do cliente desejado para salvar no banco de dados
        - **&servico=INT:** Parametro contendo o código do serviço desejado para salvar no banco de dados
        - **&data_inicio=DATE(dd/mm/yyyy):** Parametro contendo a data inicial desejada para salvar no banco de dados
        - **&data_fim=DATE(dd/mm/yyyy):** Parametro contendo a data fim desejada para salvar no banco de dados
      - **?acao=deletarPedido:** Deleta um determinado Pedido
        - **&id=INT:** Parametro obrigatório para deletar o Pedido

* **Retorno**
    - **JSON**
        - **ok:** Retorna se executou com sucesso (S) ou ocorreu algum erro (N)
        - **msg:** Se retornou erro, retorna o erro ocorrido (usado para realizar validações
        - **data:** Conteúdo solicitado



### Arquitetura ###
    - **./api:** Pasta onde será armazenado as bibliotecas criadas pelo programador ou de terceiros. Ex: Biblioteca de controle do banco de dados
    - **./controller:** Pasta onde será armazenados todos os controllers responsáveis pelas regras de negocio do projeto. Ex: clienteController.php - Realiza o controle de todas as regras referente ao módulo cliente
    - **./model:** Pasta onde conterá todos os setters e getters e a pasta Dao
    - **./model/dao:** Pasta onde terá todos os arquivos responsável pela comunicação com o banco de dados. Ex: clienteDao.php - Arquivo responsavel por possuir todos os métodos de manutenção e consulta da tabela/módulo cliente
    - **./public:** Pasta onde terá todos os arquivos responsável pela view
    - **./public/front:** Pasta onde armazenará todos os códigos do front-end, ou seja, todos os arquivos css, js, font e imagens
    - **./public/view:** Pasta onde terá todos os arquivos templates que serão mostrados para o usuário
    - **./public/ws:** Pasta onde terá os arquivos de controle do Web Service, Ex: cliente.php - Arquivo chamado pelo navegador: [DOMINIO]/ws/cliente.php?acao=[AÇÃO DESEJADA]


    