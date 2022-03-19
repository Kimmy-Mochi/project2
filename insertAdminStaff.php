<?php
session_start();
if(!ISSET($_SESSION['userProID'])){
    header('location:manageAdminStaff.php');
}
?>
<?php
include "connectDB.php";
$conn = new connectDB();
$prename = new connectDB(); 
$acaposition = new connectDB(); 
$researchgroup = new connectDB(); 

?>

<html lang="en">
    <head>
        <!-- Theme Made By www.w3schools.com -->
        <!-- <script type="text/javascript" src="profile.js"></script> -->
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
        <script type="text/javascript" src="javascript/profile.js"></script>
        <link rel="stylesheet" href="css/styleProfile.css">
        <script>
            function myFunction() {
            var txt;
            var r = confirm("คุณต้องการบันทึกข้อมูลใช่หรือไม่");
            if (r == true) {
                txt ="บันทึกข้อมูลสำเร็จ";
            } else {
                txt = "ยกเลิกการบันทึก!";
            }
            document.getElementById("demo").innerHTML = txt;
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
        <script> 
	// Function เพื่อตรวจสอบรหัสผ่านว่าตรงกันหรือไม่
	function checkPassword(form) { 
		password = form.password1.value; 
		cpassword = form.password2.value; 

		// ถ้าช่่องรหัสผ่านไม่ถูกกรอก
		if (password == '') 
			alert ("Please enter Password"); 
					
		// ถ้าช่่องยืนยันรหัสผ่านไม่ถูกกรอก
		else if (cpassword == '') 
			alert ("Please enter confirm password"); 
						
		//ถ้าทั้งสองช่องไม่ตรงกัน   ให้แจ้งผู้ใช้  และ  return false
		else if (password != cpassword) { 
			alert ("\nPassword did not match: Please try again...") 
			return false; 
			} 

		//ถ้าทั้งสองช่องตรงกัน  return true
		else{ 
			
			alert("Password Match: Welcome to Mindphp!") 
				return true; 
			} 
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
                                $query = mysqli_query($conn->connect(), "SELECT * FROM   `userprofile` WHERE `userProID`='$_SESSION[userProID]'");
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
        <div class="profile-images-card1">
        <div id="" class="container text-center">
        <form action="checkEventAdminStaff.php" method="POST" enctype="multipart/form-data">
            <div class="container">
                    <div class="col-12" align="left">
                        <div>
                            <h2 style="color: #1f3c88;">เพิ่มข้อมูลผู้ดูแลระบบและเจ้าหน้าที่</h2>
                            <hr noshade="noshade" width="1200">
                        </div>
                    </div>
                    <div class="profile-images-card">
                        <div class="profile-images">
                            <img src="img/user1.png" onclick="showPic(this.src)" id="upload-img">
                        </div>
                        <div class="custom-file">
                            <label for="fileupload" class="font" style="font: bold;color: darkred;">Upload Profile</label>
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
                        <label for="usr">รหัสผู้ดูแลระบบหรือเจ้าหน้าที่
                        </label></div> 
                        <?php
                        echo "<input type='text' id='adminStaffUserID' class='form-control' size='40px' name='adminStaffUserID' autocomplete='off' required>";
                        echo " <font size='3'><span id='message_id'></span></font>";
                        ?>
                    </div>
                </div>
            <div class="col-sm-12 col-md-4 col-lg-3" >
                    <div class="form-group">
                        <div>
                        <label for="usr">Username
                        </label></div> 
                        <?php
                        echo "<input type='text' id='username' class='form-control' size='40px' name='username' autocomplete='off' required>";
                        echo " <font size='3'><span></span></font>";
                        ?>
                       
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3" >
                    <div class="form-group">
                        <div>
                        <label for="usr">รหัสผ่าน
                        </label></div> 
                        <?php
                        echo "<input type='password' id='hashedPassword' class='form-control' size='40px' name='password' required>";
                        echo " <font size='3'><span id='message_pwd'></span></font>";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3" >
                    <div class="form-group"> <br>
                        <div class="form-check">
                            <?php
                                echo "<input class='form-check-input' type='radio' value='A' name='adminOrStaff' checked>  ผู้ดูแลระบบ</input>";
                                ?>
                            <?php
                                echo "<input class='form-check-input' type='radio' value='SF' name='adminOrStaff' checked>  เจ้าหน้าที่</input>";
                            
                                ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-2" >
                    <div >
                        
                        <label for="member_prefix">คำนำหน้า
                        </label><br>
                        <?php

						$sql = "SELECT * FROM prename";
						$result = mysqli_query($prename->connect(), $sql);
						?>
                        <select name="pnameTH" id="pnameTH" style="width: 100%;height:34px;text-align: left;" class="form-control prf" onchange='$(".prf").val(this.value)'>
							<option id="pnameTH" name="pnameTH" value="" style="font-size: 16px;">- please select -</option>
							<?php while ($row = $result->fetch_row()) { ?>
								<option value="<?php echo ($row[0]); ?>"><?php echo ($row[1]); ?></option>
							<?php } ?>
						</select>
                       
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-5">
                    <div class="form-group">
                        <label for="usr">ชื่อ
                        </label><br>
                        <?php
                        echo "<input type='text' id='firstnameTH' class='form-control' size='40px' name='firstnameTH' required>";
                        echo " <font size='3'><span id='message_nameTH'></span></font>";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-5" >
                    <div class="form-group">
                        <label for="usr">นามสกุล
                        </label><br>
                        <?php
                        echo "<input type='text' id='lastnameTH' class='form-control' size='40px' name='lastnameTH' required>";
                        echo " <font size='3'><span id='message_lastTH'></span></font>";
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-2">
                    <div>
                        
                        <label for="member_prefix">Prename
                        </label><br>
                        <?php

						$sql = "SELECT prenameID,prenameEN FROM prename";
						$result = mysqli_query($prename->connect(), $sql);
						?>
                        <select name="pnameEN" id="pnameEN" style="width: 100%;height:34px;text-align: left;" class="form-control prf" onchange='$(".prf").val(this.value)' disabled='disabled'>
							<option id="pnameEN" name="pnameEN" value="" style="font-size: 16px;">- please select -</option>
							<?php while ($row = $result->fetch_row()) { ?>
								<option value="<?php echo ($row[0]); ?>"><?php echo ($row[1]); ?></option>
							<?php } ?>
						</select>
                       
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-5" >
                    <div class="form-group">
                        <label for="usr">Firstname
                        </label><br>
                        <?php
                        echo "<input type='text' id='firstnameEN' class='form-control' size='40px' name='firstnameEN' required>";
                        echo " <font size='3'><span id='message_nameEN'></span></font>";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-5" >
                    <div class="form-group">
                        <label for="usr">Lastname
                        </label><br>
                        <?php
                        echo "<input type='text' id='lastnameEN' class='form-control' size='40px' name='lastnameEN' required>";
                        echo " <font size='3'><span id='message_lastEN'></span></font>";
                        ?>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-3" >
                    <div class="form-group">
                        
                        <label for="usr">Line ID
                        </label>
                       
                        <?php
                        echo "<input type='text' id='lineID' class='form-control' size='40px' name='lineID' autocomplete='off' required>";
                        echo " <font size='3'><span id='message_lineID'></span></font>";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label for="usr">E-mail
                        </label><br>
                        <?php
                        echo "<input type='text' id='email' class='form-control' size='40px' name='email' autocomplete='off' required>";
                        echo " <font size='3'><span id='message_email'></span></font>";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3" >
                    <div class="form-group">
                        
                        <label for="usr">Tel.
                        </label>
                        <?php
                        echo "<input type='text' id='phone' class='form-control' size='40px' name='tel' OnKeyPress='return chkNumber(this)' autocomplete='off' required>";
                        echo " <font size='3'><span id='message_phone'></span></font>";
                        ?>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 col-lg-3">
                    <div class="form-group">
                        <label for="usr">Token Line
                        </label><br>
                        <?php
                        echo "<input type='text' id='exampleForm2' class='form-control' size='40px' name='token' autocomplete='off'>";
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-4 col-lg-12" >
                    <div class="form-group">
                        <center>
                            <?php
                            
                        echo "<button class='glyphicon glyphicon-floppy-save btn btn-info btn-lg btn-save'  type='submit' name='submit' value='Insert' onclick='myFunction()'><font class='font'> บันทึกข้อมูล</font></button>";
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
        </footer> -->
    </body>
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
        <script>
            function showPic(newsrc){
            mainpic=document.getElementById("main");
            mainpic.src=newsrc;
            }
        </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src=""></script>
<!-- <script src="https://code.jquery.com/jquer-3.4.1.min.js"></script> -->
        <script>
$(document).ready(function(){
    var username_state = false;

	$("#username").on('blur',function(){
		var username = $('#username').val();
        if(username==''){
            username_state = false;
            return ;
        }
        $.ajax({
            url: 'function.ajax.php',
            type: 'post',
            data :{
                'username_chk':1,
                'username': username
            },
            success: function(response){
                if(response == 'taken'){
                    username_state = false;
                    $('#username').parent().removeClass();
                    $('#username').parent().addClass('form_error');
                    $('#username').siblings("span").text("Sorry");
                }else if(response == "not_taken"){
                    username_state = true;
                    $('#username').parent().removeClass();
                    $('#username').parent().addClass('form_succes');
                    $('#username').siblings("span").text("Pass");
                }
            }
        })
		
	});
});
</script>	

<!-- 
        <script>
            $('#username').keyup(function(){
                // console.log($(this).val())
                var value = $(this).val();
                if(value == ""){
                    $(this).addClass('border-danger');
                    $('#message_username').html('**กรุณากรอกข้อมูล Username');
                    $('#message_username').addClass('text-danger');
                    $('.btn-save').attr('disabled',true);
                }else{
                    // $.ajax({
                    //     method:'post',
                    //     url:'function_ajax.php',
                    //     data:{value:username,function:'check_username'},
                    //     success:function(data){
                    //         // alert(data)
                    //         if(data > 0){
                    //             $('#username').addClass('border-danger');
                    //             $('#message_username').html('**Username ซ้ำ กรุณากรอกข้อมูลใหม่!!');
                    //             $('#message_username').addClass('text-danger');
                    //             $('.btn-save').attr('disabled',true);
                    //         }else{
                    //             $('#username').addClass('border-success');
                    //             $('#message_username').html('**Username ');
                    //             $('#message_username').addClass('text-success');
                    //             $('.btn-save').attr('disabled',false);

                    //         }
                    //     }
                    // })
                }
            });
            $('#adminStaffUserID').keyup(function(){
                // console.log($(this).val())
                var value = $(this).val();
                if(value == ""){
                    $(this).addClass('border-danger');
                    $('#message_id').html('**กรุณากรอกข้อมูล รหัสผู้ใช้งาน');
                    $('#message_id').addClass('text-danger');
                    $('.btn-save').attr('disabled',true);
                }else{
                    $(this).addClass('border-success');
                    $('.btn-save').attr('disabled',false);
                }
            });
            $('#hashedPassword').keyup(function(){
                // console.log($(this).val())
                var value = $(this).val();
                if(value == ""){
                    $(this).addClass('border-danger');
                    $('#message_pwd').html('**กรุณากรอกข้อมูล รหัสผ่าน');
                    $('#message_pwd').addClass('text-danger');
                    $('.btn-save').attr('disabled',true);
                }else{
                    $(this).addClass('border-success');
                    $('.btn-save').attr('disabled',false);
                }
            });
            $('#firstnameTH').keyup(function(){
                // console.log($(this).val())
                var value = $(this).val();
                if(value == ""){
                    $(this).addClass('border-danger');
                    $('#message_nameTH').html('**กรุณากรอกข้อมูล ชื่อผู้ใช้');
                    $('#message_nameTH').addClass('text-danger');
                    $('.btn-save').attr('disabled',true);
                }else{
                    $(this).addClass('border-success');
                    $('.btn-save').attr('disabled',false);
                }
            });
            $('#lastnameTH').keyup(function(){
                // console.log($(this).val())
                var value = $(this).val();
                if(value == ""){
                    $(this).addClass('border-danger');
                    $('#message_lastTH').html('**กรุณากรอกข้อมูล นามสกุลผู้ใช้');
                    $('#message_lastTH').addClass('text-danger');
                    $('.btn-save').attr('disabled',true);
                }else{
                    $(this).addClass('border-success');
                    $('.btn-save').attr('disabled',false);
                }
            });
            $('#firstnameEN').keyup(function(){
                // console.log($(this).val())
                var value = $(this).val();
                if(value == ""){
                    $(this).addClass('border-danger');
                    $('#message_nameEN').html('**กรุณากรอกข้อมูล ชื่อผู้ใช้');
                    $('#message_nameEN').addClass('text-danger');
                    $('.btn-save').attr('disabled',true);
                }else{
                    $(this).addClass('border-success');
                    $('.btn-save').attr('disabled',false);
                }
            });
            $('#lastnameEN').keyup(function(){
                // console.log($(this).val())
                var value = $(this).val();
                if(value == ""){
                    $(this).addClass('border-danger');
                    $('#message_lastEN').html('**กรุณากรอกข้อมูล นามสกุลผู้ใช้');
                    $('#message_lastEN').addClass('text-danger');
                    $('.btn-save').attr('disabled',true);
                }else{
                    $(this).addClass('border-success');
                    $('.btn-save').attr('disabled',false);
                }
            });
            $('#lineID').keyup(function(){
                // console.log($(this).val())
                var value = $(this).val();
                if(value == ""){
                    $(this).addClass('border-danger');
                    $('#message_lineID').html('**กรุณากรอกข้อมูล ไลน์');
                    $('#message_lineID').addClass('text-danger');
                    $('.btn-save').attr('disabled',true);
                }else{
                    $(this).addClass('border-success');
                    $('.btn-save').attr('disabled',false);
                }
            });
            $('#email').keyup(function(){
                // console.log($(this).val())
                var value = $(this).val();
                if(value == ""){
                    $(this).addClass('border-danger');
                    $('#message_email').html('**กรุณากรอกข้อมูล อีเมล');
                    $('#message_email').addClass('text-danger');
                    $('.btn-save').attr('disabled',true);
                }else{
                    $(this).addClass('border-success');
                    $('.btn-save').attr('disabled',false);
                }
            });
            $('#phone').keyup(function(){
                // console.log($(this).val())
                var value = $(this).val();
                if(value == ""){
                    $(this).addClass('border-danger');
                    $('#message_phone').html('**กรุณากรอกข้อมูล เบอร์โทรศัพท์');
                    $('#message_phone').addClass('text-danger');
                    $('.btn-save').attr('disabled',true);
                }else{
                    $(this).addClass('border-success');
                    $('.btn-save').attr('disabled',false);
                }
            });
        </script> -->
</html>