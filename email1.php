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
        $sql1 =( "SELECT * FROM   teachers  INNER JOIN advisory  ON  teachers.TuserProID= advisory.TuserProID
        INNER JOIN students  ON   advisory.SuserProID = students.SuserProID INNER JOIN userprofile  ON teachers.TuserProID = userprofile.userProID
        WHERE students.SuserProID  ='$ID' and advisoryStatus = 'M' ");
        $result1 = $connect->query($sql1);
        $data = $result1->fetch_assoc();
    //  echo  $data['email']."<br />\n";
     $mailto = $data['email'];
     $token = $data['tokenLine'];
      echo $mailto;
       echo $token;
       $mailSub =  "=?utf-8?B?".base64_encode("แจ้งเตือน")."?=";
       $mailMsg = "กรุณาเข้าพบนิสิตเพิ่อให้คำปรึกษา";
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
                 echo "Mail Not Sent";
         }
         else{
             
                 echo "<script>window.location='email2.php?id=".$ID."'</script>";  
         }
   
       $str = "กรุณาเข้าพบนิสิตเพิ่อให้คำปรึกษา"; 
       
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