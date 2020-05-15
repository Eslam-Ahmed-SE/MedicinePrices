<?php

class API {
    var $pharmID = 0;
    
    function makeAvail($id) {
        require_once('../DBCon.php');
        $DB = new DBClass();
        $conn = $DB->startCon();

        $sql = "SELECT * FROM drugs where id=" . $id;
        $result = $conn->query($sql);

        if ($result->num_rows != null) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $str = $row["availability"];  
                $delimiter =  "|"; 

                $token = strtok($str, $delimiter);  
                $newAvail = "";
                while($token !==false) {
                    if ( $token == $this->pharmID ){

                    }
                    else {
                        $newAvail = $newAvail . "|" . $token ;
                    }
                    $token =strtok($delimiter);  
                }


                $sqlUpdate = "UPDATE drugs SET availability='" . substr($newAvail , 1, strlen($newAvail)-1 ) . "' WHERE id=" . $id;

                if ($conn->query($sqlUpdate) === TRUE) {
                    return '{"success":   { "text": "Made unavailable successfully",
                                            "code": 20}}';
                } else {
                    return '{"error":   { "text": "sql error",
                                            "code": 13}}';
                }
            }
        } else {
            return '{"error":   { "text": "sql error",
                                            "code": 14}}';
        }

        $conn->close();
    }
    
    function checkCreds($user, $pass) {
        require_once('../DBCon.php');
        $DB = new DBClass();
        $conn = $DB->startCon();

        $sql = "SELECT * FROM pharmacies";
        $result = $conn->query($sql);

        $found = 0;
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
        //        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                if ($user == $row["mail"] && $pass == $row["password"]){
                    $found = 1;
                    $this->pharmID = $row["id"];
                }
            }
        }
        
        if ($found == 1){return true;}
        else {return false;}
        $conn->close();
    }
}


$API = new API;
if ( isset($_POST["mail"]) && isset($_POST["pass"]) ){
    if ($API->checkCreds($_POST["mail"], $_POST["pass"])){
        if (isset($_GET["id"]) ){
            echo $API->makeAvail($_GET["id"]);
        }
        else {
            header('content-type: application/json');
            echo '{"error":   {"text": "No drug id found",
                                         "code": 12}}';
        }
    }
    else {
        header('content-type: application/json');
        echo '{"error":   {"text": "User name or password are incorect",
                                     "code": 10}}';
    }
}
else {
    header('content-type: application/json');
    echo '{"error": {"text": "User mail or password is empty", "code": 11}}';
}
//        codes:
//          errors: 
//              10: User name or password are incorect
//              11: User mail or password is empty
//              12: Drug id is empty
//              13: Sql error
//              14: no record found with this drug id
//          successs:
//              20: Updated availability


?>