<?php
    header('content-type: application/json');

    
class API {
    function addDrug(){
        require_once('DBCon.php');
        $DB = new DBClass();
        $conn = $DB->startCon();

        $name = "";
        $price = "";
        $pharmID = "";

        if (isset($_POST["medName"]) && isset($_POST["medPrice"]) && isset($_POST["pharmID"]) ){
            $name = $_POST["medName"];
            $price = $_POST["medPrice"];
            $pharmID = $_POST["pharmID"];

            $sql = "INSERT INTO drugs (name, price, availability) VALUES ('" . $name . "', " . $price . ", " . $pharmID . " );";
        //    echo $sql;

            if ($conn->query($sql) === TRUE) {
                return json_encode('[{"success": {  "text": "added successfully",
                                "code": 20}}]');
            } else {
                return json_encode('[{"error": {  "text": "an error occured",
                                "code": 11}}]');
            }


            $conn->close();
        }

        else {
            return json_encode('[{"error": {  "text": "Fields can not be empty",
                                "code": 12}}]');
        }
        
//        return json_encode($pharms, JSON_UNESCAPED_UNICODE);
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
                }
            }
        }
        
        if ($found == 1){return true;}
        else {return false;}
        $conn->close();
    }
}


$API = new API;
if ( isset($_POST["mailCred"]) && isset($_POST["passCred"]) ){
    if ($API->checkCreds($_POST["mailCred"], $_POST["passCred"])){
        echo $API->addDrug();
    }
    else {
        echo '[{"error": {  "text": "User name or password are wrong",
                            "code": 13}}]';
    }
//    echo $API->selectPhamaciesWID($_GET["id"]);
}
else {
    echo '[{"error": {  "text": "no name or password sent",
                        "code": 14}}]';
}

//        codes:
//          errors: 
//              11: sql error
//              12: one or more of the parameters are empty
//              13: Wrong credintials
//              14: no credintials received
//          successs:
//              20: added successfully
?>