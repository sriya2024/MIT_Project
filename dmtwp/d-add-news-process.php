<?php    
require_once("../include/session.php");
require_once("../include/sessionmanagementdmt.php");
require_once("../include/dbconnection.php");

if (isset($_SESSION['stfNic'])) {
    $staffid=$_SESSION['stfNic'];
    $stfFname = $_SESSION['stfFname'];
   
} else {
    echo "NIC value not found.";
}

$today=date('Y-m-d'); 
//add news
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $newsTitle=$_POST['news_title'];
    $newsDes=$_POST['news_des'];
 
         // SQL insert
         $sqladdnews = "INSERT INTO news (newsId, newsTitle, newsDescription, addBy, newsDate) 
         VALUES ('','$newsTitle','$newsDes','$stfFname','$today')";
         $resultaddnews = mysqli_query($conn, $sqladdnews) or die(mysqli_error($conn));

         if ($resultaddnews) {
         $msg ="Successfully Add News ";	
         header("Location:d-newsmgt.php?id=$msg"); 
         exit();
         
     } else {
         $msg = "Failed to Add News"; 	
         header("Location:d-newsmgt.php?id=$msg"); 
         exit();
         }

}else {
    echo " value not found.";     
}  

mysqli_close($conn);


?>
