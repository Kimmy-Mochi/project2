<?php
session_start();
if(!ISSET($_SESSION['userProID'])){
    header('location:adminstaffAddDoc.php');
}
?>
<?php

 error_reporting(E_ALL^E_NOTICE);
 require_once './connectDB.php';
$conn = new connectDB();

//advisory
$SuserProID = $_POST['sID'];
$TuserProID = $_POST['tID'];
$date = date("Y-m-d");
$advisoryStatus = $_POST['mainOrco'];
$sID=$SuserProID;

$query = mysqli_query($conn->connect() , "SELECT * FROM  `userprofile` 
 WHERE `userProID`='$_SESSION[userProID]'");
 $fetch = mysqli_fetch_array($query);
 $userID = $fetch['userProID'];


$stID = mysqli_real_escape_string($conn->connect(), $_REQUEST['id']);
// $doctype = mysqli_real_escape_string($conn->connect(), $_REQUEST['doctype']);
$doctype = '2';
$details = mysqli_real_escape_string($conn->connect(), $_REQUEST['details']);
// $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
// $format="Y-m-d H:i:s";

$datetime=date("Y-m-d H:i:s");

// echo $stID;

$file_dir  = "documentAdminStaff";   
if(isset($_POST["submit"]))
{ 

        for ($x = 0; $x < count($_FILES['filename']['name']); $x++) {      
                        
            $file_name   = $_FILES['filename']['name'][$x];
            $file_tmp    = $_FILES['filename']['tmp_name'][$x];
            //  mysql_query("ALTER TABLE  `meetfiles` AUTO_INCREMENT =1");
           // $sql = "INSERT INTO `document`(`fileName`) VALUES ('$file_name')"; 

           $sql = "INSERT INTO `document`(`SumuserProID`,`AuserProID`, `typeID`, `details`, `uploadDatetime`, `fileName`)  VALUES ('$stID','$userID','$doctype', '$details','$datetime','$file_name')";
            /* location file save */
            
            $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name; /* DIRECTORY_SEPARATOR = / or \ */
            if (move_uploaded_file($file_tmp, $file_target)) { 
                
            
                if(mysqli_query($conn->connect(), $sql)){
                    
                    $sql = "INSERT INTO `advisory`(`SuserProID`,`TuserProID`, `advisoryStatus`, `dateStart`) VALUES ('$stID','$TuserProID','$advisoryStatus','$date')";


                    if (mysqli_query($conn->connect(),$sql)){
                        echo "<script>alert('บันทึกข้อมูลสำเร็จ!!')</script>";
                        echo "<script>window.location='manageAdvisory.php?id=$stID'</script>";
                    //  header("Location:AdvisoryAccept.php");
                    }
            
                
                } else{
                    echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ!!')</script>";
                        echo "<script>window.location='manageAdvisory.php?id=$stID'</script>";
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn->connect());
                    
                }                      
                                
            } else {    
                echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ!!')</script>";
                echo "<script>window.location='manageAdvisory.php?id=$stID'</script>";                  
                //echo "Sorry, there was an error uploading {$file_name}.";      
                // echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn->connect());                       
            }   
                            

        }              
}
else{
    $conn = new connectDB();
    $del=$_POST['checkbox'];
    // foreach ($del as $value){
        for($i=sizeof($del);$i>=0;$i--){

        $sql1 = "DELETE advisory FROM advisory WHERE advisoryID='".$del[$i]."'  ";
        $result1 = mysqli_query($conn->connect(),$sql1);
        // echo ".$del[$i]." . "<br>"; 
        // echo ".$result[userProID].". "<br>";
        // echo ".$_SESSION[userProID].". "<br>";
    }
    if($result1) {
        echo "<script>alert('ลบข้อมูลสำเร็จ!!')</script>";
        echo "<script>window.location='showAdvisory.php?id=$stID'</script>";
        // header ("Location:showAdvisory.php");
    }
    else {
        echo "<script>alert('ลบข้อมูลไม่สำเร็จ!!')</script>";
        echo "<script>window.location='showAdvisory.php'</script>";

    }
}


?>