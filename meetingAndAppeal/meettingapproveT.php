<?php
	session_start();
	if(!ISSET($_SESSION['userProID'])){
		header('location:index.php');
	}
?>
<?php 

$connect = new mysqli('localhost', 'root', 'abc123', 'project2');
    // $connect = new mysqli('localhost', 'id16923734_root', 'c6RVG|6-^J|}qR#+', 'id16923734_project2');
    require_once '../connectDB.php';
    $conn = new connectDB();
    $ID = $_GET['id'];
    if ($connect->connect_error) {
        die("Something wrong.: " . $connect->connect_error);
      }


    
    $sql =( "SELECT * FROM  meettingapprove INNER JOIN students  ON  meettingapprove.MuserProID = students.SuserProID
    INNER JOIN advisory  ON  students.SuserProID = advisory.SuserProID INNER JOIN teachers  ON  advisory.TuserProID= teachers.TuserProID
    WHERE advisory.TuserProID = '$ID'  and advisoryStatus = 'M'")or die(mysqli_error($connect));
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
                    "pageLength": 10, //??????????????????????????????????????????????????????????????? ????????? 1 ????????????
                    "searching": false, //????????????=true ?????????=false ????????????????????????????????????????????????????????????
                    "lengthChange": false, //????????????=true ?????????=false ???????????????????????????????????????????????????????????????
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
                            <a href="../homeTeachers.php">????????????????????????</a>
                        </li>
                        <li>
                            <a href="../homeTeachers.php?#document">???????????????????????????????????????</a>
                        </li>
                        <li>
                            <a href="../homeTeachers.php?#meeting">?????????????????????????????????????????????????????????</a>
                        </li>
                        <li>
                            <a href="../homeTeachers.php?#appeal">????????????????????????????????????</a>
                        </li>
                        <!-- <li>
                            <a href="../homeAdminStaff.php?#data">??????????????????????????????????????????????????????????????????</a>
                        </li> -->
                        <li>
                            <a href="../homeTeachers.php?#contact">??????????????????</a>
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

                                <li><a href="../ProfileTeachers.php">?????????????????????</a></li>
                                <li><a href="../changePasswordTeacher.php">?????????????????????????????????????????????</a></li>
                                <li><a href="../index.php">??????????????????????????????</a></li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <td><?php echo $row['firstNameTH']; ?></td>  
        <div id="services" class="container-fluid text-center">

           
            <div class="container">
                <h2 style="color: #1f3c88;">?????????????????????????????????????????????????????????</h2><br>
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
                                
                                <th>?????????????????????</th>
                                <th>????????????????????????</th>
                                <th>?????????????????????????????????????????????????????????</th>
                                <th>????????????????????????????????????</th>
                                <th>??????????????????????????????????????????????????????</th>
                                <th>????????????????????????????????????????????????????????????</th>
                                <th>???????????????????????????</th>
                                <th>???????????????????????????????????????????????????????????????????????????????????????</th>
                                <th>???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</th>
                                <th>??????????????????????????????</th>
                                <th>??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????</th>
                
                               
                                
                            </tr>
                        </thead>
                        <tbody align="left">
                            <tr>
                                
                                <?php while($row = $result->fetch_assoc()): ?>
                                    <tr>
                                    <?php
                             
                
                                $query = mysqli_query($conn->connect(), "SELECT * FROM  `userprofile` WHERE `userProID`='$row[TuserProID]'") or die(mysqli_error($conn->connect()));
                                $fetch = mysqli_fetch_array($query);
                               
                               
                                 ?>  
                                 
                                       <td><?php echo $fetch['firstNameTH']."&nbsp;".$fetch['lastNameTH'];?></td> 
                                                                
                                        <td><?php echo $row['SuserProID'];?></td>  
                                        <td><?php echo $row['details'];?></td> 
                                        <td><?php echo $row['date']; ?></td>                                                       
                                        <td> <?php echo $row['startTime'];?></td> 
                                        <td><?php echo $row['endTime'];?></td>  
                                        <td><?php echo $row['onlineOrOffline'];?></td> 
                                        
                                        <td><?php echo $row['teacherComments'];?></td> 
                                        <td><?php echo $row['approvedDateTime'];?></td> 
                                        <td><?php echo $row['approve'];?></td> 
                                        <td><?php echo $row['teacherRejectComments'];?></td> 
                                   

                                        
                                  
                                        <td><a href="updatemeetteachers.php?id=<?php echo $row['meetID']; ?>"   style="background-color:#10d25d"  class="btn btn-info btn-lg">
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

                                      

                                    <!-- <a href="approvestudent.php" class="btn btn-info btn-lg">
                                        <span class="glyphicon glyphicon-plus"></span>
                                        ?????????????????????????????????
                                    </a> -->
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