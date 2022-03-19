<?php
session_start();
if(!ISSET($_SESSION['userProID'])){
    header('location:homeStudent.php');
}
?>
<?php
error_reporting(E_ALL^E_NOTICE);
require_once './connectDB.php';
$ids=$_REQUEST['id'];
$s_id = $ids;
$studentuserprofile = $_POST['studentUserprofileID'];
$fkuser = $_POST['studentUserprofileID'];
$username =$_POST['studentUserprofileID'];
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

$acaLevelID = $_POST['academicLevel'];
$academicPlanID = $_POST['academicplan'];
$curriID = $_POST['curricular'];
$researchGroup = $_POST['researchgroup'];
$thesisTitleTH = $_POST['thesisTH'];
$thesisTitleEN = $_POST['thesisEN'];

//เปลี่ยนรหัสผ่าน
$id = $_SESSION["userProID"];/* userid of the user */
// $con = mysqli_connect('localhost','root','123456','project2') or die('Unable To connect');
$currentPassword = $_POST["currentPassword"];
$newPassword = $_POST["newPassword"];
$confirmPassword = $_POST["confirmPassword"];

$idm = $_REQUEST["userProID"];
$submit = $_POST['submit'];
$obj = new ActionDB();
$update = $_POST['edit'];
 $conn = new connectDB();



//insert Student
if($submit == "Insert") {
     //upload photo
    $fileImage = pathinfo(basename($_FILES["profile"]["name"]) ,PATHINFO_EXTENSION);
    $new_fileImg = 'imgStudent_'.uniqid().".".$fileImage;
    $dir = "imgStudents/";
    $upload_path = $dir.$new_fileImg;
    $upload_img = move_uploaded_file($_FILES['profile']['tmp_name'],$upload_path);
    $filetype = $_FILES["profile"]["type"];
    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
    $status ="S";

    // $obj->insertStudents($studentuserprofile,$username,$hashedPassword,$prenameID,$firstNameTH,$lastNameTH,$firstNameEN,$lastNameEN,$lineID,$tokenLine,$email,$phone,$status,$new_fileImg,$acaLevelID,$curriID,$academicPlanID,$thesisTitleTH,$thesisTitleEN,$researchGroup);
    if(in_array($filetype, $allowed)){
        $sql = "INSERT INTO `userprofile`(`userProID`,`username`, `hashedPassword`, `prenameID`, `firstNameTH`, `lastNameTH`, `firstNameEN`, `lastNameEN`, `lineID`, `tokenLine`, `email`, `phone`, `status`,`imageFile`) VALUES ('$studentuserprofile','$username','$hashedPassword','$prenameID','$firstNameTH','$lastNameTH','$firstNameEN','$lastNameEN','$lineID','$tokenLine','$email','$phone','$status','$new_fileImg')";
            
        if (mysqli_query($conn->connect(),$sql)) {
            
        $sql = "INSERT INTO `students`(`SuserProID`, `acaLevelID`, `curriID`, `academicPlanID`, `thesisTitleTH`, `thesisTitleEN`, `researchGroup`) VALUES ('$studentuserprofile','$acaLevelID','$curriID','$academicPlanID','$thesisTitleTH','$thesisTitleEN','$researchGroup')";
            
            if (mysqli_query($conn->connect(),$sql)){
                echo "<script>alert('บันทึกข้อมูลสำเร็จ')</script>";
                echo "<script>window.location='manageStudents.php'</script>";
            //  header("Location:manageStudents.php");
            }
        }
        else {
        echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ!!')</script>";
        echo "<script>window.location='insertStudents.php'</script>";
        //    echo 'Cannot Insert';
        //    echo $studentuserprofile." ".$firstNameTH ;
        //    echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }else{
            echo "<script type='text/javascript'>alert('นามสกุลไฟล์ไม่ถูกต้อง โปรดใช้นามสกุล jpg,jpeg,png เท่านั้น!!'); window.location.href = 'insertAdminStaff.php';</script>";
        }

}


//updateDataStudent
if(isset($_POST['edit']))
{
    $sql="SELECT * from userprofile INNER JOIN prename on prename.prenameID = userprofile.prenameID WHERE `userProID`='$ids' ";
    $objquerry =  mysqli_query($conn->connect(),$sql);
    $row = mysqli_fetch_array($objquerry);

    $imgFile = $_FILES['profile']['name'];
    $tmp_dir = $_FILES['profile']['tmp_name'];
    $imgSize = $_FILES['profile']['size'];

    if($imgFile)
    {
        $upload_dir = 'imgStudents/'; // upload directory 
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

        $idd =$_SESSION['userProID'];
        $sql = "UPDATE `userprofile`,`students` SET `prenameID`='".$prenameID."',`firstNameTH`='".$firstNameTH."',`lastNameTH`='".$lastNameTH."',
        `firstNameEN`='".$firstNameEN."',`lastNameEN`='".$lastNameEN."'
        ,`lineID`='".$lineID."',`tokenLine`='".$tokenLine."',`email`='".$email."',`phone`='".$phone."',
        `imageFile`='".$userpic."',`acaLevelID`='".$acaLevelID."',`curriID`='".$curriID."',`academicPlanID`='".$academicPlanID."',
        `thesisTitleTH`='".$thesisTitleTH."',`thesisTitleEN`='".$thesisTitleEN."',
        `researchGroup`='".$researchGroup."' WHERE userProID = '".$s_id."' ";
    
    // $obj1 =mysqli_query($conn->connect(), $sql);   
            if($conn->connect($sql) === TRUE){
                echo "<script type='text/javascript'>alert('แก้ไขข้อมูลสำเร็จ!'); window.location.href = 'ShowDataStudent.php?id=$ids';</script>"; 
        
            }else{
                echo "<script type='text/javascript'>alert('ไม่สามารถแก้ไขข้อมูลได้!'); window.location.href = 'editStudents.php?id=$ids';</script>"; 
                // echo "Error: "  .$sql .  mysqli_error($conn->connect());
                
            }


}

//updateProfile -->self
if(isset($_POST['update']))
{
    $sql="SELECT * from userprofile INNER JOIN prename on prename.prenameID = userprofile.prenameID WHERE `userProID`='$_SESSION[userProID] ";
    $objquerry =  mysqli_query($conn->connect(),$sql);
    $row = mysqli_fetch_array($objquerry);

    $imgFile = $_FILES['profile']['name'];
    $tmp_dir = $_FILES['profile']['tmp_name'];
    $imgSize = $_FILES['profile']['size'];

    if($imgFile)
    {
        $upload_dir = 'imgStudents/'; // upload directory 
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
 
            $idd =$_SESSION['userProID'];
            // $sql = "UPDATE `userprofile`,`students` SET `firstNameTH`='".$firstNameTH."',`lastNameTH`='".$lastNameTH."',
            // `firstNameEN`='".$firstNameEN."',`lastNameEN`='".$lastNameEN."',`email`='".$email."',`phone`='".$phone."',
            // `imageFile`='".$userpic."',`thesisTitleTH`='".$thesisTitleTH."',`thesisTitleEN`='".$thesisTitleEN."',
            // `researchGroup`='".$researchGroup."' WHERE userProID = '$_SESSION[userProID]' ";

            $sql = "UPDATE userprofile SET  firstNameTH =' $firstNameTH',lastNameTH='$lastNameTH',
            firstNameEN='$firstNameEN',lastNameEN='$lastNameEN ',email ='$email',phone='$phone',
            imageFile ='$userpic'  WHERE userProID ='$_SESSION[userProID]' ";
                   
            if(mysqli_query($conn->connect(), $sql)){

                $sql1 = "UPDATE students SET  thesisTitleTH  ='$thesisTitleTH',thesisTitleEN='$thesisTitleEN',
                researchGroup='$researchGroup'  WHERE SuserProID ='$_SESSION[userProID]' ";
                  if(mysqli_query($conn->connect(), $sql1)){
     
                     echo "<script type='text/javascript'>alert('แก้ไขข้อมูลสำเร็จ!'); window.location.href = 'ProfileStudents.php';</script>"; 
                  }else{
     
                     echo "<script>alert('แก้ไขข้อมูลไม่สำเร็จ!!')</script>";
                     echo "<script>window.location='ProfileStudents.php'</script>";  
                 }
               
        
            }else{
                echo "<script>alert('แก้ไขข้อมูลไม่สำเร็จ!!')</script>";
                echo "<script>window.location='ProfileStudents.php'</script>";
               
                //  echo "Error: "  .$sql .  mysqli_error($conn->connect()) .$mysqli -> error;
                
            }

}
else{
    // $conn = new connectDB();
    $del=$_POST['checkbox'];
    // foreach ($del as $value){
        for($i=sizeof($del);$i>=0;$i--){
        $sql = "DELETE userprofile, students FROM userprofile INNER JOIN students ON userprofile.userProID = students.SuserProID WHERE userProID='".$del[$i]."' ";
        $result = mysqli_query($conn->connect(),$sql);
    }
    if($result) {
        echo "<script>alert('ลบข้อมูลสำเร็จ!!')</script>";
        echo "<script>window.location='manageStudents.php'</script>";
        // header ("Location:manageStudents.php");
    }
    else {
        echo "<script>alert('ลบข้อมูลไม่สำเร็จ!!')</script>";
        echo "<script>window.location='manageStudents.php'</script>";
        // echo 'Cannot Delete<br>';
        // foreach ($del as $value){
        //     echo $value."<br>";
        //     echo $sql;
        // }
    }
}

?>
