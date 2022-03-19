<?php
	session_start();
$severname ="localhost";
$username ="root";
$password= "123456";
$dbname ="project2";

$conn = new mysqli($severname,$username,$password,$dbname);// Using database connection file here





if(count($_POST)>0) 
{
   
$email = $_POST['email'];
$query = mysqli_query($conn, "SELECT * FROM `userprofile` WHERE `email` = '$email' ") ;
$fetch = mysqli_fetch_array($query);

 $mailto = $fetch['email'] ;

    if (!$mailto ) {

        // echo "<h3>ERROR : email นี้ไม่มีอยู่ในระบบค่ะ</h3>";
        $message = "ERROR : email นี้ไม่มีอยู่ในระบบค่ะ";
       echo "<script type='text/javascript'>alert('$message');</script>";
    }
    else{
     
        $num= random_int(1000, 100000);
       
        
        $mailto = $fetch["email"];
  
    
        $mailSub =  "=?utf-8?B?".base64_encode("แจ้งเตือน")."?=";
        $mailMsg = "รหัสของคุณ $num";
        require 'PHPMailer/PHPMailerAutoload.php';
          $mail = new PHPMailer();
          $mail ->IsSmtp();
              
          $mail ->SMTPAuth = true;
          $mail ->SMTPSecure = 'tls';
          $mail ->Host = "smtp.gmail.com";
          $mail ->Port = 587; // or 587
          //$mail ->IsHTML(true);
          $mail ->Username = "superCtrl2563@gmail.com";
          $mail ->Password = "Superctrl2563";
          $mail ->SetFrom("superCtrl2563@gmail.com", "Staff");
          $mail ->Subject = $mailSub;
          $mail ->Body = $mailMsg;
          $mail ->AddAddress($mailto);
  
          if(!$mail->Send()){
                  echo "Mail Not Sent";
          }
          else{
                  // echo "<script>alert('บันทึกสำเร็จ')</script>";
              
                  $_SESSION["num"] =  $num;
                  $_SESSION["email"]=  $fetch["email"];
                  echo "<script>window.location='Resetpassword1.php'</script>";  
          }
    
      
  
    
  
    
  
                            
             

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
          <script type='text/javascript'>
            function check_email(elm){
                var regex_email=/^[_a-zA-Z0-9-]+(\.[_a-zA-Z0-9-]+)*\@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*(\.([a-zA-Z]){2,4})$/
                if(!elm.value.match(regex_email)){
                    alert('รูปแบบ email ไม่ถูกต้อง');
                }
            }
         </script>

            <p> อีเมล</p>
            <input type="email" id="email" name="email" rows="3"  class="form-control"onblur='check_email(this)' />
            </div>
         </div>
        <div class="form-group">
          <div class="col-sm-12">
            <button type="submit" onclick="return confirm('ยืนยันการบันทึก')"class="btn btn-primary" name="btnadd"> ส่งรหัสผ่าน </button>
          </div>
        </div>

      </form>

    </div>
  </div>
</div>

</body>

