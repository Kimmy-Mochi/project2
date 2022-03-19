<?php
session_start();
if(!ISSET($_SESSION['userProID'])){
    header('location:homeStudent.php');
}
?><!DOCTYPE html>
<?php
        require_once './connectDB.php';
        $con = new connectDB();
        if($con->connect()){
            $sql="SELECT * from userprofile WHERE `userProID`='$_SESSION[userProID]' ";
            $objquerry =  mysqli_query($con->connect(),$sql);
            $row = mysqli_fetch_array($objquerry);
        }
        else{
            echo "Connect failed...";
        }
        ?>

<html lang="en">
    <head>
        <!-- Theme Made By www.w3schools.com -->
        <script type="text/javascript" src="profile.js"></script>
        <title>Supervision Control System</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <link href="https://fonts.googleapis.com/css2?family=Kanit" rel="stylesheet" type="text/css">

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
        <!-- <link rel="stylesheet" href="css/profile.css"> -->
        <script type="text/javascript" src="javascript/profile.js"></script>
        <script type="text/javascript" src="javascript/showPassword.js"></script>
        <script>
            function myFunction() {
            var txt;
            var r = confirm("คุณต้องการเปลี่ยนรหัสผ่านใช่หรือไม่");
            if (r == true) {
               txt="เปลี่ยนรหัสผ่านสำเร็จ";
            } else {
                txt = "ยกเลิกการบันทึก!";
            }
            document.getElementById("demo").innerHTML = txt;
            }
        </script>
        <script> 
	// Function เพื่อตรวจสอบรหัสผ่านว่าตรงกันหรือไม่
	function checkPassword(form) { 
		password = document.forms["form1"]["password"].value
		cpassword = document.forms["form1"]["cpassword"].value;

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
       
        <div class="profile-images-card1">
           <div class="container-fluid">
          <form action="checkEventChangPassword.php" method="POST">
        
           <h3 class="modal-title" id="exampleModalLongTitle" align="center">เปลี่ยนรหัสผ่าน</h3><br>
           <div><?php if(isset($message)) { echo $message; } ?></div>
                
           <div class="row ">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                    
                        <label>รหัสผ่านเดิม</label>
                        <div class="form-group " id="show_hide_password"> 
        
                                <input class="form-control" type="password" name="currentPassword" id="currentPassword" value="">
                        </div> 
                    </div> 
                   
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                
                        <label>รหัสผ่านใหม่</label>
                        <div class="form-group " id="show_hide_password"> 
                          
                                <input class="form-control" type="password" name="newPassword" id="newPassword" value="">
                               
                        </div> 

                    </div> 
                   
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">

                        <label>ยืนยันรหัสผ่าน</label>
                        <div class="form-group" id="show_hide_password"> 
                            
                                <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" value="">
                            
                           
                        </div> 

                    </div> 
                   
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group" >
                            <?php
                            
                            echo "<button class='btn btn-danger btn-lg btn-block' class='form-control' type='submit' name='savePWD' value='savePWD' onclick='myFunction()'>ยืนยันรหัสผ่าน</button>";
                        ?>
                      
                        </div>

                    </div> 
                   
                </div>
             
                </form> 
            </div>
            
        </div>
        
       
    

        
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
        <script type="text/javascript">
$(function(){
      
     $(".btn-confirm").on("click",function(){        
        var obj = $(this); // อ้างอิงปุ่ม
        obj.parents("tr").toggleClass("table-danger"); // เปลี่ยนสีพื้นหลังแถวที่จะลบ
        // ถ้ามีการกำหนด title ใช้ข้อความใน title มาข้นแจ้ง ถ้าไม่มีใช้ค่าที่กำหนด "ลบรายการข้อมูล"
         var alertMsg = (obj.attr("title")!=undefined)?obj.attr("title"):"เปลี่ยนแปลงรหัสผ่าน";
         setTimeout(function(){ // หน่วงเวลาเพื่อให้ การกำหนดสีพืนหลังแถวทำงานได้
             if(!confirm("ยืนยันการทำรายการ "+alertMsg+" ?")){
                    obj.parents("tr").toggleClass("table-danger"); // ไม่ยืนยันการลบ เปลี่ยนสีพื้นหลังกลับ
             }else{
                    window.location = obj.attr("href"); // ถ้ายืนยันการลบ ก็ให้ลิ้งค์ทำงาน
             }
         },100); // หน่วงเวลา 100 มิลลิวินาที
         return false; // ไม่ให้ลิ้งค์ทำงานปกติ ให้เข้าไปในเงื่อนไข confirm แทน
     });
      
});
</script>

       
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
</html>