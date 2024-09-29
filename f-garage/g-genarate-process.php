
<?php
require_once("../include/session.php");
require_once("../include/sessionmanagementgarage.php");
require_once("../include/dbconnection.php");
//email notification
require "../vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

// vehino already assing to session variables
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    if (isset($_POST["vehiNo"])) {
       
        $cus_email = $_POST["cusEmail"];
        $cus_fname = $_POST["cusFname"];
        $vehiNo = $_POST["vehiNo"];
        //echo $cus_email;
       // echo $cus_fname;
     
    }else {
        echo "value not found.";
}
}

$validUntill=$_SESSION['lvaliddate'];
$bookingId=$_SESSION['bookingId'];
$cofficerid=$_SESSION['coid'];

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $engiMake=$_POST['engiMake'];
    $wheelbase=$_POST['wheelbase'];
    $engincon=$_POST['engincon'];
    $clutchcon=$_POST['clutchcon'];
    $gearboxcon=$_POST['gearboxcon'];
    $transmissioncon=$_POST['transmissioncon'];
    $backaxelcon=$_POST['backaxelcon'];
    $frontaxelcon=$_POST['frontaxelcon'];
    $wheelcon=$_POST['wheelcon'];
    $springcon=$_POST['springcon'];
    $chassiscon=$_POST['chassiscon'];
    $steeringcon=$_POST['steeringcon'];
    $brakescon=$_POST['brakescon'];
    $fuelcon=$_POST['fuelcon'];
    $exhaustcon=$_POST['exhaustcon'];
    $electricalcon=$_POST['electricalcon'];
    $othercon=$_POST['othercon'];
    $bodycon=$_POST['bodycon'];
    $payload=$_POST['payload'];
    $payloadcon=$_POST['payloadcon'];
    $observation=$_POST['observation'];
    $descriptionvehi=$_POST['descriptionvehi'];
    $make=$_POST['make'];
    $fronttyre=$_POST['fronttyre'];
    $rear=$_POST['rear'];
    $tyrerequirement=$_POST['tyerRequir'];
    $noaxles=$_POST['noaxles'];
    $bodytype=$_POST['bodytype'];
    

        //generate automatic report no
        // define the WP text
        $wpText = "WP";

        // get the record count
        $sqlCount = "SELECT COUNT(*) as count FROM fitness_certificate"; 
        $resultCount = mysqli_query($conn, $sqlCount);

        if ($resultCount) {
            $row = mysqli_fetch_assoc($resultCount);
            $recordCount = $row['count'];

            // increment the record count by one
            $nextReportNumber = $recordCount + 1;

            // combine the WP text with the incremented number
            // formats the number with leading zeros
            $reportNumber = $wpText . sprintf('%04d', $nextReportNumber); 

            // $reportNumber contains automatically generated report number
            $reportNo = $reportNumber;
        } else {
           
        $msg=  "Error: " . mysqli_error($conn);
        }


   
    $sqlinspection = "INSERT INTO inspection_report (inspectionId, reportNo, vehiNo, engineMake, wheelBase, engine, clutch, gearBox, transmission, backAxle, frontAxle, wheelsTyres, springs, chassis, steering, brakes, fuelSystem, exhaustSystem, electricEquip, otherEquip, body, payLoad, payLoadCondition,observation) 
    VALUES ('','$reportNo','$vehiNo','$engiMake','$wheelbase','$engincon','$clutchcon',' $gearboxcon','$transmissioncon','$backaxelcon','$frontaxelcon','$wheelcon','$springcon','$chassiscon','$steeringcon','$brakescon','$fuelcon','$exhaustcon','$electricalcon','$othercon','$bodycon','$payload','$payloadcon','$observation')";
    $resultinspection = mysqli_query($conn, $sqlinspection) or die(mysqli_error($conn));

    //get last inserted inspection id
       $inspectionId = mysqli_insert_id($conn);

    $sqlfitness = "INSERT INTO fitness_certificate (fitnessId, certificateNo, descriptionVehi, makeVehi, tyerfrontSize, tyerrearSize, tyerRequir, NoAxles, typeBody, validUntill) 
    VALUES ('','$reportNo','$descriptionvehi','$make','$fronttyre','$rear', '$tyrerequirement','$noaxles','$bodytype','$validUntill')";
    $resultfitness = mysqli_query($conn, $sqlfitness);

        //get last inserted fitnes id
        $fitnessId = mysqli_insert_id($conn);
       
        //select the issued_certificate from the bookingId
        $sqlissue= "SELECT * FROM issued_certificate WHERE bookingId = $bookingId";
        $resulissue = mysqli_query($conn, $sqlissue);

        if (mysqli_num_rows($resulissue) > 0 ) {
            // update the issued_certificate table
            $fitnessStatus = "Complete";
            $inspectionStatus = "Complete";
           
            $currentDate= date("Y-m-d");
            date_default_timezone_set("Asia/Colombo");
            $currentTime= date("H:i:sa");

            $sqlupdateIssued = "UPDATE issued_certificate 
                                SET fitnessId = '$fitnessId',
                                    fStatus = '$fitnessStatus',
                                    inspectionId ='$inspectionId',
                                    iStatus = '$inspectionStatus', 
                                   
                                    cofficerId='$cofficerid',
                                    issueDate='$currentDate',
                                    issueTime = '$currentTime'
                                WHERE bookingId = $bookingId";
            
            if (mysqli_query($conn, $sqlupdateIssued)) {
              
                $msg = "issued_certificate updated successfully.";
            } else {
                
                $msg = "Error updating issued_certificate: " . mysqli_error($conn);
            }
        }


          //email notification
          $mail = new PHPMailer(true);
          $mail ->isSMTP();
          $mail ->SMTPAuth = true;
 
          $mail ->Host = "smtp.gmail.com";
          $mail ->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
          $mail ->Port = 587;

          $mail ->Username = "wcvfeisproject@gmail.com";
          $mail ->Password = "xzll euej xvli frza";
 
          $mail ->setFrom("wcvfeisproject@gmail.com","WCVFEIS");
          $mail ->addAddress($cus_email,$cus_fname);
          $mail ->Subject = "Notification from Commercial Vechicle Fitness e-certificate Issuing System";
          date_default_timezone_set('Asia/kolkata');
          $mail->isHTML(true); 
 

          $mail->Body = '<p><strong> Your report of Vehicle Inspection and Fitness e-certificate has been successfully generated. Please visit the Download Vehicle Fitness e-Certificate page and download your certificate. </strong></p>' .
                      '<p>This email is automatically generated by the system. Please do not reply.</p>' .
                      '<p>Log time: ' . date('Y-m-d H:i:s') . '</p>';
 
 
          //error handeling
          try {
              $mail->send();
              
              $msg = "generated successfully";
              $redirectUrl = "g-bookingmgt.php?garageId=$bookingId&id=" . urlencode($msg);
              header("Location: $redirectUrl");
                  exit();
          } catch (Exception $e) {
            
              $msg = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
              header("Location:g-bookingmgt.php?id=$msg");
          }
          exit();
 
       // Display a success message 
      // $msg = "generated successfully";
      // $redirectUrl = "g-bookingmgt.php?garageId=$bookingId&id=" . urlencode($msg);
     //  header("Location: $redirectUrl");
     //  exit();
       


} else { 
        //  unsuccess message 
        $msg = "Something went wrongd in the generationg process";
        $redirectUr2 = "g-bookingmgt.php?garageId=$bookingId&id=" . urlencode($msg);
        header("Location: $redirectUr2");
        exit();

   }

 mysqli_close($conn);
?>