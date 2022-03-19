<!DOCTYPE html>
<?php
	session_start();
    include "connectDB.php";
    $conn = new connectDB();
	if(!ISSET($_SESSION['userProID'])){
		header('location:index.php');
	}
?>
<html lang="en">
    <head>
        <!-- Theme Made By www.w3schools.com -->
        <title>KPS-CTRL</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
            <link href="https://fonts.googleapis.com/css2?family=Kanit" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <script>
            $('#carousel_myslide').carousel({
                interval: 3000, // กำหนดให้ slide รายการทุก 3 วินาที
                pause:"hover" // ให้หยุด slide ชั่วคราวเมื่อวางเมาส์อยู่เหนือรายการ มีผลเฉพาะ desktop
                // และเลื่อนอีกครั้งเมื่อลเลื่อนเมาส์ออก กรณืมือถือจะมีผลเมื่อ แตะที่ slide
            });
        </script>
             <script src="/lib/jquery-1.12.2.min.js"></script>
  <script src="/lib/bootstrap.min.js"></script>
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin: auto;
  }
  </style>
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
                    <!-- <a class="navbar-brand" href="#myPage"></a> -->
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right ">
                        <li>
                            <a href="#home">หน้าหลัก</a>
                        </li>
                        <li>
                            <a href="#document">จัดเก็บเอกสาร</a>
                        </li>
                        <li>
                            <a href="#meeting">รายละเอียดการประชุม</a>
                        </li>
                        <li>
                            <a href="#appeal">การร้องเรียน</a>
                        </li>
                        <li>
                            <a href="#contact">ติดต่อ</a>
                        </li>
                        
                        <li>
                        <?php
                                $query = mysqli_query($conn->connect(), "SELECT * FROM   `userprofile` WHERE `userProID`='$_SESSION[userProID]'");
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
<div class="container-fluid">

    <div id="home"class="container-fluid jumbotron text-center">
     <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
        <!-- <li data-target="#myCarousel" data-slide-to="3"></li> -->
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <img src="img/ctrl1.jpg" alt="Chania" width="300px" height="300px">
            </div>     
            <div class="item">
                <img src="img/msu.jpg" alt="Chania" width="300px" height="300px">
            </div>

            <div class="item">
                <img src="img/jj.jfif" alt="Chania" width="300px" height="300px">
            </div>
            
            <!-- <div class="item">
                <img src="img_flower.jpg" alt="Flower" width="460" height="345">
            </div>

            <div class="item">
                <img src="img_flower2.jpg" alt="Flower" width="460" height="345">
            </div> -->
        </div>

        <!-- Left and right controls -->
        <a class="left carousel-control" style="color: white;" href="#myCarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" style="color: white;" href="#myCarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
        </a>
    </div>
</div>


        <div id="document" class="container-fluid text-center">
        <h2>จัดการข้อมูลเอกสาร</h2>
            <br>
            
            <div class="row">
                <div class="col-sm-3" align="center">
                </div>
                <div class="col-sm-3" align="center">
                        <!-- <span class="glyphicon glyphicon-off logo-small"></span> -->
                    <a href="studentAddDoc.php"><img src="img/google-docs.png" width="100px" height="100px"></a>
                    <h4>เอกสารที่เกี่ยวข้องกับวิทยานิพนธ์</h4>
                </div>
                <div class="col-sm-3" align="center">
                    <!-- <span class="glyphicon glyphicon-heart logo-small"></span> -->
                    <a href="showDocSTD.php"><img src="img/google-sheets.png" width="100" height="100"></a>
                    <h4>ตรวจสอบเอกสาร</h4>
                </div>
        </div>

        <div class="container-fluid text-center">
            <div class="row slideanim">
                <img src="img/c1.jpg" alt="" width="1000px" height="500">
            </div>
        </div>

        <div id="meeting" class="container-fluid text-center">
        <h2>รายละเอียดการประชุม</h2>
            <br>

            <div class="row slideanim">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <!-- <span class="glyphicon glyphicon-heart logo-small"></span> -->
                    <a href="./meetingAndAppeal/meettingapproveS.php"><img src="img/conversation.png" width="100" height="100"></a>
                    <h4>เพิ่มข้อมูลการประชุม</h4>
                </div>
                <div class="col-sm-4">
                </div>
            </div>
        </div>
        <div class="container-fluid text-center">
            <div class="row slideanim">
                <img src="img/c2.jpg" alt="">
            </div>
        </div>

        <!-- Container (Pricing Section) -->
        <div id="appeal" class="container-fluid text-center">
        <h2>การร้องเรียน</h2>
            <br>
            <div class="row slideanim">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                    <!-- <span class="glyphicon glyphicon-heart logo-small"></span> -->
                    <a href="./meetingAndAppeal/Hstudentappeal.php"><img src="img/teacher (1).png" width="100" height="100"></a>
                    <h4>ร้องเรียนอาจารย์ที่ปรึกษา</h4>
                </div>
                <div class="col-sm-4">
                </div>
            </div>
        </div>
        <div class="container-fluid text-center">
            <div class="row slideanim">
                <img src="img/c4.jpg" alt="">
            </div>
        </div>
            <br>
        </div>
</div>

        <!-- <footer class="container-fluid bg-gray text-center" id="contact">
                <h2 class="text-center">CONTACT</h2>
                    <p>Theeraporn Srisuk</p>
                    <p>Usa Saensen</p>
        </footer> -->

        
<footer class="text-center text-lg-start bg-light text-muted" style="background-color: rgba(0, 0, 0, 0.05);" id="contact">
  <!-- Section: Social media -->
 
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-5 col-lg-5 col-xl-5 mx-auto mb-4">
          <!-- Content -->
          <div class="me-5 d-none d-lg-block">
            <span>มหาวิทยาลัยมหาสารคาม</span><br>
            <span>คณะวิทยาการสารสนเทศ สาขาวิทยาการคอมพิวเตอร์</span>
         </div>
          <p>
           
          </p>
        </div>
        <div class="col-md-7 col-lg-7 col-xl-7 " align="right">
          <!-- Links -->
          <div class="">
            <span>ติดต่อ</span>
         </div>
          <span>นางสาวธีราภรณ์  ศรีสุข  <br> E-mail: 60011212193@msu.ac.th <br> Tel. 095-3857028</span> <br>
          <span>นางสาวอุษา  แสนเสน  <br> E-mail: 60011212220@msu.ac.th <br> Tel. 082-1134699</span><br>
          <span>อาจารย์ที่ปรึกษา  ผศ.ดร.สมนึก พ่วงพรพิทักษ์</span>
        

        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2021 Copyright: Supervision Control System
    <!-- <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a> -->
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
       
                        


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

    </body>
</html>