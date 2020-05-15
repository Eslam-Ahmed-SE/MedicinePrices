<?php
    header('content-type: application/json');
    
    require_once('../DBCon.php');
    $DB = new DBClass();
    $conn = $DB->startCon();

    if (    isset($_POST["pharmName"])      && isset($_POST["pharmPhone"]) 
        &&  isset($_POST["pharmAddress"])   && isset($_POST["pharmNear"]) 
        &&  isset($_POST["pharmMail"])      && isset($_POST["pharmPass"]) )
    {
        $name = $_POST["pharmName"];
        $phone = $_POST["pharmPhone"];
        $address = $_POST["pharmAddress"];
        $landmark = $_POST["pharmNear"];
        $mail = $_POST["pharmMail"];
        $password = $_POST["pharmPass"];

        
        
        $sqlMail = "SELECT mail FROM pharmacies where mail like '%" . $mail . "%'";
        $resultMail = $conn->query($sqlMail);

        if ($resultMail->num_rows != null) {
            // output data of each row
            echo '[{"error": {"text": "Email already exists",
                              "code": 10}}]';
        }
        else {

            $sql = "INSERT INTO pharmacies (name, phone, address, landmark, password, mail)
            VALUES ('". $name."', ". $phone .", '". $address ."','". $landmark ."','". $password ."','". $mail . "')";

            if ($conn->query($sql) === TRUE) {
                echo '{"success":   {"text": "pharmacy added successfully",
                                     "code": 20}}';
            } else {
                echo '{"error": {"text": "' . $conn->error . '",
                                 "code": 11}}';
            }
        }
    }
    else {
        echo '[{"error": {  "text": "Fields can not be empty",
                            "code": 12}}]';
    }
    $conn->close();
//        codes:
//          errors: 
//              10: email already exists
//              11: sql error
//              12: one or more of the parameters are empty
//          successs:
//              20: added successfully
?>