<?php 

require('../connect.php');
$price = $_POST['gia'];
$msp = $_POST['msp'];
$size = $_POST['size'];
// echo $price ;
// echo $msp;
// echo $size;

$sql = "SELECT * FROM `chitietsanpham` WHERE Ma_SP='$msp' AND Ma_Size='$size' ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
if($row > 0){
    $sql= "UPDATE `chitietsanpham` SET Gia=$price WHERE Ma_SP='$msp' AND Ma_Size='$size'";
    if(mysqli_query($con, $sql)){
        echo '<script language="javascript">alert("Thêm giá thành công !!!"); window.location="admin_after_login.php"</script>';
    }
    else {
        echo '<script language="javascript">alert("Lỗi!!! Thêm giá thất bại"); window.location="admin_after_login.php"</script>';
    }
}
else {
    $sql = "INSERT INTO `chitietsanpham`(`Ma_SP`, `Ma_Size`, `Gia`) VALUES ('$msp','$size',$price)";
    if(mysqli_query($con, $sql)){
        echo '<script language="javascript">alert("Thêm giá thành công !!!"); window.location="admin_after_login.php"</script>';
    }
    else{
        echo '<script language="javascript">alert("Lỗi!!! Thêm giá thất bại"); window.location="admin_after_login.php"</script>';
    }
}

$con->close();

?>