<?php 

require("../connect.php");
session_start();

$mhd = $_POST['mhd'];

$sql = "SELECT * FROM hoadon WHERE Ma_HD='$mhd' ";
$result= mysqli_query($con,$sql);

if(mysqli_num_rows($result) > 0){
    //xoa hoa don
    $sql_1 = "DELETE FROM hoadon WHERE Ma_HD='$mhd' ";
    //xoa chi tiet hoa don
    $sql_2 = "DELETE FROM chitiethoadon WHERE Ma_HD='$mhd' ";
    if(mysqli_query($con,$sql_2) && mysqli_query($con,$sql_1)){
        echo '<script language="javascript">alert("Xóa hóa đơn thành công !!!"); window.location="admin_after_login.php";</script>';
    }
    else {
        echo '<script language="javascript">alert("Xóa hóa đơn thất bại !!!"); window.location="admin_after_login.php";</script>';
    }
}
else {
    echo '<script language="javascript">alert("Mã hóa đơn không tồn tại"); window.location="admin_after_login.php";</script>';
}

$con->close();

?>