<?php
	session_start();

?>
<?php

$severname ="localhost";
$username ="root";
$password= "abc123";
$dbname ="project2";


$link  = new mysqli($severname,$username,$password,$dbname);
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error($link));
}

// Escape user inputs for security

$details = mysqli_real_escape_string($link, $_REQUEST['details']);

$date = mysqli_real_escape_string($link, $_REQUEST['date0']);
$time = mysqli_real_escape_string($link, $_REQUEST['time0']);
$time1 = mysqli_real_escape_string($link, $_REQUEST['time1']);
$cars = mysqli_real_escape_string($link, $_REQUEST['cars']);


$fetch =$_SESSION['userProID'];

// Attempt insert query execution
$sql = "INSERT INTO meettingapprove(details,MuserProID,date,startTime,endTime,onlineOrOffline,teacherComments,approvedDateTime,approve,	teacherRejectComments) VALUES ('$details','$fetch', '$date','$time','$time1','$cars',null,null,null,null)";

 


                                          
if(mysqli_query($link, $sql)){
$query = mysqli_query($link , "SELECT MAX(meetID) FROM meettingapprove ");
 $fetch = mysqli_fetch_array($query);
 $row=$fetch['MAX(meetID)'];

        // echo "<a class='text-success'>".$row."</a>";
        $file_dir  = "uploads";     
        if (isset($_POST["bteven"])) {

            for ($x = 0; $x < count($_FILES['file']['name']); $x++) {               

            $file_name   = $_FILES['file']['name'][$x];
            $file_tmp    = $_FILES['file']['tmp_name'][$x];
            //  mysql_query("ALTER TABLE  `meetfiles` AUTO_INCREMENT =1");
            $sql = "INSERT INTO meetfiles(meetID,meetFileName) VALUES ('$row ','$file_name')"; 

            /* location file save */
            $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name; /* DIRECTORY_SEPARATOR = / or \ */
            if (move_uploaded_file($file_tmp, $file_target)) { 
                
            
                if(mysqli_query($link, $sql)){
            
                	$ID=$_SESSION['userProID'];
                $q = mysqli_query($link , "SELECT * FROM nomeetnotify where studentID=   '$ID'  ");
                $f = mysqli_fetch_array($q);
                 $name= $f['studentID'];

               if($name){

                $q1 = mysqli_query($link , "SELECT * FROM  notification ");
                $f1 = mysqli_fetch_array($q1);
                 $n= $f1['n'];
                $strNewDate = date ("Y-m-d", strtotime(" $n week", strtotime($date)));
                // echo $strNewDate ;
                    $sql2 = "UPDATE nomeetnotify SET studentID ='$name',notifyDateTime='$strNewDate' where studentID=   '$ID'  ";

                        if ($link->query($sql2) === TRUE) {
                    
                            echo "<script>window.location='lineemailapprov.php'</script>"; 
                            
                        } else {
                        echo "Error updating record: " . $link->error;
                        }


               }else{
                $q1 = mysqli_query($link , "SELECT * FROM  notification ");
                $f1 = mysqli_fetch_array($q1);
                 $n= $f1['n'];
                $strNewDate = date ("Y-m-d", strtotime(" $n week", strtotime($date)));
                $sql2 = "INSERT INTO nomeetnotify (studentID,notifyDateTime) VALUES ('$ID','$strNewDate')";
                if ($link->query($sql2) === TRUE) {
                    
                    echo "<script>window.location='lineemailapprov.php'</script>"; 
                     
                 } else {
                 echo "Error updating record: " . $link->error;
                 }
               }
                  
                
                } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    
                }                      
                                
            } else {                      
                //echo "Sorry, there was an error uploading {$file_name}.";      
                // echo "<script>window.location='lineemailapprov.php'</script>";
                $ID=$_SESSION['userProID'];
                $q = mysqli_query($link , "SELECT * FROM nomeetnotify where studentID=   '$ID'  ");
                $f = mysqli_fetch_array($q);
                 $name= $f['studentID'];

               if($name){

                $q1 = mysqli_query($link , "SELECT * FROM  notification ");
                $f1 = mysqli_fetch_array($q1);
                 $n= $f1['n'];
                $strNewDate = date ("Y-m-d", strtotime(" $n week", strtotime($date)));
                // echo $strNewDate ;
                    $sql2 = "UPDATE nomeetnotify SET studentID ='$name',notifyDateTime='$strNewDate' where studentID=   '$ID'  ";

                        if ($link->query($sql2) === TRUE) {
                    
                            echo "<script>window.location='lineemailapprov.php'</script>"; 
                            
                        } else {
                        echo "Error updating record: " . $link->error;
                        }


               }else{
                $q1 = mysqli_query($link , "SELECT * FROM  notification ");
                $f1 = mysqli_fetch_array($q1);
                 $n= $f1['n'];
                $strNewDate = date ("Y-m-d", strtotime(" $n week", strtotime($date)));
                $sql2 = "INSERT INTO nomeetnotify (studentID,notifyDateTime) VALUES ('$ID','$strNewDate')";
                if ($link->query($sql2) === TRUE) {
                    
                    echo "<script>window.location='lineemailapprov.php'</script>"; 
                     
                 } else {
                 echo "Error updating record: " . $link->error;
                 }
               }
                          
            }   

                            

            }               
        }    
 } else{
     echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    
 }
 
// Close connection
mysqli_close($link);
?>