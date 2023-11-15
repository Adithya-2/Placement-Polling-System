<?php
    session_start();
    include("../api/connection.php");
    if(!isset($_SESSION['id'])){
        echo '<script>
                    alert("back");
                </script>';
        header("location: ../");
    }
    $data = $_SESSION['data'];

    if($_SESSION['status']==1){
        $status = '<b style="color: green">Voted</b>';
    }
    else{
        $status = '<b style="color: red">Not Voted</b>';
    }
   
    $st = mysqli_query($connect, "select count(*) from user where status=1");
    if ($st) {
        $row = $st->fetch_assoc();
        $vc = (int)$row['count(*)'];}
    $rs=mysqli_query($connect, "select count(*) from user");
    if ($rs) {
            $row = $rs->fetch_assoc();
            $rowCount = (int)$row['count(*)'];}
    if(TRUE){
        $getid= mysqli_query($connect, "select id,name,votes from user where votes=(select max(votes) from user");
        if ($getid) {
            $rid = $getid->fetch_assoc();
            $roid = (int)$rid['id'];
            
            $rvt=(int)$rid['votes'];
        }}
    
    
?>


<html>
    <head>
        <title>Online voting system - Dashboard</title>
        <link rel="stylesheet" href="../css/stylesheet.css">
		<style>
		body{
			background-image:url("imdash.jpg");
			background-repeat:no-repeat;
			background-size:100% 100%;
		}
       
        #details {
            display: none;
        }
   
		</style>
    </head>
    <body>
        
            <center>
            <div id="headerSection">
            <a href="../"><button id="back-button"> Back</button></a>
            <a href="logout.php"><button id="logout-button">Logout</button></a>
            <h1>Online Voting System</h1>  
            </div>
            </center>
            <hr>

            <div id="mainSection">
                <div id="profileSection">
                    <center><img src="../uploads/<?php echo $data['photo']?>" height="100" width="100"></center><br>
                    <b>Name : </b><?php echo $data['name'] ?><br><br>
                    <b>Mobile : </b><?php echo $data['mobile'] ?><br><br>
                    <b>Address : </b><?php echo $data['address'] ?><br><br>
                    <b>Status : </b><?php echo $status ?>
                </div>
                <div id="groupSection">
                    <?php

                    if(isset($_SESSION['groups'])){
                        $groups = $_SESSION['groups'];
                        for($i=0; $i<count($groups); $i++){
                            ?>
                                <div style="border-bottom: 1px solid #bdc3c7; margin-bottom: 10px">
                                <img style="float: right" src="../uploads/<?php echo $groups[$i]['photo']?>" height="80" width="80">
                                <b>Group Name : </b><?php echo $groups[$i]['name']?><br><br>
                                
                                <form method="POST" action="../api/vote.php">
                                <input type="hidden" name="gvotes" value="<?php echo $groups[$i]['votes'] ?>">
                                <input type="hidden" name = "gid" value="<?php echo $groups[$i]['id'] ?>">
                                <?php

                                if($_SESSION['status']==1){
                                    ?>
                                    <button disabled style="padding: 5px; font-size: 15px; background-color: #27ae60; color: white; border-radius: 5px;" type="button">Voted</button>
                                    <?php
                                }
                                else{
                                    ?>
                                    <button style="padding: 5px; font-size: 15px; background-color: #3498db; color: white; border-radius: 5px;" type="submit">Vote</button>
                                    <?php
                                }
                                ?>
                                </form>
                                </div>
                            <?php
                        }
                    }
                    else{
                        ?>
                            <div style="border-bottom: 1px solid #bdc3c7; margin-bottom: 10px">
                                <b>No groups available right now.</b>    
                            </div>
                        <?php
                    } ?>

                    <div>
                    <h1>Submit Form</h1>

<form id="myForm" >
    

    <input type="submit" value="Submit">
</form>


<div id="details">
    <h2>Details:</h2>
    
    <img style="float: right" src="../uploads/<?php echo $groups[$roid]['photo']?>" height="80" width="80">

    <p><strong>Name:</strong> <span id="display_name"></span></p>
    
    <p><strong>votes:</strong> <?php echo $rvt ?> </p>
</div>

<script>
    
    const form = document.getElementById("myForm");
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        

        details.style.display = "block";
    });
</script>
                    </div>
                    
                </div>
            </div> 
    </body>
</html>