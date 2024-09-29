<?php                 
require_once("../include/session.php");
require_once("../include/sessionmanagementgarage.php");
require_once("../include/dbconnection.php");
//email notification
require "../vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (isset($_SESSION['unic'])) {
    $usernic = $_SESSION['unic'];
    $payBy=$_SESSION['ownerFname'];
    
   
} else {
    echo "NIC value not found.";
}



 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["renewId"])) {
        $renewId = $_POST["renewId"];
   
   // already paid
    $sql = "SELECT * FROM payment_dmtwp WHERE renewId = '$renewId'";
    $result = mysqli_query($conn, $sql);
    
        if (mysqli_num_rows($result) > 0) {
          
            $msg = "Your already pay for the Renewal";
            $redirectUrl = "g-renew-registration.php?renewId=$renewId&id=" . urlencode($msg);
            header("Location: $redirectUrl");
        } else {
            
                // No paid
                $amount ="5000" ;
                $payType = "Card-Online";
                $currentDate= date("Y-m-d");
                $payBy="customer-online";

                    $sqlinsert = "INSERT INTO payment_dmtwp (payrId, renewId, amount, payType, pDate, payBy ) VALUES ('','$renewId','$amount','$payType','$currentDate','$payBy')";
                   
                    $resultinsert = mysqli_query($conn, $sqlinsert);
                   
                    $pStatus = "Complete";
                    
                  
                    $sqlupdate = "UPDATE garage_renew SET
                                  pStatus='$pStatus' 
                                  WHERE renewId = $renewId";
                  
                    $resultupdate=mysqli_query($conn,$sqlupdate);
                 
                              
                                $msg = "Payment successful.";
                                $redirectUrl = "g-renew-registration.php?renewId=$renewId&id=" . urlencode($msg);
                                 header("Location: $redirectUrl");
                  
                      
                    
                      exit();
            }
   
            mysqli_close($conn);
    }else {
         echo "value not found.";
    }
}
?>
      
        