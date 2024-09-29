<?php    
require_once("../include/session.php");
require_once("../include/sessionmanagementdmt.php");
require_once("../include/dbconnection.php");

if (isset($_SESSION['stfNic'])) {
    $staffid=$_SESSION['stfNic'];
} else {
    echo "NIC value not found.";
}
  
//feedback delete
if (isset($_GET['feedbackId'])) {
    $feedbackId = $_GET['feedbackId'];
         // SQL delete 
         $sqldeletefb = "DELETE FROM feedback WHERE feedbackId ='$feedbackId'";

         $resultdeletefb=mysqli_query($conn,$sqldeletefb) or die(mysqli_error($conn));

         if ($resultdeletefb) {
         $msg ="Successfully Deleted ";	
         header("Location:d-feedbackmgt.php?id=$msg"); 
         exit();
         
     } else {
         $msg = "Failed to delete feedback"; 	
         header("Location:d-feedbackmgt.php?id=$msg"); 
         exit();
         }

}else {
    echo "feedbackId value not found.";     
}  


//news delete
if (isset($_GET['newsId'])) {
    $newsId = $_GET['newsId'];
         // SQL delete 
         $sqldeletenews = "DELETE FROM news WHERE newsId ='$newsId'";

         $resultdeletenews=mysqli_query($conn,$sqldeletenews) or die(mysqli_error($conn));

         if ($resultdeletenews) {
         $msg ="Successfully Deleted ";	
         header("Location:d-newsmgt.php?id=$msg"); 
         exit();
         
     } else {
         $msg = "Failed to delete news"; 	
         header("Location:d-newsmgt.php?id=$msg"); 
         exit();
         }

}else {
    echo "newsId value not found.";     
}   

//faq delete
if (isset($_GET['faqId'])) {
    $faqId = $_GET['faqId'];
         // SQL delete 
         $sqldeletefaq = "DELETE FROM faq WHERE faqId ='$faqId'";

         $resultdeletefaq=mysqli_query($conn,$sqldeletefaq) or die(mysqli_error($conn));

         if ($resultdeletefaq) {
         $msg ="Successfully Deleted ";	
         header("Location:d-faqmgt.php?id=$msg"); 
         exit();
         
     } else {
         $msg = "Failed to delete news"; 	
         header("Location:d-faqmgt.php?id=$msg"); 
         exit();
         }

}else {
    echo "faqId value not found.";     
}   

mysqli_close($conn);


?>
