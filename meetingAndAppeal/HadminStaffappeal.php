<?php
	session_start();
?>
<?php 
    $connect = new mysqli('localhost', 'root', 'abc123', 'project2');
    $ID = $_GET['id'];
    if ($connect->connect_error) {
        die("Something wrong.: " . $connect->connect_error);
      }

    $sql =( "SELECT * FROM studentappeal
     INNER JOIN students  ON  studentappeal.studentID = students.studentID 
     INNER JOIN invigilation ON  students.studentID = invigilation.studentID INNER JOIN teachers  ON  invigilation.teacherID = teachers.teacherID 
     ")or die(mysqli_error());
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
                    <a class="navbar-brand" href="#myPage"><img src="" alt=""></a>
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
                                $severname ="localhost";
                                $username ="root";
                                $password= "abc123";
                                $dbname ="project2";
                            
                                $conn = new mysqli($severname,$username,$password,$dbname);
                
                                $query = mysqli_query($conn, "SELECT * FROM   `userprofile` WHERE `userProID`='$_SESSION[userProID]'") or die(mysqli_error());
                                $fetch = mysqli_fetch_array($query);
                                
                                // $s= $fetch['`userProID'];
                                // echo $s;
                
                                echo "<a class='text-success'>".$fetch['firstNameTH']."&nbsp;".$fetch['lastNameTH']."</a>";
                            ?>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span class="glyphicon glyphicon-user"></span>
                            <ul class="dropdown-menu" style="background-color:darkblue">
                            <li><a href="../ProfileAdmin.php">โปรไฟล์</a></li>
                                <li><a href="../changePasswordAdmin.php">เปลี่ยนรหัสผ่าน</a></li>
                                <li><a href="../index.php">ออกจากระบบ</a></li>>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
      
        <div id="services" class="container-fluid text-center">

           
            <div class="container">
                <h2 style="color: #1f3c88;">รายละเอียดการร้องเรียนของนิสิต</h2><br>
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
                             
                
                                $query = mysqli_query($conn, "SELECT * FROM  `userprofile` WHERE `userProID`='$row[SuserProID]'") or die(mysqli_error());
                                $fetch = mysqli_fetch_array($query);
                                $query1 = mysqli_query($conn, "SELECT * FROM  userprofile   INNER JOIN teachers  ON userprofile.userProID = teachers.TuserProID 
                                INNER JOIN advisory  ON  advisory.TuserProID = teachers.TuserProID 
                                INNER JOIN students  ON  students.SuserProID = advisory.SuserProID 
                                WHERE students.SuserProID ='$row[SuserProID]'") or die(mysqli_error());
                                $fetch1 = mysqli_fetch_array($query1);

                                $query2 = mysqli_query($conn, "SELECT * FROM studentappealfiles INNER JOIN studentappeal  ON studentappeal.sAppealID = studentappealfiles.sAppealID 
                                 WHERE  studentappealfiles.sAppealID  = '$row[sAppealID]' ") or die(mysqli_error());



                                $query3 = mysqli_query($conn, "SELECT * FROM studentappealfiles INNER JOIN studentappeal  ON studentappeal.sAppealID = studentappealfiles.sAppealID 
                                 WHERE  studentappealfiles.sAppealID  = '$row[sAppealID]' ") or die(mysqli_error());
                                $row3= mysqli_fetch_array($query3);
                                 
                                 ?>  
                                        <td><?php echo $fetch1['firstNameTH']."&nbsp;".$fetch1['lastNameTH'];?></td>  
                                        <td><?php echo $fetch['firstNameTH']."&nbsp;".$fetch['lastNameTH'];?></td>  
                                        <td><?php echo $row['details'];?></td> 
                                        <td><?php echo $row['datetime']; ?></td> 
                                         
                                        <td><?php  while($row1= mysqli_fetch_array($query2)){ 
                                            echo "<a  href=uploads/".$row1['sAppealFiles'].">".$row1['sAppealFiles']."</a> &nbsp;</br>";
                                             }  ?>
                                            
                                            </td>   
                                            <td><?php echo $row['appealResults']; ?></td>
                                              <td><?php echo $row['dateResult']; ?></td> 


                                              <td><?php  echo "<a  href=uploads/".$row3['sAppealResultFiles'].">".$row3['sAppealResultFiles']."</a> &nbsp;</br>"; ?></td> 
                                              
                                     
                                        
                                  
                                        <td><a href="insertappealT.php?id=<?php echo $row['sAppealID']; ?>"   style="background-color:#10d25d"  class="btn btn-info btn-lg">
                                        details
                                    </a></td> 

                                    <!-- <td><a href="approvestudent.php" style="background-color:#fb2c45" class="btn btn-info btn-lg">
                                        
                                            ลบ
                                    </a></td>  -->
                                    <!-- <br/> -->
                                      
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