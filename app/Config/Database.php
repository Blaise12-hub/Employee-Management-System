<?php
 namespace App\Config;

 use PDO;
 use PDOException;
 use Dotenv\Dotenv;

class Database{
    private $host;
    private $db_name;
    private $password;
    private $conn;

    public function __construct(){
        // $dotenv =Dotenv::createImmutable(__DIR__ . '/../');
        // $dotenv->load();

        // $this->host = $_ENV['DB_HOST'];
        // $this->db_name = $_ENV['DB_DATABASE'];
        // $this->username = $_ENV['DB_USER'];
        // $this->password = $_ENV['DB_PASS'];

        $this->host ='localhost';
        $this->db_name = 'employeems';
        $this->username = 'root';
        $this->password = '';

    }
    public function connect(){
        $this->conn = null;
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . "dbname=" . $ths->db_name, $this->username,$this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            die("Database Connection Error:" . $e->getMessage());
        }
        return $this->conn;
    }

}


?>