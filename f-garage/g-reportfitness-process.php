<?php                  
require_once("../include/session.php");
require_once("../include/sessionmanagementgarage.php");
require_once("../include/dbconnection.php");

require "../vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;

if (isset($_SESSION['unic'])) {
    $usernic = $_SESSION['unic'];
    $garageid = $_SESSION['garageId'];
    $garagename = $_SESSION['gname'];
    
} else {
    echo "value not found.";
}





 if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['action'])) {  
        $action = $_GET['action'];
        $issuedby = $_GET['issuedby'];
       // echo $action;

        //function
         function getFitness($startDate, $endDate, $category, $garageid,$issuedby) {
         global $conn;
 
         $startDate = mysqli_real_escape_string($conn, $startDate);
         $endDate = mysqli_real_escape_string($conn, $endDate);
         $category = mysqli_real_escape_string($conn, $category);
         //$issuedby = mysqli_real_escape_string($conn, $issuedby);
 
         // SQL query
         $sqlFitness = "SELECT * FROM booking as b, customer as c, vehicle as v, issued_certificate as ic, certifying_officer as co, fitness_certificate as fc
                         WHERE b.vehiId = v.vehiId
                         AND b.cusId = c.cusId
                         AND b.bookingId = ic.bookingId
                         AND fc.fitnessId = ic.fitnessId
                         AND co.cofficerId = ic.cofficerId
                         AND ic.issueby = '$issuedby'
                         AND b.garageId = '$garageid'
                         AND ic.issueDate BETWEEN '$startDate' AND '$endDate'
                         ";
 

        // category is not all
        if ($category != 'all') {
            $sqlFitness .= " AND ic.fStatus  = '$category'";
        }

         $resultFitness = mysqli_query($conn, $sqlFitness);
 
         // Error handling
         if (!$resultFitness) {
             die("Error: " . mysqli_error($conn));
         }
 
         return $resultFitness;
     }

    //****************************************** excel
        if ($action=='generate_excel') {

        // check get valu and assing default values
        //?? null coalescing operator 
        $startDate = $_GET['start_date'] ?? '2023-01-01';
        $endDate = $_GET['end_date'] ?? date('Y-m-d');
        $category = $_GET['category'] ?? 'all';
    
        // call function 
        $fitnesses = getFitness($startDate, $endDate, $category, $garageid,$issuedby);
        
        //excel
        $spreadsheet = new Spreadsheet();

        $sheet = $spreadsheet->getActiveSheet();

        // set title 
        $sheet->setCellValue('A1', $startDate . ' To ' . $endDate . ' Fitness Certificate issuing Details');
        $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true)->setColor(new PhpOffice\PhpSpreadsheet\Style\Color(PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE));

        // merge cells and set value for A1
        $sheet->mergeCells('A1:H1');
        $sheet->setCellValue('A1', $startDate . ' To ' . $endDate . ' Fitness Certificate issuing Details');

        // set page properties
        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(12);

        // set headers and formatting for headers
        $sheet->getStyle('A2:H2')->getFont()->setBold(true)->setColor(new PhpOffice\PhpSpreadsheet\Style\Color(PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE));
        $sheet->getStyle('A2:H2')->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('2E75B5');

        // add headers
        $sheet->setCellValue('A2', 'Issue ID');
        $sheet->setCellValue('B2', 'Vehicle Number');
        $sheet->setCellValue('C2', 'Booking ID');
        $sheet->setCellValue('D2', 'Customer Name');
        $sheet->setCellValue('E2', 'Status');
        $sheet->setCellValue('F2', 'Certificate No');
        $sheet->setCellValue('G2', 'Issued Date');
        $sheet->setCellValue('H2', 'Issued By');
     

        $row = 3; // start from row 2
        while ($fitness = mysqli_fetch_assoc($fitnesses)) {
            $sheet->setCellValue('A' . $row, $fitness['issueId']);
            $sheet->setCellValue('B' . $row, $fitness['vehiNo']);
            $sheet->setCellValue('C' . $row, $fitness['bookingId']);
            $sheet->setCellValue('D' . $row, $fitness['cusFname']);
            $sheet->setCellValue('E' . $row, $fitness['fStatus']);
            $sheet->setCellValue('F' . $row, $fitness['certificateNo']);
            $sheet->setCellValue('G' . $row, $fitness['issueDate']);
            $sheet->setCellValue('H' . $row, $fitness['cofficerFname']);
            $row++;
        }

        // set column width 
        foreach (range('A', 'H') as $column) {
            $sheet->getColumnDimension($column)->setWidth(10);
        }

        //text wrap for all cells
        $sheet->getStyle('A1:H' . $row)->getAlignment()->setWrapText(true);

        //set alignment to center for all cells
        $alignment = $sheet->getStyle('A1:H' . $row)->getAlignment();
        $alignment->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $filename = 'fitness_detils_report.xlsx';

        // save Excel file to a temporary location
        $tempFile = tempnam(sys_get_temp_dir(), 'excel');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // clear output buffers
        ob_clean();

        // set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        header('Content-Length: ' . filesize($tempFile));

        // output to browser
        echo file_get_contents($tempFile);

        // delete temporary file
        unlink($tempFile);
        exit();
        }
//****************************************** pdf
if ($action == 'generate_pdf') {
    
    // check get valu and assing default values
    //?? null coalescing operator 
    $startDate = $_GET['start_date'] ?? '2023-01-01';
    $endDate = $_GET['end_date'] ?? date('Y-m-d');
    $category = $_GET['category'] ?? 'all';
   
 
     // call function 
     $fitnesses = getFitness($startDate, $endDate, $category, $garageid,$issuedby);
 
     // create a new mPDF object 
     $mpdf = new Mpdf(['orientation' => 'L']);
 
     // Set font
     $mpdf->SetFont('Arial');
 
     // start adding content to PDF
     $mpdf->WriteHTML('<h2>' . $garagename . ' - Vehicle Fitness e-certificate issued Details Report</h1>');
     $mpdf->WriteHTML('<p>Date Range: ' . $startDate . ' to ' . $endDate . '</p>');
 
     // sdd table
     $mpdf->WriteHTML('<table border="1" cellspacing="0" cellpadding="5">
                         <tr>
                             <th>Issue ID</th>
                             <th>Vehicle Number</th>
                             <th>Booking ID</th>
                             <th>Customer Name</th>
                             <th>Issuing Status</th>
                             <th>Fitness e-certificate No</th>
                             <th>Issue Date</th>
                             <th>Issued By</th>
                         </tr>');
 
     // iterate over data and add rows to the table
     while ($fitness = mysqli_fetch_assoc($fitnesses)) {
         $mpdf->WriteHTML('<tr>
                             <td>' . $fitness['issueId'] . '</td>
                             <td>' . $fitness['vehiNo'] . '</td>
                             <td>' . $fitness['bookingId'] . '</td>
                             <td>' . $fitness['cusFname'] . '</td>
                             <td>' . $fitness['fStatus'] . '</td>
                             <td>' . $fitness['certificateNo'] . '</td>
                             <td>' . $fitness['issueDate'] . '</td>
                             <td>' . $fitness['issueby'] . '</td>
                         </tr>');
     }
 
     // close the table
     $mpdf->WriteHTML('</table>');
 
     // timezone
     date_default_timezone_set('asia/kolkata');
     $date = date('m/d/Y h:i:s a', time());
     $mpdf->WriteHTML('<p>Generated on: ' .  $date. '</p>');
 
     // output PDF to browser
     $mpdf->Output('fitness_report.pdf', 'D');
 
     exit();


        }
    }

 }

?>
            

   
