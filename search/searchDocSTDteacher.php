<?php
session_start();
if(!ISSET($_SESSION['userProID'])){
    header('location:homeTeachers.php');
}
?>
<!DOCTYPE html>
<?php
require_once "./connectDB.php";
$search = $_GET['search'];
if($search != NULL){
    $con = new connectDB();
    if($con->connect()){
        // $sql= "SELECT * from document INNER JOIN documenttype on document.typeID = documenttype.categoryID 
        // WHERE name_category LIKE '%$search%' or name_category LIKE '%$search' or name_category LIKE '$search%' or SumuserProID = $_SESSION[userProID]" ;
        $sql= "SELECT * from document INNER JOIN documenttype on document.typeID = documenttype.categoryID WHERE name_category LIKE '%$search%'  ";
        $objquerry =  mysqli_query($con->connect(),$sql);
        
    }
}
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
                    <a class="navbar-brand" href="homeTeachers.php"><img src="" alt=""></a>
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
                            <a href="homeTeachers.php">จัดการข้อมูล</a>
                        </li>
                        <li>
                            <a href="homeTeachers.php">ติดต่อ</a>
                        </li>
                        <li>
                        <?php
                                $severname ="localhost";
                                $username ="root";
                                $password= "123456";
                                $dbname ="project2";
                            
                                $conn = new mysqli($severname,$username,$password,$dbname);
                
                                $query = mysqli_query($conn, "SELECT * FROM   `userprofile` WHERE `userProID`='$_SESSION[userProID]'");
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
                                <li><a href="index.php">ออกจากระบบ</a></li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="services" class="container-fluid text-center">

            <!-- search -->
            <div class="container">
                <h2 style="color: #e43f5a;">ผลการค้นหา</h2><br>
                <!-- <form action="checkEventDoc.php" method="POST"> -->
            </div>

            <div class="container">

                <div class="row justify-content-end">
                    <form action="checkEventStudentDoc.php" method="POST">
                        <div class="col-12" align="left">
                        </div>
                    </div>
                    <table class="table table-striped" id="example" align="center">
                        <thead>
                            <tr style="font-size: 18px;">
                                <th>ประเภทเอกสาร</th>
                                <th>รายละเอียดเอกสาร</th>
                                <th>วันเวลาที่ส่งเอกสาร</th>
                                <th>ไฟล์เอกสารที่แนบมา</th>

                            </tr>
                        </thead>
                        <tbody align="left">
                            <tr>
                                <?php
                            
                                    while($row= mysqli_fetch_array($objquerry)) {
                                    
                                        echo"<tr><td>".$row['name_category']."</td><td>".$row['details']."</td>"
                                    . "<td>".$row['uploadDatetime']."</td><td><a href=documentStudents/".$row['fileName'].">".$row['fileName']."</a></td></tr>";
                                    }
                            ?>
                            </tr>
                        </tbody>
                    </table><br><br>
                    <!-- <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-12">
                            <div class="form-group">
                                <center>

                                        <button class="glyphicon glyphicon-trash btn btn-info btn-lg " > ลบข้อมูล</button>

                                    <a href="studentAddDoc.php" class="btn btn-info btn-lg">
                                        <span class="glyphicon glyphicon-plus"></span>
                                        เพิ่มข้อมูล
                                    </a>
                                </center>
                            </div>
                        </div>
                    </div> -->

                </form>
            </div>
        </div>
        <footer class="container-fluid text-center">
            <div id="contact" class="container-fluid bg-grey">
                <h2 class="text-center">CONTACT</h2>
                <div class="row">
                    <p>Theeraporn Srisuk</p>
                    <br>
                    <p>Usa Saensen</p>
                </div>
            </div>
        </footer>
    </body>

</html>