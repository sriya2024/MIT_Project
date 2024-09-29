<?php    
require_once("../include/session.php");
require_once("../include/sessionmanagementdmt.php");
require_once("../include/dbconnection.php");
require "../vendor/autoload.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

if (isset($_SESSION['stfNic'])) {
    $staffid=$_SESSION['stfNic'];
    $stfFname = $_SESSION['stfFname'];
   
} else {
    echo "NIC value not found.";
}


//add garage user
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['owner_id'])) {
    
        $garage_id=$_POST['garage_id'];
        $garage_email=$_POST['garage_email'];
        $owner_id=$_POST['owner_id'];
        $owner_fname=$_POST['owner_fname'];
        $owner_nic=$_POST['owner_nic'];
        $role_owner="1";
        $passwordsha=sha1($_POST['owner_nic']);

        $sql_nic = "SELECT * FROM garage_user WHERE userNic='$owner_nic'";
        $sql_e = "SELECT * FROM garage_login WHERE email='$garage_email'";
        $res_nic = mysqli_query($conn, $sql_nic);
        $res_e = mysqli_query($conn, $sql_e);

        if(mysqli_num_rows($res_nic) > 0){
            $msg = "Sorry... NIC already exists.."; 	
            header("Location:d-co-details.php?id=$msg&garageId=$garage_id"); 
            exit();

        
        }else if(mysqli_num_rows($res_e) > 0){
            $msg = "Sorry... email already exists.."; 	
            header("Location:d-co-details.php?id=$msg&garageId=$garage_id"); 
            exit();

            
        }else{

 
            $sqlin="INSERT INTO garage_user (userId, garageId, roleId, userNic) VALUES ('','$garage_id','$role_owner','$owner_nic')";
            $resultin=mysqli_query($conn,$sqlin) or die(mysqli_error($conn));
            
            $user_id=mysqli_insert_id($conn);
            $sqllog="INSERT INTO garage_login (email, pwd, userId) VALUES ('$garage_email','$passwordsha','$user_id')";
            $resultlog=mysqli_query($conn,$sqllog) or die(mysqli_error($conn));

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
            $mail ->addAddress($garage_email,$owner_fname);
            $mail ->Subject = "Notification from Commercial Vechicle Fitness e-certificate Issuing System";
            date_default_timezone_set('Asia/kolkata');
            $mail->isHTML(true); 

            $mail->Body = '<p><strong>You are successfully registered to the Vehicle Fitness e-certificate issuing system. User name - email, password - NIC no without V or X</strong></p>' .
                        '<p>This email is automatically generated by the system. Please do not reply.</p>' .
                        '<p>Log time: ' . date('Y-m-d H:i:s') . '</p>';

            //$mail ->send();
            //header("Location:../c-dashboard.php");

            //error handeling
            try {
                $mail->send();
               
                $msg = "You are Successfully registered."; 	
                header("Location:../d-co-details.php.php?id=$msg&garageId=$garage_id");
            } catch (Exception $e) {
                
                $msg = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
                header("Location:../d-co-details.php?id=$msg&garageId=$garage_id");
            }
            
          
            exit();
        }
    }


    if (isset($_POST['officer_id'])) {
    
        $officer_id=$_POST['officer_id'];
        $officer_fname=$_POST['officer_fname'];
        $officer_nic=$_POST['officer_nic'];
        $officer_email=$_POST['officer_email'];
        $garage_id=$_POST['garageId'];
        $role_officer="2";
        $passwordsha=sha1($_POST['officer_nic']);

        $sql_nic = "SELECT * FROM garage_user WHERE userNic='$officer_nic'";
        $sql_e = "SELECT * FROM garage_login WHERE email='$officer_email'";
        $res_nic = mysqli_query($conn, $sql_nic);
        $res_e = mysqli_query($conn, $sql_e);

        if(mysqli_num_rows($res_nic) > 0){
            $msg = "Sorry... NIC already exists.."; 	
            header("Location:d-co-details.php?id=$msg&garageId=$garage_id"); 
            exit();

        
        }else if(mysqli_num_rows($res_e) > 0){
            $msg = "Sorry... email already exists.."; 	
            header("Location:d-co-details.php?id=$msg&garageId=$garage_id"); 
            exit();

            
        }else{

 
            $sqlin="INSERT INTO garage_user (userId, garageId, roleId, userNic) VALUES ('','$garage_id','$role_officer','$officer_nic')";
            $resultin=mysqli_query($conn,$sqlin) or die(mysqli_error($conn));
            
            $user_id=mysqli_insert_id($conn);
            $sqllog="INSERT INTO garage_login (email, pwd, userId) VALUES ('$officer_email','$passwordsha','$user_id')";
            $resultlog=mysqli_query($conn,$sqllog) or die(mysqli_error($conn));

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
            $mail ->addAddress($officer_email,$officer_fname);
            $mail ->Subject = "Notification from Commercial Vechicle Fitness e-certificate Issuing System";
            date_default_timezone_set('Asia/kolkata');
            $mail->isHTML(true); 

            $mail->Body = '<p><strong>You are successfully registered to the Vehicle Fitness e-certificate issuing system. User name - email, password - NIC no without V or X</strong></p>' .
                        '<p>This email is automatically generated by the system. Please do not reply.</p>' .
                        '<p>Log time: ' . date('Y-m-d H:i:s') . '</p>';

            //$mail ->send();
            //header("Location:../c-dashboard.php");

            //error handeling
            try {
                $mail->send();
               
                $msg = "You are Successfully registered."; 	
                header("Location:../d-co-details.php.php?id=$msg&garageId=$garage_id");
            } catch (Exception $e) {
               
                $msg = "Message could not be sent. Mailer Error: " . $mail->ErrorInfo;
                header("Location:../d-co-details.php?id=$msg&garageId=$garage_id");
            }
            
          
            exit();
        }
    }    
}else {
    echo " value not found.";     
}  

mysqli_close($conn);


?>
