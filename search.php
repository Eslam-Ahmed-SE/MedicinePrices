<!doctype html>
<html dir="rtl" lang="AR">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">

    <meta name="keywords" content="FCI">
    <meta name="subject" content="FCI">
    <meta name="copyright" content="FCI">
    <meta name="description" content="FCI">
    <meta name="author" content="Eslam Ahmed">
    <meta name="robots" content="index,follow">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Home</title>

    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!--        <script src="https://kit.fontawesome.com/20c8927541.js" crossorigin="anonymous"></script>-->
    
</head>
<body class="searchResultsBody">

    <div class="mainPageContainer">
        <div class="header">
            <h3><a href="/GradProjMedPrices/index.php">صيدليتى</a></h3>
        </div>
        <div class="searchBar">
            <form action="search.php">
                <input type="search" name="search" value="<?php echo $_GET["search"] ?>" placeholder="إسم الدواء">
                <input type="submit" value="بحث"/>
                <?php require_once('getGovAndCitySelect.php'); ?>
            </form>
        </div>
        <hr>
        <div class="searchResults">
            <table class="resultsTable">
                <caption>نتائج البحث</caption>
                <tr><th>الأسم</th><th>السعر</th><th>متاح في</th></tr>


                <?php

//                $servername = "localhost";
//                $username = "root";
//                $password = "root";
//                $dbname = "medprices";

                $search = $_GET["search"];
                $searchGov = $_GET["pharmGov"];
                $searchCity = $_GET["pharmCity"];
                // Create connection
//                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
//                if ($conn->connect_error) {
//                    die("Connection failed: " . $conn->connect_error);
//                }

                require_once('DBCon.php');
                $DB = new DBClass();
                $conn = $DB->startCon();
                
                $sql = "SELECT * FROM drugs where name like '%" . $search . "%'";
                $result = $conn->query($sql);

                if ($result->num_rows != null) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>". $row["name"]. "</td><td>" . $row["price"]. "</td><td>";

                        $str = $row["availability"];  
                        $delimiter =  "|"; 

                        $token = strtok($str, $delimiter);  

                        $localAvail = 0;
                        while($token !==false)   
                        {  
                            $sql2 = "SELECT * FROM pharmacies where id=" . $token;
                            $result2 = $conn->query($sql2);

                            if ($result2->num_rows > 0) {
                                // output data of each row
                                while($row2 = $result2->fetch_assoc()) {
                                    if ($row2["gov"] == $searchGov && $row2["city"] == $searchCity) {
                                        echo "<a onclick=\"document.getElementById('pharm" . $token . "').style.display='block';\">" . $row2["name"] . "</a><hr class='dividor'>";
                                        $localAvail = 1;
                                    }
                                    
                                        ?>
                                        
                                    <div class='floatingInfo' id="<?php echo "pharm".$token;?>">
                                        <div class="floatingInfo-header">
                                            <?php echo $row2["name"]; ?>
                                        </div>
                                        <span class="closebtn" onclick="this.parentElement.style.display='none';">×</span>
                                        
                                        <div class="floatingInfo-container">
                                            <?php 
                                                echo "<p>العنوان: " . $row2["address"] . "</p>";
                                                if ( !empty($row2["landmark"]) ){
                                                    echo "<p>اقرب معلم: " . $row2["landmark"] . "</p>";
                                                }
                                                echo "<p>المحافظة: " . $DB->getGovName($row2["gov"]) . "</p>";
                                                echo "<p>المدينه: " . $DB->getCityName($row2["city"]) . "</p>";
                                            ?>
                                        </div>        
                                    </div>
                <?php
                                }
                                
                            } else {
                                echo "لا يوجد صيدليات";
                            }
                             $token =strtok($delimiter);  
                        }
                        if ($localAvail == 0){
                            echo "لا يوجد صيدليات في المنطقه المحدده";
                        }
                        echo "</td></tr>";
                    }
                } else {
                    echo "لا يوجد نتائج";
                    echo "<script>
                            var x = document.getElementsByClassName('resultsTable');
                            x[0].style.display = 'none';</script>";
                }

                $conn->close();
                ?>
            </table>
        </div>
    </div>
    
    <script>
//            $("#selectseparator").css("display","none");
        </script>
    <script src="js/initSelect.js"></script>
    <script>
        $('.gov<?php echo $_GET["pharmGov"]; ?>').prop("selected", true);
        $('.from<?php echo $_GET["pharmGov"]; ?>').css("display", "block");
        $('.city<?php echo $_GET["pharmCity"]; ?>').prop("selected", true);
    </script>
</body>
</html>