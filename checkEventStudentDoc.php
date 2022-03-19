<?php
session_start();
if(!ISSET($_SESSION['userProID'])){
    header('location:studentAddDoc.php');
}
?>
<?php

 error_reporting(E_ALL^E_NOTICE);
 require_once './connectDB.php';

// $severname ="localhost";
// $username ="root";
// $password= "123456";
// $dbname ="project2";

$link  = new connectDB();
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}


$query = mysqli_query($link->connect() , "SELECT * FROM  `userprofile` WHERE `userProID`='$_SESSION[userProID]'");
 $fetch = mysqli_fetch_array($query);
 $userID = $fetch['userProID'];
// Escape user inputs for security


$doctype = mysqli_real_escape_string($link->connect(), $_REQUEST['doctype']);
$details = mysqli_real_escape_string($link->connect(), $_REQUEST['details']);
// $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
// $format="d/m/y H:i:s";
$datetime=date("Y-m-d H:i:s");

        // echo "<a class='text-success'>".$row."</a>";
        $file_dir  = "documentStudents";     
        if (isset($_POST["submit"])) {
           // echo "55555";

            for ($x = 0; $x < count($_FILES['filename']['name']); $x++) {      
                        
            $file_name   = $_FILES['filename']['name'][$x];
            $file_tmp    = $_FILES['filename']['tmp_name'][$x];
            //  mysql_query("ALTER TABLE  `meetfiles` AUTO_INCREMENT =1");
            $sql = "INSERT INTO document(SumuserProID,typeID,details,uploadDatetime,fileName) VALUES ('$userID','$doctype', '$details','$datetime','$file_name')";
           // $sql = "INSERT INTO `document`(`fileName`) VALUES ('$file_name')"; 
 

            /* location file save */
            $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name; /* DIRECTORY_SEPARATOR = / or \ */
            if (move_uploaded_file($file_tmp, $file_target)) { 
                
            
                if(mysqli_query($link->connect(), $sql)){
                    echo "<script>alert('บันทึกข้อมูลสำเร็จ!!')</script>";
                	echo "<script>window.location='studentAddDoc.php'</script>";
                
                } else{
                    echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ!!')</script>";
                    echo "<script>window.location='studentAddDoc.php'</script>";
                    // echo "ERROR: Could not able to execute $sql. " . mysqli_error($link->connect());
                    
                }                      
                                
            } else {                      
                echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ!!')</script>";
                    echo "<script>window.location='studentAddDoc.php'</script>";
                //echo "Sorry, there was an error uploading {$file_name}.";      
                // echo "<script>window.location='lineemailapprov.php'</script>";                          
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
        $sql = "Delete from document where documentID='".$del[$i]."'";
        $result = mysqli_query($conn->connect(),$sql);
    }
    if($result) {
        echo "<script>alert('ลบข้อมูลสำเร็จ!!')</script>";
        echo "<script>window.location='showDocSTD.php'</script>";
        // header ("Location:showDocSTD.php");
    }
    else {
        echo "<script>alert('ลบข้อมูลไม่สำเร็จ!!')</script>";
        echo "<script>window.location='showDocSTD.php'</script>";
        // echo 'Cannot Delete<br>';
        // foreach ($del as $value){
        //     echo $value."<br>";
        //     echo $sql;
        // }
    }
}


?>
