<?php
require_once("../include/sessionmanagement.php");
require_once("../include/dbconnection.php");
require_once('../TCPDF-main/tcpdf.php'); 

if (isset($_SESSION['nic'])) {
    $nic = $_SESSION['nic'];
} else {
    echo "NIC value not found.";
    exit; 
}

$sql = "SELECT DISTINCT * 
FROM vehicle as v, issued_certificate as ic, vehi_owner as vo, inspection_report as ir,
certifying_officer as co, booking as b, garage as g, fitness_certificate as fc
WHERE v.vehiId=ic.vehiId 
AND ir.inspectionId=ic.inspectionId 
AND co.cofficerId  =ic.cofficerId  
AND b.bookingId=ic.bookingId 
AND b.garageId = g.garageId 
AND fc.fitnessId =ic.fitnessId 
AND vo.vehiOwnerNic='$nic'";

$result2 = mysqli_query($conn, $sql);

if (mysqli_num_rows($result2) > 0) { 

//image path
$imagePath = '../img/InspectionReport.jpg';

while ($row = mysqli_fetch_assoc($result2)) {

    $reportNo = $row['reportNo'];
    $vehiEngineNo = $row['vehiEngineNo'];
    $vehiChasisNo = $row['vehiChasisNo'];
    $vehiNo = $row['vehiNo'];
    $makeVehi=$row['makeVehi'];
    $engiMake=$row['engineMake'];
    $wheelbase=$row['wheelBase'];
    $engincon=$row['engine'];
    $clutchcon=$row['clutch'];
    $gearboxcon=$row['gearBox'];
    $transmissioncon=$row['transmission'];
    $backaxelcon=$row['backAxle'];
    $frontaxelcon=$row['frontAxle'];
    $wheelcon=$row['wheelsTyres'];
    $springcon=$row['springs'];
    $chassiscon=$row['chassis'];
    $steeringcon=$row['steering'];
    $brakescon=$row['brakes'];
    $fuelcon=$row['fuelSystem'];
    $exhaustcon=$row['exhaustSystem'];
    $electricalcon=$row['electricEquip'];
    $othercon=$row['otherEquip'];
    $bodycon=$row['body'];
    $payload=$row['payLoad'];
    $payloadcon=$row['payLoadCondition'];
    $observation=$row['observation'];
    $garage=$row['garageName'];
    $officefname=$row['cofficerFname'];
    $officerlname=$row['cofficerLname'];
    $issuedate=$row['issueDate'];
    $certificateno=$row['certificateNo'];
    $fittnesno=$row['cofficerLname'];
   
}
// create a new PDF 
$pdf = new TCPDF();

// set document information
$pdf->SetAuthor('DMTWP');
$pdf->SetTitle('Inspection Report');
$pdf->SetSubject('PDF Inspection Report');
$pdf->SetKeywords('PDF, Image, Text');

// add a page to the PDF
$pdf->AddPage();

// embed the image into the PDF with A4 size
$pdf->Image($imagePath, 10, 10, 210, 297, 'JPEG', '', '', false, 300, '', false, false, 0);

// add text to the PDF
$pdf->SetFont('helvetica', '', 10);
$pdf->SetTextColor(0, 0, 0); // black text color
//vehicle no
$pdf->SetXY(55, 57); // set text position
$pdf->Cell(40, 10, $vehiNo, 0, 1, 'L'); // add text to the PDF
//repot no
$pdf->SetXY(145, 57); 
$pdf->Cell(40, 10, $reportNo, 0, 1, 'L'); 
//1 make of vehi
$pdf->SetXY(66, 66); 
$pdf->Cell(40, 10, $makeVehi, 0, 1, 'L'); 
//3chassis no
$pdf->SetXY(135, 66); 
$pdf->Cell(40, 10, $vehiChasisNo, 0, 1, 'L'); 
//2 engi no
$pdf->SetXY(74, 76); 
$pdf->Cell(40, 10, $vehiEngineNo, 0, 1, 'L'); 
//4 wheel base
$pdf->SetXY(135, 76); 
$pdf->Cell(40, 10, $wheelbase, 0, 1, 'L'); 
//5 engine con
$pdf->SetXY(74, 85); 
$pdf->Cell(40, 10, $engincon, 0, 1, 'L'); 
//13 chassis con
$pdf->SetXY(135, 86); 
$pdf->Cell(40, 10, $chassiscon, 0, 1, 'L'); 
//6 clutch con
$pdf->SetXY(74, 95); 
$pdf->Cell(40, 10, $clutchcon, 0, 1, 'L'); 
// 14 steering con
$pdf->SetXY(135, 96); 
$pdf->Cell(40, 10, $steeringcon, 0, 1, 'L'); 
//7 gear con
$pdf->SetXY(74, 104); 
$pdf->Cell(40, 10, $gearboxcon, 0, 1, 'L'); 
// 15 break
$pdf->SetXY(135, 105); 
$pdf->Cell(40, 10, $brakescon, 0, 1, 'L'); 
//8 transmission
$pdf->SetXY(74, 112); 
$pdf->Cell(40, 10, $transmissioncon, 0, 1, 'L'); 
// 16 fule
$pdf->SetXY(135, 115); 
$pdf->Cell(40, 10, $fuelcon, 0, 1, 'L'); 
//9 back axel
$pdf->SetXY(74, 121); 
$pdf->Cell(40, 10, $backaxelcon, 0, 1, 'L'); 
//17 exhaust
$pdf->SetXY(135, 128); 
$pdf->Cell(40, 10, $exhaustcon, 0, 1, 'L'); 
//10 front axel
$pdf->SetXY(74, 129); 
$pdf->Cell(40, 10, $frontaxelcon, 0, 1, 'L'); 
//18 electrical equipment
$pdf->SetXY(135, 138); 
$pdf->Cell(40, 10, $electricalcon, 0, 1, 'L'); 
//11 tyre
$pdf->SetXY(74, 139); 
$pdf->Cell(40, 10, $wheelcon, 0, 1, 'L'); 
//19 other
$pdf->SetXY(135, 148); 
$pdf->Cell(40, 10, $othercon, 0, 1, 'L'); 
//body
$pdf->SetXY(142, 162); 
$pdf->Cell(40, 10, $bodycon, 0, 1, 'L'); 
//12 spring
$pdf->SetXY(74, 148); 
$pdf->Cell(40, 10, $springcon, 0, 1, 'L'); 
//payload
$pdf->SetXY(115, 172); 
$pdf->Cell(40, 10, $payload, 0, 1, 'L'); 
//payload condition
$pdf->SetXY(80, 177); 
$pdf->Cell(40, 10, $payloadcon, 0, 1, 'L'); 
//observation
$pdf->SetXY(50, 195); 
$pdf->Cell(40, 10, $observation, 0, 1, 'L'); 
// fitness no
$pdf->SetXY(150, 202); 
$pdf->Cell(40, 10, $certificateno, 0, 1, 'L'); 
//date
$pdf->SetXY(45, 226); 
$pdf->Cell(40, 10, $issuedate, 0, 1, 'L'); 
// garage name
$pdf->SetXY(115, 241); 
$pdf->Cell(40, 10, $garage, 0, 1, 'L'); 
//certifying officer name
$pdf->SetXY(113, 248); 
$pdf->Cell(40, 10, $officefname, 0, 1, 'L'); 
$pdf->SetXY(128, 248); 
$pdf->Cell(40, 10, $officerlname, 0, 1, 'L'); 

// PDF as a view
$pdf->Output('I'); 

exit;

} else {
    echo '<p>Not e-certificate issued under your Vehicle No</p>';
}

mysqli_close($conn);
?>






