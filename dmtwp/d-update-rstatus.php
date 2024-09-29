<?php
//update renew status
  require_once("../include/session.php");
  require_once("../include/sessionmanagementdmt.php");
  require_once("../include/dbconnection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the update
    if (isset($_POST["update"])) {
        $update_ststus = $_POST["update"];
        $renewId = $_POST["request_id"];
        $garageId = $_POST["garage_id"];
        $requestYear = $_POST["request_year"];
        
    }else {
        echo "value not found.";
}
}

if ($update_ststus == 'Pending'){
        $sqlup = "UPDATE garage_renew SET rStatus = 'Accepted' WHERE renewId = $renewId";
        
        $resultin=mysqli_query($conn,$sqlup) or die(mysqli_error($conn));
   
}elseif ($update_ststus == 'Accepted') {
    $sqlup = "UPDATE garage_renew SET rStatus = 'Complete' WHERE renewId = $renewId";
   
    $resultin=mysqli_query($conn,$sqlup) or die(mysqli_error($conn));
    $currentDate= date("Y-m-d");
    $approvedBy=$_SESSION['stfFname'];

    $sqlupgarage = "UPDATE garage SET regYear = '$requestYear', registredDate = '$currentDate', registredBy = '$approvedBy' WHERE garageId = $garageId";
   
    $resultin=mysqli_query($conn,$sqlupgarage) or die(mysqli_error($conn));

}

header('Location:d-renewmgt.php');
?>
