<?php
    session_start();
    include("connection.php");

    

    $st = mysqli_query($connect, "select count(*) from user where status=1");
    if ($st) {
        $row = $st->fetch_assoc();
        $vc = (int)$row['count(*)'];}
    $rs=mysqli_query($connect, "select count(*) from user");
    if ($rs) {
            $row = $rs->fetch_assoc();
            $rowCount = (int)$row['count(*)'];}
    if($vc==4){
        $getid= mysqli_query($connect, "select id from user where votes=(select max(votes) from user");
        if ($getid) {
            $rid = $getid->fetch_assoc();
            $roid = (int)$rid['id'];}
        
        echo '<script>

                    alert("hi ra");
                    window.location = "../routes/dashboard.php";
                </script>';
        echo "bharat";
    }
    else{
        echo '<script>
                    alert("cannot dispalay result");
                    window.location = "../routes/dashboard.php";
                </script>';
    }
    
?>