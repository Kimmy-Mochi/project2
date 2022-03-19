<?php
session_start();
if(!ISSET($_SESSION['userProID'])){
    header('location:homeTeachers.php');
}
?>
<?php
error_reporting(E_ALL^E_NOTICE);
require_once './connectDB.php';
$conn = new connectDB();
$idt = $_REQUEST['id'];
// $teacherID = $_POST['teacherID'];
$teacherUserprofileID = $_POST['teacherID'];
$username = $_POST['username'];
$hashedPassword = PASSWORD_HASH($_POST["password"], PASSWORD_DEFAULT);
$prenameID = $_POST['pnameTH'];
$firstNameTH = $_POST['firstnameTH'];
$lastNameTH = $_POST['lastnameTH'];
$firstNameEN = $_POST['firstnameEN'];
$lastNameEN = $_POST['lastnameEN'];
$researchGroup = $_POST['researchgroup'];
$highestDegree = $_POST['highestDegree'];
$highestDegreeDetails = $_POST['highestDegreeDetails'];
$acaposID = $_POST['acaposition'];
$lineID = $_POST['lineID'];
$email = $_POST['email'];
$phone = $_POST['tel'];
$tokenLine = $_POST['token'];
$status = "T";
$submit = $_POST['submit'];
$obj = new ActionDB();


//เปลี่ยนรหัสผ่าน
$currentPassword = $_POST["currentPassword"];
$newPassword = $_POST["newPassword"];
$confirmPassword = $_POST["confirmPassword"];



//insertTeacher
if($submit == "Insert") {
    
    //upload photo
    $fileImage = pathinfo(basename($_FILES["profile"]["name"]) ,PATHINFO_EXTENSION);
    $new_fileImg = 'imgTeachers_'.uniqid().".".$fileImage;
    $dir = "imgTeachers/";
    $upload_path = $dir.$new_fileImg;
    $upload_img = move_uploaded_file($_FILES['profile']['tmp_name'],$upload_path);
    $filetype = $_FILES["profile"]["type"];
    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");


    // $obj->insertTeachers($teacherUserprofileID,$username,$hashedPassword,$prenameID,$firstNameTH,$lastNameTH,$firstNameEN,$lastNameEN,$lineID,$tokenLine,$email,$phone,$status,$new_fileImg,$highestDegree,$highestDegreeDetails,$acaposID,$researchGroup);
    if(in_array($filetype, $allowed)){
        $sql = "INSERT INTO `userprofile`(`userProID`,`username`, `hashedPassword`, `prenameID`, `firstNameTH`, `lastNameTH`, `firstNameEN`, `lastNameEN`, `lineID`, `tokenLine`, `email`, `phone`, `status`,`imageFile`) VALUES ('$teacherUserprofileID','$username','$hashedPassword','$prenameID','$firstNameTH','$lastNameTH','$firstNameEN','$lastNameEN','$lineID','$tokenLine','$email','$phone','$status','$new_fileImg')";
        
        if (mysqli_query($conn->connect(),$sql)) {
             
         $sql = "INSERT INTO `teachers`(`TuserProID`, `highestDegree`, `highestDegreeDetails`, `acaposID`, `researchGroup` ) VALUES ('$teacherUserprofileID','$highestDegree','$highestDegreeDetails','$acaposID','$researchGroup')";
             
             if (mysqli_query($conn->connect(),$sql)){

                 echo "<script>alert('บันทึกข้อมูลสำเร็จ')</script>";
                 echo "<script>window.location='manageTeachers.php'</script>";
                 
             }
        }
        else {
            // echo "Error: " . $sql . "<br>" . $conn->error;
         echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ!!')</script>";
         echo "<script>window.location='insertTeachers.php'</script>";
        }
    }else{
        echo "<script type='text/javascript'>alert('นามสกุลไฟล์ไม่ถูกต้อง โปรดใช้นามสกุล jpg,jpeg,png เท่านั้น!!'); window.location.href = 'insertTeachers.php';</script>";
    }
}

//updateDataTeacher
if(isset($_POST['edit']))
{
    $sql="SELECT * from userprofile INNER JOIN prename on prename.prenameID = userprofile.prenameID WHERE `userProID`='$idt' ";
    $objquerry =  mysqli_query($conn->connect(),$sql);
    $row = mysqli_fetch_array($objquerry);

    $imgFile = $_FILES['profile']['name'];
    $tmp_dir = $_FILES['profile']['tmp_name'];
    $imgSize = $_FILES['profile']['size'];

    if($imgFile)
    {
        $upload_dir = 'imgTeachers/'; // upload directory 
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
    echo "old:".'imgTeachers/'.$row['imageFile'];
    } 
   
        $sql = "UPDATE userprofile,teachers SET  username='".$username."',prenameID='".$prenameID."', firstNameTH='".$firstNameTH."',
        lastNameTH='".$lastNameTH."', firstNameEN='".$firstNameEN."', lastNameEN='".$lastNameEN."', lineID='".$lineID."',
        tokenLine='".$tokenLine."', email='".$email."', phone='".$phone."',  imageFile='".$userpic."',
        highestDegree='".$highestDegree."',highestDegreeDetails='".$highestDegreeDetails."', acaposID='".$acaposID."',
        researchGroup='".$researchGroup."'  WHERE userProID ='$idt' ";
        if(mysqli_query($conn->connect(), $sql)){
            echo "<script type='text/javascript'>alert('แก้ไขข้อมูลสำเร็จ!'); window.location.href = 'ShowDataTeacher.php?id=$idt';</script>"; 

        }else{
            // echo "Error: " . $sql . "<br>" . $conn->error;
            echo "<script type='text/javascript'>alert('แก้ไขข้อมูลไม่สำเร็จ!'); window.location.href = 'editTeachers.php?id=$idt';</script>"; 
            
            // echo $id." <br>".$fb;
        }
 
    
}

//updateProfile --> self
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
        $upload_dir = 'imgTeachers/'; // upload directory 
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
   
        $sql = "UPDATE userprofile,teachers SET username='".$username."', firstNameTH='".$firstNameTH."', lastNameTH='".$lastNameTH."',
        firstNameEN='".$firstNameEN."', lastNameEN='".$lastNameEN."', email='".$email."', phone='".$phone."', imageFile='".$userpic."',
        acaposID='".$acaposID."', researchGroup='".$researchGroup."'  WHERE userProID ='".$_SESSION['userProID']."' ";
        if(mysqli_query($conn->connect(), $sql)){
            echo "<script type='text/javascript'>alert('แก้ไขข้อมูลสำเร็จ!'); window.location.href = 'ProfileTeachers.php';</script>"; 

        }else{
            // echo "Error: " . $sql . "<br>" . $conn->error;
            echo "<script type='text/javascript'>alert('แก้ไขข้อมูลไม่สำเร็จ!'); window.location.href = 'ProfileTeachers.php';</script>"; 
            
            // echo $id." <br>".$fb;
        }
   
}

else{
    $conn = new connectDB();
    $del=$_POST['checkbox'];
    // foreach ($del as $value){
        for($i=sizeof($del);$i>=0;$i--){
        $sql = "DELETE userprofile, teachers FROM userprofile INNER JOIN teachers ON userprofile.userProID = teachers.TuserProID WHERE userProID='".$del[$i]."'";
        $result = mysqli_query($conn->connect(),$sql);
    }
    if($result) {
        echo "<script>alert('ลบข้อมูลสำเร็จ!!')</script>";
        echo "<script>window.location='manageTeachers.php'</script>";
        // header ("Location:manageTeachers.php");
    }
    else {
        echo "<script>alert('ลบข้อมูลไม่สำเร็จ!!')</script>";
        echo "<script>window.location='manageTeachers.php'</script>";
        // echo 'Cannot Delete<br>';
        // foreach ($del as $value){
        //     echo $value."<br>";
        //     echo $sql;
        // }
    }
}

?>
