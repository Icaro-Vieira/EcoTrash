<?php

    require_once("User.php");

    class PersonalUser extends User{

        protected $sobrenome;

        public function __construct($nome, $sobrenome, $documento, $email, $telefone, $idEndereco, $senha){
            parent::__construct($nome, $documento, $email, $telefone, $idEndereco, $senha, "F");
            $this->sobrenome = $sobrenome;
        }

        public function get_sobrenome(){
            return $this->sobrenome;
        }

    }

?>