<?php
	session_start();
	if(!ISSET($_SESSION['userProID'])){
		header('location:index.php');
	}
?>
<?php

// $severname ="localhost";
// $username ="root";
// $password= "abc123";
// $dbname ="project2";

// $conn = new mysqli($severname,$username,$password,$dbname);// Using database connection file here


require_once '../connectDB.php';
$conn = new connectDB();


// $qry = mysqli_query($conn,"select * from userprofile INNER JOIN students  ON  userprofile.userProID  = students.SuserProID  INNER JOIN advisory  
// ON  students.studentID = advisory.studentID INNER JOIN teachers  ON  advisory.teacherID = teachers.teacherID 
// WHERE `userProID`='$_SESSION[userProID]'"); // select query
$qry = mysqli_query($conn->connect(),"select * from userprofile INNER JOIN teachers  ON  userprofile .userProID  = teachers.TuserProID  INNER JOIN advisory  
ON   advisory.TuserProID = teachers.TuserProID INNER JOIN students ON  students.SuserProID = advisory.SuserProID
WHERE `userProID`='$_SESSION[userProID]'");
$data = mysqli_fetch_array($qry); 




$query = mysqli_query($conn->connect(), "SELECT * FROM  `userprofile` WHERE `userProID`='$data[TuserProID]'") or die(mysqli_error($conn->connect()));
$fetch = mysqli_fetch_array($query);

$query1 = mysqli_query($conn->connect(), "SELECT * FROM  `userprofile` WHERE `userProID`='$data[SuserProID]'") or die(mysqli_error($conn->connect()));
$fetch1 = mysqli_fetch_array($query1);


// $query1 = mysqli_query($conn, "SELECT * FROM  `userprofile` WHERE `userProID`='$data[SuserProID]'") or die(mysqli_error());
// $fetch1 = mysqli_fetch_array($query1);






// if (isset($_GET['submit'])) {
//   echo '<div class="form" id="form3"><br><br><br><br><br><br>
//   <Span>Data Updated Successfuly......!!</span></div>';
//   }
if(count($_POST)>0) 
{


$query3 = mysqli_query($conn->connect(), "SELECT * FROM  teachers WHERE teachers.TuserProID='$data[TuserProID]'") or die(mysqli_error($conn->connect()));
$fetch3 = mysqli_fetch_array($query3);

  $teacherID=$fetch3['teacherID'];
  $studentID=$_POST['datas'];
  $details = $_POST['details'];
    // $th=mktime(gmdate("H")+7,gmdate("i"),gmdate("m"),gmdate("d"),gmdate("Y"));
    // $format="d/m/y H:i:s";
    $datetime=date("Y-m-d H:i:s");
    // echo $teacherID;
    // echo $_SESSION['userProID'];
  
    // echo  $studentID;
    // echo $details;
    // echo $datetime;

    
      $sql = "INSERT INTO teacherappeal( teacherID,studentID,detail,datetime) VALUES (' $teacherID','$studentID','$details','$datetime')";
     

    
       
              
   

    if (mysqli_query($conn->connect(),$sql) === TRUE) {
      $file_dir  = "uploads"; 
      $query3 = mysqli_query($conn->connect(), "SELECT * FROM  teachers WHERE teachers.TuserProID='$data[TuserProID]'") or die(mysqli_error($conn->connect()));
      $fetch3 = mysqli_fetch_array($query3);
  $teacherID=$fetch3['teacherID'];
      $query11 = mysqli_query($conn->connect(), "SELECT MAX(tAppealID) FROM teacherappeal
      WHERE teacherID = $teacherID");
      $fetch11 = mysqli_fetch_array($query11);
      $row=$fetch11['MAX(tAppealID)'];    
          for ($x = 0; $x < count($_FILES['file']['name']); $x++) {               
          $file_name   = $_FILES['file']['name'][$x];
          $file_tmp    = $_FILES['file']['tmp_name'][$x];
          //  mysql_query("ALTER TABLE  `meetfiles` AUTO_INCREMENT =1");
          $sql = "INSERT INTO teacherappealfiles(tAppealID,tAppealFiles) VALUES ('$row ','$file_name') "; 

          /* location file save */
          $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name; /* DIRECTORY_SEPARATOR = / or \ */
          if (move_uploaded_file($file_tmp, $file_target)) { 
              
          
              if(mysqli_query($conn->connect(), $sql)){
          
                
                echo "<script>window.location='lineemailapprovInvigilationTln.php?id=". $studentID."'</script>"; 
              
              } else{
                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn->connect());
                  
              }                      
                              
          } else {                      
             // echo "Sorry, there was an error uploading {$file_name}.";      
             echo "<script>window.location='lineemailapprovInvigilationTln.php?id=". $studentID."'</script>";                        
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
      <h4 align="center"> การร้องเรียน</h4>
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
            <p> นักศึกษาที่ต้องการร้องเรียน</p>
            <?php
         
          $sql= "SELECT * FROM userprofile INNER JOIN students ON  userprofile .userProID  = students.SuserProID  INNER JOIN advisory  
          ON students.SuserProID  = advisory.SuserProID    INNER JOIN teachers ON  advisory.TuserProID  = teachers.TuserProID  WHERE teachers.TuserProID  ='$_SESSION[userProID]' " ; 
          $result = mysqli_query($conn->connect(), $sql); 
		
            echo" <select   class='col-sm-12' id='datas'name='datas'>";  
            while($row = mysqli_fetch_array($result)){  
              
              echo"<option value='$row[0]'>".$row["userProID"]."</option>";
            }
            echo"</select>";
          ?>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> รายละเอียดในการร้องเรียน</p>
            <textarea  name="details" id="details" class="form-control"  rows="8" required ></textarea>
            
          </div>
        </div>
       
        <div class="form-group">
          <div class="col-sm-12">
            <p> ไฟล์</p>  
		       <input  type="file"   name="file[]" multiple/>
          </div>
        </div>
       
        <div class="form-group">
          <div class="col-sm-12">
            <button type="submit" onclick="return confirm('ยืนยันการบันทึก')"class="btn btn-primary" name="btnadd"> บันทึกการร้องเรียน </button>
          </div>
        </div>

      </form>
     <A  class="btn btn-primary"style="background-color:#f7dd08" HREF="javascript:history.back()">ย้อนกลับ </A>
    </div>
  </div>
</div>

</body>