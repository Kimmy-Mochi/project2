<!DOCTYPE html>
<?php
	session_start();
	if(!ISSET($_SESSION['userProID'])){
		header('location:adminManageDocType.php');
	}
?>
<?php
include "connectDB.php";
$conn = new connectDB();
$doctype = new connectDB();

?>
<html>
    <head>
        <script type="text/javascript" src="profile.js"></script>
        <title></title>
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
        <script>
            function myFunction() {
            var txt;
            var r = confirm("คุณต้องการบันทึกข้อมูลใช่หรือไม่");
            if (r == true) {
                window.alert("บันทึกข้อมูลสำเร็จ");
            } else {
                txt = "ยกเลิกการบันทึก!";
            }
            document.getElementById("demo").innerHTML = txt;
            }
        </script>
    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

        <!-- <nav class="navbar navbar-default navbar-fixed-top">
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
                    <a class="navbar-brand" href="#myPage"><img src="" alt=""></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="">หน้าหลัก</a>
                        </li>
                        <li>
                            <a href="">จัดเก็บเอกสาร</a>
                        </li>
                        <li>
                            <a href="">รายละเอียดการประชุม</a>
                        </li>
                        <li>
                            <a href="">การร้องเรียน</a>
                        </li>
                        <li>
                            <a href="">ติดต่อ</a>
                        </li>
                        <li>
                            <a href="">จัดการข้อมูล</a>
                        </li>
                        <li>
                        <?php
             
                                $query = mysqli_query($conn->connect(), "SELECT * FROM   `userprofile` WHERE `userProID`='$_SESSION[userProID]'");
                                $fetch = mysqli_fetch_array($query);
                
                                echo "<a class='text-success'>".$fetch['firstNameTH']."&nbsp;".$fetch['lastNameTH']."</a>";
                            ?>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>
                            <ul class="dropdown-menu" style="background-color:darkblue">
                                <li><a href="#">โปรไฟล์</a></li>
                                <li><a href="#">เปลี่ยนรหัสผ่าน</a></li>
                                <li><a href="#">ออกจากระบบ</a></li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav> -->
        <form action="checkEventDocType.php" method="POST"  name="form1">
        <div id="" class="container text-center " >
            <div class="grid-1 callout primary">
          
                <div class="row">
                        <div class="col-sm-12" align="center">
                            <div>
                                <h2 style="color: #1f3c88;">เพิ่มประเภทเอกสาร</h2>
                                <hr noshade="noshade" width="1200">
                            </div>
                        </div>
                </div>

                <div class="row" align="left">

               
                    <div class="col-sm-12 col-md-4 col-lg-4">                    
                    </div>
                    <div class="col-sm-12 ">
                            <label for="usr">ชื่อประเภทเอกสาร
                            </label>
                            <input name="doctype" id="doctype" cols="10" rows="10" style="font-size: 16px;" class="form-control " placeholder="ชื่อประเภทเอกสาร"required></input>
                            
                    </div>
                </div><br>

                 <div class="row">
                    <div class="col-sm-12 col-md-4 col-lg-12" >
                        <div class="form-group">
                            <center>
                                <?php
                                
                                echo "<button class='glyphicon glyphicon-floppy-save btn btn-info btn-lg'  type='submit' name='submit' value='Insert' >บันทึกข้อมูล</button>";
            ?>
                                <!-- <input type="submit" class="btn btn-danger" style="font-size:24px" name="submit" value="บันทึก"></input> -->
                                <!-- <i class="fa fa-save" align="center"></i> -->
                            </center>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        </form>

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