<?php
	session_start();
	if(!ISSET($_SESSION['userProID'])){
		header('location:Smeettingapprove.php');
	}
?>
 <?php
 define('LINE_API',"https://notify-api.line.me/api/notify");
     
        $severname ="localhost";
        $username ="root";
        $password= "abc123";
        $dbname ="project2";
        
        $link  = new mysqli($severname,$username,$password,$dbname);
        if($link === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
        }
        $ID = $_GET['id'];

    // $query = mysqli_query($link, "SELECT * FROM  students   INNER JOIN advisory  ON advisory.studentID = students.studentID 
    // INNER JOIN teachers ON  teachers.teacherID = advisory.teacherID INNER JOIN userprofile  ON students.SuserProID = userprofile.userProID
    // WHERE TuserProID ='$_SESSION[userProID]'") or die(mysqli_error());

       
     $query = mysqli_query($link, "SELECT * FROM  students   INNER JOIN  invigilation  ON students.studentID  =  invigilation.studentID 
     INNER JOIN teachers ON invigilation.teacherID  = teachers.teacherID  INNER JOIN userprofile  ON teachers.TuserProID = userprofile.userProID
     WHERE SuserProID ='$ID'") or die(mysqli_error());   

      $fetch = mysqli_fetch_array($query);
      $token = $fetch["tokenLine"];
      $mailto = $fetch["email"];


    //   echo $ID;
    //   echo $mailto;
    //   echo $token;
      $mailSub =  "=?utf-8?B?".base64_encode("แจ้งเตือน")."?=";
      $mailMsg = "มีการร้องเรียนจากอาจารย์";
      require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer();
        $mail ->IsSmtp();
            
        $mail ->SMTPAuth = true;
        $mail ->SMTPSecure = 'tls';
        $mail ->Host = "smtp.gmail.com";
        $mail ->Port = 587; // or 587
        //$mail ->IsHTML(true);
        $mail ->Username = "superCtrl2563@gmail.com";
        $mail ->Password = "******";
        $mail ->SetFrom("superCtrl2563@gmail.com", "Staff");
        $mail ->Subject = $mailSub;
        $mail ->Body = $mailMsg;
        $mail ->AddAddress($mailto);

        if(!$mail->Send()){
                $message = "บันทึกไม่สำเร็จ";
                echo "<script type='text/javascript'>alert('$message');window.location='HteachersappealS.php'</script>";
        }
        else{
                // echo "<script>alert('บันทึกสำเร็จ')</script>";
                $message = "บันทึกสำเร็จ";
                echo "<script type='text/javascript'>alert('$message');window.location='HteachersappealS.php'</script>";
                // echo "<script>window.location='HteachersappealS.php'</script>"; 
        }
  
      $str = "มีการร้องเรียนจากอาจารย์"; 
      
      $res = notify_message($str,$token);
      print_r($res);
      function notify_message($message,$token){
      $queryData = array('message' => $message);
      $queryData = http_build_query($queryData,'','&');
      $headerOptions = array( 
              'http'=>array(
                  'method'=>'POST',
                  'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                            ."Authorization: Bearer ".$token."\r\n"
                            ."Content-Length: ".strlen($queryData)."\r\n",
                  'content' => $queryData
              ),
      );
      $context = stream_context_create($headerOptions);
      $result = file_get_contents(LINE_API,FALSE,$context);
      $res = json_decode($result);

  

    
}
?>