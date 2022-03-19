<!DOCTYPE html>
<?php
	session_start();
	if(!ISSET($_SESSION['userProID'])){
		header('location:homeAdminStaff.php');
	}
?>
<?php
        require_once './connectDB.php';
        $con = new connectDB();
        if($con->connect()){
            $row1 = 10;
            $page = $_GET['page'];
            if($page <= 0){
                $page = 1;
            }
            $total_data = "SELECT COUNT(categoryID) from documenttype";
            $result = mysqli_query($con->connect(),$total_data);
            $total_page = mysqli_fetch_row($result);
            $total_data = $total_page[0];

            $total_page = ceil($total_data/$row1);
            // echo $total_page;
            if($page >= $total_page){
                $page = $total_page;

            }
            $start = ($page-1)* $row1;

            $sql="SELECT * from documenttype ORDER BY categoryID ASC LIMIT $start,$row1 ";
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
        <script type="text/javascript" src="js/pagination.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <link
            rel="stylesheet"
            href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
        <script>
            function myFunction() {
            var txt;
            var r = confirm("คุณต้องการบันทึกข้อมูลใช่หรือไม่");
            if (r == true) {
                txt = "บันทึก!";
            } else {
                txt = "ยกเลิกการบันทึก!";
            }
            document.getElementById("demo").innerHTML = txt;
            }
        </script>
        <script>
            $(document).ready(function () {
                $('#example').DataTable({
                    "pageLength": 10, //จำนวนข้อมูลที่ให้แสดง ต่อ 1 หน้า
                    "searching": false, //เปิด=true ปิด=false ช่องค้นหาครอบจักรวาล
                    "lengthChange": false, //เปิด=true ปิด=false ช่องปรับขนาดการแสดงผล
                });
            });
        </script>
        <script type="text/javascript">
        function js_popup(theURL,width,height) { //v2.0  ฟังก์ชั่น windows popup สถานะรถ
            leftpos = (screen.availWidth - width) / 2;
                toppos = (screen.availHeight - height) / 2;
            window.open(theURL, "viewdetails","width=" + width + ",height=" + height + ",left=" + leftpos + ",top=" + toppos);
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
                    <!-- <a class="navbar-brand" href="#myPage"><img src="" alt=""></a> -->
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
                <h2 style="color: #1f3c88;">จัดการประเภทเอกสาร</h2><br>
                <!-- <form action="searchDoctype.php" class="search search-form " method="GET">
                    <input type="search" placeholder="search" class="search-input" name="search">
                    <a href="searchDoctype.php">
                        <i class="fa fa-search"></i>
                    </a>
                </form> -->
                <form action="" class="search search-form ">
                    <input type="text" placeholder="search" class="search-input " id="myInput" onkeyup="myFunction()" >
                   
                        <i class="fa fa-search"></i>
                   
                </form>
            </div>

            <div class="container">

                <div class="row justify-content-end">
                    <form action="checkEventDocType.php" method="POST">
                        <div class="col-12" align="left">
                        </div>
                    </div>
                    <table id="myTable" class="table table-striped " cellspacing="0" width="100%">
                        <thead>
                            <tr style="font-size: 18px;">
                                <th>ลบ</th>
                                <th>ประเภทเอกสาร</th>
                            </tr>
                        </thead>
                        <tbody align="left">
                            <tr>
                                <?php
                    
                                    while($row= mysqli_fetch_array($objquerry)) {
                                    
                                        echo"<tr><td><input type='checkbox' name='checkbox[]' value='".$row['categoryID']."'</td>"
                                        . "<td>".$row['name_category']."</td></tr>";
                                    }
                            ?>
                            </tr>
                        </tbody>
                    </table><br>
                    <nav aria-label="Page navigation example" align="right"> 
                    <ul class="pagination">
                        <li <?php if($page==1) echo 'class=""';?>>
                        <a class="page-link" href="adminManageDocType.php?page=<?=$page-1?>" >Previous</a>
                        </li>

                        <?php for($i=1;$i<=$total_page;$i++) {?>
                        <li <?php if($page == 1) echo 'class="action"';?>>
                        <a class="page-link" href="adminManageDocType.php?page=<?=$i?>"><?=$i ?></a></li>
                        
                        <?php } ?>

                        <li <?php if($page==$total_page ) echo 'class=""';?>>
                        <a class="page-link" href="adminManageDocType.php?page=<?=$page+1?>">Next</a></li>
                    </ul>
                    </nav><br>
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-12">
                            <div class="form-group">
                                <center>

                                        <button class="glyphicon glyphicon-trash btn btn-danger btn-lg "  onclick="if (!confirm('คุณต้องการลบข้อมูลใช่หรือไม่?')) { return false }"><font class="font"> ลบข้อมูล</font> </button>
                                        <i class="btn btn-info btn-lg "><label for="editprofile" class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#exampleModalLong"><font class="font"> เพิ่มข้อมูล</font></label></i>

                                    <!-- <a  class="btn btn-info btn-lg " onclick="js_popup('adminAddDoctype.php',600,470); return false;">
                                        <span class="glyphicon glyphicon-plus"></span>
                                        เพิ่มข้อมูล
                                    </a> -->
                                </center>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <!-- ===========================================================popup==================================================================================== -->
                
        <form action="checkEventDocType.php" method="post"  enctype="multipart/form-data">
                <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    
                    <div class="modal-header"><br>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="row">
                            <div class="col-sm-12" align="center">
                                <div>
                                    <h2 style="color: #1f3c88;">เพิ่มประเภทเอกสาร</h2>
                                    <!-- <hr noshade="noshade" width="100"> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                   

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
                                        
                                        echo "<button class='glyphicon glyphicon-floppy-save btn btn-info btn-lg'  type='submit' name='submit' value='Insert' onclick='myFunction()'><font class='font'>บันทึกข้อมูล</font</button>";
                    ?>
                                        <!-- <input type="submit" class="btn btn-danger" style="font-size:24px" name="submit" value="บันทึก"></input> -->
                                        <!-- <i class="fa fa-save" align="center"></i> -->
                                    </center>
                                </div>
                            </div>
                        </div>
                </div>
                </form>

    <script>
            $(function(){
                $("#fileupload").change(function(event) {
                    var x = URL.createObjectURL(event.target.files[0]);
                    $("#upload-img").attr("src",x);
                    console.log(event);
                });
            })
        </script>

        <script>
            function showPic(newsrc){
            mainpic=document.getElementById("main");
            mainpic.src=newsrc;
            }
        </script>

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
                    if (td[1].innerText.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
        }
        }
        </script>
              <!-- <script type="text/javascript">
$(function(){
      
     $(".btn-confirm").on("click",function(){        
        var obj = $(this); // อ้างอิงปุ่ม
        obj.parents("tr").toggleClass("table-danger"); // เปลี่ยนสีพื้นหลังแถวที่จะลบ
        // ถ้ามีการกำหนด title ใช้ข้อความใน title มาข้นแจ้ง ถ้าไม่มีใช้ค่าที่กำหนด "ลบรายการข้อมูล"
         var alertMsg = (obj.attr("title")!=undefined)?obj.attr("title"):"ลบรายการข้อมูล";
         setTimeout(function(){ // หน่วงเวลาเพื่อให้ การกำหนดสีพืนหลังแถวทำงานได้
             if(!confirm("ยืนยันการทำรายการ "+alertMsg+" ?")){
                    obj.parents("tr").toggleClass("table-danger"); // ไม่ยืนยันการลบ เปลี่ยนสีพื้นหลังกลับ
             }else{
                    window.location = obj.attr("href"); // ถ้ายืนยันการลบ ก็ให้ลิ้งค์ทำงาน
             }
         },100); // หน่วงเวลา 100 มิลลิวินาที
         return false; // ไม่ให้ลิ้งค์ทำงานปกติ ให้เข้าไปในเงื่อนไข confirm แทน
     });
      
});
</script> -->
</html>