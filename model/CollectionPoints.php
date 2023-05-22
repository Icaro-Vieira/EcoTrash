<?php

    class CollectionPoints{
        protected $id;
        protected $descricao;
        protected $documento;
        protected $latitude;
        protected $longitude;
        protected $idEndereco;

        public function __construct($descricao, $documento, $latitude, $longitude, $idEndereco){
            $this->descricao = $descricao;
            $this->documento = $documento;
            $this->latitude = $latitude;
            $this->longitude = $longitude;
            $this->idEndereco = $idEndereco;
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

        public function get_documento(){
            return $this->documento;
        }

        public function get_latitude(){
            return $this->latitude;
        }

        public function get_longitude(){
            return $this->longitude;
        }

        public function get_idEndereco(){
            return $this->idEndereco;
        }
    }
    
?>