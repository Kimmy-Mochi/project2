<?php
	session_start();
	if(!ISSET($_SESSION['userProID'])){
		header('location:index.php');
	}
?>
<?php 
    $connect = new mysqli('localhost', 'id16923734_root', 'c6RVG|6-^J|}qR#+', 'id16923734_project2');
    require_once '../connectDB.php';
    $conn = new connectDB();
    if ($connect->connect_error) {
        die("Something wrong.: " . $connect->connect_error);
      }

      $sql =( "SELECT * FROM  teacherappeal
      INNER JOIN teachers   ON   teacherappeal.teacherID  = teachers.teacherID 
     WHERE teachers.TuserProID = '$_SESSION[userProID]' ")or die(mysqli_error($connect));
     $result = $connect->query($sql);
    



?>
<!DOCTYPE html>

<html lang="en">
    <head>
        <!-- Theme Made By www.w3schools.com -->
        <script type="text/javascript" src="profile.js"></script>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link
            rel="stylesheet"
            href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link
            rel="stylesheet"
            href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
            integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
            crossorigin="anonymous">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script
            src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="css/style.css">
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <link
            rel="stylesheet"
            href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#example').DataTable({
                    "pageLength": 10, //จำนวนข้อมูลที่ให้แสดง ต่อ 1 หน้า
                    "searching": false, //เปิด=true ปิด=false ช่องค้นหาครอบจักรวาล
                    "lengthChange": false, //เปิด=true ปิด=false ช่องปรับขนาดการแสดงผล
                });
            });
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
                    <!-- <a class="navbar-brand" href="homeStudent.php"><img src="" alt=""></a> -->
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="../homeTeachers.php">หน้าหลัก</a>
                        </li>
                        <li>
                            <a href="../homeTeachers.php">จัดเก็บเอกสาร</a>
                        </li>
                        <li>
                            <a href="../homeTeachers.php">รายละเอียดการประชุม</a>
                        </li>
                        <li>
                            <a href="../homeTeachers.php">การร้องเรียน</a>
                        </li>
                        <li>
                            <a href="../homeTeachers.php">ข้อมูลนักศึกษา</a> 
                        </li>
                        <li>
                            <a href="../homeTeachers.php">ติดต่อ</a>
                        </li>
                        
                        <li>
                        <?php
                                $query = mysqli_query($conn->connect(), "SELECT * FROM   `userprofile` WHERE `userProID`='$_SESSION[userProID]'");
                                $fetch = mysqli_fetch_array($query);
                
                                echo "<a href='../ProfileTeachers.php' class='text-success'>".$fetch['firstNameTH']."&nbsp;".$fetch['lastNameTH']."</a>";
                            ?>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>
                            <ul class="dropdown-menu" style="background-color:darkblue">
                                <li><a href="../ProfileTeachers.php">โปรไฟล์</a></li>
                                <li><a href="../changePasswordTeacher.php">เปลี่ยนรหัสผ่าน</a></li>
                                <li><a href="../index.php">ออกจากระบบ</a></li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <td><?php echo $row['firstNameTH']; ?></td>  
        <div id="services" class="container-fluid text-center">

           
            <div class="container">
                <h2 style="color: #1f3c88;">รายละเอียดการร้องเรียน</h2><br>
                <!-- <form action="search.php" class="search search-form " method="GET">
                    <input type="search" placeholder="search" class="search-input" name="search">
                    <a href="search.php">
                        <i class="fa fa-search"></i>
                    </a>
                </form> -->
            </div>


            <div class="container">

                <div class="row justify-content-end">
                    <form action="checkEvent.php" method="POST">
                        <div class="col-12" align="left">
                        </div>
                    </div>
                    <table class="table table-striped" id="example" align="center">
                        <thead>
                            <tr style="font-size: 16px;">
                                
                                <th>อาจารย์</th>
                                <th>นักศึกษา</th>
                                <th>รายละเอียดในการร้องเรียน</th>
                                <th>วันเวลาที่ร้องเรียน</th>
                                <th>ไฟล์การร้องเรียน</th>
                                <th>ผลการร้องเรียน</th>
                                <th>วันเวลาที่บันทึกผลการ</th>
                                <th>ไฟล์ผลการร้องเรียน</th>
                               
                                
                            </tr>
                        </thead>
                        <tbody align="left">
                            <tr>
                                
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr>
                                    <?php
                             
                
                                $query = mysqli_query($conn->connect(), "SELECT * FROM  `userprofile` WHERE `userProID`='$row[TuserProID]'") or die(mysqli_error($conn->connect()));
                                $fetch = mysqli_fetch_array($query);
                                $query1 = mysqli_query($conn->connect(), "SELECT * FROM  `userprofile` WHERE `userProID`='$row[studentID]'") or die(mysqli_error($conn->connect()));
                                $fetch1 = mysqli_fetch_array($query1);
                                

                                 $query2 = mysqli_query($conn->connect(), "SELECT * FROM teacherappealfiles INNER JOIN teacherappeal  ON teacherappeal.tAppealID = teacherappealfiles.tAppealID 
                                 WHERE  teacherappealfiles.tAppealID  = '$row[tAppealID]' ") or die(mysqli_error($conn->connect()));

                                $query3 = mysqli_query($conn->connect(), "SELECT * FROM teacherappealfiles INNER JOIN teacherappeal  ON teacherappeal.tAppealID = teacherappealfiles.tAppealID 
                                WHERE  teacherappealfiles.tAppealID  = '$row[tAppealID]' ") or die(mysqli_error($conn->connect()));
                                $row3= mysqli_fetch_array($query3);
                                 ?>  
                                 
                                       
                                 <td><?php echo $fetch['firstNameTH']."&nbsp;".$fetch['lastNameTH'];?></td>                               
                                       <td><?php echo $fetch1['firstNameTH']."&nbsp;".$fetch1['lastNameTH'];?></td>  
                                        <td><?php echo $row['detail'];?></td> 
                                        <td><?php echo $row['datetime']; ?></td>  


                                        <td><?php  while($row1= mysqli_fetch_array($query2)){ 
                                            echo "<a  href=uploads/".$row1['tAppealFiles'].">".$row1['tAppealFiles']."</a> &nbsp;</br>"; }  ?>
                                            </td>   
                                            <td><?php echo $row['appealResults']; ?></td>
                                              <td><?php echo $row['dateResult']; ?></td> 

                                              <td><?php  echo "<a  href=uploads/".$row3['tAppealResultFiles'].">".$row3['tAppealResultFiles']."</a> &nbsp;</br>"; ?></td> 
                                           
                                      

                                        
                                  
                                    </tr>
                                <?php endwhile ?>
     
    
                            </tr>
                        </tbody>
                    </table><br><br>
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-12">
                            <div class="form-group">
                                <center>

                                      

                                    <a href="INteachersappeal.php" class="btn btn-info btn-lg">
                                        <span class="glyphicon glyphicon-plus"></span>
                                        ร้องเรียน
                                    </a>
                                </center>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>


    </body>
</html>