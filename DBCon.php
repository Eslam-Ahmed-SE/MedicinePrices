<?php

class DBClass {
    public $servername;
    public $username;
    public $password;
    public $dbname;

    function __construct(){
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "root";
        $this->dbname = "medprices";
    }
    
//    function __construct($name) {
//        $this->name = $name;
//    }
    
    
    function startCon() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;
    }
    
    function getGovName($id) {
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "root";
        $this->dbname = "medprices";
        
        $name = "a ";
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT governorate_name FROM governorates where id=" . $id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            $name = $row["governorate_name"];
          }
        } else {
          $name = "0 results";
        }
        $conn->close();
        
        return $name;
    }
    
    function getCityName($id) {
        
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "root";
        $this->dbname = "medprices";
        
        $name = "a ";
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT city_name FROM cities where id=" . $id;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            $name = $row["city_name"];
          }
        } else {
          $name = "0 results";
        }
        $conn->close();
        
        return $name;
    }
}

?>