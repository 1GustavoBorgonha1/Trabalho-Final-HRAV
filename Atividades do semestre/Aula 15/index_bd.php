<?php

    $conexaobd = new conexaobd();
    $conexaobd->sethost("127.0.0.1");
    $conexaobd->setporta(5432);
    $conexaobd->setusername("postgres");
    $conexaobd->setpassword("1234");
    if(!$conexaobd->conectar()){
        echo "Falha na conexão";
    }

?>