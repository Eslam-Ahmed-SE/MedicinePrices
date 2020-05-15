<?php
session_start();
//
//if (isset($_SESSION['valid']) && $_SESSION['valid'] == false) {
//    header("Location:pharmSignin.php");
//}

require_once('DBCon.php');
                $DB = new DBClass();
                $conn = $DB->startCon();

$search = "";
if (isset($_GET["value"])){
    $search = $_GET["value"];
}
    ?>

    <?php


$sql = "SELECT * FROM drugs WHERE name like '%" . $search . "%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row

    echo "<table cellspacing='15'>";
    echo "<tr><th>م</th><th>الأسم</th><th>السعر</th><th></th></tr>";
    while($row = $result->fetch_assoc()) {

        $str = $row["availability"];  
        $delimiter =  "|"; 

        $token = strtok($str, $delimiter);  

        echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["price"]. "</td>";
        $availableFlag = 0;
        while($token !==false) {
            if ( $token == $_SESSION["id"] ){
                $availableFlag = 1;
            }
            $token =strtok($delimiter);  
        }
        if ($availableFlag == 0){
            echo "<td>غير متاح
                </td>
                <td>
                <form action='mkAvailWID.php' method='post'  class='fakeForm'>
                     <input type='number' name='drugID' value='" . $row["id"] . "' readonly/>
                     <input type='submit' value='تغيير الي متاح'/>
                </form>
                </td></tr>";
        }
        else {
            echo "<td>متاح
                </td>
                <td>
                <form action='mkUnavailWID.php' method='post' class='fakeForm'>
                     <input type='number' name='drugID' value='" . $row["id"] . "' />
                     <input type='submit' value='تغيير الي غير متاح'/>
                </form>
                </td></tr>";
        }

    }
    echo "</table>";
} else {
    echo "لا يوجد نتائج";
}
$conn->close();
?>