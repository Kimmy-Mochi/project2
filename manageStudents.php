<?php
session_start();
if(!ISSET($_SESSION['userProID'])){
    header('location:homeAdminStaff.php');
}
?><!DOCTYPE html>
<?php
        require_once './connectDB.php';
        $con = new connectDB();
        if($con->connect()){
            $row1 = 10;
            $page = $_GET['page'];
            if($page <= 0){
                $page = 1;
            }
            $total_data = "SELECT COUNT(userProID) from userprofile where status='S'";
            $result = mysqli_query($con->connect(),$total_data);
            $total_page = mysqli_fetch_row($result);
            $total_data = $total_page[0];

            $total_page = ceil($total_data/$row1);
            // echo $total_page;
            if($page >= $total_page){
                $page = $total_page;

            }
            $start = ($page-1)* $row1;
            $sql="SELECT * from userprofile where status = 'S' ORDER BY userProID ASC LIMIT $start,$row1";
            $objquerry =  mysqli_query($con->connect(),$sql);
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
        <link rel="stylesheet" href="css/styleProfile.css">
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

        <div id="services" class="container-fluid text-center">
        <div class="profile-images-card1">
            <!-- search -->
            <div class="container">
                <h2 style="color: #1f3c88;">จัดการข้อมูลนักศึกษา</h2><br>
                <form action="" class="search search-form ">
                    <input type="text" placeholder="search" class="search-input " id="myInput" onkeyup="myFunction()" >
                   
                        <i class="fa fa-search"></i>
                   
                </form>
            </div>

            <div class="container">

                <div class="row justify-content-end">
                    <form action="checkEvent.php" method="POST">
                        <div class="col-12" align="left">
                        </div>
                    </div>
                    <table class="table table-striped" id="myTable" align="center">
                        <thead>
                            <tr style="font-size: 18px;">
                                <th>ลบ</th>
                                <th>แก้ไข</th>
                                <th>รหัสนักศึกษา</th>
                                <th>ชื่อ</th>
                                <th>นามสกุล</th>
                            </tr>
                        </thead>
                        <tbody align="left">
                            <tr>
                                <?php

                                    while($row= mysqli_fetch_array($objquerry)) {
                                    
                                    

                                        echo"<tr><td><input type='checkbox' name='checkbox[]' value='".$row['userProID']."'</td>"
                                        . "<td><a href=editStudents.php?id=".$row['userProID']." class='btn btn-warning a-btn-slide-text'>
                                        <span class='glyphicon glyphicon-edit' aria-hidden='true'></span>
                                        <span><strong>Edit</strong></span></a></td><td><a href=ShowDataStudent.php?id=".$row['userProID'].">".$row['userProID']."</td>"
                                    . "<td>".$row['firstNameTH']."</td><td>".$row['lastNameTH']."</td></tr>";
                                    }
                            ?>
                            </tr>
                        </tbody>
                    </table><br>
                    <nav aria-label="Page navigation example" align="right">
                    <ul class="pagination">
                        <li <?php if($page==1) echo 'class=""';?>>
                        <a class="page-link" href="manageStudents.php?page=<?=$page-1?>">Previous</a>
                        </li>

                        <?php for($i=1;$i<=$total_page;$i++) {?>
                        <li <?php if($page == 1) echo 'class="action"';?>>
                        <a class="page-link" href="manageStudents.php?page=<?=$i?>"><?=$i ?></a></li>
                        
                        <?php } ?>

                        <li <?php if($page==$total_page ) echo 'class=""';?>>
                        <a class="page-link" href="manageStudents.php?page=<?=$page+1?>">Next</a></li>
                    </ul>
                    </nav><br>

                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-12">
                            <div class="form-group">
                                <center>

                                    <button class="glyphicon glyphicon-trash btn btn-danger btn-lg"  onclick="if (!confirm('คุณต้องการลบข้อมูลใช่หรือไม่?')) { return false }"><font class="font"> ลบข้อมูล</font></button>

                                    <a href="insertStudents.php" class="btn btn-info btn-lg">
                                        <span class="glyphicon glyphicon-plus"></span>
                                        เพิ่มข้อมูล
                                    </a>
                                    
                                </center>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
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
        <script>
        function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td");
                if(td.length > 0){ // to avoid th
                    // txtValue = td.textContent || td.innerText;
                    if (td[2].innerText.toUpperCase().indexOf(filter) > -1 || td[3].innerText.toUpperCase().indexOf(filter) > -1 || td[4].innerText.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
        }
        }
        </script>
 

    </body>
</html>