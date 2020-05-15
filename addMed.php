<?php
session_start();
//
//if (isset($_SESSION['valid']) && $_SESSION['valid'] == false) {
//    header("Location:pharmSignin.php");
//}
require_once('DBCon.php');
$DB = new DBClass();
$conn = $DB->startCon();

$name = "";
$price = "";
if (isset($_POST["value"]) && isset($_POST["price"]) ){
    $name = $_POST["value"];
    $price = $_POST["price"];

    $sql = "INSERT INTO drugs (name, price, availability) VALUES ('" . $name . "', " . $price . ", " . $_SESSION["id"] . " );";
//    echo $sql;

    if ($conn->query($sql) === TRUE) {
        echo "<span style='color:green'>
        تم الإضافه
        </span>";
    } else {
        echo "<span style='color:red'>
        حدث خطأ
        </span>";
//        echo "خطأ: " . $sql . "<br>" . $conn->error;
    }
    
$conn->close();
    
    }
?>