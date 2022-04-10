<?php 
if(isset($_GET['Ma_HD'])){
    $id_hd = $_GET['Ma_HD'];
    $ten_kh = $_GET['TenKH'];
require('../connect.php');
}


?>

<!DOCTYPE hmtl>
<html>
<head>
    <link rel = "icon" href = "../icon/Daco_373178.png" type = "image/x-icon"> 
    <meta charset="UTF-8">
    <title>Pizza Hut</title>
    <link rel="stylesheet" type="text/css" href="./style_admin.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
</head>
<body>
    <div class="flex-head">
        <?php 
            $sql = "SELECT DISTINCT TenKH FROM hoadon INNER JOIN khachhang ON hoadon.MSKH=khachhang.MSKH WHERE Ma_HD='<?php echo $id_hd ?>' ";
            $result = $con->query($sql);
            $row = $result->fetch_assoc();
        ?>
        <div class="item"><a href="#">Hóa đơn: <?php echo $id_hd ?></a></div>
        <div class="item"><a href="#"><?php echo $ten_kh ?></a></div>
        <div class="item"><a href="./admin_after_login.php">Back</a></div>
    </div>

    <div id="list-product" class="flex-container">
        <table class="tb-list-product">
            <tr>
                <th>Tên món</th>
                <th>Số lượng</th>
            </tr>
        <?php 
        $sql =  "SELECT * FROM chitiethoadon INNER JOIN sanpham ON chitiethoadon.Ma_SP = sanpham.Ma_SP WHERE 1";
        $result = $con->query($sql);
            while($row = $result->fetch_assoc()){ 
                if($row['Ma_HD'] == $id_hd){
                ?>
                
                <tr>
                    <td><?php echo $row['Ten_SP'] ?></td>
                    <td><?php echo $row['SoLuong'] ?></td>
                </tr>
                <?php } ?>  
            <?php } ?>
        </table>
    </div>
    <div class="footer-admin">
        <p>
            <i>
                Copyright &copy; Son Thanh Tung. All rights reserved. <br>
                &mdash; Địa chỉ: số X, đường Y, Phường Z, Quận W, Tp. A &mdash;
            </i>
        </p>
    </div>
</body>
</html>