<?php 
    session_start();
    require('../connect.php');

    // Format price PHP
    function product_price($priceFloat) {
        $symbol_thousand = '.';
        $decimal_place = 0;
        $price = number_format($priceFloat, $decimal_place, '', $symbol_thousand);
        return $price;
    }

?>
<!DOCTYPE html>
<html>
<head>
    <link rel = "icon" href = "../icon/Daco_373178.png" type = "image/x-icon"> 
    <meta charset="UTF-8">
    <title>Pizza Hut</title>
    <link rel="stylesheet" type="text/css" href="./style_admin.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
</head>
<body>
    <div class="header">
        <div class="header-col-1">
            <h1>STORE MANAGEMENT</h1>
        </div>
        <div class="header-col-2">
                <p>Xin chào: <?php echo $_SESSION['Name_AD']?></p>
        </div>
    </div>
    <div class="main">
        <!-- <p><?php echo $_GET['mhd'] ?></p>
        <p><?php echo $_GET['mkh'] ?></p> -->
        <?php 
        
        $sql = "SELECT * FROM khachhang WHERE MSKH='$_GET[mkh]'";
        $result = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($result);

        ?>
        <div class="caidat-infor-bill">
                        <table>
                            <tr>
                                <th>Tên khách hàng</th>
                                <td><?php echo $row['TenKH'] ?></td>
                            </tr>
                            <tr>
                                <th>Mã số hóa đơn</th>
                                <td ><b><?php echo $_GET['mhd'] ?></b></td>
                            </tr>
                            <tr>
                                <?php 
                                    $sql = "SELECT Gia_Dat_Hang FROM hoadon WHERE Ma_HD='$_GET[mhd]'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                ?>
                                <th>Tổng tiền</th>
                                <td><div id="img-money"class="change-pw"><img src="./icon/dollar.svg"><?php echo product_price($row['Gia_Dat_Hang'])?>đ</div></td>
                            </tr>
                            <tr>
                                <th>Nhóm người sử dụng</th>
                                <td><div class="type">Customer</div></td>
                            </tr>
                        </table>          
                    </div>
    </div>
    <div class="box-content-bill">
        <div class="title">
            <h2>Chi tiết hóa đơn</h2>
            <button type="submit" id="print" name="action" value="print">In hóa đơn</button>
        </div>
        <table>

            <tr>
                <th id="tsp-bill-th">Tên sản phẩm</th>
                <th>Số lượng</th>
            </tr>
            <?php 
            $sql = "SELECT SoLuong,Ten_SP,Ma_Loai FROM hoadon hd INNER JOIN chitiethoadon ct ON hd.Ma_HD = ct.Ma_HD 
                        INNER JOIN sanpham sp ON ct.Ma_SP = sp.Ma_SP WHERE ct.Ma_HD='$_GET[mhd]'";
            $result = mysqli_query($con,$sql);
            while($row = mysqli_fetch_assoc($result)){
            ?>
            <tr>
                <td id="tsp-bill-td"><?php echo $row['Ten_SP'] ?></td>
                <td><?php echo $row['SoLuong'] ?></td>
            </tr>
            <?php } ?>
        </table>
    <div>
</body>
