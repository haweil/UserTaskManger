<?php 

class Dbh {
    
    protected function connect () {
        try {
           $username="root";
           $password = "";
           $port = '3307';
           $dbname ="Form1";
           $host = "localhost";
            return new PDO("mysql:host=$host;port=$port;dbname=$dbname", $username, $password);
        } catch (PDOException $e) {
            echo "Connection Failed".$e->getMessage()."<br>";
            die();
        }
    }

}