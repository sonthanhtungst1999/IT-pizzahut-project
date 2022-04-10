<?php 
session_start();
require('../connect.php');
$admin_ID = $_POST['username'];
$admin_PW = $_POST['password'];
// echo $admin_ID;
// echo $admin_PW;

$sql = " SELECT * FROM `khachhang` WHERE TK='$admin_ID' AND PW='$admin_PW' AND user_type='admin' ";
$result = mysqli_query($con, $sql);

    if(mysqli_num_rows($result) > 0 && !empty($admin_ID) && !empty($admin_PW)){
        // lay Ma khach hang
        $result = mysqli_query($con, $sql);
        $result_id_admin = mysqli_fetch_assoc($result);
        // lay Ten
        $result = mysqli_query($con, $sql);
        $result_ten_admin = mysqli_fetch_assoc($result);
        //Lay SDT
        $result = mysqli_query($con, $sql);
        $result_phone_number = mysqli_fetch_assoc($result);
 
        // Session Full Infomation
        $_SESSION['MS_AD'] = $result_id_admin['MSKH'];
        $_SESSION['Name_AD'] = $result_ten_admin['TenKH'];
        $_SESSION['Phone'] =  $result_phone_number['Phone'];
        $_SESSION['UID_AD'] = $admin_ID;
        $_SESSION['PW_AD'] = $admin_PW;
        echo '<script language="javascript">alert("Logged in successfully"); window.location="admin_after_login.php";</script>';
    }
    else{
        $sql = " SELECT * FROM `khachhang` WHERE TK='$admin_ID' ";
        $result = mysqli_query($con,$sql);
        if(mysqli_num_rows($result) > 0){
            echo '<script language="javascript">alert("Incorrect password"); window.location="index.html";</script>';
            die();
        }
        else{
            echo '<script language="javascript">alert("UID does not exist"); window.location="index.html";</script>';
            die();
        }
    }

$con->close(); // dong ket noi

?>