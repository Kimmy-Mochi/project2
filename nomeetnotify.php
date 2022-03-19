
<?php 
session_start();
$connect = new mysqli('localhost', 'root', 'abc123', 'project2');
  // while(true){
    // echo "1"."<br />\n";
    $date = new DateTime();
    $datetime= $date->format("Y-m-d ") . "\n";
     echo $datetime;
    
    $sql =( "SELECT * FROM  nomeetnotify WHERE notifyDateTime = '$datetime' ");
    $result = $connect->query($sql);
   // $row = $result->fetch_assoc();
    // echo  $row['studentID']; 
   
    
 while($row = $result->fetch_assoc()){

      $ID= $row['studentID'];
      //  echo   $ID;
        $sql1 =( "SELECT * FROM  userprofile 
        INNER JOIN students  ON   userprofile.userProID = students.SuserProID  
        INNER JOIN advisory  ON  students.SuserProID  = advisory.SuserProID 
         INNER JOIN teachers  ON  advisory.TuserProID = teachers.TuserProID WHERE userProID = '$row[studentID]' ");
       $result1 = $connect->query($sql1);
       $data = $result1->fetch_assoc();
       echo  $data['email']."<br />\n";
       echo  $data['tokenLine']."<br />\n";
       if ($data ) {
        
        echo "<script>window.location='email.php?id=".$row['studentID']."'</script>";  
       }

        
//  }
  
  }

?>
<html>
<head>
<title></title>
<script type="text/javascript">
function getCurrentTime()
{
var myDate = new Date();
var mySecs = myDate.getSeconds();
var curHour = myDate.getHours();
var curMin = myDate.getMinutes();
var suffix = "AM";

if(mySecs < 10)
mySecs = "0" + mySecs;

if(curMin < 10)
curMin = "0" + curMin;

if(curHour == 12 && curMin >= 1)
{
suffix = "PM";
}
if(curHour == 24 && curMin >= 1)
{
curHour-= 12;
suffix = "AM";
}
if(curHour > 12)
{
curHour-= 12;
suffix = "PM";
}

var time = curHour + ":" + curMin + ":" + mySecs + " " + suffix;
document.getElementById('time').innerHTML=(time);

if(time == "18:00:00 PM") //Change this to whatever time you want
location.reload();

}
</script>
</head>
<body onload="setInterval('getCurrentTime()', 1000);">
<div id="time"></div>
</body>
</html>

