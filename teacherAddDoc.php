<?php
session_start();
if(!ISSET($_SESSION['userProID'])){
    header('location:homeTeachers.php');
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
                    <a class="navbar-brand" href="homeStudent.php"><img src="" alt=""></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="homeTeachers.php">หน้าหลัก</a>
                        </li>
                        <li>
                            <a href="homeTeachers.php">จัดเก็บเอกสาร</a>
                        </li>
                        <li>
                            <a href="homeTeachers.php">รายละเอียดการประชุม</a>
                        </li>
                        <li>
                            <a href="homeTeachers.php">การร้องเรียน</a>
                        </li>
                        <li>
                            <a href="homeTeachers.php">ข้อมูลนักศึกษา</a>
                        </li>
                        <li>
                            <a href="homeTeachers.php">ติดต่อ</a>
                        </li>
                        
                        <li>
                        <?php
                                $query = mysqli_query($con->connect(), "SELECT * FROM   `userprofile` WHERE `userProID`='$_SESSION[userProID]'");
                                $fetch = mysqli_fetch_array($query);
                
                                echo "<a href='ProfileTeachers.php' class='text-success'>".$fetch['firstNameTH']."&nbsp;".$fetch['lastNameTH']."</a>";
                            ?>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>
                            <ul class="dropdown-menu" style="background-color:darkblue">
                                <li><a href="ProfileTeachers.php">โปรไฟล์</a></li>
                                <li><a href="changePasswordTeacher.php">เปลี่ยนรหัสผ่าน</a></li>
                                <li><a href="index.php">ออกจากระบบ</a></li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
  
        <div id="" class="container text-center " >
            <div class="grid-1 callout primary">
            <form action="checkEventTeacherDoc.php" method="POST" enctype="multipart/form-data" name="form1">
                <div class="container"><br><br>
                        <div class="col-12" align="center">
                            <div>
                                <h2 style="color: #1f3c88;">เอกสารที่เกี่ยวข้องกับวิทยานิพนธ์</h2>
                                <hr noshade="noshade" width="1200">
                            </div>
                        </div>
                </div>

                <div class="container" align="left">
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">                    
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="usr" >รหัสนักศึกษา
                            </label>
                            
							<?php
						$sql2 = "SELECT * FROM userprofile where status='S' ";
						$result2 = mysqli_query($doctype->connect(), $sql2);
						?>
                        <select name="sID" id="sID" class="selectpicker form-control" data-show-subtext="true" data-live-search="true" style="width: 100%;height:34px;text-align: left;">
                            <option id="sID" name="sID" value="" style="font-size: 16px;">- เลือกรหัสนักศึกษา -</option>
                            <?php while ($row2 = $result2->fetch_row()) { ?>
                                    <option value="<?php echo ($row2[0]); ?>"><?php echo ($row2[0]); ?></option>
                            <?php } ?>
                        </select>
                         
                     
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">                    
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="usr" >ประเภทเอกสาร
                            </label>
                            
							<?php

						$sql = "SELECT * FROM documenttype where categoryID='5' AND categoryID='6' AND categoryID='9' AND  categoryID='9' ";
						$result = mysqli_query($doctype->connect(), $sql);
						?>
                        <select name="doctype" id="doctype" style="width: 100%;height:34px;text-align: left;" class="form-control prf" onchange='$(".prf").val(this.value)'>
							<option id="doctype" name="doctype" value="" style="font-size: 16px;">- please select -</option>
							<?php while ($row = $result->fetch_row()) { ?>
								<option value="<?php echo ($row[0]); ?>"><?php echo ($row[1]); ?></option>
							<?php } ?>
						</select> 
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">                    
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="usr">คำอธิบายเพิ่มเติม (ถ้ามี)
                            </label>
                            <textarea name="details" id="details" cols="10" rows="10" style="font-size: 16px;" class="form-control " placeholder="คำอธิบายเพิ่มเติม"></textarea>
                            
                    </div>
                </div><br>

                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">                    
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4" >
                    <center>
                    <i class=""><input type="file" id="filename" name="filename[]" multiple="multiple"></i>
                    </center>
                    </div>
                </div><br>
                 <div class="row">
                     <div class="col-sm-12 col-md-4 col-lg-6" align="right">
                     <div class="form-group" >
                            

                            <a href="showDocTeacher.php" class="btn btn-success btn-lg font">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-border-style" viewBox="0 0 16 16">
<path d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1zm0 4a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-1zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm8 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-4 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm8 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-4-4a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-1z"/>
</svg>
                            แสดงข้อมูล
                            
                        </a>
                     </div>
                        </div>
                    <div class="col-sm-12 col-md-4 col-lg-6"  align="left">
                        <div class="form-group">
                            
                                
                                
                                <button class="glyphicon glyphicon-floppy-save btn btn-info btn-lg"  type="submit" name="submit" value="Insert" onclick="myFunction()" ><font class="font">บันทึกข้อมูล</font></button>
            
                                <!-- <input type="submit" class="btn btn-danger" style="font-size:24px" name="submit" value="บันทึก"></input> -->
                                <!-- <i class="fa fa-save" align="center"></i> -->
                           
                        </div>
                    </div>
                </div>
                </div>
                    </div>
                </div><br>
                </form>
            </div>
        </div>

  
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js"></script>
    </body>

</html>