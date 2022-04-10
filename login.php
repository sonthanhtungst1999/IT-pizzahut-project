<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel = "icon" href = "./icon/Daco_373178.png" type = "image/x-icon"> 
    <meta charset="UTF-8">
    <title>Pizza Hut</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
</head>
<body class="login-main">
    <div id="header" class="header-login">
        <div class="div-header-1"><a href="./index.php"><img src="./icon/Daco_373178.png" alt="logo pizzahut" class="img-header-login"></a></div>
    </div>
    <div id="main">
        <div class="flex-login-main">
            <div id="form-box" class="content-flex-box">
                <div class="hut-reward"><img src="quangcao/login/hut-rewards.png"></div>
                <div class="button-box">
                    <div id="transition-click"></div>
                    <button type="button" id="login" onclick="login()">Login</button>
                    <button type="button" id="register" onclick="register()">Register</button>
                </div>
                    <form id="login-box" class="content-form" action="login_user.php" method="POST" enctype="multipart/form-data">
                        <input type="text" class="input-login" required="required" placeholder="User ID" name="UID">
                        <input type="password" class="input-login" required="required" placeholder="Enter Password" name="PW">
                        <input type="submit" value="Login" class="submit-button">
                        <div class="login-icon">
                            <img src="icon/facebook.svg">
                            <img src="icon/instagram.svg">
                            <img src="icon/twitter.svg">
                        </div>

                    </form> 
                    <form id="register-box"  onsubmit="return warning()" action="register_user.php" class="content-form" enctype="multipart/form-data" method="POST">
                        <input type="text" class="input-login" required="required" placeholder="Full Name" id="name" name="Name">
                        <input type="text" class="input-login" required="required" placeholder="Phone Number" id="phone" name="Phone">
                        <p id="warning_phone">Invalid phone number</p>
                        <input type="text" class="input-login" required="required" placeholder="User ID" id="uid" name="UID">
                        <p id="warning_uid">Invalid UID</p>
                        <input type="password" class="input-login" required="required" placeholder="Enter Password" id="pw" name="PW"> 
                        <p id="warning_pw">Invalid password (Number + UpperCase + LowerCase)</p>
                        <input type="password" class="input-login" required="required" placeholder="Enter Password Again" id="pwa">
                        <p id="warning_pwa">Passwords are not the same</p>
                        <input type="submit" value="Register" class="submit-button">
                    </form> 
            </div>
        </div>
    </div>

    <script>
        var x = document.getElementById("login-box");
        var y = document.getElementById("register-box");
        var z = document.getElementById("transition-click");
        var x1 = document.getElementById("login");
        var y1 = document.getElementById("register");
        var size = document.getElementById("form-box");
        function register(){
            y.style.left="0";
            x.style.left="-500px";
            z.style.left="135px";
            x1.style.color="#000000";
            y1.style.color="#ffffff";
            size.style.height="640px";
        }
        function login(){
            x.style.left="0";
            y.style.left="500px";
            z.style.left="0"
            y.style.color="white";
            x1.style.color="#ffffff"
            y1.style.color="#000000";
            size.style.height="550px";
        }
        function warning(){
            var pw = document.getElementById("pw").value;
            var pwa = document.getElementById("pwa").value;
            var uid = document.getElementById("uid").value;
            var phone = document.getElementById("phone").value;
            var name = document.getElementById("name").value;
            var check_uid = /^[A-z](\w){6,20}$/ ; 
            var check_pw =/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{6,20}$/ ; //so + chu in + chu thuong (yeu cau mat khau manh)
            var check_phone= /^[0-9]{10,11}$/ ;
            check_submit=true;
         
            // check tai khoan
            if(check_uid.test(uid)){
                var p = document.getElementById("warning_uid");
                var border = document.getElementById("uid");
                p.style.display="none"; 
                border.style.borderBottomColor="#999";
            }   
            else{
                var p = document.getElementById("warning_uid");
                var border = document.getElementById("uid");
                p.style.display="block"; 
                border.style.borderBottomColor="#b71540";
                check_submit=false;  
            }

            // check password
            if(check_pw.test(pw)){
                var p = document.getElementById("warning_pw");
                var border = document.getElementById("pw");
                p.style.display="none"; 
                border.style.borderBottomColor="#999";
            }   
            else{
                var p = document.getElementById("warning_pw");
                var border = document.getElementById("pw");
                p.style.display="block"; 
                border.style.borderBottomColor="#b71540";
                check_submit=false;  
            }

            // check nhap lai Password
            if(pwa==pw){
                var p = document.getElementById("warning_pwa");
                var border = document.getElementById("pwa");
                p.style.display="none"; 
                border.style.borderBottomColor="#999";
            }
            else{
                var p = document.getElementById("warning_pwa");
                var border = document.getElementById("pwa");
                p.style.display="block"; 
                border.style.borderBottomColor="#b71540";
                check_submit=false;
            }   

            // check phone number
            if(check_phone.test(phone)){
                var p = document.getElementById("warning_phone");
                var border = document.getElementById("phone");
                p.style.display="none"; 
                border.style.borderBottomColor="#999";
            }   
            else{
                var p = document.getElementById("warning_phone");
                var border = document.getElementById("phone");
                p.style.display="block"; 
                border.style.borderBottomColor="#b71540";
                check_submit=false;  
            }
            return check_submit;
        }
    </script>
</body>
</html>