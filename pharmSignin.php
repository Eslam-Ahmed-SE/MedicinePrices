<?php
    session_start();

    $message="";

    if (   isset($_POST['pharmMail']) 
        && isset($_POST['pharmPass']) ) {
        $con = mysqli_connect('127.0.0.1:3306','root','root','medprices') or die('Unable To connect');
        $result = mysqli_query($con,"SELECT * FROM pharmacies WHERE mail='" . $_POST["pharmMail"] . "' and password = '". $_POST["pharmPass"]."'");
        require_once('DBCon.php');
        $DB = new DBClass();
                
        $row  = mysqli_fetch_array($result);
        if(is_array($row)) {
            $_SESSION['valid'] = true;
            $_SESSION["id"] = $row['id'];
            $_SESSION["name"] = $row['name'];
            $_SESSION["phone"] = $row['phone'];
            $_SESSION["address"] = $row['address'];
            $_SESSION["landmark"] = $row['landmark'];
            $_SESSION["mail"] = $row['mail'];
            $_SESSION["gov"] = $DB->getGovName($row['gov']);
            $_SESSION["city"] = $DB->getCityName($row['city']);
            
            $message = $message . " " . $_SESSION["id"];
        }
        else {
            $_SESSION['valid'] = false;
            $message = "الإيميل او اسم المستخدم غير صحيحين";
        }
    }
    
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
        
<!--        <script src="https://kit.fontawesome.com/20c8927541.js" crossorigin="anonymous"></script>-->
    </head>
    <body class="pharmSignupBody">
        <div class="mainPageContainer">
            <div class="signupFormContainer">
                <form action="pharmSignin.php" method="post">
                    <label>ادخل الي حسابك</label>
                    <input type="email" name="pharmMail" placeholder="الإيميل" required/>
                    <input type="password" name="pharmPass" placeholder="الرقم السري" required/>
                    <p class="errMsg err"><?php echo $message?></p>
                    <input type="submit" value="الدخول"/>
                    <input type="button" value="الغاء" onclick="window.location.href = 'index.php';"/>
                </form>
            </div>
        </div>
        
    </body>
</html>