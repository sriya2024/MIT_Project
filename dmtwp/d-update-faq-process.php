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
if (isset($_GET['faq_id'])) {
    $faqId = $_GET['faq_id'];
    $faqQues=$_GET['faq_Ques'];
    $faqAns=$_GET['faq_Ans'];

         // SQL update
         $sqladdnews = "UPDATE faq 
                        SET faqQues ='$faqQues',
                        faqAns ='$faqAns',
                        addBy='$stfFname', 
                        addDate='$today' 
                        WHERE faqId = $faqId";
         $resultaddnews = mysqli_query($conn, $sqladdnews) or die(mysqli_error($conn));

         if ($resultaddnews) {
         $msg ="Successfully Update FAQ ";	
         header("Location:d-faqmgt.php?id=$msg"); 
         exit();
         
     } else {
         $msg = "Failed to Update FAQ"; 	
         header("Location:d-faqmgt.php?id=$msg"); 
         exit();
         }

}else {
    echo " value not found.";     
}  
mysqli_close($conn);
?>
