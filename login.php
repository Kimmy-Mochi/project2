<?php
 session_start();
 require_once './connectDB.php'; 
 $conn = new connectDB();
 if(ISSET($_POST['login'])){
  $username = $_POST['username'];
  $password = $_POST['password'];

  $query = mysqli_query($conn->connect(), "SELECT * FROM userprofile WHERE username = '$username' or email = '$username' ");
  $fetch = mysqli_fetch_array($query);
  $hash = $fetch['hashedPassword'];
  $verify = password_verify($password, $hash); 
  
  if ($verify) { 
    $_SESSION['userProID']=$fetch['userProID'];
    $_SESSION['status']=$fetch['status'];
    echo "<script>alert('Login Successfully!')</script>";
    
      if($_SESSION["status"]=="A" or $_SESSION["status"]=="SF"){ 
    
        echo "<script>window.location='homeAdminStaff.php'</script>";

      }

      if ($_SESSION["status"]=="T"){  

        echo "<script>window.location='homeTeachers.php'</script>";

      }
      else{
        echo "<script>window.location='homeStudent.php'</script>";
      }
    } else { 
    echo "<script>alert('กรุณาตรวจสอบ ชื่อผู้ใช้ หรือ รหัสผ่านให้ถูกต้อง')</script>";
    echo "<script>window.location='index.php'</script>";
  }
  
 
   
 
 
 }
 
?>