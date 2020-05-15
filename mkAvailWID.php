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
                        
                        
                        $sqlUpdate = "UPDATE drugs SET availability='" . $row["availability"] . "|" . $_SESSION['id'] . "' WHERE id=" . $_POST["drugID"];

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