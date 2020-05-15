<?php
session_start();

if (isset($_SESSION['valid']) && $_SESSION['valid'] == false) {
    header("Location:pharmSignin.php");
}
if (isset($_POST["drugID"]) ){
    

                require_once('DBCon.php');
                $DB = new DBClass();
                $conn = $DB->startCon();

                $sql = "SELECT * FROM drugs where id=" . $_POST["drugID"];
                $result = $conn->query($sql);

                if ($result->num_rows != null) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        $str = $row["availability"];  
                        $delimiter =  "|"; 

                        $token = strtok($str, $delimiter);  
                        $newAvail = "";
                        while($token !==false) {
                            if ( $token == $_SESSION['id'] ){
                                
                            }
                            else {
                                $newAvail = $newAvail . "|" . $token ;
                            }
                            $token =strtok($delimiter);  
                        }
                        
                        
                        $sqlUpdate = "UPDATE drugs SET availability='" . substr($newAvail , 1, strlen($newAvail)-1 ) . "' WHERE id=" . $_POST["drugID"];

                        if ($conn->query($sqlUpdate) === TRUE) {
                            header("Location:profile.php");
                        } else {
                            header("Location:profile.php");
                        }
                    }
                } else {
                    header("Location:profile.php");
                }

                $conn->close();

}
else {
    header("Location:profile.php");
}
                ?>