<?php

class PontosColeta{
    protected $id;
    protected $descricao;
    protected $idCadastro;
    protected $latitude;
    protected $longitude;
    protected $idEndereco;

    public function __construct($descricao, $idCadastro, $latitude, $longitude, $idEndereco){
        $this->descricao = $descricao;
        $this->idCadastro = $idCadastro;
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

    public function get_idCadastro(){
        return $this->idCadastro;
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