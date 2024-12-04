<? 

    function getdesconto(){
        return $_REQUEST["desconto"] ;
    }

    function getvalor(){
        return $_REQUEST["valor"] ;
    }

    function calculavalorfinal() {
        return getvalor() - getdesconto() ;     
    }

    function exibirmensagem($mensagem){
        echo $mensagem;
    }

    exibirmensagem("Valor Final". calculavalorfinal());

    exibirmensagem(var_dump($_REQUEST))
?>