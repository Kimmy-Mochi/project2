<?php
	session_start();
?>
 <?php
 define('LINE_API',"https://notify-api.line.me/api/notify");
     
        // $severname ="localhost";
        // $username ="root";
        // $password= "123456";
        // $dbname ="project2";
        
        // $link  = new mysqli($severname,$username,$password,$dbname);
        session_start();
        $connect = new mysqli('localhost', 'root', 'abc123', 'project2');

        $ID= $_GET['id']; 
       $sql1 =( "SELECT * FROM  userprofile  WHERE userProID = '$ID' ");
       $result1 = $connect->query($sql1);
       $data = $result1->fetch_assoc();
    //  echo  $data['email']."<br />\n";
     $mailto = $data['email'];
     $$token = $data['tokenLine'];
    //    echo $mailto;
    //   echo $token;
      $mailSub =  "=?utf-8?B?".base64_encode("แจ้งเตือน")."?=";
      $mailMsg = "กรุณาเข้าพบอาจารย์ที่ปรึกษา";
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

              echo "<script>alert('บันทึกไม่สำเร็จ')</script>". $mail->ErrorInfo;
        }
        else{
                

                 $severname ="localhost";
                 $username ="root";
                 $password= "abc123";
                 $dbname ="project2";
                 $link  = new mysqli($severname,$username,$password,$dbname);
                 $q1 = mysqli_query($link , "SELECT * FROM  notification ");
                 $f1 = mysqli_fetch_array($q1);
                  $n= $f1['m'];
                 //  echo $n."<br />\n";
                  $q2 = mysqli_query($link , "SELECT * FROM  nomeetnotify where studentID=   '$ID'");
                 $f2 = mysqli_fetch_array($q2);
                  $notifyDateTime= $f2['notifyDateTime'];
                 //  echo  $notifyDateTime."<br />\n";
                 $ID= $_GET['id']; 
                 $strNewDate = date ("Y-m-d", strtotime(" $n week", strtotime($notifyDateTime)));
                 echo  $strNewDate ;


                 echo   $ID;
                 $sql2 = "UPDATE nomeetnotify SET notifyDateTime='$strNewDate' where studentID=   '$ID'  ";
     
                 if ($link->query($sql2) === TRUE) {
                   
                  echo "<script>window.location='email1.php?id=".$ID."'</script>";  
             
                    //  echo "<script>window.location='nomeetnotify.php'</script>"; 
                     
                 } else {
                 echo "Error updating record: " . $link->error;
                 }
               
        }
        $str = "กรุณาเข้าพบอาจารย์ที่ปรึกษา"; 
      
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