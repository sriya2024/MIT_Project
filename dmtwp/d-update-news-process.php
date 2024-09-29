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
//update news
if (isset($_GET['news_id'])) {
    $newsId = $_GET['news_id'];
    $newsTitle=$_GET['news_title'];
    $newsDes=$_GET['news_des'];

         // SQL  update
         $sqladdnews = "UPDATE news 
                        SET newsTitle ='$newsTitle',
                        newsDescription ='$newsDes',
                        addBy='$stfFname', 
                        newsDate='$today' 
                        WHERE newsId = $newsId";
         $resultaddnews = mysqli_query($conn, $sqladdnews) or die(mysqli_error($conn));

         if ($resultaddnews) {
         $msg ="Successfully Update News ";	
         header("Location:d-newsmgt.php?id=$msg"); 
         exit();
         
     } else {
         $msg = "Failed to Update News"; 	
         header("Location:d-newsmgt.php?id=$msg"); 
         exit();
         }

}else {
    echo " value not found.";     
}  

mysqli_close($conn);


?>
