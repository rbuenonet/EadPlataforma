<?php

    class pedido {
        private $id;
        private $cliente;
        private $servico;
        private $dataInicio;
        private $dataFim;
        
        function getId() {
            return $this->id;
        }

        function getCliente() {
            return $this->cliente;
        }

        function getServico() {
            return $this->servico;
        }

        function getDataInicio() {
            return $this->dataInicio;
        }

        function getDataFim() {
            return $this->dataFim;
        }

        function setId($id) {
            $this->id = $id;
        }

        function setCliente($cliente) {
            $this->cliente = $cliente;
        }

        function setServico($servico) {
            $this->servico = $servico;
        }

        function setDataInicio($dataInicio) {
            $this->dataInicio = $dataInicio;
        }

        function setDataFim($dataFim) {
            $this->dataFim = $dataFim;
        }


    }
