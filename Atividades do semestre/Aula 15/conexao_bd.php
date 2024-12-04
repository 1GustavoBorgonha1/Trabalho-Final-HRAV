<?php

    class Conexaobd{

        private $host;
        private $porta;
        private $userName;
        private $password;
        private $dbconn;
        public function setHost($host){
            $this->host = $host;
        }
        public function setPorta($porta){
            $this->porta = $porta;
        }
        public function setUserName($userName){
            $this->userName = $userName;
        }
        public function setPassword($password){
            $this->password = $password;
        }
        public function conectar(){
            try {
                $this->$dbconn = pg_conenct
            }
        }
    }

?>