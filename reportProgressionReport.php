<?php include ('connectDB.php'); 
$con = new connectDB();
?>
 <?php  
session_start();

 function fetch_data()  
 {  
      $output = '';  
      $i=1;
      $num = 1;
      $d_s = $_POST['d_s'];//ตัวแปรวันที่เริ่มต้น
      $d_e = $_POST['d_e'];//ตัวแปรวันที่สิ้นสุด
      
      $d_s = $d_s." ".'00.00.00';//กำหนดเวลาเริ่มต้น
      
      $d_e= $d_e." ".'23.59.59';//กำหนดเวลาสิ้นสุด
      require_once './connectDB.php';
      $connect = new connectDB();
      $sql = "SELECT DISTINCT SumuserProID, firstNameTH, lastNameTH, email  FROM document inner join userprofile on document.SumuserProID = userprofile.userProID
      inner join documenttype on documenttype.categoryID = document.typeID where typeID=5 or typeID=6 or uploadDatetime BETWEEN '$d_s' AND '$d_e' ORDER BY SumuserProID ASC ";  
      $result = mysqli_query($connect->connect(), $sql);
    
      while($row = mysqli_fetch_array($result))  
      {       
        $output .= '<tr>  
                        <td>'.$i++.'</td>  
                        <td>'.$row["SumuserProID"].'</td>  
                        <td>'.$row["firstNameTH"].'</td>  
                        <td>'.$row["lastNameTH"].'</td>  
                        <td>'.$row["email"].'</td> 
    
                  </tr>  
                        ';  

      }  
      return $output;  
      
 }  
 if(isset($_POST["create_pdf"]))  
 {  
      require_once('TCPDF-main/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("ReportProgression");  
      $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
      $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
      $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
      $obj_pdf->SetDefaultMonospacedFont('thsarabun');  
      $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
      $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
      $obj_pdf->setPrintHeader(false);  
      $obj_pdf->setPrintFooter(false);  
      $obj_pdf->SetAutoPageBreak(TRUE, 10);  
      $obj_pdf->SetFont('thsarabun', '', 16);  
      $obj_pdf->AddPage();  
      $content = '';  
      $content .= '  
      <h1 align="center">รายงานสรุปข้อมูลของนักศึกษาที่ทำการสอบ Progression ผ่าน</h1><br /><br />  

      <table border="1" cellspacing="0" cellpadding="5" align="center">  
           <tr>  
                <th width="10%">ลำดับ</th>  
                <th width="15%">รหัสนักศึกษา</th>  
                <th width="20%">ชื่อ</th>  
                <th width="20%">นามสกุล</th>  
                <th width="40%">อีเมล</th>
                
           </tr>  
      ';  
      $content .= fetch_data();  
      $content .= '</table>';  
      $obj_pdf->writeHTML($content);  
      ob_end_clean();
      $obj_pdf->Output('sample.pdf', 'I');    
 }  
 ?>  
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>KPS-CTRL</title>
<link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <link href="https://fonts.googleapis.com/css2?family=Kanit" rel="stylesheet" type="text/css">

        <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js'></script>
        <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css'>
        <link href='https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css'>
        <link
            rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
            integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
            crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/styleProfile.css">
        <script type="text/javascript" src="javascript/profile.js"></script>

<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
       
        <link href="bt/css/bootstrap.min.css" rel="stylesheet">
        <link href="bt/css/style.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css">
        <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.0.min.js"></script>
        <script type="text/javascript" src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js">
        </script>

        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> -->
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

 <script>
$(document).ready(function() {
$('#example').DataTable( {
"aaSorting" :[[0,'ASC']],
});
} );
</script>

<title>my backend</title>
<style type="text/css">
  img {
    width: 20px;
  height: auto; }
  </style>

</head>

<body >

    <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button
                        type="button"
                        class="navbar-toggle"
                        data-toggle="collapse"
                        data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                    <li>
                            <a href="homeAdminStaff.php" class="font">หน้าหลัก</a>
                        </li>
                        <li>
                            <a href="homeAdminStaff.php?#document" class="font">จัดเก็บเอกสาร</a>
                        </li>
                        <li>
                            <a href="homeAdminStaff.php?#meeting" class="font">รายละเอียดการประชุม</a>
                        </li>
                        <li>
                            <a href="homeAdminStaff.php?#appeal" class="font">การร้องเรียน</a>
                        </li>
                        <li>
                            <a href="homeAdminStaff.php?#data" class="font">จัดการข้อมูลผู้ใช้ระบบ</a>
                        </li>
                        <li>
                            <a href="homeAdminStaff.php?#contact" class="font">ติดต่อ</a>
                        </li>
                        <li>
                        <?php
                                $query = mysqli_query($con->connect(), "SELECT * FROM   `userprofile` WHERE `userProID`='$_SESSION[userProID]'");
                                $fetch = mysqli_fetch_array($query);
                
                                echo "<a href='ProfileAdmin.php' class='text-success font'>".$fetch['firstNameTH']."&nbsp;".$fetch['lastNameTH']."</a>";
                            ?>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>
                            <ul class="dropdown-menu" style="background-color:darkblue">
                                <li><a href="ProfileAdmin.php" class="font">โปรไฟล์</a></li>
                                <li><a href="changePasswordAdmin.php" class="font">เปลี่ยนรหัสผ่าน</a></li>
                                <li><a href="index.php" class="font">ออกจากระบบ</a></li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

<div class="profile-images-card1">

    <div class="container">
        <h1 for="" align="center" class="font">รายชื่อข้อมูลของนักศึกษาที่ทำการสอบ Progression ผ่าน</h1><br>
        <!-- <div class="row">
            <div class="col-md-12">
                <div class="panel panel-info">
                    <div class="panel-heading font"><b><font size="5" class="font"><center>   ค้นหา ตามช่วงวันที่</center></font></b></div>
                        <div class="panel-body">
                        <form id="form1"   name="form1" class="form-inline" method="post" action="reportProposalPass.php">
                        <center>
                        <div class="form-group">
                            <label for="exampleInputName2" class="font">วันที่ :</label>
                            <input name="d_s" id="datepicker" width="270" />
                        </div>
                        <div class="form-group" >
                            <label for="exampleInputEmail2" class="font">&nbsp;ถึงวันที่ :&nbsp;</label>
                            <input name="d_e" id="datepicker2" width="270" />
                        </div>
                        &nbsp;&nbsp;<button type="submit" class="btn btn-info font"><span class="glyphicon glyphicon-search"></span> ค้นหา</button></center>
                    
                        </form>
                    </div>
                </div>
            </div>
            
        </div> -->
    </div>

    <div class="container">

        <table  border="0" align="center" cellspacing="1" class="display font" id="example">
        <!--ส่วนหัว-->
        <thead>
        <tr>
                      
            <th align="center" class="font">ลำดับ</th>
            <th align="center" class="font">รหัสนักศึกษา</th>
            <th align="center" class="font">ชื่อ</th>
            <th align="center" class="font">นามสกุล</th>
            <th align="center" class="font">อีเมล</th>
            <!-- <th align="center" class="font">วันที่อัปโหลด</th> -->
            
        </tr>
        </thead>



        <?php 
        //     $d_s = $_POST['d_s'];//ตัวแปรวันที่เริ่มต้น
        //     $d_e = $_POST['d_e'];//ตัวแปรวันที่สิ้นสุด

        //     $d_s = $d_s." ".'00.00.00';//กำหนดเวลาเริ่มต้น

        //     $d_e= $d_e." ".'23.59.59';//กำหนดเวลาสิ้นสุด

        // echo $d_s;
        // echo "<br>";
        // echo $d_e;
        // echo "<br>";

        echo fetch_data();

        ?>
        </table>

        <form method="post">  

        <button type="submit" name="create_pdf" class="btn btn-danger fas fa-file-pdf " /> <font class="font" style="font-size: 18px;">Download</font> </button>
        </form>  

    </div><br><br>
</div>
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap',
            format: "yyyy-mm-dd",
            type : "date"
        });

        
    </script>
<script>
        $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap',
            format: "yyyy-mm-dd",
            type : "date"
        });

        
    </script>



</body>

</html>