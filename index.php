<!doctype html>
<html dir="rtl" lang="AR">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        
        <meta name="keywords" content="medicine, prices, pharmacy">
        <meta name="subject" content="Medicine prices">
        <meta name="copyright" content="Eslam">
        <meta name="description" content="Know medicine prices and where to get them in nearby pharmacies">
        <meta name="author" content="Eslam Ahmed">
        <meta name="robots" content="index,follow">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <title>Home</title>
        
        <link rel="stylesheet" href="css/style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--        <script src="https://kit.fontawesome.com/20c8927541.js" crossorigin="anonymous"></script>-->
    </head>
    <body class="indexBody">
        <div class="mainPageContainer">
            <div class="header">
                <h3>صيدليتى</h3>
                <hr>
                <p>صيدلتى هو أول موقع يساعدك علي ايجاد الدواء الذي تحتاجه ويخبرك بالصيدليات المتاح بها ويرشدك لأقرب صيدلية من بيتك يتواجد فيها مع عرض سعر الدواء</p>
            </div>
            <div class="searchBar">
                <form action="search.php">
                    <input type="search" name="search" placeholder="إسم الدواء">
                    <input type="submit" value="بحث"/>
                    <br>
                    <?php require_once('getGovAndCitySelect.php'); ?>
                </form>
            </div>
            <div class="footer">
                <h5>صيدليه؟ قم <a href="pharmSignin.php">بالدخول لحسابك</a> او <a href="pharmSignup.php">سجل الآن</a></h5>
            </div>
        </div>
<!--        <img src="imgs/a.png">-->
        
        <script>
//            $("#selectseparator").css("display","none");
        </script>
        <script src="js/initSelect.js"></script>
    </body>
</html>