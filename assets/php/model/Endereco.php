<?php

class Endereco{
    protected $id;
    protected $logradouro;
    protected $numero;
    protected $complemento;
    protected $bairro;
    protected $cidade;
    protected $estado;
    protected $cep;

    public function __construct($logradouro, $numero, $complemento, $bairro, $cidade, $estado, $cep){
        $this->logradouro = $logradouro;
        $this->numero = $numero;
        $this->complemento = $complemento;
        $this->bairro = $bairro;
        $this->cidade = $cidade;
        $this->estado = $estado;
        $this->cep = $cep;
    }

    public function get_id(){
        return $this->id;
    }

    public function set_id($id){
        $this->id = $id;
    }

    public function get_logradouro(){
        return $this->logradouro;
    }

    public function get_numero(){
        return $this->numero;
    }

    public function get_complemento(){
        return $this->complemento;
    }

    public function get_bairro(){
        return $this->bairro;
    }

    public function get_cidade(){
        return $this->cidade;
    }

    public function get_estado(){
        return $this->estado;
    }

    public function get_cep(){
        return $this->cep;
    }
}

?>