<?php
    namespace CT275\Project;
    use PDO;

    class Db {
        private static $instance = NULL;
        private function __construct(){}
        private function __clone(){}

        public static function getInstance(){
            if(!isset(static::$instance)){
                $dsn = 'mysql:host=localhost; dbname=ct275_project;charset=utf8';
                $options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                static::$instance =  new PDO($dsn,'root','',$options);
            }
            return static::$instance;
        }

    }

?>