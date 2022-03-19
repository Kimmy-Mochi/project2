<?php
session_start();
if(!ISSET($_SESSION['userProID'])){
    header('location:index.php');
}
?>
<?php
   
    error_reporting(E_ALL^E_NOTICE);
    require_once './connectDB.php';
    $id = $_SESSION["userProID"];/* userid of the user */
    $con = new connectDB();
    $currentPassword = $_POST["currentPassword"];
    $newPassword = $_POST["newPassword"];
    $confirmPassword = $_POST["confirmPassword"];

    if(count($_POST)>0) {
        $result = mysqli_query($con->connect(),"SELECT * from userprofile WHERE userProID='" . $id . "'");
        $row=mysqli_fetch_array($result);
        $hash = $row['hashedPassword'];
        $status = $row['status'];
        $verify = password_verify($currentPassword, $hash);

        if($verify){
            if($_POST["newPassword"] == $_POST["confirmPassword"] ) {
                
                $newPasswordd = PASSWORD_HASH($_POST["newPassword"], PASSWORD_DEFAULT);
                $sql = mysqli_query($con->connect(),"UPDATE userprofile set hashedPassword='". $newPasswordd ."' WHERE userProID='" . $id . "'");
                // $message = "Password Changed Sucessfully";
                echo "<script>alert('เปลี่ยนรหัสผ่านสำเร็จ')</script>";

                if($status=="A" or $status=="SF"){
                    echo "<script>window.location='homeAdminStaff.php'</script>";
                }
                
                if ($status =="T"){  
                    echo "<script>window.location='homeTeachers.php'</script>";
                }else{
                    echo "<script>window.location='homeStudent.php'</script>";
                }

            }
        } 
            
         else{
            // $message = "Password is not correct";
            if($status=="A" or $status=="SF"){
                echo "<script>alert('กรุณากรอกรหัสผ่าน')</script>";
                echo "<script>window.location='changePasswordAdmin.php'</script>";
            }
            if($status=="T"){
                echo "<script>alert('กรุณากรอกรหัสผ่าน')</script>";
                echo "<script>window.location='changePasswordTeacher.php'</script>";
            }
            if($status=="S"){
                echo "<script>alert('กรุณากรอกรหัสผ่าน')</script>";
                echo "<script>window.location='changePasswordStudent.php'</script>";
            }
           
        }
    }
?>