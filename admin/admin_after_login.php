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
        <div class="main-col-1">
            <ul>
                <li class="check "><a> <img src="./icon/pizza.svg"><p>PizzaHut</p></a></li>
                <li id="cus" class ="active" onclick="click_customer()"><a href="#customer"><img src="./icon/customer.svg"><p>Khách hàng</p></a></li>
                <li id="pro" onclick="click_product()"><a href="#product" > <img src="./icon/p.svg"><p>Sản phẩm</p></a></li>
                <li id="pri"  onclick="click_price()"><a href="#price"> <img src="./icon/price.svg"><p>Thêm giá</p></a></li>
                <li id="bill" onclick="click_bill()"><a href="#hoadon"> <img src="./icon/bill.svg"><p>Hóa đơn</p></a></li>
                <li id="ad" onclick="click_admin()"><a href="#admin"> <img src="./icon/staff.svg"><p>Nhân viên</p></a></li>
                <li id="cd" onclick="click_setting()"><a href="#caidat"> <img src="./icon/settings.svg"><p>Cài đặt</p></a></li>
                <li><a href="./exit.php"> <img src="./icon/exit.svg"><p>Đăng xuất</p></a></li>
            </ul>

        </div>
        <div class="main-col-2">
            <div class="customer">
                <form id="form-product" action="handle_customer.php" method="POST" enctype="multipart/form-data">
                    <div class="title">
                        <h2>Thông tin khách hàng</h2>
                        <button type="submit" id="xoa" name="action" value="delete-cus">Xóa</button>
                        <button type="submit" id="sua" name="action" value="update-cus">Sửa</button>
                        <button type="submit" id="them" name="action" value="add-cus">Thêm</button>
                    </div>
                    <div class="box-table">
                        <table>
                            <tr>
                                <th class="ten-kh ">Tên khách hàng</th>
                                <th class="ma-san-pham">Mã khách hàng </th>
                                <th >Số điện thoại</th>
                                <th >Tài khoản</th>
                                <th >Mật khẩu</th>

                            </tr>
                            <?php 
                                $sql = "SELECT * FROM khachhang WHERE user_type IS NULL";
                                $result = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <tr class="list_row">
                                <td class="ten-kh color-tkh"><?php echo $row['TenKH'] ?></td>
                                <td class="ma-san-pham color-msp"><?php echo $row['MSKH'] ?></td>
                                <td class="color-mt" > <?php echo $row['Phone'] ?></td>
                                <td class="tk color-mt" > <?php echo $row['TK'] ?></td>
                                <td class="mk color-mt" > <?php echo $row['PW'] ?></td>
                            </tr>
                            <?php } ?>
                            
                        </table>
                    </div>

                    <div class="box-form">
                        <div class="form-col-1">
                            <h2> Thông tin cơ bản</h2>
                            <h3> Nhập tên và các thông tin cơ bản của khách hàng</h3>
                            <div class="sl-sanpham">
                                <?php 
                                    $sql = "SELECT count(*) AS sl FROM khachhang WHERE user_type IS NULL";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $sl = $row['sl'];
                                ?>
                                <span>SL khách hàng: <p> <?php echo $sl ?> </p>   </span>
                            </div>
                        </div>
                        <div class="form-col-2">
                            <label for="lsp">User type</label>
                            <input type="text" disabled id="lkh" value="Khách hàng" > </br>
                            <label for="msp">Mã khách hàng</label>
                            <input type="text" id="msp" name="mkh" placeholder="Mã số khách hàng"> </br>
                            <label for="tsp">Tên khách hàng</label>
                            <input type="text" id="tsp" name="tkh" placeholder="Tên khách hàng"> </br>
                        </div>
                        <div class="form-col-3">
                            <label for="sdt">Số điện thoại</label>
                            <input type="text" id="sdt" name="sdt" placeholder="Phone"> </br>
                            <label for="tk">Tài khoản</label>
                            <input type="text" id="tk" name="tk" placeholder="Tài khoản"> </br>
                            <label for="mk">Mật khẩu</label>
                            <input type="text" id="mk" name="mk" placeholder="Mật khấu"> </br>
                        </div>
                    </div>
                </form>
            </div>
            <div class="product">
                <form id="form-product" action="handle_product.php" method="POST" enctype="multipart/form-data">
                    <div class="title">
                        <h2>Thông tin sản phẩm</h2>
                        <button type="submit" id="xoa" name="action" value="delete-product">Xóa</button>
                        <button type="submit" id="sua" name="action" value="update-product">Sửa</button>
                        <button type="submit" id="them" name="action" value="add-product">Thêm</button>
                    </div>
                    <div class="box-table">
                        <table>
                            <tr>
                                <th class="ten-san-pham">Tên sản phẩm</th>
                                <th class="ma-san-pham">Mã sản phẩm </th>
                                <th class="mo-ta">Mô tả</th>
                            </tr>
                            <?php 
                                $sql = "SELECT * FROM sanpham WHERE 1";
                                $result = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <tr class="list_row">
                                <td class="ten-san-pham color-tsp"><?php echo $row['Ten_SP'] ?></td>
                                <td class="ma-san-pham color-msp"><?php echo $row['Ma_SP'] ?></td>
                                <td class="mo-ta color-mt" > <?php echo $row['MOTA'] ?></td>
                            </tr>
                            <?php } ?>
                            
                        </table>
                    </div>

                    <div class="box-form">
                        <div class="form-col-1">
                            <h2> Thông tin cơ bản</h2>
                            <h3> Nhập tên và các thông tin cơ bản sản phẩm</h3>
                            <div class="sl-sanpham">
                                <?php 
                                    $sql = "SELECT count(*) AS sl FROM sanpham WHERE 1";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $sl = $row['sl'];
                                ?>
                                <span>SL sản phẩm: <p> <?php echo $sl ?> </p>   </span>
                            </div>
                        </div>
                        <div class="form-col-2">
                            <label for="lsp">Loại sản phẩm</label>
                            <select name="lsp">
                                <option value="1T1">Mua 1 tặng 1</option>
                                <option value="CB">Combo</option>
                                <option value="PZ">Pizza</option>
                                <option value="M">Mì</option>
                                <option value="C">Cơm</option>
                                <option value="MKV">Món khai vị</option>
                                <option value="N">Thức uống</option>
                            <select>
                            <label for="msp">Mã sản phẩm</label>
                            <input type="text" id="msp" name="msp" placeholder="Mã sản phẩm"> </br>
                            <label for="tsp">Tên sản phẩm</label>
                            <input type="text" id="tsp" name="tsp" placeholder="Tên sản phẩm"> </br>
                        </div>
                        <div class="form-col-3">
                            <label for="mota">Mô tả sản phẩm</label>
                            <textarea placeholder="Nhập mô tả cho sản phẩm....." name="mota"></textarea>
                            <input type="file" name="link" id="file">
                            <label for="file"> <img src="./icon/photo.svg">Chọn ảnh</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="price">
                <form id="" action="handle-add-price.php" method="POST" enctype="multipart/form-data">
                    <div class="title">
                        <h2>Thêm giá sản phẩm</h2>
                    </div>
                    <div class="box-add-price">
                        <div class="price-col-1">
                            <label for="size">Mã size</label>
                            <select name="size">
                                <option value="S">Size S</option>
                                <option value="M" selected>Size M</option>
                                <option value="L">Size L</option>
                            <select>
                        </div>
                        <div class="price-col-2">
                            <label for="msp">Mã sản phẩm</label>
                            <input type="text" name="msp" placeholder="Nhập mã sản phẩm">
                        </div>
                        <div class="price-col-3">
                            <label for="gia">Giá</label>
                            <input type="text" name="gia" placeholder="Nhập giá tiền">
                            
                        </div>
                        <button id="btn-submit-price" type="submit"><img src="./icon/dollar.svg">Lưu</button>
                    </div>
                    <div class="infor-extend">
                        <p><img src="./icon/windows.svg">Thông tin mở rộng( <small>Nhấn để xem các thông tin cho thuộc tính sản phẩm</small> )</p>
                    </div>
                </form>
            </div>
            <div class="bill">
                <form id="form-product" action="handle_bill.php" method="POST" enctype="multipart/form-data">
                    <div class="title">
                        <h2>Thông tin hóa đơn</h2>
                        <div id="huy-hd" onclick="extend_bill_close()" name="action" value="">Hủy</div>
                        <button type="submit" id="xoa-hd" name="action" value="change-password">Xóa</button>    
                    </div>
                    <div class="box-bill">
                        <table>
                            <tr>
                                <th>Mã hóa đơn</th>
                                <th>Tên khách hàng</th>
                                <th>SĐT</th>
                                <th>Ngày đặt hàng</th>
                                <th>Địa chỉ</th>
                                <th>Tổng tiền</th>
                                <th>Chi tiết hóa đơn</th>
                            </tr>
                            <?php 
                            $sql="SELECT * FROM hoadon hd INNER JOIN khachhang kh ON hd.MSKH = kh.MSKH WHERE 1";
                            $result = mysqli_query($con,$sql);
                            while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <tr>
                                <td class="mhd"><?php echo $row['Ma_HD'] ?></td>
                                <td class=""><?php echo $row['TenKH'] ?></td>
                                <td><?php echo $row['Phone'] ?></td>
                                <td><?php echo $row['Ngay_DH'] ?></td>
                                <td><?php echo $row['Dia_Chi'] ?></td>
                                <td><?php echo product_price($row['Gia_Dat_Hang']) ?>đ</td>
                                <td><a href="ct_hoadon.php?mhd=<?php echo $row['Ma_HD'] ?>&mkh=<?php echo $row['MSKH'] ?>
                                        &tkh=<?php echo $row['TenKH'] ?>" target='_Blank'>xem</a></td>
                            </tr>
                            <?php } ?> <!-- close while hd -->
                        </table>
                    </div>
                    <div class="infor-extend" onclick="extend_bill_open()">
                        <p id="extend-bill"><img src="./icon/windows.svg">Thông tin hóa đơn( <small>Nhấn để thao tác lên hóa đơn</small> )</p>
                    </div>
                    <div class="xoa-bill">
                        <label for="msp">Mã hóa đơn</label>
                        <input type="text" name="mhd" placeholder="Nhập mã hóa đơn">
                    </div>
                </form>
            </div>
            <div class="admin">
                <form id="form-product" action="handle_admin.php" method="POST" enctype="multipart/form-data">
                    <div class="title">
                        <h2>Thông tin nhân viên</h2>
                        <button type="submit" id="xoa" name="action" value="delete-admin">Xóa</button>
                        <button type="submit" id="sua" name="action" value="update-admin">Sửa</button>
                        <button type="submit" id="them" name="action" value="add-admin">Thêm</button>
                    </div>
                    <div class="box-table">
                        <table>
                            <tr>
                                <th class="ten-kh ">Tên nhân viên</th>
                                <th class="ma-san-pham">Mã nhân viên </th>
                                <th >Số điện thoại</th>
                                <th >Tài khoản</th>
                                <th >Mật khẩu</th>

                            </tr>
                            <?php 
                                $sql = "SELECT * FROM khachhang WHERE user_type='admin'";
                                $result = mysqli_query($con,$sql);
                                while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <tr class="list_row">
                                <td class="ten-kh color-tkh"><?php echo $row['TenKH'] ?></td>
                                <td class="ma-san-pham color-msp"><?php echo $row['MSKH'] ?></td>
                                <td class="color-mt" > <?php echo $row['Phone'] ?></td>
                                <td class="tk color-mt" > <?php echo $row['TK'] ?></td>
                                <td class="mk color-mt" > <?php echo $row['PW'] ?></td>
                            </tr>
                            <?php } ?>
                            
                        </table>
                    </div>

                    <div class="box-form">
                        <div class="form-col-1">
                            <h2> Thông tin cơ bản</h2>
                            <h3> Nhập tên và các thông tin cơ bản của nhân viên</h3>
                            <div class="sl-sanpham">
                                <?php 
                                    $sql = "SELECT count(*) AS sl FROM khachhang WHERE user_type='admin'";
                                    $result = mysqli_query($con,$sql);
                                    $row = mysqli_fetch_assoc($result);
                                    $sl = $row['sl'];
                                ?>
                                <span>SL nhân viên: <p> <?php echo $sl ?> </p>   </span>
                            </div>
                        </div>
                        <div class="form-col-2">
                            <label for="lsp">User type</label>
                            <input type="text" disabled id="lkh" value="ADMIN" > </br>
                            <label for="msp">Mã nhân viên</label>
                            <input type="text" id="msp" name="mkh" placeholder="Mã số nhân viên"> </br>
                            <label for="tsp">Tên nhân viên</label>
                            <input type="text" id="tsp" name="tkh" placeholder="Tên nhân viên"> </br>
                        </div>
                        <div class="form-col-3">
                            <label for="sdt">Số điện thoại</label>
                            <input type="text" id="sdt" name="sdt" placeholder="Phone"> </br>
                            <label for="tk">Tài khoản</label>
                            <input type="text" id="tk" name="tk" placeholder="Tài khoản"> </br>
                            <label for="mk">Mật khẩu</label>
                            <input type="text" id="mk" name="mk" placeholder="Mật khấu"> </br>
                        </div>
                    </div>
                </form>
            </div>
            <div class="caidat">
                <form id="form-product" action="handle_admin.php" method="POST" enctype="multipart/form-data">
                    <div class="title">
                        <h2>Thông tin người đăng nhập</h2>
                        <div id="huy" onclick="doi_mk_2()" name="action" value="">Hủy</div>
                        <button type="submit" id="luu" name="action" value="change-password">Lưu</button>
                        <input type="hidden" name="mkh" value="<?php echo $_SESSION['MS_AD'] ?>">
                    </div>
                    <div class="caidat-infor">
                        <table>
                            <tr>
                                <th>Tên nhân viên</th>
                                <td colspan="2"><?php echo $_SESSION['Name_AD'] ?></td>
                            </tr>
                            <tr>
                                <th>Mã nhân viên</th>
                                <td  colspan="2"><b><?php echo $_SESSION['MS_AD'] ?></b></td>
                            </tr>
                            <tr>
                                <th>Mật khẩu</th>
                                <td><div onclick="doi_mk_1()" class="change-pw"><img src="./icon/exchange.svg">Đổi mật khẩu</div></td>
                                <td><input  type="text" placeholder="Nhập mật khẩu mới" class="mat-khau-moi" name="npw"></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td colspan="2"><small>admin@admin.com</small></td>
                            </tr>
                            <tr>
                                <th>Nhóm người sử dụng</th>
                                <td colspan="2"><div class="type">Admin</div></td>
                            </tr>
                        </table>          
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        // Script di chuyen slide ADMIN

        var x1 = document.getElementsByClassName('customer')[0];
        var x2 = document.getElementsByClassName('product')[0];
        var x3 = document.getElementsByClassName('bill')[0];
        var x4 = document.getElementsByClassName('price')[0];
        var x5 = document.getElementsByClassName('admin')[0];
        var x6 = document.getElementsByClassName('caidat')[0];

        var y1 = document.getElementById("cus");
        var y2 = document.getElementById("pro");
        var y3 = document.getElementById("bill");
        var y4 = document.getElementById("pri");
        var y5 = document.getElementById("ad");
        var y6 = document.getElementById("cd");

        //setting 
        var btn_huy = document.getElementById("huy");
        var btn_luu = document.getElementById("luu");
        var mkm = document.getElementsByClassName('mat-khau-moi')[0];

        //bill
        var btn_huy_bill =document.getElementById("huy-hd");
        var btn_xoa_bill =document.getElementById("xoa-hd");
        var extend_bill = document.getElementsByClassName('xoa-bill')[0];
        
        function click_customer(){
            x1.style.display="block";
            x2.style.display="none";
            x3.style.display="none";
            x4.style.display="none";
            x5.style.display="none";
            x6.style.display="none";

            y1.setAttribute("class","active");
            y2.setAttribute("class","");
            y3.setAttribute("class","");
            y4.setAttribute("class","");
            y5.setAttribute("class","");
            y6.setAttribute("class","");
        }

        function click_product(){
            x1.style.display="none";
            x2.style.display="block";
            x3.style.display="none";
            x4.style.display="none";
            x5.style.display="none";
            x6.style.display="none";

            y1.setAttribute("class","");
            y2.setAttribute("class","active");
            y3.setAttribute("class","");
            y4.setAttribute("class","");
            y5.setAttribute("class","");
            y6.setAttribute("class","");
        }

        
        function click_price(){
            x1.style.display="none";
            x2.style.display="none";
            x3.style.display="none";
            x4.style.display="block";
            x5.style.display="none";
            x6.style.display="none";

            y1.setAttribute("class","");
            y2.setAttribute("class","");
            y3.setAttribute("class","");
            y4.setAttribute("class","active");
            y5.setAttribute("class","");
            y6.setAttribute("class","");
        }

        function click_admin(){
            x1.style.display="none";
            x2.style.display="none";
            x3.style.display="none";
            x4.style.display="none";
            x5.style.display="block";
            x6.style.display="none";

            y1.setAttribute("class","");
            y2.setAttribute("class","");
            y3.setAttribute("class","");
            y4.setAttribute("class","");
            y5.setAttribute("class","active");
            y6.setAttribute("class","");
        }

        function click_setting(){
            x1.style.display="none";
            x2.style.display="none";
            x3.style.display="none";
            x4.style.display="none";
            x5.style.display="none";
            x6.style.display="block";

            y1.setAttribute("class","");
            y2.setAttribute("class","");
            y3.setAttribute("class","");
            y4.setAttribute("class","");
            y5.setAttribute("class","");
            y6.setAttribute("class","active");
        }

        function click_bill(){
            x1.style.display="none";
            x2.style.display="none";
            x3.style.display="block";
            x4.style.display="none";
            x5.style.display="none";
            x6.style.display="none";

            y1.setAttribute("class","");
            y2.setAttribute("class","");
            y3.setAttribute("class","active");
            y4.setAttribute("class","");
            y5.setAttribute("class","");
            y6.setAttribute("class","");
        }

        function doi_mk_1(){
            btn_huy.style.display="block";
            btn_luu.style.display="block";
            mkm.style.display="block";
        }

        function doi_mk_2(){
            btn_huy.style.display="none";
            btn_luu.style.display="none";
            mkm.style.display="none";
        }

        function extend_bill_open() {
            btn_huy_bill.style.display="block";
            btn_xoa_bill.style.display="block";
            extend_bill.style.display="block";
        }

        function extend_bill_close() {
            btn_huy_bill.style.display="none";
            btn_xoa_bill.style.display="none";
            extend_bill.style.display="none";
        }
        
    </script>
</body>
