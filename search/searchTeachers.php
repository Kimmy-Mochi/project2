<?php
session_start();
if(!ISSET($_SESSION['userProID'])){
    header('location:homeAdminStaff.php');
}
?>
<!DOCTYPE html>
<?php
require_once "./connectDB.php";
$search = $_GET['search'];
if($search != NULL){
    $con = new connectDB();
    if($con->connect()){
        $sql="SELECT username,firstNameTH,lastNameTH from userprofile where username LIKE '%$search%' or username LIKE '%$search' or username LIKE '$search%' 
        or firstNameTH LIKE '%$search%'  or firstNameTH LIKE '%$search'  or firstNameTH LIKE '$search%' 
        or lastNameTH LIKE '%$search%' or lastNameTH LIKE '%$search' or lastNameTH LIKE '$search%' AND status='T'" ;
        $objquerry =  mysqli_query($con->connect(),$sql);
        echo $sql;
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
                    <a class="navbar-brand" href="#myPage"><img src="" alt=""></a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="">????????????????????????</a>
                        </li>
                        <li>
                            <a href="">???????????????????????????????????????</a>
                        </li>
                        <li>
                            <a href="">?????????????????????????????????????????????????????????</a>
                        </li>
                        <li>
                            <a href="">????????????????????????????????????</a>
                        </li>
                        <li>
                            <a href="">????????????????????????????????????</a>
                        </li>
                        <li>
                            <a href="">??????????????????</a>
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
                                <li><a href="#">?????????????????????</a></li>
                                <li><a href="#">?????????????????????????????????????????????</a></li>
                                <li><a href="index.php">??????????????????????????????</a></li>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div id="services" class="container-fluid text-center">

            <!-- search -->
            <div class="container">
                <h2 style="color: #e43f5a;">??????????????????????????????</h2><br>
            </div>
            <div class="container">
                <table class="table table-striped" id="" align="center">
                    <thead>
                        <tr style="font-size: 18px;" >
                            <th>??????????????????????????????</th>
                            <th>????????????</th>
                            <th>?????????????????????</th>
                        </tr>
                    </thead>
                    <tbody align="left">
                        <tr>
                            <?php
            while($row= mysqli_fetch_array($objquerry)) {
                echo "<tr><td><a href=ShowDataTeacher.php?id=".$row['userProID'].">".$row['username'], "</td><td><a href=ShowDataTeacher.php?id=".$row['userProID'].">".$row['firstNameTH'],"</td><td>".$row['lastNameTH'],"</td></tr>";

                // echo "<td><a href=".$row['studentID'].">".$row['studentID']."</td>"
                // ."<td><a href=".$row['firstNameTH'].">".$row['firstNameTH']."</td>"
                // ."<td><a href=".$row['lastNameTH'].">".$row['lastNameTH']."</td>";
            }
      ?>
                        </tr>
                    </tbody>
                </table>

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