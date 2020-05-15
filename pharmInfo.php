
<!DOCTYPE html>
<html>
<body>

    <?php
    require_once('DBCon.php');
    $DB = new DBClass();
    $conn = $DB->startCon();

    $sql = "SELECT * FROM pharmacies where id=" . $_GET["id"];
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<br> id: ". $row["id"]. " - Name: ". $row["name"]. " - address: " . $row["address"] . " - nearest land mark: " . $row["landmark"] . "<br>";
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>

</body>
</html>