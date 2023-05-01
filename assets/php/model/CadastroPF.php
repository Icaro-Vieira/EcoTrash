<?php

require_once("Cadastro.php");

class CadastroPF extends Cadastro{

    protected $dataNascimento;

    public function __construct($nome, $dataNascimento, $documento, $email, $telefone, $idEndereco, $senha){
        parent::__construct($nome, $documento, $email, $telefone, $idEndereco, $senha, "F");
        $this->dataNascimento = $dataNascimento;
    }

    public function get_dataNascimento(){
        return $this->dataNascimento;
    }

}

?>