<?php
session_start();

if (isset($_SESSION['valid']) && $_SESSION['valid'] == false) {
    header("Location:pharmSignin.php");
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
        
        <script src="https://kit.fontawesome.com/20c8927541.js" crossorigin="anonymous"></script>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <script type="text/javascript">
//            var $loading = $('#loadingDiv').hide();
            $(document).ready(function() {
                $('#loadingDiv').hide();

                var timeoutID = null;

                function findMember(str) {
                    console.log('search: ' + str);
//                    $loading.show();
                    $('#loadingDiv').show();
                    var value = $('#searchStr').val();
                    $.get('profileSearchFun.php',{value:value}, function(data){
//                        $('#loadingDiv').hide();
                     $("#search_results").html(data);
                        $('#loadingDiv').hide();
                    });
                }

                $('#searchStr').keyup(function(e) {
                    
                  clearTimeout(timeoutID);
                  //timeoutID = setTimeout(findMember.bind(undefined, e.target.value), 500);
                  timeoutID = setTimeout(() => findMember(e.target.value), 500);
                    
                });

          });

          $(function() {
            $("#profileSearchForm").bind('submit',function() {
              var value = $('#searchStr').val();
               $.get('profileSearchFun.php',{value:value}, function(data){
                 $("#search_results").html(data);
               });
               return false;
            });
          });
            
          $(function() {
            $("#addMedForm").bind('submit',function() {
              var value = $('#medName').val();
              var price = $('#medPrice').val();
               $.post('addMed.php',{value:value, price:price}, function(data){
                 $("#addMed_results").html(data);
                   
                 $('#loadingDiv').show();
                 var value = $('#searchStr').val();
                 $.get('profileSearchFun.php',{value:value}, function(data){
//                        $('#loadingDiv').hide();
                 $("#search_results").html(data);
                    $('#loadingDiv').hide();
                });
                   $("#floatingInfo").hide();
                   
               });
               return false;
            });
          });
            
            
            $( document ).ready(function() {
               var value = $('#searchStr').val();
               $.get('profileSearchFun.php',{value:value}, function(data){
                 $("#search_results").html(data);
               });
            });
            
//            $(document)
//              .ajaxStart(function () {
//                $loading.show();
//              })
//              .ajaxStop(function () {
//                $loading.hide();
//              });
        </script>
    </head>
    <body class="profileBody">
        <div class="profileMainPageContainer">
            <nav>
                <p>
                    مرحبا بك، <?php echo $_SESSION["name"]; ?>
                </p>

                <a href="logout.php">
                    <i class="fas fa-sign-out-alt"></i>
                    الخروج
                </a>
            </nav>
            
            <div class="mainCard card">
                <p>الأدويه المسجله: </p>
                <form method="get" action="profile.php" class="profileSearch" id="profileSearchForm" autocomplete="off">
                    <input type='search' name='search' placeholder='ابحث..' id="searchStr"/>
                    <input type='submit' value="بحث" id="searchSubmit"/>
<!--                    <a href="profile.php">إلغاء</a>-->
                </form>
                <div id="loadingDiv">يتم التحميل ...</div>
                <div id="search_results">يتم التحميل ...</div>
                <br>
                <div id="addMed_results"></div>
                <div class="medNotFound">
                    لا تجد الدواء؟
                    <a onclick=" document.getElementById('floatingInfo').style.display='block'; " style="cursor: pointer">ضفه من هنا</a>
                </div>
            </div>
            
            <div class='floatingInfo' id="floatingInfo">
                <div class="floatingInfo-header">
                    قم باضافة دواء
                </div>
                <span class="closebtn" onclick="this.parentElement.style.display='none';">×</span>

                <div class="floatingInfo-container">
                    <form method="post" autocomplete="off" id="addMedForm">
                        <input type="text" name="medName" placeholder="الأسم" id="medName"/>
                        <input type="number" name="medPrice" placeholder="السعر" id="medPrice"/>
                        <input type="submit" value="أضف" id="addMedSubmit"/>
                    </form>
                    
                </div>        
            </div>
            
            <div class="infoCard card">
                <h3>معلوماتك: <span><a href="editProfile.php">تعديل</a></span></h3>
                <p><span class="infoLabel">الأسم:</span>&nbsp;&nbsp;
                    <?php echo $_SESSION["name"]; ?>
                </p>
                <p><span class="infoLabel">رقم الموبايل:</span>&nbsp;&nbsp;
                     <?php echo $_SESSION["phone"]; ?>
                </p>
                <p><span class="infoLabel">العنوان:</span>&nbsp;&nbsp;
                    <?php echo $_SESSION["address"]; ?>
                </p>
                <p><span class="infoLabel">اقرب معلم:</span>&nbsp;&nbsp;
                    <?php echo $_SESSION["landmark"]; ?>
                </p>
                <p><span class='mailLabel infoLabel'>عنوان البريد الإلكتروني: </span>&nbsp;&nbsp;&nbsp;<span class='mail'>
                    <?php echo $_SESSION["mail"]; ?>
                </span></p>
                <p><span class='mailLabel infoLabel'>المحافظة : </span>&nbsp;&nbsp;&nbsp;<span class='mail'>
                    <?php echo $_SESSION["gov"]; ?>
                </span></p>
                <p><span class='mailLabel infoLabel'>المدينه : </span>&nbsp;&nbsp;&nbsp;<span class='mail'>
                    <?php echo $_SESSION["city"]; ?>
                </span></p>
            
        





            </div>
        </div>
    </body>
</html>