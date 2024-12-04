<?php
// 10.Dado o Array abaixo, pede-se para recursivamente criar a árvore ao lado:

$past = array (
         "bsn" => array(
        "3a Fase" => array("desenvWeb", "bancoDados 1", "engSoft 1"), 
        "4a Fase" => array("Intro Web", "bancoDados 2", "engSoft")
    )
);

$x = 0;
    foreach ($past as $facul => $arrayfase) {
        echo "-", $facul,"<br>";
            foreach ($arrayfase as $fases => $arraymateria){
                echo "- -",$fases,"<br>";
                    foreach ($arraymateria as $materia){
                        echo "- - -",$materia,"<br>";
                    }
            }
    }
?>