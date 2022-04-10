<?php
    session_start();	
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login Pizza Hut</title>
</head>
<body>
    <?php 
        $UID = $_POST['UID'];
        $PW = $_POST['PW'];
        require ("connect.php");
        $con->set_charset("UTF-8");
        $sql = " SELECT * FROM `khachhang` WHERE TK='$UID' AND PW='$PW' ";
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) > 0 && !empty($UID) && !empty($PW)){
                // lay Ma khach hang
                $result = mysqli_query($con, $sql);
                $result_mskh = mysqli_fetch_assoc($result);
                // lay Ten
                $result = mysqli_query($con, $sql);
                $result_ten = mysqli_fetch_assoc($result);
                 // Session Full Infomation
                $_SESSION['MSKH'] = $result_mskh['MSKH'];
                $_SESSION['Name'] = $result_ten['TenKH'];
                $_SESSION['UID'] = $UID;
                $_SESSION['PW'] = $PW;
                echo '<script language="javascript">alert("Logged in successfully"); window.location="index_after_login.php";</script>';
        }
        else{
            $sql = " SELECT * FROM `khachhang` WHERE TK='$UID' ";
            $result = mysqli_query($con,$sql);
            if(mysqli_num_rows($result) > 0){
                echo '<script language="javascript">alert("Incorrect password"); window.location="login.php";</script>';
                die();
            }
            else{
                echo '<script language="javascript">alert("UID does not exist"); window.location="login.php";</script>';
                die();
            }
        }
        
        $con->close(); // dong ket noi
    ?>
</body>
</html>