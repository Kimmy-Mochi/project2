<?php
	session_start();
	
?>
<?php

$severname ="localhost";
$username ="root";
$password= "abc123";
$dbname ="project2";


$conn = new mysqli($severname,$username,$password,$dbname);// Using database connection file here




// if (isset($_GET['submit'])) {
//   echo '<div class="form" id="form3"><br><br><br><br><br><br>
//   <Span>Data Updated Successfuly......!!</span></div>';
//   }
if(count($_POST)>0) 
{
    $n= $_POST['n'];
    $m = $_POST['m'];
    
    $sql = "UPDATE notification SET  n=  '$n' , m='$m' ";

   if ($conn->query($sql) === TRUE) {
    
    $message = "บันทึกสำเร็จ";
                echo "<script type='text/javascript'>alert('$message');window.location='homeAdminStaff.php'</script>"; 

   } else {
    $message = "บันทึกไม่สำเร็จ";
    echo "<script type='text/javascript'>alert('$message');window.location='Notification.php'</script>"; 
   }


   
	
 }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title> notification</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6"> <br />
      <h4 align="center">กำหนดวันแจ้งเตือน</h4>
      <hr />
      <form  name="addproduct" action="" method="POST" enctype="multipart/form-data"  class="form-horizontal">
        <div class="form-group">
          <div class="col-sm-12">
            <p>กำหนดสัปดาห์ในการแจ้งเตือนครั้งที่1กรณีไม่มีการพบปะกับที่ปรึกษา</p>
            <input type="text" id="n"  pattern="[0-9]{1,}" title="กรอกตัวเลขเท่านั้น" required  rows="3" name="n" class="form-control"  />
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            <p> แจ้งเตือนทุกๆกี่สัปดาห์กรณีแจ้งเตือนครั้งที่1แล้ว</p>
            <input type="text" id="m"  pattern="[0-9]{1,}" title="กรอกตัวเลขเท่านั้น" required rows="3" name="m" class="form-control"  />
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