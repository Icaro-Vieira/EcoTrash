<?php
    session_start();
    session_destroy();

    header("Location: http://localhost/ProjetoAplicado/EcoTrash/view/index.php");
    
    exit();
?>