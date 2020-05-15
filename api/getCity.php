<?php

class API {
    function selectCity(){
        require_once('../DBCon.php');
        $DB = new DBClass();
        $conn = $DB->startCon();

        $sql = "SELECT * FROM cities";
        $result = $conn->query($sql);

        $i = 0;
        $pharms = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
        //        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                $pharms[$i] = array(
                    'id'            => $row["id"],
                    'gov_id'        => $row["gov_id"],
                    'city_name'     => $row["city_name"],
                    'city_name_en'  => $row["city_name_en"]
                );
                $i++;
            }
        }
        $conn->close();
        
        return json_encode($pharms, JSON_UNESCAPED_UNICODE);
    }
    
    function selectCityWID( $ID ) {
        require_once('../DBCon.php');
        $DB = new DBClass();
        $conn = $DB->startCon();

        $sql = "SELECT * FROM cities where id='" . $ID . "'";
        $result = $conn->query($sql);

        $i = 0;
        $pharms = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
        //        echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
                $pharms[$i] = array(
                    'id'            => $row["id"],
                    'gov_id'        => $row["gov_id"],
                    'city_name'     => $row["city_name"],
                    'city_name_en'  => $row["city_name_en"]
                );
                $i++;
            }
            
            $conn->close();
            return json_encode($pharms, JSON_UNESCAPED_UNICODE);
        }
        else {
            header('content-type: application/json');
            echo '{"error": {"text": "Nothing found", "code": 10}}';
        }
        
        
        
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
if ( isset($_GET["id"]) ){
    header('content-type: application/json');
    echo $API->selectCityWID($_GET["id"]);
}
else {
    header('content-type: application/json');
    echo $API->selectCity();
}
//if ($API->checkCreds("ezaby@mail.com", "123")){
//}


?>