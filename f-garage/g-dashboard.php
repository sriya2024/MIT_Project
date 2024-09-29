<?php                 
include_once "../include/headergarage.php";      

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["vehiNo"])) {
        $vehiNo = $_POST["vehiNo"];
    }else {
        echo "value not found.";
}
}
?>

<!-- ****************************** garage owner******************************* -->  
<?php 
if($_SESSION['roleId']==1){ ?> 

<!-- garage owner dashboard -->  
<section id="godashboard">
        <div class="container py-5">
            <h3 class="text-right mt-4 pt-4"><?php echo $garagename?></h3>
            <p class="text-right">Dashboard</p>
            <div class="container">
       
            <?php if (isset($_GET["id"])){?>
            <p class="p-2 text-center alert alert-info">
            <span class="text-secondary"> <?php echo $_GET["id"];?> </span>
            </p> 
            <?php  } ?>

           <!-- 1st row -->  
           <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4 pt-4">
                    <div class="col-12 col-md-3">
                        <div class="card shadow mb-5 bg-body rounded ">
                            <div class="card-body bg-primary text-white ">
                                <?php 
                                 $sqlrow1="SELECT * FROM booking as b, garage as g
                                 WHERE g.garageId=b.garageId
                                 AND b.garageId='$garageid'
                                 AND b.bStatus='Pending'";
                                 $resultpending = mysqli_query($conn, $sqlrow1);
                                 $countpending=mysqli_num_rows($resultpending); 
                                ?>
                                <h4>Booking &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<b><?php echo $countpending; ?></b></h4>
                                <p>Pending</p>   
                            </div>
                        </div>
                    </div> 
                    <div class="col-12 col-md-3">
                        <div class="card shadow mb-5 bg-body rounded ">
                            <div class="card-body bg-primary text-white ">
                                <?php 
                                 $today=date("Y-m-d");
                                 $sqltoday="SELECT * FROM booking as b, garage as g
                                 WHERE g.garageId=b.garageId
                                 AND b.garageId='$garageid'
                                 AND b.bookingDate='$today'";
                                 $resultoday = mysqli_query($conn, $sqltoday);
                                 $counttoday=mysqli_num_rows($resultoday); 
                                ?>

                                <h4>Booking &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<b><?php echo $counttoday; ?></b></h4>
                                <p>Today</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card shadow mb-5 bg-body rounded ">
                            <div class="card-body bg-primary text-white ">
                            <?php 
                                 $sqlrowfit="SELECT * FROM booking as b, garage as g, issued_certificate as ic 
                                 WHERE g.garageId=b.garageId
                                 AND b.bookingId=ic.bookingId
                                 AND b.garageId='$garageid'
                                 AND ic.fStatus='Complete'
                                 AND ic.issueDate='$today'";
                                 $resultfit = mysqli_query($conn, $sqlrowfit);
                                 $countfit=mysqli_num_rows($resultfit); 
                                ?>
                                <h4>Fitness Certificate <b><?php echo $countfit; ?></b></h4>
                                <p>Issued Today</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="card  shadow mb-5 bg-body rounded ">
                            <div class="card-body bg-primary text-white ">
                                 <?php 
                                 $sqlrowreject="SELECT * FROM booking as b, garage as g, issued_certificate as ic 
                                 WHERE g.garageId=b.garageId
                                 AND b.bookingId=ic.bookingId
                                 AND b.garageId='$garageid'
                                 AND b.vehiInspection='Reject'";
                                 $resultereject = mysqli_query($conn, $sqlrowreject);
                                 $countreject=mysqli_num_rows($resultereject); 
                                ?>
                                <h4>Inspection &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<b><?php echo $countreject; ?></b></h4>
                                <p>Reject</p>
                            </div>
                        </div>
                    </div>       
            </div>
              <!-- 2nd row -->  

            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4">
                <div class="col-12">
                    <div class="card shadow mb-5 bg-body rounded">
                        <div class="text-left p-4" style="background-color: #e3f2fd">
                        <h4 class="card-title">Inspection Report & Fitness Certificate</h4>
                         <p>Search either Vehicle Number or Engine No. Vehicle Number should insert on ABXXXX format.</p> <hr>
                         
                            <div class="container-fluid" >
                                <form class="d-flex" action="g-dashboard.php" method="POST">
                                <input class="form-control me-2" type="text" placeholder="Vehicle Number" aria-label="Search" id="vehiNo" name="vehiNo" required>
                                <input class="form-control me-2" type="text" placeholder="Engine Number" aria-label="Search" id="engiNo" name="engiNo">
                                
                                <button class="btn btn-outline-primary" type="submit">Search</button>
                                </form>
                            </div>
                        </div>   
                        <div class="card-body text-center" >
                      
                            <?php
                            if (isset($_POST["vehiNo"]) && isset($_POST["engiNo"])) {
                          
                            $vehiNo = filter_var($_POST["vehiNo"], FILTER_SANITIZE_STRING);
                            $engiNo = filter_var($_POST["engiNo"], FILTER_SANITIZE_STRING);
                            
                            $vehiNo = mysqli_real_escape_string($conn, $vehiNo);
                            $engiNo = mysqli_real_escape_string($conn, $engiNo);

                            $sql2 = "SELECT DISTINCT *  FROM vehicle as v, issued_certificate as ic, fitness_certificate as fc, inspection_report as ir
                            WHERE v.vehiId=ic.vehiId 
                            AND ic.inspectionId = ir.inspectionId
                            AND ic.fitnessId=fc.fitnessId
                            AND (v.vehiNo='$vehiNo' OR v.vehiEngineNo='$engiNo') 
                            AND ic.inspectionId!='0' AND ic.fitnessId!='0'";

                                
                                $result2 = mysqli_query($conn, $sql2); 

                                        if (mysqli_num_rows($result2) > 0) { ?>
                                        <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Vehicle No</th>
                                                <th>Engine Number</th>
                                                <th>Inspection Report No</th>
                                                <th>e-fitness Certificate No</th>
                                            </tr>
                                        </thead>
                                        <?php while ($row = mysqli_fetch_assoc($result2)) { ?>
                                            <tbody>   
                                                <tr>
                                                    <td><?php echo $row['vehiNo']; ?></td>
                                                    <td><?php echo $row['vehiEngineNo']; ?></td>
                                                    <td><?php echo $row['reportNo']; ?></br><a class="link-primary" href="g-report-iview.php" target="_blank">View</a> | <a class="link-primary" href="g-report-idown.php" target="_blank">Download</a></td>
                                                    <td><?php echo $row['certificateNo']; ?></br><a class="link-primary" href="g-report-fview.php" target="_blank">View</a> | <a class="link-primary" href="g-report-fdown.php" target="_blank">Download</a></td>
                                                </tr>
                                        <?php } ?>
                                        </tbody>
                                        </table>
                                    <?php } else { ?>
                                        <p>Not e-certificate issued under your Vehicle No</p>
                                    <?php } }
                                    mysqli_close($conn);
                                    ?>
                        </div> 
                    </div>
                </div>    
            </div>
          
              <!-- 3rd row -->  

            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4">
                <div class="col-12 col-md-2">
                    <div class="card h-80 shadow mb-5 bg-body rounded">
                        <div class="card-body">  
                        <a class="btn btn-outline-primary d-grid py-5" href="g-bookingmgt.php" role="button">Booking Management</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="card h-80 shadow mb-5 bg-body rounded">
                        <div class="card-body">
                        <a class="btn btn-outline-primary d-grid py-5" href="g-paymentmgt.php" role="button">Payment Managemet</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="card h-80 shadow mb-5 bg-body rounded">
                        <div class="card-body">
                        <a class="btn btn-outline-primary d-grid py-5" href="g-reportmgt.php" role="button">Report Management</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card h-80 shadow mb-5 bg-body rounded p-1">
                        <div class="card-body">
                            
                            <div class="row py-1">
                            <h4 class="card-title">Registerd Year - <?php echo $garageregyear; ?></h4>
                                <div class="col-sm-6 pt-2">
                                    
                                    <a class="btn btn-outline-primary d-grid p-2" href="g-garage-details.php" role="button">Veiw Garage Registration Certificate</a> </br>

                                </div>
                                <div class="col-sm-6 pt-2">
                                <a class="btn btn-outline-primary d-grid p-2" href="g-renew-registration.php" role="button">Renew registration</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> 
            </div>
        </div>
</section>
    
<?php }?>

<!-- *********************Certifying officer*********************** -->  
<?php 
if($_SESSION['roleId']==2){ ?> 
    
<!-- certifing officer dashboard -->  
<section id="codashboard">
        <div class="container py-5">
            <h3 class="text-right mt-2 pt-4"><?php echo $garagename?></h3>
            <p class="text-right">Dashboard</p>
            <div class="container">
       
            <!-- 1st row -->  
            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4 pt-4">
                    <div class="col-12 col-md-3">
                        <div class="card shadow mb-5 bg-body rounded ">
                            <div class="card-body bg-primary text-white ">
                                <?php 
                                 $sqlrow1="SELECT * FROM booking as b, garage as g
                                 WHERE g.garageId=b.garageId
                                 AND b.garageId='$garageid'
                                 AND b.bStatus='Pending'";
                                 $resultpending = mysqli_query($conn, $sqlrow1);
                                 $countpending=mysqli_num_rows($resultpending); 
                                ?>
                                <h4>Booking &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<b><?php echo $countpending; ?></b></h4>
                                <p>Pending</p>   
                            </div>
                        </div>
                    </div> 
                    <div class="col-12 col-md-3">
                        <div class="card shadow mb-5 bg-body rounded ">
                            <div class="card-body bg-primary text-white ">
                                <?php 
                                 $today=date("Y-m-d");
                                 $sqltoday="SELECT * FROM booking as b, garage as g
                                 WHERE g.garageId=b.garageId
                                 AND b.garageId='$garageid'
                                 AND b.bookingDate='$today'";
                                 $resultoday = mysqli_query($conn, $sqltoday);
                                 $counttoday=mysqli_num_rows($resultoday); 
                                ?>

                                <h4>Booking &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<b><?php echo $counttoday; ?></b></h4>
                                <p>Today</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card shadow mb-5 bg-body rounded ">
                            <div class="card-body bg-primary text-white ">
                            <?php 
                                 $sqlrowfit="SELECT * FROM booking as b, garage as g, issued_certificate as ic 
                                 WHERE g.garageId=b.garageId
                                 AND b.bookingId=ic.bookingId
                                 AND b.garageId='$garageid'
                                 AND ic.fStatus='Complete'
                                 AND ic.issueDate='$today'";
                                 $resultfit = mysqli_query($conn, $sqlrowfit);
                                 $countfit=mysqli_num_rows($resultfit); 
                                ?>
                                <h4>Fitness Certificate <b><?php echo $countfit; ?></b></h4>
                                <p>Issued Today</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="card  shadow mb-5 bg-body rounded ">
                            <div class="card-body bg-primary text-white ">
                                 <?php 
                                 $sqlrowreject="SELECT * FROM booking as b, garage as g, issued_certificate as ic 
                                 WHERE g.garageId=b.garageId
                                 AND b.bookingId=ic.bookingId
                                 AND b.garageId='$garageid'
                                 AND b.vehiInspection='Reject'";
                                 $resultereject = mysqli_query($conn, $sqlrowreject);
                                 $countreject=mysqli_num_rows($resultereject); 
                                ?>
                                <h4>Inspection &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp<b><?php echo $countreject; ?></b></h4>
                                <p>Reject</p>
                            </div>
                        </div>
                    </div>       
            </div>
           
              <!-- 2nd row -->  

            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4">
                <div class="col-12">
                    <div class="card shadow mb-5 bg-body rounded">
                        <div class="text-left p-4" style="background-color: #e3f2fd">
                        <h4 class="card-title">Inspection Report & Fitness Certificate</h4>
                         <p>Search either Vehicle Number or Engine No. Vehicle Number should insert on ABXXXX format.</p> <hr>
                         
                            <div class="container-fluid" >
                                <form class="d-flex" action="g-dashboard.php" method="POST">
                                <input class="form-control me-2" type="text" placeholder="Vehicle Number" aria-label="Search" id="vehiNo" name="vehiNo" required>
                                <input class="form-control me-2" type="text" placeholder="Engine Number" aria-label="Search" id="engiNo" name="engiNo">
                                
                                <button class="btn btn-outline-primary" type="submit">Search</button>
                                </form>
                            </div>
                        </div>   
                        <div class="card-body text-center" >
                      
                            <?php
                            
                            if (isset($_POST["vehiNo"]) && isset($_POST["engiNo"])) {
                          
                            $vehiNo = filter_var($_POST["vehiNo"], FILTER_SANITIZE_STRING);
                            $engiNo = filter_var($_POST["engiNo"], FILTER_SANITIZE_STRING);
                            
                        
                            $vehiNo = mysqli_real_escape_string($conn, $vehiNo);
                            $engiNo = mysqli_real_escape_string($conn, $engiNo);

                            // sql2 get all data which certificate issued
                            $sql2 = "SELECT DISTINCT *  FROM vehicle as v, issued_certificate as ic, fitness_certificate as fc, inspection_report as ir
                            WHERE v.vehiId=ic.vehiId 
                            AND ic.inspectionId = ir.inspectionId
                            AND ic.fitnessId=fc.fitnessId
                            AND (v.vehiNo='$vehiNo' OR v.vehiEngineNo='$engiNo') 
                            AND ic.inspectionId!='0' AND ic.fitnessId!='0'";

                                
                                $result2 = mysqli_query($conn, $sql2); 

                                        if (mysqli_num_rows($result2) > 0) { 
                                            // sql2 get all data which certificate issued under logged garage
                                            $sql3 = "SELECT DISTINCT *  FROM vehicle as v, issued_certificate as ic, fitness_certificate as fc, inspection_report as ir, booking as b, garage as g
                                            WHERE v.vehiId=ic.vehiId 
                                            AND g.garageId=b.garageId
                                            AND b.bookingId=ic.bookingId
                                            AND b.garageId='$garageid'
                                            AND ic.inspectionId = ir.inspectionId
                                            AND ic.fitnessId=fc.fitnessId
                                            AND (v.vehiNo='$vehiNo' OR v.vehiEngineNo='$engiNo') 
                                            AND ic.inspectionId!='0' AND ic.fitnessId!='0'";
                                            
                                                 $result3 = mysqli_query($conn, $sql3); 
                                                 if (mysqli_num_rows($result3) > 0) { ?>
                                                        <table class="table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Vehicle No</th>
                                                                <th>Engine Number</th>
                                                                <th>Inspection Report No</th>
                                                                <th>Vehicle fitness e-Certificate No</th>
                                                            </tr>
                                                        </thead>
                                                        <?php while ($row = mysqli_fetch_assoc($result2)) { ?>
                                                            <tbody>   
                                                                <tr>
                                                                    <td><?php echo $row['vehiNo']; ?></td>
                                                                    <td><?php echo $row['vehiEngineNo']; ?></td>
                                                                    <td><?php echo $row['reportNo']; ?></br><a class="link-primary" href="g-report-iview.php" target="_blank">View</a> | <a class="link-primary" href="g-report-idown.php" target="_blank">Download</a></td>
                                                                    <td><?php echo $row['certificateNo']; ?></br><a class="link-primary" href="g-report-fview.php" target="_blank">View</a> | <a class="link-primary" href="g-report-fdown.php" target="_blank">Download</a></td>
                                                                </tr>
                                                        <?php } ?>
                                                        </tbody>
                                                        </table>
                                                        <?php } else { ?>
                                                            <p>This garage has not issued an e-certificate under your Vehicle No</p>
                                                        <?php } ?>

                                    <?php } else { ?>
                                        <p>No e-certificate was issued under your Vehicle No</p>
                                    <?php } }
                                    mysqli_close($conn);
                                    ?>
                        </div> 
                    </div>
                </div>    
            </div>
          
              <!-- 3rd row -->  

            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4">
                <div class="col-12 col-md-2">
                    <div class="card h-80 shadow mb-5 bg-body rounded">
                        <div class="card-body">  
                        <a class="btn btn-outline-primary d-grid py-5" href="g-bookingmgt.php" role="button">Booking Management</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="card h-80 shadow mb-5 bg-body rounded">
                        <div class="card-body">
                        <a class="btn btn-outline-primary d-grid py-5" href="g-paymentmgt.php" role="button">Payment Managemet</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="card h-80 shadow mb-5 bg-body rounded">
                        <div class="card-body">
                        <a class="btn btn-outline-primary d-grid py-5" href="g-reportmgt.php" role="button">Report Management</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="card h-80 shadow mb-5 bg-body rounded p-1">
                        <div class="card-body">
                            <div class="row py-1">
                            <h4 class="card-title">Registerd Year - <?php echo $garageregyear; ?></h4>
                                <div class="col-sm-6 pt-2">
                                  
                                    <a class="btn btn-outline-primary d-grid" href="g-garage-details.php" role="button">Veiw Garage Registration Certificate</a> </br>

                                </div>
                                <div class="col-sm-6 pt-2">
                               
                                    <button type="button" class="btn btn-outline-primary d-grid px-5"  href="g-renew-registration.php" disabled>Renew registration</button>
                                </div>
                            </div>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section> 
<?php }?>

<?php                 
include_once "../include/footer.php";                 
?>
