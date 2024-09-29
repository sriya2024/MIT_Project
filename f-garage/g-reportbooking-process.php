<?php                  
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

//check empty input
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

        //function 
        function getBookings($startDate, $endDate, $category, $garageid) {
            global $conn;
    
            $startDate = mysqli_real_escape_string($conn, $startDate);
            $endDate = mysqli_real_escape_string($conn, $endDate);
            $category = mysqli_real_escape_string($conn, $category);
                //check end date cannot be grater than start date
                if($startDate<<$endDate) {
                    $sqlbooking = "SELECT * FROM booking as b, customer as c, vehicle as v
                                    WHERE b.vehiId = v.vehiId
                                    AND b.cusId = c.cusId
                                    AND b.garageId = '$garageid'
                                    AND b.bookingDate BETWEEN '$startDate' AND '$endDate'";
                    
                    // category is not all
                    if ($category != 'all') {
                        $sqlbooking .= " AND b.bStatus = '$category'";
                    }
                
                    $resultBooking = mysqli_query($conn, $sqlbooking);
            
                    // error handling
                    if (!$resultBooking) {
                        die("Error: " . mysqli_error($conn));
                    }
    
                     return $resultBooking;
            }  else {
                $msg=("Please select the End date later than the Start date...");
                header("Location:g-reportbooking.php?id=$msg");	
                exit();
            }
        }



    //****************************************** excel
        if ($action=='generate_excel') {
          
       // check get valu and assing default values
        //?? null coalescing operator 
        $startDate = $_GET['start_date'] ?? '2023-01-01';
        $endDate = $_GET['end_date'] ?? date('Y-m-d');
        $category = $_GET['category'] ?? 'all';

    
        // call funtion
        $bookings = getBookings($startDate, $endDate, $category, $garageid);

        // create new Spreadsheet
        $spreadsheet = new Spreadsheet();

        // add data 
        $sheet = $spreadsheet->getActiveSheet();

        // set title
        $sheet->setCellValue('A1', $startDate . ' To ' . $endDate . ' Booking Details');
        $sheet->getStyle('A1')->getFont()->setSize(16)->setBold(true)->setColor(new PhpOffice\PhpSpreadsheet\Style\Color(PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLUE));

        // merge 9 cells
        $sheet->mergeCells('A1:F1');

        //set value for A1
        $sheet->setCellValue('A1', $startDate . ' To ' . $endDate . ' Booking Details');

        // set page properties
        $spreadsheet->getDefaultStyle()->getFont()->setName('Arial')->setSize(12);

        // set headers 
        $sheet->getStyle('A2:F2')->getFont()->setBold(true)->setColor(new PhpOffice\PhpSpreadsheet\Style\Color(PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE));
        $sheet->getStyle('A2:F2')->getFill()->setFillType(PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('2E75B5');

        // add headers
        $sheet->setCellValue('A2', 'Booking ID');
        $sheet->setCellValue('B2', 'Vehicle Number');
        $sheet->setCellValue('C2', 'Booking Date');
        $sheet->setCellValue('D2', 'Booking Time');
        $sheet->setCellValue('E2', 'Customer Name');
        $sheet->setCellValue('F2', 'Booking Status');
       

        
        $row = 3; // start from row 2
        // get data 
        while ($booking= mysqli_fetch_assoc($bookings)) {
            $sheet->setCellValue('A' . $row, $booking['bookingId']);
            $sheet->setCellValue('B' . $row, $booking['vehiNo']);
            $sheet->setCellValue('C' . $row, $booking['bookingDate']);
            $sheet->setCellValue('D' . $row, $booking['timeSlot']);
            $sheet->setCellValue('E' . $row, $booking['cusFname']);
            $sheet->setCellValue('F' . $row, $booking['bStatus']);
            $row++;
        }

        //column width 
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setWidth(10);
        }

        //text wrap for all cells
        $sheet->getStyle('A1:F' . $row)->getAlignment()->setWrapText(true);

        //alignment to center for all cells
        $alignment = $sheet->getStyle('A1:F' . $row)->getAlignment();
        $alignment->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        //filename
        $filename = 'booking_report.xlsx';

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
        if ($action=='generate_pdf') {
            // check get valu and assing default values
            //?? null coalescing operator 
            $startDate = $_GET['start_date'] ?? '2023-01-01';
            $endDate = $_GET['end_date'] ?? date('Y-m-d');
            $category = $_GET['category'] ?? 'all';


            // call function
            $bookings = getBookings($startDate, $endDate, $category, $garageid);
            
            //new mPDF object with A4 size and vertical orientation
            $mpdf = new Mpdf(['orientation' => 'L']);

            // set font
            $mpdf->SetFont('Arial');

            // adding content to PDF
            $mpdf->WriteHTML('<h2>' . $garagename . ' - Booking Details Report</h1>');
            $mpdf->WriteHTML('<p>Date Range: ' . $startDate . ' to ' . $endDate . '</p>');
           
         
            // sdd a table with headers
            $mpdf->WriteHTML('<table border="1" cellspacing="0" cellpadding="5">
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Vehicle Number</th>
                                    <th>Booking Date</th>
                                    <th>Booking Time</th>
                                    <th>Customer Name</th>
                                    <th>Booking Status</th>
                                </tr>');

            // iterate over data and add rows to the table
            while ($booking = mysqli_fetch_assoc($bookings)) {
                $mpdf->WriteHTML('<tr>
                                    <td>'.$booking['bookingId'].'</td>
                                    <td>'.$booking['vehiNo'].'</td>
                                    <td>'.$booking['bookingDate'].'</td>
                                    <td>'.$booking['timeSlot'].'</td>
                                    <td>'.$booking['cusFname'].'</td>
                                    <td>'.$booking['bStatus'].'</td>
                          
                                </tr>');
            }

            // close the table
            $mpdf->WriteHTML('</table>');
            // timezone
            date_default_timezone_set('asia/kolkata');
            $date = date('m/d/Y h:i:s a', time());
            $mpdf->WriteHTML('<p>Generated on: ' .  $date. '</p>');
            // output PDF to browser
            $mpdf->Output('booking_report.pdf', 'D');

            exit();

            }
        }
    }
?>
            

   
