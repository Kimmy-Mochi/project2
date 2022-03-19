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
$sid = $_REQUEST['id'];
$userPro = $sID;
$sql2 = mysqli_query($con->connect(),"SELECT * FROM userprofile where userProID='$sid'");
$fetch = mysqli_fetch_array($sql2);
$row= mysqli_num_rows($sql2);
$ssid = $fetch['userProID'];
echo $ssid;

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
        </nav>
    
        <div id="" class="container text-center " >
       
            <div class="grid-1 callout primary">
            <form action="checkEventAdvisory.php?id=<?php echo $ssid; ?>" method="POST" enctype="multipart/form-data" name="form1">
                <div class="container"><br><br>
                        <div class="col-12" align="center">
                            <div>
                                <h2 style="color: #1f3c88;">การให้คำปรึกษาวิทยานิพนธ์</h2>
                                <hr noshade="noshade" width="1200"></hr>
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
                    
						$sql2 = mysqli_query($con->connect(),"SELECT * FROM userprofile where userProID='$sid'");
                        $fetch = mysqli_fetch_array($sql2);
                        $ssid = $fetch['userProID'];
                        echo "<input type='text' id='sID' class='form-control font' size='20px' name='sID' value='$ssid' disabled>";
						// $result2 = mysqli_query($doctype->connect(), $sql2);
						?>
                         
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">                    
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="usr" >ชื่ออาจารย์
                            </label>
                            
							<?php
						$sql2 = "SELECT * FROM userprofile where status='T' ";
						$result2 = mysqli_query($doctype->connect(), $sql2);
						?>
                        <select name="tID" id="tID" class="selectpicker form-control" data-show-subtext="true" data-live-search="true" style="width: 100%;height:34px;text-align: left;">
                            <option id="tID" name="tID" value="" style="font-size: 16px;">- เลือกชื่ออาจารย์ -</option>
                            <?php while ($row2 = $result2->fetch_row()) { ?>
                                    <option value="<?php echo ($row2[0]); ?>"><?php echo ($row2[4] ."&nbsp;" . $row2[5]) ; ?></option>
                            <?php } ?>
                        </select>
                         
                     
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">                    
                        </div>
                    <div class="col-sm-12 col-md-6 col-lg-6" >
                    <label for="usr" >สถานะการเป็นที่ปรึกษา
                            </label>
                            <div class="form-check">
                                <div>
                                    <input class="form-check-input" type="radio" value="M" name="mainOrco" > อาจารย์ที่ปรึกษาหลัก</input>
                                </div>
                                <div>
                                    <input class="form-check-input" type="radio" value="J" name="mainOrco" > อาจารย์ที่ปรึกษาร่วม</input>
                                </div>
                                    
                            </div>
                        
                    </div>
                </div><br>
                <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-4">                    
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="usr" >ประเภทเอกสาร
                            </label>
                            
							<?php
                            
                        $sql2 = mysqli_query($con->connect(),"SELECT * FROM documenttype where categoryID='2' ");
                        $fetch = mysqli_fetch_array($sql2);
                        $tyid = $fetch['name_category'];
                        $ttid = $fetch['categoryID'];
                        echo "<input type='text' id='doctype' class='form-control font' size='20px' name='doctype' value='$tyid' disabled>";
						?>
                    </div>
                </div><br>
                <div class="row">
                     <div class="col-sm-12 col-md-4 col-lg-4">                    
                        </div>
                    <div class="col-sm-12 col-md-4 col-lg-4" >
                    <label for="usr" align="left">ไฟล์เอกสารการอนุมัติการแต่งตั้งที่ปรึกษา
                            </label>
                        <center>
                        <i class=""><input type="file" id="filename" name="filename[]" multiple="multiple"></i>
                        </center>
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
                     <div class="col-sm-12 col-md-4 col-lg-6" align="right">
                            <div class="form-group" >
                            

                                      
                                     <a href="showAdvisory.php" class="btn btn-success btn-lg font">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-border-style" viewBox="0 0 16 16">
  <path d="M1 3.5a.5.5 0 0 1 .5-.5h13a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-1zm0 4a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-1zm0 4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm8 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-4 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm8 0a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1zm-4-4a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-5a.5.5 0 0 1-.5-.5v-1z"/>
</svg>
                                        แสดงข้อมูล
                                        
                                    </a>
                            </div>
                        </div>
                    <div class="col-sm-12 col-md-4 col-lg-6"  align="left">
                        <div class="form-group">
                            
                                
                                
                                <button class="glyphicon glyphicon-floppy-save btn btn-info btn-lg"  type="submit" id="submit" name="submit" value="submit" onclick="myFunction()" ><font class="font"> บันทึกข้อมูล</font></button>
            
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