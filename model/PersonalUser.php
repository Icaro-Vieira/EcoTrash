<?php

    require_once("User.php");

    class PersonalUser extends User{

        public function __construct($nome, $documento, $email, $telefone, $idEndereco, $senha){
            parent::__construct($nome, $documento, $email, $telefone, $idEndereco, $senha, "F");
        }
    }

?>