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

if (isset($_GET["action"])){
    if($_GET['start_date']== "" || $_GET['end_date']== "" | $_GET['category']== ""){
        $msg=("Dates and category cannot be empty...");
        header("Location:g-reportbooking.php?id=$msg");	
		exit();
    
    }}


 if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['action'])) {  
        $action = $_GET['action'];
        //echo $action;

        // function
        function getInspections($startDate, $endDate, $category, $garageid){
        global $conn;

        $startDate = mysqli_real_escape_string($conn, $startDate);
        $endDate = mysqli_real_escape_string($conn, $endDate);
        $category = mysqli_real_escape_string($conn, $category);

          // SQL query
          $sqlInspections = "SELECT * FROM booking as b, customer as c, vehicle as v, issued_certificate as ic, certifying_officer as co, inspection_report as ir
          WHERE b.vehiId = v.vehiId
          AND b.cusId = c.cusId
          AND b.bookingId = ic.bookingId
          AND ir.inspectionId = ic.inspectionId
          AND co.cofficerId = ic.cofficerId
          AND b.garageId = '$garageid'
          AND b.bookingDate BETWEEN '$startDate' AND '$endDate'
         ";

   
        if ($category != 'all') {
            $sqlFitness .= " AND ic.iStatus  = '$category'";
        }

        $resultInspections = mysqli_query($conn, $sqlInspections);

        // Error handling
        if (!$resultInspections) {
            die("Error: " . mysqli_error($conn));
        }

        return $resultInspections;
    }


    //****************************************** excel
        if ($action=='generate_excel') {
        
     
        $startDate = $_GET['start_date'] ?? '2023-01-01';
        $endDate = $_GET['end_date'] ?? date('Y-m-d');
        $category = $_GET['category'] ?? 'all';
    
        // call function
        $inspections = getInspections($startDate, $endDate, $category, $garageid);

        //  Spreadsheet
        $spreadsheet = new Spreadsheet();

        // data to the Spreadsheet
        $sheet = $spreadsheet->getActiveSheet();

        // title and formatting for title
        $sheet->setCellValue('A1', $startDate . ' To ' . $endDate . ' Ispection Details');
        $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true)->setColor(new PhpOffice\PhpSpreadsheet\Style\Color(PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE));

        // mereg cells 
        $sheet->mergeCells('A1:H1');
        //set value for A1
        $sheet->setCellValue('A1', $startDate . ' To ' . $endDate . ' Ispection Details');

        //  page properties
        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(12);

        // headers and formatting for headers
        $sheet->getStyle('A2:H2')->getFont()->setBold(true)->setColor(new PhpOffice\PhpSpreadsheet\Style\Color(PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE));
        $sheet->getStyle('A2:H2')->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('2E75B5');

        // Add headers
        $sheet->setCellValue('A2', 'Inspection ID');
        $sheet->setCellValue('B2', 'Vehicle Number');
        $sheet->setCellValue('C2', 'Booking ID');
        $sheet->setCellValue('D2', 'Customer Name');
        $sheet->setCellValue('E2', 'Vehicle Inspection Status');
        $sheet->setCellValue('F2', 'Isuing Status');
        $sheet->setCellValue('G2', 'Issue Date');
        $sheet->setCellValue('H2', 'Inspector Name');
       

        $row = 3; // Start from row 2
        while ($inspection = mysqli_fetch_assoc($inspections)) {
            $sheet->setCellValue('A' . $row, $inspection['inspectionId']);
            $sheet->setCellValue('B' . $row, $inspection['vehiNo']);
            $sheet->setCellValue('C' . $row, $inspection['bookingId']);
            $sheet->setCellValue('D' . $row, $inspection['cusFname']);
            $sheet->setCellValue('E' . $row, $inspection['vehiInspection']);
            $sheet->setCellValue('F' . $row, $inspection['iStatus']);
            $sheet->setCellValue('G' . $row, $inspection['issueDate']);
            $sheet->setCellValue('H' . $row, $inspection['cofficerFname']);
        
            $row++;
        }
  


        // column width
        foreach (range('A', 'I') as $column) {
            $sheet->getColumnDimension($column)->setWidth(10);
        }

        //text wrap 
        $sheet->getStyle('A1:I' . $row)->getAlignment()->setWrapText(true);

        // alignmentcenter 
        $alignment = $sheet->getStyle('A1:I' . $row)->getAlignment();
        $alignment->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        $filename = 'Inspection_details_report.xlsx';

        // save Excel file to a temporary location
        $tempFile = tempnam(sys_get_temp_dir(), 'excel');
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempFile);

        // clear output buffers
        ob_clean();

        // set headers 
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
    $inspections = getInspections($startDate, $endDate, $category, $garageid);

    // new mPDF object 
    $mpdf = new Mpdf(['orientation' => 'L']);

    // Set font
    $mpdf->SetFont('Arial');

    // PDF
    $mpdf->WriteHTML('<h2>' . $garagename . ' - Vehicle Inspection Details Report</h1>');
    $mpdf->WriteHTML('<p>Date Range: ' . $startDate . ' to ' . $endDate . '</p>');

    //table with headers
    $mpdf->WriteHTML('<table border="1" cellspacing="0" cellpadding="5">
                        <tr>
                            <th>Inspection ID</th>
                            <th>Vehicle Number</th>
                            <th>Booking ID</th>
                            <th>Customer Name</th>
                            <th>Vehicle Inspection Status</th>
                            <th>Isuing Status</th>
                            <th>Issue Date</th>
                            <th>Inspector Name</th>
                        </tr>');

    while ($inspection = mysqli_fetch_assoc($inspections)) {
        $mpdf->WriteHTML('<tr>
                            <td>' . $inspection['inspectionId'] . '</td>
                            <td>' . $inspection['vehiNo'] . '</td>
                            <td>' . $inspection['bookingId'] . '</td>
                            <td>' . $inspection['cusFname'] . '</td>
                            <td>' . $inspection['vehiInspection'] . '</td>
                            <td>' . $inspection['iStatus'] . '</td>
                            <td>' . $inspection['issueDate'] . '</td>
                            <td>' . $inspection['cofficerFname'] . '</td>
                        </tr>');
    }

    // close the table
    $mpdf->WriteHTML('</table>');

    // timezone
    date_default_timezone_set('asia/kolkata');
    $date = date('m/d/Y h:i:s a', time());
    $mpdf->WriteHTML('<p>Generated on: ' .  $date. '</p>');

    // output PDF to browser
    $mpdf->Output('inspection_report.pdf', 'D');


    exit();
}

    }

 }

?>
            

   
