<?php
	session_start();
$severname ="localhost";
$username ="root";
$password= "123456";
$dbname ="project2";

$conn = new mysqli($severname,$username,$password,$dbname);// Using database connection file here

//  echo $_SESSION["email"];
//  echo $_SESSION["num"];
if(count($_POST)>0) 
{
    $text = $_POST['text'];
    if($_SESSION["num"]==$text){

        $_SESSION["email"];
        echo "<script>window.location='Resetpassword2.php'</script>";  
    }
    else{
        $message = "รหัสไม่ถูกต้อง";
        echo "<script type='text/javascript'>alert('$message');</script>";
    }
   

 }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>ลืมรหัสผ่าน</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<body>
<div class="container">
  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-md-6"> <br />
      <h4 align="center"> ลืมรหัสผ่าน</h4>
      <hr />
      <form  name="addproduct" action="" method="POST" enctype="multipart/form-data"  class="form-horizontal">
         <div class="form-group">
          <div class="col-sm-12">
            <p> กรอกตัวเลขที่ส่งไปยังอีเมล</p>
            <input type="text" id="text" name="text" rows="3"  class="form-control"onblur='check_email(this)' />
            </div>
         </div>
        <div class="form-group">
          <div class="col-sm-12">
            <button type="submit" onclick="return confirm('ยืนยันการบันทึก')"class="btn btn-primary" name="btnadd"> ยืนยัน </button>
          </div>
        </div>

      </form>

    </div>
  </div>
</div>

</body>


