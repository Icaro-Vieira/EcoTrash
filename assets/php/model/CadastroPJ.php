<?php

require_once("Cadastro.php");

class CadastroPJ extends Cadastro{

    protected $segmento;

    public function __construct($nome, $documento, $email, $telefone, $idEndereco, $segmento, $senha){
        parent::__construct($nome, $documento, $email, $telefone, $idEndereco, $senha, "J");
        $this->segmento = $segmento;
    }

    public function get_segmento(){
        return $this->segmento;
    }

}

?>