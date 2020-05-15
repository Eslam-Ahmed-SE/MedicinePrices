<?php
session_start();

if (isset($_SESSION['valid']) && $_SESSION['valid'] == true) {
    header("Location:profile.php");
}
?>
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
    <body class="pharmSignupBody">
        <div class="mainPageContainer">
            <div class="signupFormContainer">
                
                
                
                <?php
                echo "<div class='doneSignup'>";
                require_once('DBCon.php');
                $DB = new DBClass();
                $conn = $DB->startCon();

                
                if (            isset($_POST["pharmName"]) && isset($_POST["pharmPhone"]) 
                            &&  isset($_POST["pharmAddress"]) && isset($_POST["pharmNear"]) 
                            &&  isset($_POST["pharmMail"]) && isset($_POST["pharmPass"])
                            &&  isset($_POST["pharmGov"]) && isset($_POST["pharmCity"])
                   )
                {
                    $name = $_POST["pharmName"];
                    $phone = $_POST["pharmPhone"];
                    $address = $_POST["pharmAddress"];
                    $landmark = $_POST["pharmNear"];
                    $mail = $_POST["pharmMail"];
                    $password = $_POST["pharmPass"];
                    $gov = $_POST["pharmGov"];
                    $city = $_POST["pharmCity"];
                    
                    $sqlMail = "SELECT mail FROM pharmacies where mail like '%" . $mail . "%'";
                    $resultMail = $conn->query($sqlMail);

                    if ($resultMail->num_rows != null) {
                        // output data of each row
                        echo "  <h3 class='err errSignup'>
                                    <i class='fas fa-times'></i>
                                    الايميل مسجل بالفعل                             
                                </h3>   
                                <a href='pharmSignin.php'>قم بالدخول الان</a>";
                    }
                    else {

                        $sql = "INSERT INTO pharmacies (name, phone, address, landmark, password, mail, gov, city)
                        VALUES ('". $name."', ". $phone .", '". $address ."','". $landmark ."','". $password ."','". $mail . "','". $gov ."','". $city . "')";

                        if ($conn->query($sql) === TRUE) {
                            echo "  <h3 class='success successSignup'>
                                    <i class='fas fa-check'></i>
                                    تم انشاء الحساب
                                    </h3>
                            <a href='pharmSignin.php'>قم بالدخول الان</a>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                }
                
                    

echo "</div>";
                $conn->close();
                ?>

                <form action="pharmSignup.php" method="post">
                    <label>سجل صيدليتك الآن</label>
                    <input type="name" name="pharmName" placeholder="اسم الصيدليه" required/>
                    <input type="address" name="pharmAddress" placeholder="عنوان الصيدليه" required/>
                    <input type="text" name="pharmNear" placeholder="اقرب معلم مشهور"/>
                    <?php require_once('getGovAndCitySelect.php'); ?>
                    <input type="tel" name="pharmPhone" placeholder="رقم الموبايل" pattern="[0-9]{11}" required/>
                    <input type="email" name="pharmMail" placeholder="الإيميل" required/>
                    <input type="password" name="pharmPass" placeholder="الرقم السري" required/>
                    <input type="submit" value="سجل"/>
                    <input type="button" value="الغاء" onclick="window.location.href = 'index.php';"/>
                </form>
            </div>
        </div>
        <script src="js/initSelect.js"></script>
    </body>
</html>