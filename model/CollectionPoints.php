<?php

    class CollectionPoints{
        protected $id;
        protected $descricao;
        protected $cep;
        protected $logradouro;
        protected $bairro;
        protected $numero;
        protected $tipoMateriais;
        protected $idCadastro;

        public function __construct($descricao, $cep, $logradouro, $bairro, $numero, $tipoMateriais, $idCadastro){
            $this->descricao = $descricao;
            $this->cep = $cep;
            $this->logradouro = $logradouro;
            $this->bairro = $bairro;
            $this->numero = $numero;
            $this->tipoMateriais = $tipoMateriais;
            $this->idCadastro = $idCadastro;
        }

        public function get_id(){
            return $this->id;
        }

        public function set_id($id){
            $this->id = $id;
        }

        public function get_descricao(){
            return $this->descricao;
        }

        public function get_cep(){
            return $this->cep;
        }

        public function get_logradouro(){
            return $this->logradouro;
        }

        public function get_bairro(){
            return $this->bairro;
        }

        public function get_numero(){
            return $this->numero;
        }

        public function get_tipoMateriais(){
            return $this->tipoMateriais;
        }

        public function get_idCadastro(){
            return $this->idCadastro;
        }
    }
?>
