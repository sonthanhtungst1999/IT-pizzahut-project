<?php 
session_start();
require 'connect.php';
$con->set_charset("UTF-8");

date_default_timezone_set('Asia/Ho_Chi_Minh');
$makhachhang = $_SESSION['MSKH'];
$ndh = date('Y-m-d H:i:s');
$masanpham = $_POST['msp'];
$quantity = $_POST['quantity'];
$address = $_POST['Address'];
$gia_DH = $_POST['price'];

$sql_dh = "INSERT INTO `hoadon`(`MSKH`, `Ngay_DH`, `Dia_Chi`, `Gia_Dat_Hang`) VALUES ($makhachhang,'$ndh','$address',$gia_DH)";
$result = mysqli_query($con, $sql_dh);
$last_id = mysqli_insert_id($con);
for($i=0; $i<count($_SESSION['cart']); $i++){
    $sql = " INSERT INTO `chitiethoadon`(`Ma_HD`, `Ma_SP`, `SoLuong`) VALUES ($last_id,'$masanpham[$i]',$quantity[$i]) ";
    $result  = mysqli_query($con,$sql);
}

unset($_SESSION['cart']);
$con->close();
echo '<script language="javascript">alert("Order Success"); window.location="index_after_login.php";</script>';


?>



