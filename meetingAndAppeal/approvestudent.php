<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title> </title>
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/choose.css">
</head>	
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title></title>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
	<script type="text/javascript">
	function Preview(ele) {
	$('#img').attr('src', ele.value);
	if (ele.files && ele.files[0]) {
	var reader = new FileReader();
	reader.onload = function (e) {
		$('#img').attr('src', e.target.result);
	}
	reader.readAsDataURL(ele.files[0]);
	}
	}
	</script>
<body>
<body>
	
	<div class="limiter" >
	<div class="container-login100">
	<div class="wrap-login100 p-t-50 p-b-90">
	<form name="useraddinfo" class="login100-form validate-form flex-sb flex-w" action="insertapprovestudent.php" method="POST" enctype="multipart/form-data">
	<span class="login100-form-title p-b-51">
	MettingApprove
	</span>
	<span class="login100-form-title p-b-51">
	</span>

		
  <div class="wrap-input100 validate-input m-b-16">
		<!-- <input class="input100" type="text" cols="10" rows="10" style="font-size: 16px;" name="details" id="details" placeholder="รายละเอียดการประชุม"required> -->
		รายละเอียดการประชุม
		<textarea  name="details" id="details" cols="58"style="background-color:#e6e6e6" rows="11" style="font-size: 16px;" class="form-control prf" required></textarea>
		<span class="focus-input100"></span> 
		</div>
		<!-- <label for="cars">รหัสนักศึกษา:</label> -->
    <!-- <div class="wrap-input100 validate-input m-b-16" > 
    
        <?php
        //   $severname ="localhost";
        //   $username ="root";
        //   $password= "abc123";
        //   $dbname ="project2"; 
        //   $conn = new mysqli($severname,$username,$password,$dbname);
        //   $sql= "SELECT * FROM userprofile  WHERE status ='T' " or die("Error:" . mysqli_error()); 
        //   $result = mysqli_query($conn, $sql); 
		
        //     echo" <select  class='input100' id='datas'name='datas'>";  
        //     while($row = mysqli_fetch_array($result)){  
              
        //       echo"<option value='$row[0]'>".$row["userProID"]."</option>";
        //     }
        //     echo"</select>";
          ?>
            
          

          </div> -->

    
        <div class="wrap-input100 validate-input m-b-16">
		<input class="input100" type="date" name="date0" id="date0" placeholder="วันที่ประชุม" required>
		<span class="focus-input100"></span>
		</div>

		<div class="wrap-input100 validate-input m-b-16">
		<input class="input100" type="time" name="time0" id="time0" placeholder="เวลาที่เริ่มประชุม"required>
		<span class="focus-input100"></span>
		</div>

		<div class="wrap-input100 validate-input m-b-16">
		<input class="input100" type="time" name="time1" id="time1" placeholder="เวลาสิ้นสุดการประชุม"required>
		<span class="focus-input100"></span>
		</div>
        <label for="cars">วิธีการพบ:</label>
		<div class="wrap-input100 validate-input m-b-16">
  
  <select  class="input100" name="cars" id="cars">
    <option value="online">online</option>
    <option value="offline">offline</option>
  </select>
		<span class="focus-input100"></span>
		</div>



		<div class="wrap-input100 validate-input m-b-16">
		<input  type="file"   name="file[]" multiple/>
		<span class="focus-input100"></span>
		</div>
		
		<div class="container-login100-form-btn m-t-17">
		<button name="bteven" onclick="return confirm('ยืนยันการบันทึก')"  class="login100-form-btn" value="Create" onclick="return checkadduser()">
		save

		</button>
		

</body>



	
</body>
</html>