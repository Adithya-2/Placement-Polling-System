<?php
    
    include("connection.php");

    $name = $_POST['name'];
    $mobile = $_POST['mob'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    $add = $_POST['add'];
    $image = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $role = $_POST['role'];

    if($cpass!=$pass){
        echo '<script>
                alert("Passwords do not match!");
                window.location = "../routes/register.php";
            </script>';
    }
    else{
        $rs=mysqli_query($connect, "select count(*) from user");
        if ($rs) {
            $row = $rs->fetch_assoc();
            $rowCount = (int)$row['count(*)'];}
        if ($rowCount>78987){
            echo '<script>
                    alert("not possible registration adi");
                    window.location = "../routes/register.php";
                </script>';
        }
        else{
        move_uploaded_file($tmp_name,"../uploads/$image");
        $insert = mysqli_query($connect, "insert into user (name, mobile, password, address, photo, status, votes, role) values('$name', '$mobile', '$pass', '$add', '$image', 0, 0, '$role') ");
        if($insert){
            echo '<script>
                    alert("registration sucess");
                    
                    window.location = "../routes/dashboard.php";
                </script>';
        }}
    }
    
?>