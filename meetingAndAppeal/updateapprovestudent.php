<?php

// $severname ="localhost";
// $username ="id16923734_root";
// $password= "c6RVG|6-^J|}qR#+";
// $dbname ="id16923734_project2";
$severname ="localhost";
$username ="root";
$password= "abc123";
$dbname ="project2";

$conn = new mysqli($severname,$username,$password,$dbname);// Using database connection file here

$meetID = $_GET['id']; // get id through query string



$qry = mysqli_query($conn,"select * from meettingapprove  INNER JOIN students  ON  meettingapprove.MuserProID = students.SuserProID  INNER JOIN advisory  
ON  students.SuserProID  = advisory.SuserProID  INNER JOIN teachers  ON  advisory.TuserProID = teachers.TuserProID
 where meetID='$meetID'"); // select query

$data = mysqli_fetch_array($qry); 



$qry1 = mysqli_query($conn,"select * from  meettingapprove   where meetID='$meetID'"); // select query

$data1 = mysqli_fetch_array($qry1);



$query = mysqli_query($conn, "SELECT * FROM  `userprofile` WHERE `userProID`='$data[TuserProID]'") or die(mysqli_error());
$fetch = mysqli_fetch_array($query);

$query1 = mysqli_query($conn, "SELECT * FROM  `userprofile` WHERE `userProID`='$data[SuserProID]'") or die(mysqli_error());
$fetch1 = mysqli_fetch_array($query1);


$query2 = mysqli_query($conn, "SELECT* FROM  meetfiles  where meetID ='$data[meetID]'") ;




// if (isset($_GET['submit'])) {
//   echo '<div class="form" id="form3"><br><br><br><br><br><br>
//   <Span>Data Updated Successfuly......!!</span></div>';
//   }
if(count($_POST)>0) 
{
 
    $details = $_POST['details'];
    $date = $_POST['date0'];
    $SuserProID = $data['SuserProID'];
    $startTime = $_POST['time0'];
    $endTime = $_POST['time1'];
    $onlineOrOffline = $_POST['onlineOrOffline'];
  
    $sql = "UPDATE meettingapprove SET details =  '$details' , MuserProID='$SuserProID',date=' $date',startTime='$startTime',
     endTime = ' $endTime ' ,onlineOrOffline = '$onlineOrOffline' , teacherRejectComments= null  WHERE meetID='$meetID' ";

    if ($conn->query($sql) === TRUE) {
      $file_dir  = "uploads";     
          for ($x = 0; $x < count($_FILES['file']['name']); $x++) {               

          $file_name   = $_FILES['file']['name'][$x];
          $file_tmp    = $_FILES['file']['tmp_name'][$x];
          //  mysql_query("ALTER TABLE  `meetfiles` AUTO_INCREMENT =1");
          $sql = "INSERT INTO meetfiles(meetID,meetFileName) VALUES ('$meetID ','$file_name') "; 

          /* location file save */
          $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name; /* DIRECTORY_SEPARATOR = / or \ */
          if (move_uploaded_file($file_tmp, $file_target)) { 
              
          
              if(mysqli_query($conn, $sql)){
              
          
                echo "<script>window.location='lineemailapprov.php'</script>"; 
               
              
              } else{
                  echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                  
              }                      
                              
          } else {                      
              //echo "Sorry, there was an error uploading {$file_name}.";      
              echo "<script>window.location='lineemailapprov.php'</script>"; 
                              
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
<title>Edit</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6"> <br />
      <h4 align="center"> แก้ไขข้อมูล </h4>
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
            <p> นักศึกษา</p>
            <input type="text" value="<?php echo $fetch1 ['firstNameTH']."&nbsp;".$fetch1['lastNameTH']; ?>" disabled='disabled' rows="3" name="U" class="form-control" required  />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> รายละเอียด </p>
            <textarea  name="details" id="details" class="form-control"  rows="5" required ><?php echo $data['details']; ?></textarea>
            
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> วันที่ประชุม</p>
            <input   type="date"   value="<?php echo $data['date']; ?>"  rows="3" name="date0" id="date0" class="form-control" required  />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> เวลาที่เริ่มประชุม</p>
            <input   type="time"   value="<?php echo $data['startTime']; ?>"  rows="3" name="time0" id="time0" class="form-control" required  />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> เวลาสิ้นสุดการประชุม</p>
            <input   type="time"   value="<?php echo $data['endTime']; ?>"  rows="3" name="time1" id="time1" class="form-control" required  />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> วิธีการพบ</p>
           
           <?php $type = (isset($data['onlineOrOffline'])) ? $data['onlineOrOffline'] : ''; ?>
            <select class="form-control" name="onlineOrOffline" id="onlineOrOffline">
            <option value="online" <?php if($type == "online") echo "selected"; ?> >online</option>
            <option value="offline" <?php if($type == "offline") echo "selected"; ?> >offline</option>
          </select>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> ไฟล์</p>  
            <?php
              while($row= mysqli_fetch_array($query2)){
                echo "<a href=uploads/".$row['meetFileName'].">".$row['meetFileName']."</a> &nbsp;"; 
                echo "<a href=deleteappove.php?id=".$row['meetFileID']." ><font color='red'>delete </font></a><br>";
                
              }
            ?>
		       <input  type="file"   name="file[]" multiple/>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> ความเห็นเพิ่มเติมจากที่ปรึกษา</p>
            <textarea  name="teacherComments" id="teacherComments" class="form-control" disabled='disabled' rows="5" required ><?php echo $data1['teacherComments']; ?></textarea>
         </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> วันเวลาที่อาจารย์ที่ปรึกษาเข้ามายืนยันข้อมูลการประชุม</p>
            <input   type="text"  value="<?php echo $data1['approvedDateTime']; ?>" disabled='disabled' rows="3" name="approvedDateTime" id="approvedDateTime" class="form-control" required  />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> การอนุมัติ</p>
            <?php $type = (isset( $data1['approve'])) ?  $data1['approve']: ''; ?>
            <select class="form-control" name="approve" id="approve" disabled='disabled' >
            <option value=" " <?php  echo "selected"; ?> ></option>
            <option value="อนุมัติ" <?php if($type == "อนุมัติ") echo "selected"; ?> >อนุมัติ</option>
            <option value="ไม่อนุมัติ" <?php if($type == "ไม่อนุมัติ") echo "selected"; ?> >ไม่อนุมัติ</option>
          </select>
         
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> ความเห็นเพิ่มเติมจากที่ปรึกษากรณีที่ไม่อนุมัติ</p>
            <textarea name="teacherRejectComments" id="teacherRejectComments"  class="form-control" disabled='disabled' rows="5" required ><?php echo $data1['teacherRejectComments']; ?></textarea>
          </div>
        </div>
       
        <div class="form-group">
          <div class="col-sm-12">
            <button type="submit" onclick="return confirm('ยืนยันการบันทึก')"class="btn btn-primary" name="btnadd"> บันทึกการแก้ไข </button>
          </div>
        </div>

      </form>
     <A  class="btn btn-primary"style="background-color:#f7dd08" HREF="javascript:history.back()">ย้อนกลับ </A>
    </div>
  </div>
</div>

</body>