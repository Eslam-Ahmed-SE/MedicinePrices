<label class="govTxt">المحافظة</label>
<select id="govList" class="govSelect" name="pharmGov">
<?php

require_once('DBCon.php');
$DB = new DBClass();
$conn = $DB->startCon();
$sql = "SELECT * FROM governorates";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<option value='" . $row["id"] . "' class='gov" . $row["id"] . "'>". $row["governorate_name"]. "</option>";
        
//        $str = $row["availability"];  
//        $delimiter =  "|"; 
//
//        $token = strtok($str, $delimiter);  
//
//        while($token !==false)   
//        {  
//            $sql2 = "SELECT name FROM pharmacies where id=" . $token;
//            $result2 = $conn->query($sql2);
//
//            if ($result2->num_rows > 0) {
//                // output data of each row
//                while($row2 = $result2->fetch_assoc()) {
//                    echo "<a href='pharmInfo.php?id=" . $token . "'> -" . $row2["name"] . "</a>";
//                }
//            } else {
//                echo "0 results pharmacies";
//            }
//             $token =strtok($delimiter);  
//        }
        
    }
} else {
    echo "0 results";
}

    
    ?>
</select>
<br id="selectseparator">
    <label class="cityTxt">المدينه</label>
    <select class="citySelect" name="pharmCity">
    <?php
    
    $sql = "SELECT * FROM cities";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<option id='citiesList' class='from" . $row["gov_id"] . " city" . $row["id"] . "' style='display:none;' value='" . $row["id"] . "'>". $row["city_name"]. "</option>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
</select>
<br id="selectseparator">