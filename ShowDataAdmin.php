<?php
session_start();
if(!ISSET($_SESSION['userProID'])){
    header('location:homeAdminStaff.php');
}
?><!DOCTYPE html>
<?php
        require_once './connectDB.php';
        $con = new connectDB();
        $idm=$_REQUEST['id'];
        $userPro = $idm;
        if($con->connect()){
            $sql="SELECT * from userprofile inner join prename on prename.prenameID = userprofile.prenameID WHERE `userProID`='$userPro' ";
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
        <title>KPS-CTRL</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <script>
            function myFunction() {
            var txt;
            var r = confirm("คุณต้องการแก้ไขข้อมูลใช่หรือไม่");
            if (r == true) {
                window.alert("แก้ไขข้อมูลสำเร็จ");
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
        </nav>
        <br><br>
        <div class="profile-images-card1">
           <div class="container-fluid">
                <h1 align="center"class="font" style="font: bold;" >ข้อมูลผู้ใช้</h1>

                <div class="row">
                    <div class="col-sm-12" align="center">
                        <div class="profile-images1">
                             <img src="<?php echo 'imgAdminStaff/'.$row['imageFile']?> "  >
                            <!-- echo $idm;?> "  > -->
                        </div>     
                    </div>
                </div><br>
                <!-- mainprofile -->
                <div class="row">
                    <div class="col-sm-12" align="left">
                        <div class="form-group" >
                            <div >
                                <label for="usr">ชื่อผู้ใช้
                                </label></div> 
                                <img src="img/username (2).png" width="50px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label>&nbsp;<?php echo ($row[1]);?></label></font>
                            </div>
                        </div>      
                    </div>
                
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                                <div>
                                <label for="usr">คำนำหน้า
                                </label></div> 
                    
                                <img src="img/namee.png" width="50px" height="48px" alt="">&nbsp;
                                <font color="#778899"  id=<?php echo ($row['prenameID'])?>><label><?php echo ($row['prenameTH']);;?></label></font>
                               
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <div class="form-group">
                                 <div>
                                <label for="usr">ชื่อ
                                </label></div> 
                                <img src="img/namee.png" width="50px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label><?php echo ($row[4]);;?></label></font>
                         </div>
                    </div> 
                    <div class="col-sm-4">
                        <div class="form-group">
                            <div>
                                <label for="usr">นามสกุล
                                </label></div> 
                                <img src="img/namee.png" width="50px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label><?php echo ($row[5]);;?></label></font>
                        </div>
                    </div>      
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                                <div>
                                <label for="usr">Prename
                                </label></div> 
                        
                                <img src="img/namee.png" width="50px" height="48px" alt="">&nbsp;
                                <font color="#778899" id=<?php echo ($row['prenameID'])?>><label><?php echo ($row['prenameEN']);;?></label></font>
                               
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <div class="form-group">
                                 <div>
                                <label for="usr">Firstname
                                </label></div> 
                                <img src="img/namee.png" width="50px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label><?php echo ($row[6]);;?></label></font>

                               
                        </div>
                    </div>  
                    <div class="col-sm-4">
                        <div class="form-group">
                                <div>
                                <label for="usr">Lastname
                                </label></div> 
                                <img src="img/namee.png" width="50px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label><?php echo ($row[7]);;?></label></font>
                               
                        </div>
                    </div>                     
                </div>
                <div class="row">
                    <div class="col-sm-12" align="left">
                        
                        <h3>ข้อมูลการติดต่อ</h3>
                    </div>      
                </div>
                
                <div class="row">
                    <div class="col-sm-12" align="left">
                        <div class="form-group" >
                            <div>
                                <label for="usr">E-mail
                                </label></div> 
                                <img src="img/mail.png" width="53px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label><?php echo ($row[10]);;?></label></font>
                        </div>
                    </div>      
                </div>
                <div class="row">
                    <div class="col-sm-12" align="left">
                        <div class="form-group" >
                            <div>
                                <label for="usr">Tel.
                                </label></div> 
                                <img src="img/tel.png" width="50px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label><?php echo ($row[11]);;?></label></font>
                        </div>
                    </div>      
                </div>
                <div class="row">
                    <div class="col-sm-12" align="left">
                        <div class="form-group" >
                            <div>
                                <label for="usr" class="font" style="font: bold;">LineID.
                                </label></div> 
                                <img src="img/line.png" width="50px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label class="font"><?php echo ($row[8]);;?></label></font>
                        </div>
                    </div>      
                </div>
                <div class="row">
                    <div class="col-sm-12" align="left">
                        <div class="form-group" >
                            <div>
                                <img src="img/bg.jpg" alt="" width="800px" height="48px">
                        </div>
                    </div>      
                </div>
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