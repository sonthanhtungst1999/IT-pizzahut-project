<?php 
    require 'connect.php';
    session_start();
    if(isset($_GET['action'])){
        if($_GET['action']=='remove'){
            foreach($_SESSION['cart'] as $key  => $value){
                if($value['product_id'] == $_GET['id']){

                    unset($_SESSION['cart'][$key]);
                    unset($_SESSION['size_product_id'][$key]);

                    // sap xep lai  $key sau khi unset SESSION
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                    $_SESSION['size_product_id'] = array_values($_SESSION['size_product_id']);
                    echo '<script language="javascript">window.location="cart.php";</script>';

                }
            }
        }
    }

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
    <link rel = "icon" href = "./icon/Daco_373178.png" type = "image/x-icon"> 
    <meta charset="UTF-8">
    <title>Cart Pizza Hut</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
</head>

<body onload="update_total()">
    <div id="header">
        <div class="div-header-1">
            <a href="index_after_login.php">
                <img src="./icon/pizaahut.png" alt="logo pizzahut">
            </a>
        </div>
        <div class="div-header-2">
            <?php
                echo ' <div><a href=""><img src="./icon/icon-khach-hang.png">'.$_SESSION['Name'].'</a></div>';
            ?>
            <div class="cart-box">
                <a href="cart.php">
                    <img src="./icon/cart_icon.svg">
                </a>
                <span class="cart_count">
                    <?php
                    if(isset($_SESSION['cart'])){
                        $count = count($_SESSION['cart']);
                        echo "<p>$count</p>";
                    }
                    else{
                        echo "<p>0</p>";
                    }
                    ?>
                </span>
            </div>
        </div>
        <div class="div-header-4"><a href="exit.php" onclick="warning_logout()"><img src="./icon/exit.svg"></a></div>
        <div class="div-header-3">
            <select class="select-box">
                <optgroup label="">
                <option class="opt-VN">VN</option>
                <option class="opt-EN">EN</option> 
            </select>
        </div>  
    </div>

    <!-- <?php print_r($_SESSION); ?> -->

    <?php 
    require 'connect.php';
    $con->set_charset("UTF-8");
    $sql = "SELECT * FROM sanpham";
    $result = $con->query($sql);
    $total = 0;
    if(isset($_SESSION['cart'])) {
        $product_id = array_column($_SESSION['cart'],'product_id');
        $size = array_column($_SESSION['size_product_id'],'size');?>
            <div class="cart-container" id="cart-container">
            <form action="order.php" method="POST">
                <table id="cart_item">
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Remove</th>
                    </tr>
        <?php 

            for($i=0; $i<count($_SESSION['cart']); $i++){ 
                $sql = "SELECT * FROM sanpham WHERE Ma_SP='$product_id[$i]'";
                $result = $con->query($sql);
                $row = $result->fetch_assoc();
                ?>
                    <tr class="cart_row">
                        <td>
                            <div class="cart-info">
                                <img src="<?php echo $row['HINH']?>">
                                <div>
                                    <p><?php echo $row['Ten_SP']?></p>
                                </div>
                                <input type="hidden" name="msp[]" value="<?php echo $row['Ma_SP'] ?>">
                            </div>
                        </td>
                        <td><input min="1" max="99" type="number" value="1" class="cart_quantity" name="quantity[]" onchange="update_total()"></td>

                    <?php 
                        $check_size_list = $size[$i];
                        $sql_price = "SELECT * FROM chitietsanpham WHERE Ma_SP='$row[Ma_SP]' AND Ma_Size='$check_size_list' ";
                        $result_price = $con->query($sql_price);
                        $result_price_row = $result_price->fetch_assoc();
                        echo'<td class=cart_price >'.product_price($result_price_row["Gia"]).'đ</td>';
                    ?>
                        <td><a href="cart.php?action=remove&id=<?php  echo $row['Ma_SP'] ?>">Remove</a></td>
                    </tr>
            <?php } ?> <!--close for -->

                </table>
            </div>
    <?php } else {   ?>

            <div class="cart-container">
                <table id="cart_item">
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Remove</th>
                    </tr>
                    <tr>
                        <td><div class="cart_temp"></div></td>
                    </tr>
                </table>
                <img src="./quangcao/empty_cart.png">
            </div>
    <?php } ?>
    <div class="table-total">
        <table>
                <tr>
                    <td>Total</td>
                    <td id="total_price"></td>
                    <input id="total_price_input_hidden" type="hidden" name="price">    
                </tr>
                <tr>
                    <td>Address</td>
                    <td><input id="address" type="text" required="required" name="Address" placeholder="Required"></td>
                </tr>
                <tr>
                    <td colspan="2"> 
                        <button class="order" type="submit">Đặt hàng</button>
                    </td>     
                </tr>
        </table>
    </div>
    </form>
    <div id="footer">
        <div class="flex-footer">
            <div>
                <ul>
                    <li class="title-footer">Cần sự hỗ trợ?</li>
                    <li class="call-footer">Gọi 1900 1822</li>
                </ul>
            </div>
            <div>
                <ul>
                    <li class="title-footer">Về chúng tôi</li>
                    <li><a href="#">Giới thiệu</a></li>
                    <li><a href="#">Tầm nhìn của chúng tôi</a></li>
                    <li><a href="#">Giá trị cốt lõi</a></li>
                    <li><a href="#">Vệ sinh an toàn thực phẩm</a></li>
                </ul>   
            </div>
            <div>
                <ul>
                    <li class="title-footer">Tìm cửa hàng</li>
                    <li><a href="#">Miền Bắc</a></li>
                    <li><a href="#">Miền Trung</a></li>
                    <li><a href="#">Miền Nam</a></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li class="title-footer">Thông tin tuyển dụng</li>
                    <li><a href="#">làm việc tại Pizza Hut</a></li>
                    <li><a href="#">Môi trường làm việc</a></li>
                    <li><a href="#">Cơ hội phát triển nghề nghiệp</a></li>
                </ul>
            </div>
            <div>
                <ul>
                    <li class="title-footer">Liên hệ với Pizza Hut</li>
                    <li>
                        <a href="https://www.facebook.com/VietnamPizzaHut" target="_blank"><img src="icon/FB.png"></a>
                        <a href="https://www.youtube.com/channel/UCyqyAPpM7hbYhrRKi1kv0vg" target="blank"><img src="icon/YT.png"></a>
                        <a href="mailto:customerservice@pizzahut.vn" target="blank"><img src="icon/M.png"></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <script>
    function update_total() {
        var cart_item = document.getElementsByClassName('cart_item')[0];
        var cart_row = document.getElementsByClassName('cart_row');
        var total = 0;
        for(var i = 0; i < cart_row.length; i++){
            var item = cart_row[i];
            var price_item = item.getElementsByClassName('cart_price')[0];
            var quantity_item = item.getElementsByClassName('cart_quantity')[0];
            var price = price_item.innerHTML.replace('đ','');
            price = price.replace('.','');
            var quantity = quantity_item.value;
            if(quantity < 1){
                quantity = 1;
            }
            total = total + (price * quantity);
        }
        // Format price JS
        document.getElementById('total_price_input_hidden').value = total;
        console.log(total);
        total = total.toLocaleString('Vi', {style : 'currency', currency : 'VND'});
        document.getElementById('total_price').innerHTML = total;
        console.log(total);
    }
    </script>
</body>
</html>