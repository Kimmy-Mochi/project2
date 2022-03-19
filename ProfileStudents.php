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
            $sql="SELECT * from userprofile inner join students on userprofile.userProID = students.SuserProID inner join researchgroup on researchgroup.researchgrID = students.researchGroup 
            inner join academiclevel on academiclevel.acaLevelID = students.acaLevelID inner join curricular on curricular.curriID = students.curriID 
            inner join academicplan on academicplan.academicPlanID = students.academicPlanID
            inner join prename on prename.prenameID=userprofile.prenameID WHERE `userProID`='$_SESSION[userProID]' ";
            $objquerry =  mysqli_query($con->connect(),$sql);
            $researchgroup = new connectDB(); 
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
        <!-- <link rel="stylesheet" href="css/profile.css"> -->
        <script type="text/javascript" src="javascript/profile.js"></script>
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
                    <a class="navbar-brand" href="#myPage">Logo</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right ">
                    <li>
                            <a href="homeStudent.php">หน้าหลัก</a>
                        </li>
                        <li>
                            <a href="homeStudent.php?#document">จัดเก็บเอกสาร</a>
                        </li>
                        <li>
                            <a href="homeStudent.php?#meeting">รายละเอียดการประชุม</a>
                        </li>
                        <li>
                            <a href="homeStudent.php?#appeal">การร้องเรียน</a>
                        </li>
                        <li>
                            <a href="homeStudent.php?#contact">ติดต่อ</a>
                        </li>
                        
                        <li>
                        <?php
                                $query = mysqli_query($con->connect(), "SELECT * FROM   `userprofile` WHERE `userProID`='$_SESSION[userProID]'");
                                $fetch = mysqli_fetch_array($query);
                
                                echo "<a href='ProfileStudents.php' class='text-success'>".$fetch['firstNameTH']."&nbsp;".$fetch['lastNameTH']."</a>";
                            ?>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>
                            <ul class="dropdown-menu" style="background-color:darkblue">
                                <li><a href="ProfileStudents.php">โปรไฟล์</a></li>
                                <li><a href="changePasswordStudent.php">เปลี่ยนรหัสผ่าน</a></li>
                                <li><a href="index.php">ออกจากระบบ</a></li>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </nav>

        <br><br>
        <div class="profile-images-card1">
           <div class="container-fluid">
                        <h1 align="center"class="font" style="font: bold;"> Profile</h1>     
                <div class="row">
                    <div class="col-sm-12" align="center">
                        <div class="profile-images1 separator">
                        
                       

                            <img src="<?php echo 'imgStudents/'.$row['imageFile']?> "  >

                   
                        </div>
                        
                        <!-- <div class="custom-file1">
                            <label for="fileupload">Upload Profile</label>
                            <input type="file" id="fileupload" style="display: none;">
                        </div>    -->
                        <div class="custom-file1" align="right">
                       <i class="fas fa-edit" style="font-size:18px;color:#FF5733;"><label for="editprofile" data-toggle="modal" data-target="#exampleModalLong"> <font style="color: #FF5733;">Edit Profile</font></label></i>
                            
                        </div>      
                    </div>
                </div><br>
                <!-- ===========================================================popup==================================================================================== -->
                
                <form action="checkEvent.php" method="post"  enctype="multipart/form-data">
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    
                    <div class="modal-header"><br>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button> 
                        <h3 class="modal-title font" id="exampleModalLongTitle" align="center"  style="font: bold;">Edit Profile</h3><br>
                        <div class="custom-file1" align="right">
                     
                        
                    </div>
                    <div class="modal-body">
                            <div class="row">
                            <div class="col-sm-12" align="center">
                                <div class="profile-images1">
                                
                                    
                                    <img src="<?php echo 'imgStudents/'.$row['imageFile']?> " onclick="showPic(this.src)" id="upload-img" for="fileupload"  >
                                    
                                
						
                                </div>

                  
                                <div class="custom-file">
                                    <label for="fileupload" class="font" style="font: bold;color: darkred;">Upload Profile</label>
                                    <input type="file" id="fileupload" name="profile" value="profile">
                                </div>
                            
                                </div>      
                            </div>
                            <div class="row">
                            <div class="col-sm-6" align="left">
                                <div class="form-group " >
                                    <div>
                                        <label for="usr" class="font" style="font: bold;">ชื่อผู้ใช้
                                        </label></div> 
                                        <?php
                                            echo "<input type='text' id='studentUserprofileID' class='form-control font' size='20px' name='studentUserprofileID' value='$row[1]' disabled='disabled'>";
                                            ?>
                                    </div>
                                </div>      
                            </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                        <div>
                                        <label for="usr" class="font" style="font: bold;" >ชื่อ
                                        </label></div> 
                                        
                                        <?php
                                            echo "<input type='text' id='firstnameTH' class='form-control font' size='20px' name='firstnameTH' value='$row[4]'>";
                                            ?>
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group" align="left">
                                    <div>
                                        <label for="usr" class="font" style="font: bold;">นามสกุล
                                        </label></div> 
                                        
                                        <?php
                                            echo "<input type='text' id='lastnameTH' class='form-control font' size='20px' name='lastnameTH'  value='$row[5]'>";
                                        ?>
                                </div>
                            </div>      
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                        <div>
                                        <label for="usr" class="font" style="font: bold;">Firstname
                                        </label></div> 
                                        
                                        <?php
                                            echo "<input type='text' id='firstnameEN' class='form-control font' size='20px' name='firstnameEN'  value='$row[6]' >";
                                            ?>
                                </div>
                            </div>  
                            <div class="col-sm-6">
                                <div class="form-group" align="left">
                                        <div>
                                        <label for="usr" class="font" style="font: bold;">Lastname
                                        </label></div> 
                                    
                                        <?php
                                            echo "<input type='text' id='lastnameEN' class='form-control font' size='20px' name='lastnameEN'  value='$row[7]'>";
                                        ?>
                                </div>
                            </div>                     
                        </div>
                        <div class="row">
                    <div class="col-sm-12" align="left">
                        
                        <h3 class="font" style="font: bold;">ข้อมูลปริญญานิพนธ์</h3>
                    </div>      
                </div>
                <div class="row">
                    <div class="col-sm-12" align="left">
                        <div class="form-group" >
                            <div>
                                <label for="usr" class="font" style="font: bold;">ชื่อปริญญานิพนธ์ (ภาษาไทย)
                                </label></div> 
                                <?php
                                
                                $thesisTH = $row['thesisTitleTH'];
                                echo "<input type='text' id='thesisTH' class='form-control font' size='20px' name='thesisTH'  value='$thesisTH' autocomplete='off'>";
                                ?>
                                
                        </div>
                    </div>      
                </div>
                <div class="row">
                    <div class="col-sm-12" align="left">
                        <div class="form-group" >
                            <div>
                                <label for="usr" class="font" style="font: bold;">ชื่อปริญญานิพนธ์ (ภาษาอังกฤษ)
                                </label></div> 
                                <?php
                                $thesisEN = $row['thesisTitleEN'];
                                echo "<input type='text' id='thesisEN' class='form-control font' size='20px' name='thesisEN'  value='$thesisEN' autocomplete='off'>";
                                ?>
                        </div>
                    </div>      
                </div>
                <div class="row">
                    <div class="col-sm-6" align="left">
                        <div class="form-group" >
                            <div>
                                <label for="usr" class="font" style="font: bold;">กลุ่มวิจัยที่สังกัด
                                </label></div> 
                                

                                <?php
                                $rechearchGr = $row['researchgrAbbrName'];
                                $rechearchGrID = $row['researchgrID'];
                                $sql1 = "SELECT researchgrID,researchgrAbbrName FROM researchgroup  ";
                                $result1 = mysqli_query($researchgroup->connect(), $sql1);
                                ?>
                                <select name="researchgroup" id="researchgroup" style="width: 100%;height:34px;text-align: left;" class="form-control font">
                                    <option id="researchgroup" name="researchgroup" value="<?php echo $rechearchGrID ?>" class="font" style="font-size: 16px;"><?php echo $rechearchGr; ?></option>
                                    <?php while ($row1 = $result1->fetch_row()) { ?>
                                        <option class="font" value="<?php echo ($row1[0]); ?>"><?php echo ($row1[1]); ?></option>
                                    <?php }  ?>
                                </select>

   
                        </div>
                    </div>      
                </div>
                        <div class="row">
                            <div class="col-sm-6" align="left">
                                
                                <h3 class="font" style="font: bold;">ข้อมูลการติดต่อ</h3>
                            </div>      
                        </div>
                        <div class="row">
                            <div class="col-sm-6" align="left">
                                <div class="form-group" >
                                    <div>
                                        <label for="usr" class="font" style="font: bold;">E-mail
                                        </label></div> 
                                    
                                        <?php
                                            echo "<input type='email' id='email' class='form-control font' size='20px' name='email'  value='$row[10]' autocomplete='off'>";
                                        ?>
                                </div>
                            </div>      
                        </div>
                        <div class="row">
                            <div class="col-sm-6" align="left">
                                <div class="form-group" >
                                    <div>
                                        <label for="usr" class="font" style="font: bold;">Tel.
                                        </label></div> 
                                        
                                        <?php
                                            echo "<input type='text' id='tel' class='form-control font' size='20px' name='tel'  value='$row[11]' autocomplete='off'>";
                                        ?>
                                </div>
                            </div>      
                        </div>
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary font" data-dismiss="modal">Close</button>
                        <?php
                            
                        echo "<button class='btn btn-primary font'  id='update' type='submit' name='update' value='' onclick='myFunction()''>Save</button>";
        ?>
                        <!-- <button type="submit" class="btn btn-primary" name="update" id="update">Save</button> -->
                    </div>
                    
                    </div>
                    
                </div>
                </div></form>
                

                <!-- mainprofile -->
                <div class="row">
                    <div class="col-sm-12" align="left">
                        <div class="form-group" >
                            <div >
                                <label for="usr" class="font" style="font: bold;">ชื่อผู้ใช้
                                </label></div> 
                                <img src="img/username (2).png" width="50px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label class="font">&nbsp;<?php echo ($row[1]);?></label></font>
                                
                
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
                                <label for="usr" class="font" style="font: bold;"sizeof="100px">ชื่อ
                                </label></div> 
                                <img src="img/namee.png" width="50px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label class="font"><?php echo ($row[4]);;?></label></font>

                              
                         </div>
                    </div> 
                    <div class="col-sm-4">
                        <div class="form-group" >
                            <div>
                                <label for="usr" class="font" style="font: bold;">นามสกุล
                                </label></div> 
                                <img src="img/namee.png" width="50px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label class="font"><?php echo ($row[5]);;?></label></font>

                               
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
                                <font color="#778899"  id=<?php echo ($row['prenameID'])?>><label><?php echo ($row['prenameEN']);;?></label></font>
                               
                        </div>
                    </div> 
                    <div class="col-sm-4">
                        <div class="form-group">
                                 <div>
                                <label for="usr" class="font" style="font: bold;">Firstname
                                </label></div> 
                                <img src="img/namee.png" width="50px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label class="font"><?php echo ($row[6]);;?></label></font>

                               
                        </div>
                    </div>  
                    <div class="col-sm-4">
                        <div class="form-group" >
                                <div>
                                <label for="usr" class="font" style="font: bold;">Lastname
                                </label></div> 
                                <img src="img/namee.png" width="50px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label class="font"><?php echo ($row[7]);;?></label></font>
                               
                        </div>
                    </div>                     
                </div>
                <div class="row">
                    <div class="col-sm-12" align="left">
                        
                        <h3 class="font" style="font: bold;">ข้อมูลการศึกษา</h3>
                    </div>      
                </div>
                <div class="row">
                    <div class="col-sm-6" align="left">
                        <div class="form-group" >
                            <div>
                                <label for="usr" class="font" style="font: bold;">ระดับการศึกษา
                                </label></div> 
                                <img src="img/edu.png" width="53px" height="48px" alt="">&nbsp;
                                <?php
                                $educationLevel = $row['educationLevel'];
                                echo "<font color='#778899'><label color='#778899' class='font'>".$educationLevel."</label></font>";
                                
                                ?>
                        </div>
                    </div>  
                    <div class="col-sm-6" align="left">
                        <div class="form-group" >
                            <div>
                                <label for="usr" class="font" style="font: bold;">แผนการศึกษา
                                </label></div> 
                                <img src="img/edu.png" width="53px" height="48px" alt="">&nbsp;
                                <?php
                                $academicPlan = $row['academicPlan'];
                                echo "<font color='#778899'><label color='#778899' class='font'>".$academicPlan."</label></font>";
                                
                                ?>
                        </div>
                    </div>         
                </div>
                <div class="row">
                    <div class="col-sm-12" align="left">
                        <div class="form-group" >
                            <div>
                                <label for="usr" class="font" style="font: bold;">หลักสูตรการศึกษา
                                </label></div> 
                                <img src="img/cc.png" width="53px" height="48px" alt="">&nbsp;
                                <?php
                                $curricularTH = $row['curricularTH'];
                                echo "<font color='#778899'><label color='#778899' class='font'>".$curricularTH."</label></font>";
                                
                                ?>
                        </div>
                    </div>  
                </div>
    
                <div class="row">
                    <div class="col-sm-12" align="left">
                        
                        <h3 class="font" style="font: bold;">ข้อมูลปริญญานิพนธ์</h3>
                    </div>      
                </div>
                <div class="row">
                    <div class="col-sm-6" align="left">
                        <div class="form-group" >
                            <div>
                                <label for="usr" class="font" style="font: bold;">ชื่อปริญญานิพนธ์ (ภาษาไทย)
                                </label></div> 
                                <img src="img/thesis.png" width="53px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label class="font"><?php echo ($row['thesisTitleTH']);;?></label></font>
                        </div>
                    </div>      
                </div>
                <div class="row">
                    <div class="col-sm-6" align="left">
                        <div class="form-group" >
                            <div>
                                <label for="usr" class="font" style="font: bold;">ชื่อปริญญานิพนธ์ (ภาษาอังกฤษ)
                                </label></div> 
                                <img src="img/thesis.png" width="50px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label class="font"><?php echo ($row['thesisTitleEN']);;?></label></font>
                        </div>
                    </div>      
                </div>
                <div class="row">
                    <div class="col-sm-12" align="left">
                        <div class="form-group" >
                            <div>
                                <label for="usr" class="font" style="font: bold;">กลุ่มวิจัยที่สังกัด
                                </label></div> 
                                <img src="img/research.png" width="50px" height="48px" alt="">&nbsp;
                                <?php
                                
                                    $rechearchG = $row['researchgrAbbrName'];
                                    echo "<font color='#778899'><label color='#778899' class='font'>".$rechearchG."</label></font>";
                                ?>
                                
                        </div>
                    </div>      
                </div>
                <div class="row">
                    <div class="col-sm-12" align="left">
                        
                        <h3 class="font" style="font: bold;">ข้อมูลการติดต่อ</h3>
                    </div>      
                </div>
                
                <div class="row">
                    <div class="col-sm-12" align="left">
                        <div class="form-group" >
                            <div>
                                <label for="usr" class="font" style="font: bold;">E-mail
                                </label></div> 
                                <img src="img/mail.png" width="53px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label class="font"><?php echo ($row[10]);;?></label></font>
                        </div>
                    </div>      
                </div>
                <div class="row">
                    <div class="col-sm-12" align="left">
                        <div class="form-group" >
                            <div>
                                <label for="usr" class="font" style="font: bold;">Tel.
                                </label></div> 
                                <img src="img/tel.png" width="50px" height="48px" alt="">&nbsp;
                                <font color="#778899"><label class="font"><?php echo ($row[11]);;?></label></font>
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