<?php

class API {
    var $pharmID = 0;
    
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
        header('content-type: application/json');
        echo '{ "success":   {"text": "User name and password are corect",
                                     "code": 20},
                "id": ' . $API->pharmID . '
                                     }';
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
//          successs:
//              20: User name and password are corect


?>