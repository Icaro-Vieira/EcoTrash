<?php

abstract class Cadastro{
    protected $id;
    protected $nome;
    protected $documento;
    protected $email;
    protected $telefone;
    protected $idEndereco;
    protected $senha;
    protected $tipoCadastro;

    public function __construct($nome, $documento, $email, $telefone, $idEndereco, $senha, $tipoCadastro){
        $this->nome = $nome;
        $this->documento = $documento;
        $this->email = $email;
        $this->telefone = $telefone;
        $this->idEndereco = $idEndereco;
        $this->senha = $senha;
        $this->tipoCadastro = $tipoCadastro;
    }

    public function get_id(){
        return $this->id;
    }

    public function set_id($id){
        $this->id = $id;
    }

    public function get_nome(){
        return $this->nome;
    }

    public function get_documento(){
        return $this->documento;
    }

    public function get_email(){
        return $this->email;
    }

    public function get_telefone(){
        return $this->telefone;
    }

    public function get_idEndereco(){
        return $this->idEndereco;
    }

    public function get_senha(){
        return $this->senha;
    }

    public function get_tipoCadastro(){
        return $this->tipoCadastro;
    }
}

?>