<?php
include "./connectDB.php";
$conn = new connectDB();

if(isset($_POST['username'])){
    $username = mysqli_real_escape_string($con,$_POST['username']);
 
    $query = "select count(*) as cntUser from userprofile where username='".$username."'";
 
    $result = mysqli_query($con,$query);
    $response = "<span style='color: green;'>Available.</span>";
    if(mysqli_num_rows($result)){
       $row = mysqli_fetch_array($result);
 
       $count = $row['cntUser'];
     
       if($count > 0){
           $response = "<span style='color: red;'>Not Available.</span>";
       }
    
    }
 
    echo $response;
    die;
 }
// if(!empty($_POST["username"])) {
//     $query = "SELECT * FROM userprofile WHERE username='" . $_POST["username"] . "'";
//     $result = mysqli_query($conn->connect(),$query);
//     $count = mysqli_num_rows($result);
//     if($count>0) {
//       echo "<span style='color:red'> Sorry User already exists .</span>";
//       echo "<script>$('#submit').prop('disabled',true);</script>";
//     }else{
//       echo "<span style='color:green'> User available for Registration .</span>";
//       echo "<script>$('#submit').prop('disabled',false);</script>";
//     }
//   }
// $username = isset($_POST['username']) ? trim($_POST['username']) : "";
// $Query = mysqli_query($con->connect(),"SELECT * FROM userprofile WHERE username='$email'");
// $Rows = mysqli_num_rows($Query);
// if($Rows == 1){
//     echo "1";
// }

// if(isset($_POST['username_chk'])){
//     $username = $_POST['username'];
//     $sql = "SELECT * FROM userprofile WHERE username='$username'";
//     $result = mysqli_query($conn->connect(),$sql);
//     if(mysqli_num_rows($result)>0){
//         echo 'taken';
//     }else{
//         echo 'not_taken';
//     }
//     exit();
// }

// $UserName = $_REQUEST['username'];
// //เช็คจากตาราง User
// $sql = "SELECT * FROM userprofile WHERE username='$UserName'";
// $result = mysqli_query($con, $sql);
// if(mysqli_num_rows($result) == 0){
// 	echo "true,<span style='color:green'>ชื่อผู้ใช้งานถูกต้อง</span>";
// }
// else{ 
// 	echo "false,<span style='color:red'>ชื่อผู้ใช้งานนี้ถูกใช้แล้ว</span>";
// }
?>