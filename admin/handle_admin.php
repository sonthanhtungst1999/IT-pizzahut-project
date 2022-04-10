<?php
require("../connect.php");
session_start();


// xu ly add customer
if ($_POST['action'] == 'add-admin'){
    $tkh = $_POST['tkh'];
    $sdt = $_POST['sdt'];
    $tk = $_POST['tk'];
    $mk = $_POST['mk'];
    
    // echo "$tkh |";
    // echo "$sdt |";
    // echo "$tk |";
    // echo "$mk |";

    $sql = "INSERT INTO `khachhang`(`TenKH`, `Phone`, `TK`, `PW`, `user_type`) 
                    VALUES ('$tkh','$sdt','$tk','$mk','admin')";

    if(mysqli_query($con, $sql)){
        echo '<script language="javascript">alert("Thêm nhân viên thành công !!!"); window.location="admin_after_login.php"</script>';
    }
    else {
        echo '<script language="javascript">alert("Thêm nhân viên thất bại !!!"); window.location="admin_after_login.php"</script>';
    }
    $con->close();
}

// //xu ly xoa customer
if ($_POST['action'] == 'delete-admin'){
    $mkh = $_POST['mkh'];
    // echo "$mkh |";

    $sql = "DELETE FROM `khachhang` WHERE MSKH='$mkh' AND user_type='admin' ";

    if(mysqli_query($con, $sql)){
        echo '<script language="javascript">alert("Xóa nhân viên thành công !!!"); window.location="admin_after_login.php"</script>';
    }
    else {
        echo '<script language="javascript">alert("Xóa nhân viên thất bại !!!"); window.location="admin_after_login.php"</script>';
    }
    $con->close();
}


// //xu ly update customer
if ($_POST['action'] == 'update-admin'){
    $mkh = $_POST['mkh'];
    $tkh = $_POST['tkh'];
    $sdt = $_POST['sdt'];
    $tk = $_POST['tk'];
    $mk = $_POST['mk'];

    $sql = " SELECT * FROM khachhang WHERE MSKH='$mkh' AND user_type='admin' ";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);

    // Chon ra gia tri cu tren CDDL neu khong nhap vao truong input
    if($tkh==''){
        $tkh = $row['TenKH'];
        // echo "$tkh |";
    }

    if($sdt==''){
        $sdt = $row['Phone'];
        // echo "$tkh |";
    }

    if($tk==''){
        $tk = $row['TK'];
        // echo "$tkh |";
    }
    if($mk==''){
        $mk = $row['PW'];
        // echo "$tkh |";
    }

    $sql = "UPDATE `khachhang` SET `TenKH`='$tkh',`Phone`='$sdt',`TK`='$tk',`PW`='$mk',`user_type`='admin' 
                WHERE MSKH='$mkh' AND user_type = 'admin' ";

    if(mysqli_query($con, $sql)){
        echo '<script language="javascript">alert("Cập nhật nhân viên thành công !!!"); window.location="admin_after_login.php"</script>';
    }
    else {
        echo '<script language="javascript">alert("Cập nhật nhân viên thất bại !!!"); window.location="admin_after_login.php"</script>';
    }
    $con->close();
}



if ($_POST['action'] == 'change-password'){
    $mkh = $_POST['mkh'];
    $new_pw = $_POST['npw'];
    // echo "$mkh |";
    // echo $new_pw;

    $sql = "UPDATE `khachhang` SET `PW`='$new_pw' 
                            WHERE MSKH='$mkh' AND user_type = 'admin' ";

    if(mysqli_query($con, $sql)){
        echo '<script language="javascript">alert("Đổi mật khẩu thành công !!!"); window.location="index.html"</script>';
    }
    else {
        echo '<script language="javascript">alert("Đổi mật khẩu thất bại !!!"); window.location="admin_after_login.php"</script>';
    }
    $con->close();
}

?>