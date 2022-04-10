<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register User</title>
</head>
<body>
    <?php 
        require ("connect.php");
        $fullname = $_POST['Name'];
        $phone = $_POST['Phone'];
        $UID = $_POST['UID'];
        $PW = $_POST['PW'];

        // kiem tra CSDL co UID nay chua?
        $sql = "SELECT * FROM khachhang WHERE TK = '$UID' "; 
        $result = mysqli_query($con, $sql);

        //them user vao CSDL
        if(mysqli_num_rows($result) > 0){
            echo '<script language="javascript">alert("UID does not exist"); window.location="login.php";</script>';
            die(); 
        }
        else{
            $sql = " INSERT INTO `khachhang`(`TenKH`, `Phone`, `TK`, `PW`) VALUES ('$fullname','$phone','$UID','$PW') ";

            if (mysqli_query($con, $sql)){
                echo '<script language="javascript">alert("Sign Up Success"); window.location="login.php";</script>';
            }
            else {
                echo '<script language="javascript">alert("Server Error"); window.location="login.php";</script>';
            }
        }
        $con->close(); // dong ket noi
    ?>
</body>
</html>