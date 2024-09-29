<?php
require_once("../include/sessionmanagementdmt.php");
require_once("../include/dbconnection.php");
require_once('../TCPDF-main/tcpdf.php'); 

if (isset($_SESSION['stfNic'])) {
$nic = $_SESSION['stfNic'];
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
AND fc.fitnessId =ic.fitnessId";

$result2 = mysqli_query($conn, $sql);

if (mysqli_num_rows($result2) > 0) { 

//image path
$imagePath = '../img/FitnessCertificate.jpg';

while ($row = mysqli_fetch_assoc($result2)) {

    $certificateno=$row['certificateNo'];
    $issuedate=$row['issueDate'];
    $descriptionVehi=$row['descriptionVehi'];
    $vehiNo = $row['vehiNo'];
    $makeVehi=$row['makeVehi'];
    $vehiChasisNo = $row['vehiChasisNo'];
    $vehiEngineNo = $row['vehiEngineNo'];
    $tyerfrontSize=$row['tyerfrontSize'];
    $tyerrearSize=$row['tyerrearSize'];
    $tyerRequir=$row['tyerRequir'];
    $NoAxles=$row['NoAxles'];
    $typeBody=$row['typeBody'];
    $payload=$row['payLoad'];
    $payloadcon=$row['payLoadCondition'];
    $observation=$row['observation'];
    $validUntill=$row['validUntill'];
    $garage=$row['garageName'];
    $officefname=$row['cofficerFname'];
    $officerlname=$row['cofficerLname'];  
}
// Create a new PDF document
$pdf = new TCPDF();

// Set document information
$pdf->SetAuthor('DMTWP');
$pdf->SetTitle('Fitness Certificate');
$pdf->SetSubject('PDF Fitness Certificate');
$pdf->SetKeywords('PDF, Image, Text');

// Add a page to the PDF
$pdf->AddPage();

// Embed the image into the PDF with A4 size
$pdf->Image($imagePath, 10, 10, 210, 297, 'JPEG', '', '', false, 300, '', false, false, 0);

// Add text to the PDF
$pdf->SetFont('helvetica', '', 10);
$pdf->SetTextColor(0, 0, 0); // Black text color
//certificate no
$pdf->SetXY(140, 50); // Set text position
$pdf->Cell(40, 10, $certificateno, 0, 1, 'L'); // Add text to the PDF
//issuedate
$pdf->SetXY(160, 50); 
$pdf->Cell(40, 10, $issuedate, 0, 1, 'L'); 
//description of vehi
$pdf->SetXY(128, 108); 
$pdf->Cell(40, 10, $descriptionVehi, 0, 1, 'L'); 
//registration no
$pdf->SetXY(128, 112); 
$pdf->Cell(40, 10, $vehiNo, 0, 1, 'L'); 
//make 
$pdf->SetXY(128, 116); 
$pdf->Cell(40, 10, $makeVehi, 0, 1, 'L'); 
//chassis no 
$pdf->SetXY(60, 121); 
$pdf->Cell(40, 10, $vehiChasisNo, 0, 1, 'L'); 
//engine no 
$pdf->SetXY(145, 121); 
$pdf->Cell(40, 10, $vehiEngineNo, 0, 1, 'L'); 
//front
$pdf->SetXY(88, 132); 
$pdf->Cell(40, 10, $tyerfrontSize, 0, 1, 'L'); 
//rear  
$pdf->SetXY(130, 132); 
$pdf->Cell(40, 10, $tyerrearSize, 0, 1, 'L'); 
//tyre require 
$pdf->SetXY(149, 132); 
$pdf->Cell(40, 10, $tyerRequir, 0, 1, 'L'); 
//axcel 
$pdf->SetXY(130, 140); 
$pdf->Cell(40, 10, $NoAxles, 0, 1, 'L'); 
//body 
$pdf->SetXY(130, 145); 
$pdf->Cell(40, 10, $typeBody, 0, 1, 'L'); 
//payload 
$pdf->SetXY(130, 157); 
$pdf->Cell(40, 10, $payload, 0, 1, 'L'); 
//valid date 
$pdf->SetXY(125, 170); 
$pdf->Cell(40, 10, $validUntill, 0, 1, 'L'); 
//issuedate
$pdf->SetXY(125, 174); 
$pdf->Cell(40, 10, $issuedate, 0, 1, 'L'); 
//offcer name
$pdf->SetXY(142, 195); 
$pdf->Cell(40, 10, $officefname, 0, 1, 'L'); 
$pdf->SetXY(158, 195); 
$pdf->Cell(40, 10, $officerlname, 0, 1, 'L'); 
//garage name
$pdf->SetXY(142, 204); 
$pdf->Cell(40, 10, $garage, 0, 1, 'L'); 


//  PDF as a view
$pdf->Output('I'); 
exit;

} else {
    echo '<p>Not e-certificate issued under your Vehicle No</p>';
}

mysqli_close($conn);
?>






