
<?php
class connectDB{
    public function connect() {
  
        $severname ="localhost";
        $username ="root";
        $password= "abc123";
        $dbname ="project2";
      
        $conn = new mysqli($severname,$username,$password,$dbname)
                or die("Connect failed : %s\n".$conn->error);
        mysqli_set_charset($conn, 'utf8');
        return $conn;
    }
}
    class ActionDB extends connectDB{
        
        Public function insertStudents($studentuserprofile,$username,$hashedPassword,$prenameID,$firstNameTH,$lastNameTH,$firstNameEN,$lastNameEN,$lineID,$tokenLine,$email,$phone,$status,$new_fileImg,$acaLevelID,$curriID,$academicPlanID,$thesisTitleTH,$thesisTitleEN,$researchGroup) {
            $conn = new connectDB();
            // $link = mysqli_connect("localhost", "root", "123456", "project2");
        
           $sql = "INSERT INTO `userprofile`(`userProID`,`username`, `hashedPassword`, `prenameID`, `firstNameTH`, `lastNameTH`, `firstNameEN`, `lastNameEN`, `lineID`, `tokenLine`, `email`, `phone`, `status`) VALUES ('$studentuserprofile','$username','$hashedPassword','$prenameID','$firstNameTH','$lastNameTH','$firstNameEN','$lastNameEN','$lineID','$tokenLine','$email','$phone','$status')";
        
           if (mysqli_query($conn->connect(),$sql)) {
                
            $sql = "INSERT INTO `students`(`SuserProID`,`imageFile`, `acaLevelID`, `curriID`, `academicPlanID`, `thesisTitleTH`, `thesisTitleEN`, `researchGroup`) VALUES ('$studentuserprofile','$new_fileImg','$acaLevelID','$curriID','$academicPlanID','$thesisTitleTH','$thesisTitleEN','$researchGroup')";
                
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
        }

        Public function insertTeachers($teacherUserprofileID,$username,$hashedPassword,$prenameID,$firstNameTH,$lastNameTH,$firstNameEN,$lastNameEN,$lineID,$tokenLine,$email,$phone,$status,$new_fileImg,$highestDegree,$highestDegreeDetails,$acaposID,$researchGroup) {
           
            $conn = new connectDB();
            // $link = mysqli_connect("localhost", "root", "123456", "project2");
        
           $sql = "INSERT INTO `userprofile`(`userProID`,`username`, `hashedPassword`, `prenameID`, `firstNameTH`, `lastNameTH`, `firstNameEN`, `lastNameEN`, `lineID`, `tokenLine`, `email`, `phone`, `status`) VALUES ('$teacherUserprofileID','$username','$hashedPassword','$prenameID','$firstNameTH','$lastNameTH','$firstNameEN','$lastNameEN','$lineID','$tokenLine','$email','$phone','$status')";
        
           if (mysqli_query($conn->connect(),$sql)) {
                
            $sql = "INSERT INTO `teachers`(`TuserProID`,`imageFile`, `highestDegree`, `highestDegreeDetails`, `acaposID`, `researchGroup` ) VALUES ('$teacherUserprofileID','$new_fileImg','$highestDegree','$highestDegreeDetails','$acaposID','$researchGroup')";
                
                if (mysqli_query($conn->connect(),$sql)){

                    echo "<script>alert('บันทึกข้อมูลสำเร็จ')</script>";
                    echo "<script>window.location='manageTeachers.php'</script>";
                    
                //  header("Location:manageTeachers.php");
                }
           }
           else {
            echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ!!')</script>";
            echo "<script>window.location='insertTeachers.php'</script>";
            //    echo 'Cannot Insert';
            //    echo $teacherUserprofileID." ".$firstNameTH ;
            //    echo "Error: " . $sql . "<br>" . $conn->error;
           }
           
        }
        Public function insertAdminStaff($adminStaffUserID,$username,$hashedPassword,$prenameID,$firstNameTH,$lastNameTH,$firstNameEN,$lastNameEN,$lineID,$tokenLine,$email,$phone,$adminOrStaff,$new_fileImg) {
           
            $conn = new connectDB();
            // $link = mysqli_connect("localhost", "root", "123456", "project2");
        
           $sql = "INSERT INTO `userprofile`(`userProID`,`username`, `hashedPassword`, `prenameID`, `firstNameTH`, `lastNameTH`, `firstNameEN`, `lastNameEN`, `lineID`, `tokenLine`, `email`, `phone`, `status`) VALUES ('$adminStaffUserID','$username','$hashedPassword','$prenameID','$firstNameTH','$lastNameTH','$firstNameEN','$lastNameEN','$lineID','$tokenLine','$email','$phone','$adminOrStaff')";
        

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
                        
                        // $sql = "INSERT INTO `adminstaff`(`AuserProID`,`imageFile` ) VALUES ('$adminStaffUserID','$new_fileImg')";
                        
                        // if (mysqli_query($conn->connect(),$sql)){
                            echo "<script>alert('บันทึกข้อมูลสำเร็จ')</script>";
                            echo "<script>window.location='manageAdminStaff.php'</script>";
                        //  header("Location:manageAdminStaff.php");
                        
                }
                else {
                    echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ!!')</script>";
                    echo "<script>window.location='insertAdminStaff.php'</script>";
                    //    echo 'Cannot Insert';
                    //    echo $adminStaffUserID." ".$firstNameTH ;
                    //    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
       
        // public function updateStudents($username,$firstNameTH,$lastNameTH,$firstNameEN,$lastNameEN,$email,$phone,$new_fileImg,$thesisTitleTH,$thesisTitleEN,$researchGroup) {
        //     $conn = new connectDB();
        //     $link = mysqli_connect("localhost", "root", "123456", "project2");
        //     $sql = "UPDATE userprofile,students SET username='".$username."', firstNameTH='".$firstNameTH."', lastNameTH='".$lastNameTH."', firstNameEN='".$firstNameEN."', lastNameEN='".$lastNameEN."', email='".$email."', phone='".$phone."', imageFile='".$new_fileImg."', thesisTitleTH='".$thesisTitleTH."', thesisTitleEN='".$thesisTitleEN."', researchGroup='".$researchGroup."'  WHERE userProID ='".$_SESSION['userProID']."' "or die(mysqli_error($link)); 
        //     if(mysqli_query($link, $sql)){
        //         echo 55555;
        //         echo "<script type='text/javascript'>alert('Successful - Record Updated!'); window.location.href = 'ProfileStudents.php';</script>"; 
        
        //     }else{
        //         echo "Error: " . $sql . "<br>" . $conn->error;
        //         //  echo "<script type='text/javascript'>alert('Unsuccessful - ERROR!'); window.location.href = 'ProfileStudents.php';</script>"; 
                 
        //         // echo $id." <br>".$fb;
        //     }
        // }
        // public function updateTeachers($teacherUserprofileID,$hashedPassword,$firstNameTH,$lastNameTH,$firstNameEN,$lastNameEN,$email,$phone,$status,$new_fileImg,$thesisTitleTH,$thesisTitleEN,$researchGroup) {
        //     $link = mysqli_connect("localhost", "root", "123456", "project");
        //     $sql = "UPDATE userprofile SET  hashedPassword='".$hashedPassword."', firstNameTH='".$firstNameTH."', lastNameTH='".$lastNameTH."', firstNameEN='".$firstNameEN."', lastNameEN='".$lastNameEN."', email='".$email."', phone='".$phone."', new_fileImg='".$new_fileImg."', thesisTitleTH='".$thesisTitleTH."', thesisTitleEN='".$thesisTitleEN."', researchGroup='".$researchGroup."'WHERE studentID='".$teacherUserprofileID."'";
        //     if(mysqli_query($link, $sql)){
        //         header("location:manageStudents.php");
        //     }else{
        //         echo "Cannot Update<br>";
        //         // echo $id." <br>".$fb;
        //     }
        // }
        // public function updateAdminStaff($username,$prename,$firstNameTH,$lastNameTH,$firstNameEN,$lastNameEN,$lineID,$tokenLine,$email,$phone,$new_fileImg) {
        //     $link = mysqli_connect("localhost", "root", "123456", "project2");
        //     $sql = "UPDATE userprofile,adminstaff SET username='".$username."',prenameID='".$prename."', firstNameTH='".$firstNameTH."', lastNameTH='".$lastNameTH."', firstNameEN='".$firstNameEN."', lastNameEN='".$lastNameEN."', lineID='".$lineID."', tokenLine='".$tokenLine."', email='".$email."', phone='".$phone."', imageFile='".$new_fileImg."'   WHERE userProID ='".$_SESSION['userProID']."' ";
        //     if(mysqli_query($link, $sql)){
        //         echo "<script type='text/javascript'>alert('Successful - Record Updated!'); window.location.href = 'ProfileAdmin.php';</script>"; 
        
        //     }else{
        //         echo "Error: " . $sql . "<br>";
        //         //  echo "<script type='text/javascript'>alert('Unsuccessful - ERROR!'); window.location.href = 'ProfileAdmin.php';</script>"; 
                 
        //         // echo $id." <br>".$fb;
        //     }
        // }
        Public function insertDocType($doctype) {
           
            $conn = new connectDB();
          
        
           $sql = "INSERT INTO `documenttype`( `name_category`) VALUES ('$doctype')";
        
           if (mysqli_query($conn->connect(),$sql)) {  
               
            echo "<script>alert('บันทึกข้อมูลสำเร็จ')</script>";
            echo "<script>window.location='adminManageDoctype.php'</script>";
      
           }
           else {
            echo "<script>alert('บันทึกข้อมูลไม่สำเร็จ!!')</script>";
            echo "<script>window.location='adminManageDoctype.php'</script>";
            //    echo 'Cannot Insert';
            //    echo "Error: " . $sql . "<br>" . $conn->error;
           }
        }

        
        
    }
    
?>