<?php
	session_start();
?>
<?php 
    $connect = new mysqli('localhost', 'root', 'abc123', 'project2');
    require_once '../connectDB.php';
    $conn = new connectDB();
    if ($connect->connect_error) {
        die("Something wrong.: " . $connect->connect_error);
      }


    $sql1 =( "SELECT * FROM  teacherappeal INNER JOIN students  ON teacherappeal.studentID = students.SuserProID 
    INNER JOIN invigilation ON    invigilation.studentID = students.studentID INNER JOIN teachers  ON  invigilation.teacherID = teachers.teacherID 
   ")or die(mysqli_error($connect));
   $result1= $connect->query($sql1);


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
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                    <li>
                            <a href="../homeAdminStaff.php">หน้าหลัก</a>
                        </li>
                        <li>
                            <a href="../homeAdminStaff.php?#document">จัดเก็บเอกสาร</a>
                        </li>
                        <li>
                            <a href="../homeAdminStaff.php?#meeting">รายละเอียดการประชุม</a>
                        </li>
                        <li>
                            <a href="../homeAdminStaff.php?#appeal">การร้องเรียน</a>
                        </li>
                        <li>
                            <a href="../homeAdminStaff.php?#data">จัดการข้อมูลผู้ใช้ระบบ</a>
                        </li>
                        <li>
                            <a href="../homeAdminStaff.php?#contact">ติดต่อ</a>
                        </li>
                        <li>
                        <?php
                 
                
                                $query = mysqli_query($conn->connect(), "SELECT * FROM   `userprofile` WHERE `userProID`='$_SESSION[userProID]'");
                                $fetch = mysqli_fetch_array($query);
                
                                echo "<a href='../ProfileAdmin.php' class='text-success'>".$fetch['firstNameTH']."&nbsp;".$fetch['lastNameTH']."</a>";
                            ?>
                        </li>
                       
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>
                            <ul class="dropdown-menu" style="background-color:darkblue">
                                <li><a href="../ProfileAdmin.php">โปรไฟล์</a></li>
                                <li><a href="../changePasswordAdmin.php">เปลี่ยนรหัสผ่าน</a></li>
                                <li><a href="../index.php">ออกจากระบบ</a></li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <td><?php echo $row['firstNameTH']; ?></td>  
        <div id="services" class="container-fluid text-center">

           
            <div class="container">
                <h2 style="color: #1f3c88;">รายละเอียดการร้องเรียนของอาจารย์</h2><br>
    
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
                                
                              
                                <?php while($row5 = $result1->fetch_assoc()): ?>
                                    <tr>
                                    <?php
                             


                             $query8 = mysqli_query($conn->connect(), "SELECT * FROM  teacherappeal  WHERE  teacherappeal.tAppealID  = '$row5[tAppealID]'") or die(mysqli_error($conn->connect()));
                                $fetch8 = mysqli_fetch_array($query8);
                                
                                $query = mysqli_query($conn->connect(), "SELECT * FROM  `userprofile` INNER JOIN teachers  ON  teachers.TuserProID =userprofile.userProID
                                 INNER JOIN teacherappeal ON teacherappeal.teacherID = teachers.teacherID WHERE teachers.teacherID ='$fetch8[teacherID]'  ") or die(mysqli_error($conn->connect()));
                                $fetch = mysqli_fetch_array($query);

                                $query1 = mysqli_query($conn->connect(), "SELECT * FROM  `userprofile` WHERE `userProID`='$fetch8[studentID]'") or die(mysqli_error($conn->connect()));
                                $fetch1 = mysqli_fetch_array($query1);
                                

                                 $query2 = mysqli_query($conn->connect(), "SELECT * FROM teacherappealfiles INNER JOIN teacherappeal  ON teacherappeal.tAppealID = teacherappealfiles.tAppealID 
                                 WHERE  teacherappealfiles.tAppealID  = '$row5[tAppealID]' ") or die(mysqli_error($conn->connect()));

                                $query3 = mysqli_query($conn->connect(), "SELECT * FROM teacherappealfiles INNER JOIN teacherappeal  ON teacherappeal.tAppealID = teacherappealfiles.tAppealID 
                                WHERE  teacherappealfiles.tAppealID  = '$row5[tAppealID]' ") or die(mysqli_error($conn->connect()));
                                $row3= mysqli_fetch_array($query3);
                                 ?>  
                                 
                 
                                 <td><?php echo $fetch['firstNameTH']."&nbsp;".$fetch['lastNameTH'];?></td>                               
                                       <td><?php echo $fetch1['firstNameTH']."&nbsp;".$fetch1['lastNameTH'];?></td>  
                                        <td><?php echo $row5['detail'];?></td> 
                                        <td><?php echo $row5['datetime']; ?></td>  


                                        <td><?php  while($row1= mysqli_fetch_array($query2)){ 
                                            echo "<a  href=uploads/".$row1['tAppealFiles'].">".$row1['tAppealFiles']."</a> &nbsp;</br>"; }  ?>
                                            </td>   
                                            <td><?php echo $row5['appealResults']; ?></td>
                                              <td><?php echo $row5['dateResult']; ?></td> 

                                              <td><?php  echo "<a  href=uploads/".$row3['tAppealResultFiles'].">".$row3['tAppealResultFiles']."</a> &nbsp;</br>"; ?></td> 
                                           
                                      

                                              <td><a href="insertappealT1.php?id=<?php echo $row5['tAppealID']; ?>"   style="background-color:#10d25d"  class="btn btn-info btn-lg">
                                        details
                                    </a></td> 
                                  
                                    </tr>
                                <?php endwhile ?>
    
                            </tr>
                        </tbody>
                    </table><br><br>
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-12">
                            <div class="form-group">
                                <center>

                                      

                           
                                </center>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>


    </body>
</html>