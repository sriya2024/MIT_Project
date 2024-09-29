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
    $faqQuestion=$_POST['faq_question'];
    $faqAnswer=$_POST['faq_answer'];
 
         // SQL insert
         $sqladdfaq = "INSERT INTO faq (faqId, faqQues, faqAns, addBy, addDate) 
         VALUES ('','$faqQuestion','$faqAnswer','$stfFname','$today')";
         $resultfaq = mysqli_query($conn, $sqladdfaq) or die(mysqli_error($conn));

         if ($resultfaq) {
         $msg ="Successfully Add FAQ ";	
         header("Location:d-faqmgt.php?id=$msg"); 
         exit();
         
     } else {
         $msg = "Failed to Add FAQ"; 	
         header("Location:d-faqmgt.php?id=$msg"); 
         exit();
         }

}else {
    echo " value not found.";     
}  

mysqli_close($conn);


?>
