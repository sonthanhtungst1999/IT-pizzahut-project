<?php 
require("../connect.php");
session_start();


// ----------------------------PHP add product-----------------------------

if ($_POST['action'] == 'add-product'){
    $ma_loai = $_POST['lsp'];
    $msp = $_POST['msp'];
    $tsp = $_POST['tsp'];
    $mota = $_POST['mota'];
    if($ma_loai == "1T1"){
        $file = "./quangcao/mua-1-tang-1/" . $_FILES['link']['name'];
        $link_san_pham = "../quangcao/mua-1-tang-1/" . $_FILES['link']['name'];
    }
    if($ma_loai == "CB"){
        $file = "./quangcao/combo/" . $_FILES['link']['name'];
        $link_san_pham = "../quangcao/combo/" . $_FILES['link']['name'];
    }
    if($ma_loai == "PZ"){
        $file = "./quangcao/pizza/" . $_FILES['link']['name'];
        $link_san_pham = "../quangcao/pizza/" . $_FILES['link']['name'];
    }
    if($ma_loai == "C" || $ma_loai == "M"){
        $file = "./quangcao/my-y-va-com/" . $_FILES['link']['name'];
        $link_san_pham = "../quangcao/my-y-va-com/" . $_FILES['link']['name'];
    }
    if($ma_loai == "MKV" ){
        $file = "./quangcao/khai-vi/" . $_FILES['link']['name'];
        $link_san_pham = "../quangcao/khai-vi/" . $_FILES['link']['name'];
    }
    if($ma_loai == "N"){
        $file = "./quangcao/thuc-uong/" . $_FILES['link']['name'];
        $link_san_pham = "../quangcao/thuc-uong/" . $_FILES['link']['name'];
    }

    $sql = "INSERT INTO `sanpham`(`Ma_SP`, `Ten_SP`, `HINH`, `MOTA`, `Ma_Loai`) 
                VALUES ('$msp','$tsp','$file','$mota','$ma_loai')";

    if(mysqli_query($con, $sql)){
        move_uploaded_file($_FILES['link']['tmp_name'],$link_san_pham);
        echo '<script language="javascript">alert("Thêm sản phẩm thành công !!!"); window.location="admin_after_login.php"</script>';
    }
    else {
        echo '<script language="javascript">alert("Thêm sản phẩm thất bại !!!"); window.location="admin_after_login.php"</script>';
    }
    $con->close();
}




// ----------------------------PHP delete product-----------------------------

if ($_POST['action'] == 'delete-product'){
    $ma_loai = $_POST['lsp'];
    $msp = $_POST['msp'];
    $tsp = $_POST['tsp'];
    $mota = $_POST['mota'];

    //Xoa link san pham tren htdoc
    $sql = "SELECT HINH FROM sanpham WHERE Ma_SP = '$msp'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $link_san_pham = "." .$row['HINH'];
    // echo $link_san_pham;

    //Xoa san pham tren csdl
    //(1) xoa tren table chi tiet san pham
    $sql = "DELETE FROM `chitietsanpham` WHERE Ma_SP = '$msp' ";
    mysqli_query($con, $sql);


    //(2) xoa tren table san pham
    $sql = "DELETE FROM `sanpham` WHERE Ma_SP = '$msp' ";
    mysqli_query($con, $sql);



    if(unlink($link_san_pham)){
        echo '<script language="javascript">alert("Xóa sản phẩm thành công !!!"); window.location="admin_after_login.php"</script>';
    }
    else {
        echo '<script language="javascript">alert("Xóa sản phẩm thất bại"); window.location="admin_after_login.php"</script>';
    }
    $con->close();
}



// ----------------------------PHP update product-----------------------------
if ($_POST['action'] == 'update-product'){
    $ma_loai = $_POST['lsp'];
    $msp = $_POST['msp'];
    $tsp = $_POST['tsp'];
    $mota = $_POST['mota'];

    $sql = "SELECT * FROM `sanpham` WHERE Ma_SP='$msp'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($result);
    $old_link = "." .$row['HINH'];

    // xoa san pham trong htdoc
    // echo "link san pham cu $old_link";
    unlink($old_link);

    if($ma_loai == "1T1"){
        $file = "./quangcao/mua-1-tang-1/" . $_FILES['link']['name'];
        $link_san_pham = "../quangcao/mua-1-tang-1/" . $_FILES['link']['name'];
    }
    if($ma_loai == "CB"){
        $file = "./quangcao/combo/" . $_FILES['link']['name'];
        $link_san_pham = "../quangcao/combo/" . $_FILES['link']['name'];
    }
    if($ma_loai == "PZ"){
        $file = "./quangcao/pizza/" . $_FILES['link']['name'];
        $link_san_pham = "../quangcao/pizza/" . $_FILES['link']['name'];
    }
    if($ma_loai == "C" || $ma_loai == "M"){
        $file = "./quangcao/my-y-va-com/" . $_FILES['link']['name'];
        $link_san_pham = "../quangcao/my-y-va-com/" . $_FILES['link']['name'];
    }
    if($ma_loai == "MKV" ){
        $file = "./quangcao/khai-vi/" . $_FILES['link']['name'];
        $link_san_pham = "../quangcao/khai-vi/" . $_FILES['link']['name'];
    }
    if($ma_loai == "N"){
        $file = "./quangcao/thuc-uong/" . $_FILES['link']['name'];
        $link_san_pham = "../quangcao/thuc-uong/" . $_FILES['link']['name'];
    }
    
    // kiem tra neu POST = null thi lay gia tri cu tu database
    if($tsp==""){
        $tsp = $row['Ten_SP'];
        // echo "$tsp";
    }

    if($mota==""){
        $mota = $row['MOTA'];
        // echo $mota;
    }

    if(!$_FILES['link']['name']){
        $file = $row['HINH'];
        // echo $file;
    }

    // echo "$ma_loai |";
    // echo "$msp |";
    // echo "$tsp |";
    // echo "$mota |";
    // echo "$file |";
    // echo "$link_san_pham |";

    $sql = "UPDATE `sanpham` SET `Ten_SP`='$tsp',`HINH`='$file',`MOTA`='$mota',`Ma_Loai`='$ma_loai' WHERE Ma_SP='$msp'";

    if(mysqli_query($con, $sql)){
        move_uploaded_file($_FILES['link']['tmp_name'],$link_san_pham);
        echo '<script language="javascript">alert("Chỉnh sửa sản phẩm thành công !!!"); window.location="admin_after_login.php"</script>';
    }
    else {
        echo '<script language="javascript">alert("Chỉnh sửa sản phẩm thất bại !!!"); window.location="admin_after_login.php"</script>';
    }
    $con->close();
}


?>