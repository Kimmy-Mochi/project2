<?php
session_start();
if(!ISSET($_SESSION['userProID'])){
    header('location:homeAdminStaff.php');
}
?>
<?php
error_reporting(E_ALL^E_NOTICE);
require_once './connectDB.php';
$conn = new connectDB();
$ida=$_REQUEST['id'];
// $teacherID = $_POST['teacherID'];
$adminStaffUserID = $_POST['adminStaffUserID'];
$username = $_POST['username'];
$hashedPassword = PASSWORD_HASH($_POST["password"], PASSWORD_DEFAULT);
$prenameID = $_POST['pnameTH'];
$firstNameTH = $_POST['firstnameTH'];
$lastNameTH = $_POST['lastnameTH'];
$firstNameEN = $_POST['firstnameEN'];
$lastNameEN = $_POST['lastnameEN'];
$lineID = $_POST['lineID'];
$email = $_POST['email'];
$phone = $_POST['tel'];
$tokenLine = $_POST['token'];
$adminOrStaff = $_POST['adminOrStaff'];
$submit = $_POST['submit'];
$edit = $_POST['edit'];
$insertAdvis =$_POST['InsertAdvisory'];
$delete = $_POST['delete'];
$obj = new ActionDB();
$chg = $_POST['changePWD'];
//advisory
$SuserProID = $_POST['sID'];
$TuserProID = $_POST['tID'];
$advisoryStatus = $_POST['mainOrco'];

//เปลี่ยนรหัสผ่าน
$currentPassword = $_POST["currentPassword"];
$newPassword = $_POST["newPassword"];
$confirmPassword = $_POST["confirmPassword"];

$date = date("Y-m-d");
//   $fileImage = pathinfo(basename($_FILES["profile"]["name"]) ,PATHINFO_EXTENSION);
//     $new_fileImg = 'imgAdminStaff_'.uniqid().".".$fileImage;
//     $dir = "imgAdminStaff/";
//     $upload_path = $dir.$new_fileImg;
//     $upload_img = move_uploaded_file($_FILES['profile']['tmp_name'],$upload_path);
//     $filetype = $_FILES["profile"]["type"];
//     $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
//     $imgExt = strtolower(pathinfo($fileImage,PATHINFO_EXTENSION)); // get image extension
// echo $new_fileImg;
// echo $upload_path .'<br>';
// echo $imgExt;
//edit

//insertDataAdminStaff
if($submit == "Insert") {

    //upload photo insert
  
    $fileImage = pathinfo(basename($_FILES["profile"]["name"]) ,PATHINFO_EXTENSION);
    $new_fileImg = 'imgAdminStaff_'.uniqid().".".$fileImage;
    $dir = "imgAdminStaff/";
    $upload_path = $dir.$new_fileImg;
    $upload_img = move_uploaded_file($_FILES['profile']['tmp_name'],$upload_path);
    $filetype = $_FILES["profile"]["type"];
    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");


        // $obj->insertAdminStaff($adminStaffUserID,$username,$hashedPassword,$prenameID,$firstNameTH,$lastNameTH,$firstNameEN,$lastNameEN,$lineID,$tokenLine,$email,$phone,$adminOrStaff,$new_fileImg); 
    if(in_array($filetype, $allowed)){
        $sql = "INSERT INTO `userprofile`(`userProID`,`username`, `hashedPassword`, `prenameID`, `firstNameTH`, `lastNameTH`, `firstNameEN`, `lastNameEN`, `lineID`, `tokenLine`, `email`, `phone`, `status`, `imageFile`) VALUES ('$adminStaffUserID','$username','$hashedPassword','$prenameID','$firstNameTH','$lastNameTH','$firstNameEN','$lastNameEN','$lineID','$tokenLine','$email','$phone','$adminOrStaff','$new_fileImg')";
        

        $check = "SELECT  * FROM userprofile  WHERE userProID='$adminStaffUserID' or username='$username' or lineID='$lineID' or tokenLine='$tokenLine' 
        or email='$email' or phone='$phone' ";


        $result1 = mysqli_query($conn->connect(), $check) or die(mysqli_error($conn->connect()));
        $num=mysqli_num_rows($result1);
    
        if($num > 0)
        {
            echo "<script>";
            echo "alert(' ข้อมูลซ้ำ กรุณาเพิ่มใหม่อีกครั้ง !');";
            echo "window.history.back();";
            echo "</script>";
        }else{
            if (mysqli_query($conn->connect(),$sql)) {
                    echo "<script>alert('บันทึกข้อมูลสำเร็จ')</script>";
                    echo "<script>window.location='manageAdminStaff.php'</script>";
                        
                }
                else {
                    echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ!!')</script>";
                    echo "<script>window.location='insertAdminStaff.php'</script>";
                }
        }
    }else{
            echo "<script type='text/javascript'>alert('นามสกุลไฟล์ไม่ถูกต้อง โปรดใช้นามสกุล jpg,jpeg,png เท่านั้น!!'); window.location.href = 'insertAdminStaff.php';</script>";
        }
     
}

//insert advisory
$file_dir  = "documentAdminStaff";  
if(isset($_POST["InsertAdvisory"]))
{

        for ($x = 0; $x < count($_FILES['filename']['name']); $x++) {      
                        
            $file_name   = $_FILES['filename']['name'][$x];
            $file_tmp    = $_FILES['filename']['tmp_name'][$x];

            $sql = "INSERT INTO `advisory`(`SuserProID`,`TuserProID`, `advisoryStatus`, `dateStart`) VALUES ('$SuserProID','$TuserProID','$advisoryStatus','$date')";

 

            /* location file save */
            $file_target = $file_dir . DIRECTORY_SEPARATOR . $file_name; /* DIRECTORY_SEPARATOR = / or \ */
            if (move_uploaded_file($file_tmp, $file_target)) { 
                
            
                if(mysqli_query($conn->connect(), $sql)){
            
                    echo "<script>alert('บันทึกข้อมูลสำเร็จ!!')</script>";
                	echo "<script>window.location='manageAdvisory.php'</script>";
                
                } else{
                    echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ!!')</script>";
                	echo "<script>window.location='manageAdvisory.php'</script>";
                    
                }                      
                                
            } else {                      
                //echo "Sorry, there was an error uploading {$file_name}.";      
                echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ!!')</script>";
                echo "<script>window.location='manageAdvisory.php'</script>";                   
            }   
                            

        }              

        
}

//updateDataAdminStaff 
if(isset($_POST['edit']))
{
    $sql="SELECT * from userprofile INNER JOIN prename on prename.prenameID = userprofile.prenameID WHERE `userProID`='$ida' ";
    $objquerry =  mysqli_query($conn->connect(),$sql);
    $row = mysqli_fetch_array($objquerry);

    $imgFile = $_FILES['profile']['name'];
    $tmp_dir = $_FILES['profile']['tmp_name'];
    $imgSize = $_FILES['profile']['size'];

    if($imgFile)
    {
        $upload_dir = 'imgAdminStaff/'; // upload directory 
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        $userpic = rand(1000,1000000).".".$imgExt;
        if(in_array($imgExt, $valid_extensions))
        {   
            // echo $userpic.'<br>';
                if($imgSize < 5000000)
                {
                    unlink($upload_dir.$row['imageFile']);
                    move_uploaded_file($tmp_dir,$upload_dir.$userpic);
                }
                else
                {
                $errMSG = "Sorry, your file is too large it should be less then 5MB";
                }
        }
        else
        {
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
        } 
    }
    else
    {
    $userpic = $row['imageFile']; // old image from database
    // echo "old:".'imgAdminStaff/'.$row['imageFile'];
    } 

        $id =$_SESSION['userProID'];
        $sql = "UPDATE userprofile SET username='".$username."',prenameID='".$prenameID."', firstNameTH='".$firstNameTH."', lastNameTH='".$lastNameTH."', firstNameEN='".$firstNameEN."', lastNameEN='".$lastNameEN."', lineID='".$lineID."', tokenLine='".$tokenLine."', email='".$email."', phone='".$phone."', imageFile='".$userpic."'   WHERE userProID ='".$ida."' ";
        if(mysqli_query($conn->connect(), $sql)){
            echo "<script type='text/javascript'>alert('แก้ไขข้อมูลสำเร็จ!'); window.location.href = 'ShowDataAdmin.php?id=$ida';</script>"; 
            
        }else{
            // echo "Error: " . $sql . "<br>" . $conn->error;
            echo "<script type='text/javascript'>alert('ไม่สามารถแก้ไขข้อมูลได้!'); window.location.href = 'editAdminStaff.php?id=$ida';</script>"; 
                
            // echo $id." <br>".$fb;
        }
    
}


//updateProfile --> ตัวเอง
if(isset($_POST['update']))
{
    $sql="SELECT * from userprofile INNER JOIN prename on prename.prenameID = userprofile.prenameID WHERE `userProID`='$_SESSION[userProID]' ";
    $objquerry =  mysqli_query($conn->connect(),$sql);
    $row = mysqli_fetch_array($objquerry);

    $imgFile = $_FILES['profile']['name'];
    $tmp_dir = $_FILES['profile']['tmp_name'];
    $imgSize = $_FILES['profile']['size'];

    if($imgFile)
    {
        $upload_dir = 'imgAdminStaff/'; // upload directory 
        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
        $userpic = rand(1000,1000000).".".$imgExt;
        if(in_array($imgExt, $valid_extensions))
        {   
            echo $userpic.'<br>';
                if($imgSize < 5000000)
                {
                    unlink($upload_dir.$row['imageFile']);
                    move_uploaded_file($tmp_dir,$upload_dir.$userpic);
                }
                else
                {
                $errMSG = "Sorry, your file is too large it should be less then 5MB";
                }
        }
        else
        {
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
        } 
    }
    else
    {
    $userpic = $row['imageFile']; // old image from database
    } 

    $sql = "UPDATE userprofile SET username='".$username."', firstNameTH='".$firstNameTH."', lastNameTH='".$lastNameTH."', firstNameEN='".$firstNameEN."', lastNameEN='".$lastNameEN."', email='".$email."', phone='".$phone."', imageFile='".$userpic."'   WHERE userProID ='".$_SESSION['userProID']."' ";
    if(mysqli_query($conn->connect(), $sql)){
        echo "<script type='text/javascript'>alert('Successful - Record Updated!'); window.location.href = 'ProfileAdmin.php';</script>"; 

    }else{
        // echo "Error: " . $sql . "<br>" . $conn->error;
         echo "<script type='text/javascript'>alert('Unsuccessful - ERROR!'); window.location.href = 'ProfileAdmin.php';</script>"; 
         
        // echo $id." <br>".$fb;
    }
 
}
else{
    $conn = new connectDB();
    $del=$_POST['checkbox'];
    // foreach ($del as $value){
        for($i=sizeof($del);$i>=0;$i--){
        $sql = "DELETE userprofile FROM userprofile  WHERE userProID='".$del[$i]."' AND userProID != '".$_SESSION['userProID']."' ";
        $result = mysqli_query($conn->connect(),$sql);

        $sql1 = "DELETE advisory FROM advisory WHERE advisoryID='".$del[$i]."'  ";
        $result1 = mysqli_query($conn->connect(),$sql1);
        // echo ".$del[$i]." . "<br>"; 
        // echo ".$result[userProID].". "<br>";
        // echo ".$_SESSION[userProID].". "<br>";
    }
  
    if($result['userProID'] != $_SESSION['userProID']) {
        echo "<script>alert('ลบข้อมูลสำเร็จ!!')</script>";
        echo "<script>window.location='manageAdminStaff.php'</script>";

    }
    elseif($result['userProID'] == $_SESSION['userProID']){
        echo "<script>alert('ไม่สามารถลบข้อมูลได้!!')</script>";
        echo "<script>window.location='manageAdminStaff.php'</script>";
    }
    else {
        // echo "<script>alert('ลบข้อมูลไม่สำเร็จ!!')</script>";
        echo "<script>alert('ไม่สามารถลบข้อมูลได้!!')</script>";
        echo "<script>window.location='manageAdminStaff.php'</script>";

    }
    if($result1) {
        echo "<script>alert('ลบข้อมูลสำเร็จ!!')</script>";
        echo "<script>window.location='showAdvisory.php'</script>";
        // header ("Location:showAdvisory.php");
    }
    else {
        echo "<script>alert('ลบข้อมูลไม่สำเร็จ!!')</script>";
        echo "<script>window.location='showAdvisory.php'</script>";

    }
}



?>
