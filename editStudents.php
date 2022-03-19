<?php
session_start();
if(!ISSET($_SESSION['userProID'])){
    header('location:manageAdminStaff.php');
}
?>
<?php

$idm=$_REQUEST['id'];
$userPro = $idm;
require_once './connectDB.php';
$con = new connectDB();
if($con->connect()){
    $sql="SELECT * from userprofile inner join students on userprofile.userProID = students.SuserProID 
    inner join prename on prename.prenameID = userprofile.prenameID  inner join researchgroup on researchgroup.researchgrID = students.researchGroup 
    inner join academiclevel on academiclevel.acaLevelID = students.acaLevelID inner join curricular on curricular.curriID = students.curriID 
    inner join academicplan on academicplan.academicPlanID = students.academicPlanID WHERE `userProID`='".$userPro."' ";

    $objquerry =  mysqli_query($con->connect(),$sql);
    $row = mysqli_fetch_array($objquerry);
    $prename = new connectDB(); 
    $curricular = new connectDB(); 
    $researchgroup = new connectDB(); 
    $academicplan = new connectDB();
    $academiclevel = new connectDB();
  
    
}
else{
    echo "Connect failed...";
}

  
  ?>

<html lang="en">
    <head>
        <!-- Theme Made By www.w3schools.com -->
        <script type="text/javascript" src="profile.js"></script>
        <title>KPS-CTRL</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link
            rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
            integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
            crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/popup.css">
        <script type="text/javascript" src="javascript/profile.js"></script>
        <link rel="stylesheet" href="css/styleProfile.css">
        <script type="text/javascript" src="javascript/showPassword.js"></script>
        <script>
            function myFunction() {
            var txt;
            var r = confirm("คุณต้องการแก้ไขข้อมูลใช่หรือไม่");
            if (r == true) {
                txt = "บันทึก!";
            } else {
                txt = "ยกเลิกการบันทึก!";
            }
            document.getElementById("demo").innerHTML = txt;
            }
        </script>
        
<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>
<script language="javaScript">
    function checkemail(str){
        var emailFilter=/^.+@.+\..{2,3}$/;
        var str=document.form.text1.value;
    if (!(emailFilter.test(str))) { 
        alert ("ท่านใส่อีเมล์ไม่ถูกต้อง");
        return false;
    }
        return true;
    }
    </script> 
    <script language="JavaScript">
        function chkNumber(ele) {
            var vchar = String.fromCharCode(event.keyCode);
            if ((vchar < '0' || vchar > '9') && (vchar != '.')) return false;
            ele.onKeyPress = vchar;
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
        <br><br>
        <div class="profile-images-card1">
    
        <div id="" class="container text-center">
        <form action="checkEvent.php?id=<?php echo $userPro ?>" method="POST" enctype="multipart/form-data">
            <div class="container"><br><br>
                    <div class="col-12" align="left">
                        <div>
                            <h2 style="color: #1f3c88;" class="font">แก้ไขข้อมูลนักศึกษา</h2>
                            <hr noshade="noshade" width="1200">
                        </div>
                    </div>
                    <div class="profile-images-card">
                        <div class="profile-images">
                            <img src="<?php echo 'imgStudents/'.$row['imageFile']?> " onclick="showPic(this.src)" id="upload-img" for="fileupload"  >
                        </div>
                        <div class="custom-file">
                            <label for="fileupload"class="font" style="font: bold;color: darkred;">Upload Profile</label>
                            <input type="file" id="fileupload" name="profile">
                        </div>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-3" >
                    <div class="form-group">
                        <div>
                        <label for="usr" class="font">รหัสนักศึกษา
                        </label></div> 
                        <?php
                        echo "<input type='text' id='exampleForm2' class='form-control font' size='40px' name='studentID' value='".$row['userProID']."' disabled='disabled' >";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-6" >
                </div>
                <!-- <div class="col-sm-12 col-md-4 col-lg-3" >
                    <div class="form-group">
                        <div class="custom-file1" align="right">
                       <i class="fas fa-edit" style="font-size:18px;color:#FF5733;"><label for="editprofile" data-toggle="modal" data-target="#exampleModalLong" id=".$row['userProID']."> <font style="color: #FF5733;">เปลี่ยนรหัสผ่าน</font></label></i>
                            
                        </div> 
                    </div>
                        
                </div> -->
                    
                </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-2" >
                    <div >
                        
                        <label for="" class="font">คำนำหน้า
                        </label><br>
                        <?php
                                $prenameTH = $row['prenameTH'];
                                $pnameID = $row['prenameID'];
                                
                                $sql1 = "SELECT * FROM prename  ";
                                $result1 = mysqli_query($prename->connect(), $sql1);
                                ?>
                                <select name="pnameTH" id="pnameTH" style="width: 100%;height:34px;text-align: left;" class="form-control font prf" onchange='$(".prf").val(this.value)'>
                                    <option id="pnameTH" name="pnameTH" value="<?php echo $pnameID ?>" style="font-size: 16px;" class="font"><?php echo $prenameTH; ?></option>
                                    <?php while ($row1 = $result1->fetch_row()) { ?>
                                        <option class="font" value="<?php echo ($row1[0]); ?>"><?php echo ($row1[1]); ?></option>
                                    <?php } ?>
                                </select>   
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-5">
                    <div class="form-group">
                        <label for="usr" class="font">ชื่อ
                        </label><br>
                        <?php
                        echo "<input type='text' id='exampleForm2' class='form-control font' size='40px' name='firstnameTH' value='".$row['firstNameTH']."'>";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-5" >
                    <div class="form-group">
                        <label for="usr" class="font">นามสกุล
                        </label><br>
                        <?php
                        echo "<input type='text' id='exampleForm2' class='form-control font' size='40px' name='lastnameTH' value='".$row['lastNameTH']."'>";
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-2">
                    <div>
                        
                        <label for="" class="font">Prename
                        </label><br>
                        <?php
                        $prenameEN = $row['prenameEN'];
                        $pnameID = $row['prenameID'];
						$sql2 = "SELECT prenameID,prenameEN FROM prename";
						$result2 = mysqli_query($prename->connect(), $sql2);
						?>
                        <select name="pnameEN" id="pnameEN" style="width: 100%;height:34px;text-align: left;" class="form-control prf font" onchange='$(".prf").val(this.value)' disabled='disabled'>
							<option id="pnameEN" name="pnameEN" value="<?php echo $pnameID ?>" style="font-size: 16px;" class="font"><?php echo $prenameEN; ?></option>
							<?php while ($row2 = $result2->fetch_row()) { ?>
								<option value="<?php echo ($row2[0]); ?>"><?php echo ($row2[1]); ?></option>
							<?php } ?>
						</select>
                       
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-5" >
                    <div class="form-group">
                        <label for="usr" class="font">Firstname
                        </label><br>
                        <?php
                        echo "<input type='text' id='exampleForm2' class='form-control font' size='40px' name='firstnameEN' value='".$row['firstNameEN']."'>";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-5" >
                    <div class="form-group">
                        <label for="usr" class="font">Lastname
                        </label><br>
                        <?php
                        echo "<input type='text' id='exampleForm2' class='form-control font' size='40px' name='lastnameEN' value='".$row['lastNameEN']."'>";
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-2" >
                    <div>
                        
                        <label for="" class="font">ระดับการศึกษา
                        </label><br>
                        <?php
                        $educationLevel = $row['educationLevel'];
                        $eduID = $row['acaLevelID'];
						$sql2 = "SELECT acaLevelID,educationLevel FROM academicLevel";
						$result2 = mysqli_query($prename->connect(), $sql2);
						?>
                        <select name="academicLevel" id="academicLevel" style="width: 100%;height:34px;text-align: left;" class="form-control prf font" onchange='$(".prf").val(this.value)' >
							<option id="academicLevel" name="academicLevel" value="<?php echo $eduID ?>" style="font-size: 16px;" class="font"><?php echo $educationLevel; ?></option>
							<?php while ($row2 = $result2->fetch_row()) { ?>
								<option value="<?php echo ($row2[0]); ?>"><?php echo ($row2[1]); ?></option>
							<?php } ?>
						</select>
                       
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-2" >
                    <div class="center">
                        <label for="" class="font">แผนการศึกษา
                        </label>
                        <br>
                        <?php
                        $academicplan = $row['academicPlan'];
                        $acaplanID = $row['academicPlanID'];
						$sql2 = "SELECT academicPlanID,academicPlan FROM academicplan";
						$result2 = mysqli_query($prename->connect(), $sql2);
						?>
                        <select name="academicplan" id="academicplan" style="width: 100%;height:34px;text-align: left;" class="form-control prf font" onchange='$(".prf").val(this.value)' >
							<option id="academicplan" name="academicplan" value="<?php echo $acaplanID ?>" style="font-size: 16px;" class="font"><?php echo $academicplan; ?></option>
							<?php while ($row2 = $result2->fetch_row()) { ?>
								<option value="<?php echo ($row2[0]); ?>"><?php echo ($row2[1]); ?></option>
							<?php } ?>
						</select>
                                     
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3" >
                    <div class="center">
                        <label for="" class="font">หลักสูตร
                        </label>
                        <br>
                        <?php
                        $curricularTH = $row['curricularTH'];
                        $curricularID =$row['curriID'];
						$sql2 = "SELECT curriID,curricularTH FROM curricular";
						$result2 = mysqli_query($prename->connect(), $sql2);
						?>
                        <select name="curricular" id="curricular" style="width: 100%;height:34px;text-align: left;" class="form-control prf font" onchange='$(".prf").val(this.value)' >
							<option id="curricular" name="curricular" value="<?php echo $curricularID ?>" style="font-size: 16px;" class="font"><?php echo $curricularTH; ?></option>
							<?php while ($row2 = $result2->fetch_row()) { ?>
								<option value="<?php echo ($row2[0]); ?>"><?php echo ($row2[1]); ?></option>
							<?php } ?>
						</select>
                       
                       
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-2" >
                    <div class="center">
                        <label for="" class="font">กลุ่มวิจัยที่สังกัด
                        </label><br>
                        <?php
                        $researchgrAbbrName = $row['researchgrAbbrName'];
                        $researchID =$row['researchgrID'];
						$sql2 = "SELECT researchgrID,researchgrAbbrName FROM researchgroup";
						$result2 = mysqli_query($prename->connect(), $sql2);
						?>
                        <select name="researchgroup" id="researchgroup" style="width: 100%;height:34px;text-align: left;" class="form-control prf font" onchange='$(".prf").val(this.value)' >
							<option id="researchgroup" name="researchgroup" value="<?php echo $researchID ?>" style="font-size: 16px;" class="font"><?php echo $researchgrAbbrName; ?></option>
							<?php while ($row2 = $result2->fetch_row()) { ?>
								<option value="<?php echo ($row2[0]); ?>"><?php echo ($row2[1]); ?></option>
							<?php } ?>
						</select>
                        
                       
                    </div>
                </div>
            </div><br>

            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-4" >
                    <div class="form-group">
                        
                        <label for="usr" class="font">ชื่อปริญญานิพนธ์ (ภาษาไทย)
                        </label>
                       
                        <?php
                        echo "<input type='text' id='exampleForm2' class='form-control font' size='40px' name='thesisTH' value='".$row['thesisTitleTH']."' autocomplete='off'>";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-4">
                    <div class="form-group">
                        <label for="usr" class="font">ชื่อปริญญานิพนธ์ (ภาษาอังกฤษ)
                        </label><br>
                        <?php
                        echo "<input type='text' id='exampleForm2' class='form-control font' size='40px' name='thesisEN' value='".$row['thesisTitleEN']."' autocomplete='off'>";
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-3" >
                    <div class="form-group">
                        
                        <label for="usr" class="font">Line ID
                        </label>
                       
                        <?php
                        echo "<input type='text' id='exampleForm2' class='form-control font' size='40px' name='lineID' value='".$row['lineID']."' autocomplete='off'>";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label for="usr" class="font">E-mail
                        </label><br>
                        <?php
                        echo "<input type='text' id='exampleForm2' class='form-control font' size='40px' name='email' value='".$row['email']."' autocomplete='off'>";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3" >
                    <div class="form-group">
                        
                        <label for="usr" class="font">Tel.
                        </label>
                        <?php
                        echo "<input type='text' id='exampleForm2' class='form-control font' size='40px' name='tel' value='".$row['phone']."'  OnKeyPress='return chkNumber(this)' autocomplete='off'>";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label for="usr" class="font">Token Line
                        </label><br>
                        <?php
                        echo "<input type='text' id='exampleForm2' class='form-control font' size='40px' name='token' value='".$row['tokenLine']."' autocomplete='off'>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-12" >
                    <div class="form-group">
                        <center>
                            <?php
                            
                        echo "<button class='glyphicon glyphicon-floppy-save btn btn-info btn-lg'  type='submit' name='edit' value='edit' id='edit' onclick='myFunction()'><font class='font'> บันทึกข้อมูล</font></button>";
        ?>
                            <!-- <input type="submit" class="btn btn-danger" style="font-size:24px" name="submit" value="บันทึก"></input> -->
                            <!-- <i class="fa fa-save" align="center"></i> -->
                        </center>
                    </div>
                </div>
            </div>
            </form>
        </div>
        </div>
         
        <br><br>

        <!-- <footer class="container-fluid text-center">
            <div id="contact" class="container-fluid bg-grey">
                <h2 class="text-center">CONTACT</h2>
                <div class="row">
                    <p>Theeraporn Srisuk</p>
                    <br>
                    <p>Usa Saensen</p>
                </div>
            </div>
        </footer>   -->

        <script>
            $(document).ready(function () {
                $(".navbar a, footer a[href='#myPage']").on('click', function (event) {
                    var hash = this.hash;
                    $('html, body').animate({
                        scrollTop: $(hash)
                            .offset()
                            .top
                    }, 900, function () {
                        window.location.hash = hash;
                    });
                });
                $(window).scroll(function () {
                    $(".slideanim").each(function () {
                        var pos = $(this)
                            .offset()
                            .top;

                        var winTop = $(window).scrollTop();
                        if (pos < winTop + 600) {
                            $(this).addClass("slide");
                        }
                    });
                });
            })
        </script>
        <script src="javascript/jquery-latest.min.js"></script>
        <script>
            $(function(){
                $("#fileupload").change(function(event) {
                    var x = URL.createObjectURL(event.target.files[0]);
                    $("#upload-img").attr("src",x);
                    console.log(event);
                });
            })
        </script>
        <link rel="stylesheet" href="css/styleProfile.css">


    </body>
</html>