
<?php
session_start();
if(!ISSET($_SESSION['userProID'])){
    header('location:homeAdminStaff.php');
}
?>
<!DOCTYPE html>
<?php
session_start();
include "connectDB.php";
$con = new connectDB();
$doctype = new connectDB(); 



?>
<html>
    <head>
        <script type="text/javascript" src="profile.js"></script>
        <title>KPS-CTRL</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link
            href="https://fonts.googleapis.com/css?family=Montserrat"
            rel="stylesheet"
            type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Lato"
            rel="stylesheet"
            type="text/css">
        <link
            rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
            integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
            crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/styleProfile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/css/bootstrap-select.css" />
        <script>
            function myFunction() {
            var txt;
            var r = confirm("คุณต้องการบันทึกข้อมูลใช่หรือไม่");
            if (r == true) {
                txt = "บันทึกข้อมูลสำเร็จ!";
                
            } else {
                txt = "ยกเลิกการบันทึก!";
            }
            document.getElementById("demo").innerHTML = txt;
            }
        </script>
    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

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
                    <a class="navbar-brand" href="homeAdminStaff.php"><img src="" alt=""></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                    <li>
                            <a href="homeAdminStaff.php">หน้าหลัก</a>
                        </li>
                        <li>
                            <a href="homeAdminStaff.php?#document">จัดเก็บเอกสาร</a>
                        </li>
                        <li>
                            <a href="homeAdminStaff.php?#meeting">รายละเอียดการประชุม</a>
                        </li>
                        <li>
                            <a href="homeAdminStaff.php?#appeal">การร้องเรียน</a>
                        </li>
                        <li>
                            <a href="homeAdminStaff.php?#data">จัดการข้อมูลผู้ใช้ระบบ</a>
                        </li>
                        <li>
                            <a href="homeAdminStaff.php?#contact">ติดต่อ</a>
                        </li>
                       
                        <li>
                        <?php
                                $query = mysqli_query($con->connect(), "SELECT * FROM   `userprofile` WHERE `userProID`='$_SESSION[userProID]'");
                                $fetch = mysqli_fetch_array($query);
                
                                echo "<a href='ProfileAdmin.php' class='text-success'>".$fetch['firstNameTH']."&nbsp;".$fetch['lastNameTH']."</a>";
                            ?>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>
                            <ul class="dropdown-menu" style="background-color:darkblue">
                                <li><a href="ProfileAdmin.php">โปรไฟล์</a></li>
                                <li><a href="changePasswordAdmin.php">เปลี่ยนรหัสผ่าน</a></li>
                                <li><a href="index.php">ออกจากระบบ</a></li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav><br><br>
        <div class="container">                    
                    <div class="col-12" align="center">
                        <div>
                            <h2 style="color: #1f3c88;">ออกรายงานข้อมูลที่เกี่ยวข้องกับวิทยานิพนธ์</h2>
                            <hr noshade="noshade" width="1200">
                        </div>
                    </div>
            </div>

<div class="container mt-5 mb-3">
    <div class="row">
        <div class="col-md-4">
            <div class="card p-3 mb-2"><br>
            <center>
            <label for="">รายงานสรุปข้อมูลของนักศึกษาที่ทำการส่งเอกสาร Proposal</label>
            <a href="reportProposalPass.php" class="btn btn-info btn-lg">
                                        Proposal
            </a>
            </center><br>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 mb-2"><br>
            <center>
            <label for="">รายงานสรุปข้อมูลของนักศึกษาที่ทำการส่งเอกสาร QE (Qualifying Examination Report)</label>
            <a href="reportQE.php" class="btn btn-info btn-lg">
            Qualifying Examination Report
            </a>
            </center><br>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 mb-2"><br>
            <center>
            <label for="">รายงานสรุปข้อมูลของนักศึกษาที่ทำการส่งเอกสารรายงานความก้าวหน้า (Progression Report)</label>
            <a href="reportProgressionReport.php" class="btn btn-info btn-lg">
            Progression Report
            </a>
            </center><br>
            </div>
        </div>
    </div>
</div><br>
<div class="container mt-5 mb-3">
    <div class="row">
        <div class="col-md-4">
            <div class="card p-3 mb-2"><br>
            <center>
            <label for="">รายงานสรุปข้อมูลของนักศึกษาที่ทำการส่งเอกสารวิทยานิพนธ์ฉบับสมบูรณ์</label>
            <a href="reportFinalReport.php" class="btn btn-info btn-lg">
                Final Report
            </a>
            </center><br>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 mb-2"><br>
            <center>
            <label for="">รายงานสรุปข้อมูลของนักศึกษาที่ทำการส่งเอกสารผลการตีพิมพ์ (Publications)</label>
            <a href="reportPublications.php" class="btn btn-info btn-lg">
             Publications Report
            </a>
            </center><br>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 mb-2"><br>
            <center>
            <label for="">รายงานสรุปข้อมูลการประชุม</label>
            <a href="reportMeeting.php" class="btn btn-info btn-lg">
                 Meeting Report
            </a>
            </center><br>
            </div>
        </div>
    </div>
</div><br>
<div class="container mt-5 mb-3">
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-4">
            <div class="card p-3 mb-2"><br>
            <center>
            <label for="">รายงานสรุปข้อมูลการร้องเรียนของอาจารย์</label>
            <a href="reportAppealingTeacher.php" class="btn btn-info btn-lg">
                Teacher Appealing Report
            </a>
            </center><br>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card p-3 mb-2"><br>
            <center>
            <label for="">รายงานสรุปข้อมูลการร้องเรียนของนักศึกษา</label>
            <a href="reportAppealingStudent.php" class="btn btn-info btn-lg">
             Student Appealing Report
            </a>
            </center><br>
            </div>
        </div>
    </div>
</div>
        
    
                
        

        <!-- <footer class="container-fluid text-center">
            <div id="contact" class="container-fluid bg-grey">
                <h2 class="text-center">CONTACT</h2>
                <div class="row">
                    <p>Theeraporn Srisuk</p>
                    <br>
                    <p>Usa Saensen</p>
                </div>
            </div>
        </footer> -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js"></script>
    </body>

</html>