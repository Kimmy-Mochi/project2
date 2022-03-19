
 <?php  
   session_start();
 define('LINE_API',"https://notify-api.line.me/api/notify");
     
        // $severname ="localhost";
        // $username ="root";
        // $password= "123456";
        // $dbname ="project2";
        
        // $link  = new mysqli($severname,$username,$password,$dbname);


        require_once '../connectDB.php';
        $link = new connectDB();
      $query = mysqli_query($link->connect(), "SELECT * FROM   teachers  INNER JOIN advisory  ON  teachers.TuserProID= advisory.TuserProID
      INNER JOIN students  ON   advisory.SuserProID = students.SuserProID INNER JOIN userprofile  ON teachers.TuserProID = userprofile.userProID
      WHERE students.SuserProID  ='$_SESSION[userProID]'and advisoryStatus = 'M'") or die(mysqli_error($link->connect()));
      $fetch = mysqli_fetch_array($query);
      $token = $fetch["tokenLine"];
      $mailto = $fetch["email"];
      echo $mailto;
      echo $token;
      
 <?php  
 session_start();
define('LINE_API',"https://notify-api.line.me/api/notify");
   
      $severname ="localhost";
      $username ="root";
      $password= "abc123";
      $dbname ="project2";
      
      $link  = new mysqli($severname,$username,$password,$dbname);


   
    $query = mysqli_query($link, "SELECT * FROM   teachers  INNER JOIN advisory  ON  teachers.TuserProID= advisory.TuserProID
    INNER JOIN students  ON   advisory.SuserProID = students.SuserProID INNER JOIN userprofile  ON teachers.TuserProID = userprofile.userProID
    WHERE students.SuserProID  ='$_SESSION[userProID]'and advisoryStatus = 'M'") or die(mysqli_error());
    $fetch = mysqli_fetch_array($query);
    $token = $fetch["tokenLine"];
    $mailto = $fetch["email"];

    $mailSub =  "=?utf-8?B?".base64_encode("แจ้งเตือน")."?=";
    $mailMsg = "มีรายการอนุมัติการประชุมจากนิสิต";
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
              echo "<script type='text/javascript'>alert('$message');window.location='meettingapproveS.php'</script>";
      }
      else{
              // echo "<script>alert('บันทึกสำเร็จ')</script>";
              // header('location:meettingapproveS.php');
              $message = "บันทึกสำเร็จ";
              echo "<script type='text/javascript'>alert('$message');window.location='meettingapproveS.php'</script>";
      }

    $str = "มีรายการอนุมัติการประชุมจากนิสิต"; 
    
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
?>