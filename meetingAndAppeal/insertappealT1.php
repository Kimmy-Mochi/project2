<?php
	session_start();
$severname ="localhost";
$username ="root";
$password= "abc123";
$dbname ="project2";

$conn = new mysqli($severname,$username,$password,$dbname);// Using database connection file here

$sAppealID = $_GET['id']; // get id through query string




$query8 = mysqli_query($conn, "SELECT * FROM  teacherappeal  WHERE  teacherappeal.tAppealID  = $sAppealID") or die(mysqli_error());
$fetch8 = mysqli_fetch_array($query8);



$query = mysqli_query($conn, "SELECT * FROM  `userprofile` INNER JOIN teachers  ON  teachers.TuserProID =userprofile.userProID
 INNER JOIN teacherappeal ON teacherappeal.teacherID = teachers.teacherID WHERE teachers.teacherID ='$fetch8[teacherID]'  ") or die(mysqli_error());
$fetch = mysqli_fetch_array($query);


$query1 = mysqli_query($conn, "SELECT * FROM  `userprofile` WHERE `userProID`='$fetch8[studentID]'") or die(mysqli_error());
$fetch1 = mysqli_fetch_array($query1);





$query2 = mysqli_query($conn, "SELECT * FROM  teacherappealfiles where tAppealID ='$sAppealID'") or die(mysqli_error());


// $userProID= $data ['studentID'];


// if (isset($_GET['submit'])) {
//   echo '<div class="form" id="form3"><br><br><br><br><br><br>
//   <Span>Data Updated Successfuly......!!</span></div>';
//   }
if(count($_POST)>0) 
{
  

    $appealResults=$_POST['appealResults'];
    $userProID=$_SESSION['userProID'];




   
    $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
    $format="d/m/y H:i:s";
    $datetime=date($format,$th);
   
     
     
      $sql = "UPDATE teacherappeal SET  appealResults='$appealResults',  dateResult = '$datetime' ,userID = ' $userProID'  WHERE tAppealID='$sAppealID' ";
 


    if ($conn->query($sql) === TRUE) {
      $file_dir  = "uploads"; 
      $query11 = mysqli_query($conn, "SELECT * FROM  teacherappealfiles WHERE tAppealID  = '$sAppealID'  ");
      $fetch11 = mysqli_fetch_array($query11);
      $r= $fetch11['tAppealFiles'];  
          for ($x = 0; $x < count($_FILES['file']['name']); $x++) {               

          $file_name   = $_FILES['file']['name'][$x];
          $file_tmp    = $_FILES['file']['tmp_name'][$x];
          //  mysql_query("ALTER TABLE  `meetfiles` AUTO_INCREMENT =1");
          // $sql = "INSERT INTO studentappealfiles(sAppealID,sAppealFiles) VALUES ('$row ','$file_name') "; 
           
          $details1 = $_POST[' appealResults'];
          $sql = "UPDATE teacherappealfiles SET 	tAppealID  = '$sAppealID' , tAppealFiles='$r'
          ,tAppealResultFiles= '$file_name' WHERE tAppealID  = '$sAppealID' ";

          /* location file save */
          $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name; /* DIRECTORY_SEPARATOR = / or \ */
          if (move_uploaded_file($file_tmp, $file_target)) { 
              
          
              if(mysqli_query($conn, $sql)){

                $q = mysqli_query($conn, "SELECT * FROM  `userprofile` WHERE `userProID`='$_SESSION[userProID]'") or die(mysqli_error());
                $f= mysqli_fetch_array($q);
                $status =$f['status'];
                if($status == 'T'){
                echo "<script>window.location='lineemailapprovIntoT.php'</script>";
                 }
                 else{
                  echo "<script>window.location='lineemailapprovInvigilationA.php?id=".$fetch['email']."'</script>";
                 }
                // echo "<script>window.location='Hteachersappeal.php?id=".$_SESSION['userProID']."'</script>"; 
              
              } else{
                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                  
              }                      
                              
          } else {          
            $q = mysqli_query($conn, "SELECT * FROM  `userprofile` WHERE `userProID`='$_SESSION[userProID]'") or die(mysqli_error());
            $f= mysqli_fetch_array($q);
            $status =$f['status'];
            if($status == 'T'){
            echo "<script>window.location='lineemailapprovIntoT.php'</script>";
             }
             else{
              echo "<script>window.location='lineemailapprovInvigilationA.php?id=".$fetch['email']."'</script>";
             }                        
          }   
                          

          }               
 
    } else {
      echo "Error updating record: " . $conn->error;
    }


	
 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Appeal</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6"> <br />
      <h4 align="center"> การร้องเรียนของอาจารย์</h4>
      <hr />
      <form  name="addproduct" action="" method="POST" enctype="multipart/form-data"  class="form-horizontal">
        <div class="form-group">
          <div class="col-sm-12">
            <p> อาจารย์</p>
            <input type="text" value="<?php echo $fetch ['firstNameTH']."&nbsp;".$fetch['lastNameTH']; ?>" disabled='disabled' rows="3" name="T" class="form-control" required  />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> นักศึกษาที่ถูกร้องเรียน</p>
            <input type="text" value="<?php echo $fetch1 ['firstNameTH']."&nbsp;".$fetch1['lastNameTH']; ?>" disabled='disabled' rows="3" name="U" class="form-control" required  />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> รายละเอียดในการร้องเรียน</p>
            <textarea  name="details1"id="details1" disabled='disabled'  class="form-control"  rows="5" required ><?php echo $fetch8['detail']; ?></textarea>
          </div>
        </div>
       
        <div class="form-group">
          <div class="col-sm-12">
    
          </div>
        </div>
       
        <div class="form-group">
          <div class="col-sm-12">
            <p> วันเวลาที่ร้องเรียน</p>
            <input type="text"  value="<?php echo $fetch8 ['datetime']; ?>" disabled='disabled' rows="3" id= "datetime" name="datetime" class="form-control" required  />
            </div>
         </div>
              
         <div class="form-group">
          <div class="col-sm-12">
            <p> ผลการร้องเรียน</p>
            <input type="text" value="<?php echo $fetch8['appealResults']; ?>" rows="3" id= "appealResults" name="appealResults"  class="form-control" required  />
            </div>
         </div>
         <div class="form-group">
          <div class="col-sm-12">
            <p> เพิ่มไฟล์</p>  
		       <input  type="file"   name="file[]" multiple/>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <button type="submit" onclick="return confirm('ยืนยันการบันทึก')"class="btn btn-primary" name="btnadd"> บันทึก </button>
          </div>
        </div>

      </form>
     <A  class="btn btn-primary"style="background-color:#f7dd08" HREF="javascript:history.back()">ย้อนกลับ </A>
    </div>
  </div>
</div>

</body>