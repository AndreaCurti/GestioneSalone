<?php 
    abstract class Database{
        private static $username = "admin";
        private static $password = "Admin123!";
        private static $hostname = "localhost";
        private static $dbname = "gestione_salone";

        private static $connection = "";

        public static function getConnection(){
            if(self::$connection != ""){
                return self::$connection;
            }
            self::$connection = new mysqli(self::$hostname, self::$username, self::$password, self::$dbname);
            if(self::$connection->connect_error){
                die("Connection failed: ".self::$connection->connect_error);
            }
            return self::$connection;
        }
    }
?>