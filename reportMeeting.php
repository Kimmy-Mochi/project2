<?php include ('connectDB.php'); 
$con = new connectDB();
?>
 <?php  
session_start();
$ssid = $_REQUEST['id'];

 function fetch_data()  
 {  
      $output = '';  
      $i=1;

      require_once './connectDB.php';
      $connect = new connectDB();
      $sql = "SELECT DISTINCT MuserProID ,firstNameTH, lastNameTH  FROM meettingapprove inner join userprofile on userprofile.userProID = meettingapprove.MuserProID";   
      $result = mysqli_query($connect->connect(), $sql);
    
      while($row = mysqli_fetch_array($result))  
      {       
        $output .= '<tr>  
                        <td>'.$i++.'</td> 
                        <td>'.$row["MuserProID"].'</td>   
                        <td>'.$row["firstNameTH"].'</td>  
                        <td>'.$row["lastNameTH"].'</td>  
                        
                        <td><form method="post" action="reportMeeting.php?id='.$row["MuserProID"].'">  

                        <button type="submit" name="create_pdf"  class="btn btn-danger fas fa-file-pdf " /> <font class="font" style="font-size: 18px;">Download</font> </button>
                        </form> </td>
    
                  </tr>  
                        ';  

      }  
      return $output;  
      
 }  
 
 function data()  
 {  
      $output = '';  
      $i=1;
      $ssid = $_REQUEST['id'];
      $tid = $ssid;
      require_once './connectDB.php';
      $connect = new connectDB();
      $sql = "SELECT DISTINCT MuserProID ,date,startTime,endTime,onlineOroffline,details FROM meettingapprove inner join userprofile on userprofile.userProID = meettingapprove.MuserProID where MuserProID = $tid";   
      $result = mysqli_query($connect->connect(), $sql);
    
      while($row = mysqli_fetch_array($result))  
      {       
        $output .= '<tr>  
                        <td align="center">'.$i++.'</td> 
                        <td align="center">'.$row["date"].'</td>   
                        <td align="center">'.$row["startTime"].'</td>  
                        <td align="center">'.$row["endTime"].'</td> 
                        <td align="center">'.$row["onlineOroffline"].'</td> 
                        <td>'.$row["details"].'</td>     
                  </tr>  
                        ';  

      }  
      return $output;  
      
 } 
 if(isset($_POST["create_pdf"]))  
 {  
      $ssid = $_REQUEST['id'];
      $tid = $ssid;
      require_once('TCPDF-main/tcpdf.php');  
      $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
      $obj_pdf->SetCreator(PDF_CREATOR);  
      $obj_pdf->SetTitle("ReportMeeting");  
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

  

      require_once './connectDB.php';
      $connect = new connectDB();
      $sql = "SELECT MuserProID ,prenameTH,firstNameTH, lastNameTH  FROM meettingapprove inner join userprofile on userprofile.userProID = meettingapprove.MuserProID 
      INNER JOIN advisory on advisory.SuserProID = userprofile.userProID INNER JOIN prename on prename.prenameID = userprofile.prenameID
       where MuserProID = $tid "; 
      $result = mysqli_query($connect->connect(), $sql);
      $row = mysqli_fetch_array($result);
   
      $sql1 ="SELECT SuserProID,TuserProID, firstNameTH, lastNameTH FROM advisory INNER JOIN userprofile on advisory.TuserProID = userprofile.userProID where SuserProID = '$tid' and advisoryStatus = 'M'";
      $result1 = mysqli_query($connect->connect(), $sql1);
      $row1 = mysqli_fetch_array($result1);
      $content = '';  
      $content .= '  
      <h1 align="center">????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</h1><br />
      <hr noshade width=50% color=black><br><br><br> 
      <table>
            <tr>  
                <th width="15%" align=left><b>???????????????????????????????????? :</b></th>
                <th>'.$row["MuserProID"]. '</th> 
                <th width="7%" align=left><b>???????????? : </b></th> 
                <th>'.$row["prenameTH"].''.$row["firstNameTH"]. ' '.' ' .$row["lastNameTH"].'</th>
            </tr> 
            <tr>  
                <th width="25%" align=left><b>???????????????????????????????????????????????????????????????????????? :</b></th>
                <th>'.$row1["firstNameTH"]. ' '.' '.$row1["lastNameTH"].'</th> 
            </tr> 
      </table><br><br>
      <table border="1" cellspacing="0" cellpadding="5" >  
            
     
            <tr>
                <th width="10%" align="center"><b>???????????????</b></th> 
                <th width="15%" align="center"><b>??????????????????????????????</b></th> 
                <th width="15%" align="center"><b>???????????????????????????</b></th> 
                <th width="15%" align="center"><b>?????????????????????????????????</b></th> 
                <th width="16%" align="center"><b>?????????????????????????????????</b></th> 
                <th width="30%" align="center"><b>??????????????????????????????</b></th> 
            </tr>
      ';  
      $content .= data();  
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

<body>

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
                            <a href="homeAdminStaff.php" class="font">????????????????????????</a>
                        </li>
                        <li>
                            <a href="homeAdminStaff.php?#document" class="font">???????????????????????????????????????</a>
                        </li>
                        <li>
                            <a href="homeAdminStaff.php?#meeting" class="font">?????????????????????????????????????????????????????????</a>
                        </li>
                        <li>
                            <a href="homeAdminStaff.php?#appeal" class="font">????????????????????????????????????</a>
                        </li>
                        <li>
                            <a href="homeAdminStaff.php?#data" class="font">??????????????????????????????????????????????????????????????????</a>
                        </li>
                        <li>
                            <a href="homeAdminStaff.php?#contact" class="font">??????????????????</a>
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
                                <li><a href="ProfileAdmin.php" class="font">?????????????????????</a></li>
                                <li><a href="changePasswordAdmin.php" class="font">?????????????????????????????????????????????</a></li>
                                <li><a href="index.php" class="font">??????????????????????????????</a></li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

<div class="profile-images-card1">

    <div class="container">
        <h1 for="" align="center" class="font">????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</h1><br>
    </div>

    <div class="container">

        <table  border="0" align="center" cellspacing="1" class="display font" id="example">
        <!--?????????????????????-->
        <thead>
        <tr>
                      
            <th align="center" class="font">???????????????</th>
            <th align="center" class="font">????????????????????????????????????</th>
            <th align="center" class="font">????????????</th>
            <th align="center" class="font">?????????????????????</th>
            <!-- <th align="center" class="font">?????????????????????</th> -->
            <!-- <th align="center" class="font">?????????????????????????????????????????????</th> -->
            <th align="center" class="font">Report</th>
            
        </tr>
        </thead>



        <?php 

        echo fetch_data();
        

        ?>
          
        </table>

      

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