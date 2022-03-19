<?php
session_start();
if(!ISSET($_SESSION['userProID'])){
    header('location:adminstaffAddDoc.php');
}
?>
<?php

 error_reporting(E_ALL^E_NOTICE);
 require_once './connectDB.php';
$link  = new connectDB();
$conn = new connectDB();
if($link->connect() == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
//advisory
$SuserProID = $_POST['sID'];
$TuserProID = $_POST['tID'];
$date = date("Y-m-d");
$advisoryStatus = $_POST['mainOrco'];

$query = mysqli_query($link->connect() , "SELECT * FROM  `userprofile` WHERE `userProID`='$_SESSION[userProID]'");
 $fetch = mysqli_fetch_array($query);
 $userID = $fetch['userProID'];
//  $sID = $_POST['sID'];
// Escape user inputs for security


$sID = mysqli_real_escape_string($link->connect(), $_REQUEST['sID']);
$doctype = mysqli_real_escape_string($link->connect(), $_REQUEST['doctype']);
$details = mysqli_real_escape_string($link->connect(), $_REQUEST['details']);
// $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
// $format="d/m/y H:i:s";
 
$datetime=date("Y-m-d H:i:s");

        // echo "<a class='text-success'>".$row."</a>";
        $file_dir  = "documentAdminStaff";     
        if (isset($_POST["submit"])) {
           // echo "55555";

            for ($x = 0; $x < count($_FILES['filename']['name']); $x++) {      
                        
            $file_name   = $_FILES['filename']['name'][$x];
            $file_tmp    = $_FILES['filename']['tmp_name'][$x];
            //  mysql_query("ALTER TABLE  `meetfiles` AUTO_INCREMENT =1");
            $sql = "INSERT INTO document(SumuserProID,AuserProID,typeID,details,uploadDatetime,fileName) VALUES ('$sID','$userID','$doctype', '$details','$datetime','$file_name')";
           // $sql = "INSERT INTO `document`(`fileName`) VALUES ('$file_name')"; 
 

            /* location file save */
            $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name; /* DIRECTORY_SEPARATOR = / or \ */
            if (move_uploaded_file($file_tmp, $file_target)) { 
                
            
                if(mysqli_query($link->connect(), $sql)){
                    echo "<script>alert('บันทึกข้อมูลสำเร็จ!!')</script>";
                    
                	echo "<script>window.location='adminstaffAddDoc.php'</script>";
                
                } else{
                    echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ!!')</script>";
                	echo "<script>window.location='adminstaffAddDoc.php'</script>";
                    // echo "ERROR: Could not able to execute $sql. " . mysqli_error($link->connect());
                    
                }                      
                                
            } else {   
                echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้ กรุณากรอกข้อมูล!!')</script>";
                	echo "<script>window.location='adminstaffAddDoc.php'</script>";                   
                //echo "Sorry, there was an error uploading {$file_name}.";      
                // echo "ERROR: Could not able to execute $sql. " . mysqli_error($link->connect());                       
            }   
                            

            }               
        }     
// Close connection
//mysqli_close($link);

else{
    $conn = new connectDB();
    $del=$_POST['checkbox'];
    // foreach ($del as $value){
        for($i=sizeof($del);$i>=0;$i--){
        $sql = "DELETE from document where documentID='".$del[$i]."'";
        $result = mysqli_query($conn->connect(),$sql);
    }
    if($result) {
        echo "<script>alert('ลบข้อมูลสำเร็จ!!')</script>";
                    
        echo "<script>window.location='showDocAdminStaff.php'</script>";
        // header ("Location:showDocAdminStaff.php");
    }
    else {
        echo "<script>alert('ลบข้อมูลไม่สำเร็จ!!')</script>";
        echo "<script>window.location='showDocAdminStaff.php'</script>";
        // echo 'Cannot Delete<br>';
        // foreach ($del as $value){
        //     echo $value."<br>";
        //     echo $sql;
        // }
    }
    
}



?>
