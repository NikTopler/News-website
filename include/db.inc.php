<?php 

    class Dbh {
        private $host = 'localhost';
        private $dbName   = 'NewsWebsite';
        private $user   = 'root';
        private $pwd = '';
        private $charset = 'utf8mb4';

        protected function connect() {
            $dsn = 'mysql:host=' .$this->host. ';dbname=' .$this->dbName. ';charset=' .$this->charset ; 
            $pdo = new PDO($dsn, $this->user, $this->pwd);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        }
    }


    // class Dbh {
    //     private $host = '';
    //     private $dbName   = 'niktople_Fews';
    //     private $user   = 'niktople_nik';
    //     private $pwd = 'niktopler2002';
    //     private $charset = 'utf8mb4';

    //     protected function connect() {
    //         $dsn = 'mysql:host=' .$this->host. ';dbname=' .$this->dbName. ';charset=' .$this->charset ; 
    //         $pdo = new PDO($dsn, $this->user, $this->pwd);
    //         $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    //         return $pdo;
    //     }
    // }


