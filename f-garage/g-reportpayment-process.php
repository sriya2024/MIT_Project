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
    if($_GET['start_date']== "" || $_GET['end_date']== ""){
        $msg=("Dates cannot be empty...");
        header("Location:g-reportbooking.php?id=$msg");	
        exit();
    
    }}

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {  
        $action = $_POST['action'];
        //echo $action;
        
       
        // function
        function getPayments($startDate, $endDate, $garageid) {
        global $conn;

        $startDate = mysqli_real_escape_string($conn, $startDate);
        $endDate = mysqli_real_escape_string($conn, $endDate);

        $sqlpayment = "SELECT * FROM booking as b, payment as p, customer as c, vehicle as v
                        WHERE b.vehiId = v.vehiId
                        AND b.bookingId = p.bookingId
                        AND b.cusId = c.cusId
                        AND b.garageId = '$garageid'
                        AND b.bookingDate BETWEEN '$startDate' AND '$endDate'";

        $resultPayment = mysqli_query($conn, $sqlpayment);

        // Error handling
        if (!$resultPayment) {
            die("Error: " . mysqli_error($conn));
        }

        return $resultPayment;
    }
    

    //****************************************** excel
        if ($action=='generate_excel') {
          
            
        $startDate = $_GET['start_date'] ?? '2023-01-01';
        $endDate = $_GET['end_date'] ?? date('Y-m-d');

        // call function
        $payments = getPayments($startDate, $endDate, $garageid);

        $spreadsheet = new Spreadsheet();

        // Spreadsheet
        $sheet = $spreadsheet->getActiveSheet();

        //title 
        $sheet->setCellValue('A1', $startDate . ' To ' . $endDate . ' Payment Details');
        $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true)->setColor(new PhpOffice\PhpSpreadsheet\Style\Color(PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE));

        // merge cells 
        $sheet->mergeCells('A1:I1');

        $sheet->setCellValue('A1', $startDate . ' To ' . $endDate . ' Payment Details');

        //page properties
        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(12);

        //headers 
        $sheet->getStyle('A2:I2')->getFont()->setBold(true)->setColor(new PhpOffice\PhpSpreadsheet\Style\Color(PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE));
        $sheet->getStyle('A2:I2')->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('2E75B5');

        //aAdd headers
        $sheet->setCellValue('A2', 'Payment ID');
        $sheet->setCellValue('B2', 'Booking ID');
        $sheet->setCellValue('C2', 'Vehicle Number');
        $sheet->setCellValue('D2', 'Booking Date');
        $sheet->setCellValue('E2', 'Booking Time');
        $sheet->setCellValue('F2', 'Customer Name');
        $sheet->setCellValue('G2', 'Pay Type');
        $sheet->setCellValue('H2', 'Pay Date');
        $sheet->setCellValue('I2', 'Approved By');


        $row = 3; // Start from row 2
        while ($payment = mysqli_fetch_assoc($payments)) {
            $sheet->setCellValue('A' . $row, $payment['payId']);
            $sheet->setCellValue('B' . $row, $payment['bookingId']);
            $sheet->setCellValue('C' . $row, $payment['vehiNo']);
            $sheet->setCellValue('D' . $row, $payment['bookingDate']);
            $sheet->setCellValue('E' . $row, $payment['timeSlot']);
            $sheet->setCellValue('F' . $row, $payment['cusFname']);
            $sheet->setCellValue('G' . $row, $payment['payType']);
            $sheet->setCellValue('H' . $row, $payment['pDate']);
            $sheet->setCellValue('I' . $row, $payment['aprovedBy']);
            $row++;
        }

        // column width 
        foreach (range('A', 'I') as $column) {
            $sheet->getColumnDimension($column)->setWidth(10);
        }

        //text wrap
        $sheet->getStyle('A1:I' . $row)->getAlignment()->setWrapText(true);

        //alignment to center
        $alignment = $sheet->getStyle('A1:I' . $row)->getAlignment();
        $alignment->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);


        $filename = 'payment_report.xlsx';

        // save temporary location
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
        if ($action=='generate_pdf') {

        
            $startDate = $_GET['start_date'] ?? '2023-01-01';
            $endDate = $_GET['end_date'] ?? date('Y-m-d');

            $payments = getPayments($startDate, $endDate, $garageid);

            //  new mPDF object 
            $mpdf = new Mpdf(['orientation' => 'L']);

            // Set font
            $mpdf->SetFont('Arial');

            // content to PDF
            $mpdf->WriteHTML('<h2>' . $garagename . ' - Payment Details Report</h1>');
            $mpdf->WriteHTML('<p>Date Range: ' . $startDate . ' to ' . $endDate . '</p>');
           
         

            // add a table 
            $mpdf->WriteHTML('<table border="1" cellspacing="0" cellpadding="5">
                                <tr>
                                    <th>Payment ID</th>
                                    <th>Booking ID</th>
                                    <th>Vehicle Number</th>
                                    <th>Booking Date</th>
                                    <th>Booking Time</th>
                                    <th>Customer Name</th>
                                    <th>Pay Type</th>
                                    <th>Pay Date</th>
                                    <th>Approved By</th>
                                </tr>');

            while ($payment = mysqli_fetch_assoc($payments)) {
                $mpdf->WriteHTML('<tr>
                                    <td>'.$payment['payId'].'</td>
                                    <td>'.$payment['bookingId'].'</td>
                                    <td>'.$payment['vehiNo'].'</td>
                                    <td>'.$payment['bookingDate'].'</td>
                                    <td>'.$payment['timeSlot'].'</td>
                                    <td>'.$payment['cusFname'].'</td>
                                    <td>'.$payment['payType'].'</td>
                                    <td>'.$payment['pDate'].'</td>
                                    <td>'.$payment['aprovedBy'].'</td>
                                </tr>');
            }

            // close table
            $mpdf->WriteHTML('</table>');
            //  timezone
            date_default_timezone_set('asia/kolkata');
            $date = date('m/d/Y h:i:s a', time());
            $mpdf->WriteHTML('<p>Generated on: ' .  $date. '</p>');
            // output PDF to browser
            $mpdf->Output('payment_report.pdf', 'D');

            exit();

        }

        }
    }



?>
            

   
