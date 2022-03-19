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
$conn = new connectDB();
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
            <link href="https://fonts.googleapis.com/css2?family=Kanit" rel="stylesheet" type="text/css">
        <link
            rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
            integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
            crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="javascript/search.js">
        <link rel="stylesheet" href="css/styleProfile.css">

        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/css/bootstrap-select.css" />
        <script>
            function myFunction() {
            var txt;
            var r = confirm("คุณต้องการบันทึกข้อมูลใช่หรือไม่");
            if (r == true) {
                txt = "บันทึก!";
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
                    <!-- <a class="navbar-brand" href="homeAdminStaff.php"><img src="" alt=""></a> -->
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
                
                                $query = mysqli_query($conn->connect(), "SELECT * FROM   `userprofile` WHERE `userProID`='$_SESSION[userProID]'");
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
        </nav><br><br>
        <div class="profile-images-card1">
        <div id="" class="container text-center " >
            <div class="grid-1 callout primary">
            <form action="checkEventAdminStaffDoc.php" method="POST" enctype="multipart/form-data" name="form1">
                <div class="container">
                        <div class="col-12" align="center">
                            <div>
                                <h2 style="color: #1f3c88;" class="font">เอกสารที่เกี่ยวข้องกับวิทยานิพนธ์</h2>
                                <hr noshade="noshade" width="1200">
                            </div>
                        </div>
                </div>

                <div class="container" align="left">
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">                    
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4" class="font">
                            <label for="usr" class="font">รหัสนักศึกษา
                            </label>
                            
							<?php
						$sql2 = "SELECT * FROM userprofile where status='S' ";
						$result2 = mysqli_query($doctype->connect(), $sql2);
						?>
                        <select name="sID" id="sID" class="selectpicker form-control " data-show-subtext="true" data-live-search="true" style="width: 100%;height:34px;text-align: left;">
                            <option id="sID" name="sID" value="" style="font-size: 16px;" ><font class="font" autocomplete="off" required>- เลือกรหัสนักศึกษา -</font></option>
                            <?php while ($row2 = $result2->fetch_row()) { ?>
                                    <font class="font"><option value="<?php echo ($row2[0]); ?>"><?php echo ($row2[0]); ?></option></font>
                            <?php } ?>
                        </select>
                         
                     
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">                    
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="usr" class="font" >ประเภทเอกสาร
                            </label>
                            
							<?php

						$sql = "SELECT * FROM documenttype where  categoryID='2' or categoryID='5' or categoryID='6' or  categoryID='9' or  categoryID='10' ";
						$result = mysqli_query($doctype->connect(), $sql);
						?>
                        <select name="doctype" id="doctype" style="width: 100%;height:34px;text-align: left;" class="form-control prf font" onchange='$(".prf").val(this.value)'>
							<option id="doctype" name="doctype" value="" style="font-size: 16px;" class="font" autocomplete="off" required>- please select -</option>
							<?php while ($row = $result->fetch_row()) { ?>
								<option value="<?php echo ($row[0]); ?>"><?php echo ($row[1]); ?></option>
							<?php } ?>
						</select> 
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">                    
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4" >
                            <label for="usr" class="font">คำอธิบายเพิ่มเติม (ถ้ามี)
                            </label>
                            <textarea name="details" id="details" cols="10" rows="10" style="font-size: 16px;" class="form-control font" placeholder="คำอธิบายเพิ่มเติม"></textarea>
                            
                    </div>
                </div><br>

                <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4" >
                </div>
                    <div class="col-sm-12 col-md-4 col-lg-4" >
                    <center>
                    <i class=""><input type="file" id="filename" name="filename[]" multiple="multiple" class="font"></i>
                    </center>
                    </div>
                </div><br>
                 <div class="row">
                     <div class="col-sm-12 col-md-4 col-lg-6" align="right">
                            <div class="form-group" >
                            

                                        <a href="showDocAdminStaff.php" class="btn btn-success btn-lg font">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-border-style" viewBox="0 0 16 16">
  <path d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1zm0 4a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-1zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm8 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-4 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm8 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-4-4a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-1z"/>
</svg>
                                        แสดงข้อมูล
                                        
                                    </a>
                                
                            </div>
                        </div>
                    <div class="col-sm-12 col-md-4 col-lg-6"  align="left">
                        <div class="form-group" class="font">
                            
                                
                                
                                <button class="glyphicon glyphicon-floppy-save btn btn-info btn-lg"  type="submit" name="submit" value="Insert" onclick="myFunction()"><font class="font">บันทึกข้อมูล</font></button>
            
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
        <script>
            $(document).ready(function() {
                $('.mdb-select').materialSelect();
                });
        </script>
    
    </body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.3/js/bootstrap-select.js"></script>
  
    <script>
            $('#sID').keyup(function(){
                // console.log($(this).val())
                var value = $(this).val();
                if(value == ""){
                    $(this).addClass('border-danger');
                    // $('#message_username').html('**กรุณากรอกข้อมูล Username');
                    // $('#message_username').addClass('text-danger');
                    $('.btn-save').attr('disabled',true);
                }else{
                   
                }
            });
            $('#doctype').keyup(function(){
                // console.log($(this).val())
                var value = $(this).val();
                if(value == ""){
                    $(this).addClass('border-danger');
                    // $('#message_username').html('**กรุณากรอกข้อมูล Username');
                    // $('#message_username').addClass('text-danger');
                    $('.btn-save').attr('disabled',true);
                }else{
                   
                }
            });
        </script>
        
</html>