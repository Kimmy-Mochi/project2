<?php
error_reporting(E_ALL^E_NOTICE);
require_once './connectDB.php';

$nametype = $_POST['doctype'];



$submit = $_POST['submit'];
$obj = new ActionDB();


// if($upload_img == FALSE){
//     echo "ไม่สามารถอัพโหลดรูปภาพได้";
// }

if($submit == "Insert") {

    $obj->insertDoctype($nametype);
}
else{
    $conn = new connectDB();
    $del=$_POST['checkbox'];
    // foreach ($del as $value){
        for($i=sizeof($del);$i>=0;$i--){
        $sql = "DELETE FROM documenttype WHERE categoryID='".$del[$i]."'";
        $result = mysqli_query($conn->connect(),$sql);
    }
    if($result) {
        echo "<script>alert('ลบข้อมูลสำเร็จ!!')</script>";
        echo "<script>window.location='adminManageDocType.php'</script>";
        // header ("Location:adminManageDocType.php");
    }
    else {
        echo "<script>alert('ลบข้อมูลไม่สำเร็จ!!')</script>";
        echo "<script>window.location='adminManageDocType.php'</script>";
        // echo 'Cannot Delete<br>';
        // foreach ($del as $value){
        //     echo $value."<br>";
        //     echo $sql;
        // }
    }
}

?>