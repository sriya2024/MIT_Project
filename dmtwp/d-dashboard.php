<?php                 
include_once "../include/headerdmt.php";      
?>

<!-- dashboard -->  
<section id="dashboard">
        <div class="container pt-5">
            <h2>Department of Motor Traffic Western Province (DMTWP)</h2>
          
            <p class="text-right">Dashboard</p>
           
            <div class="container">
       
            <!-- 1st row -->  
            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4 pt-4">
                    <div class="col-12 col-md-3">
                        <div class="card shadow mb-5 bg-body rounded ">
                            <div class="card-body bg-primary text-white ">
                                <h4>Renewal Request <b>10</b></h4>
                                <p>Pending</p>   
                            </div>
                        </div>
                    </div> 
                    <div class="col-12 col-md-3">
                        <div class="card shadow mb-5 bg-body rounded ">
                            <div class="card-body bg-primary text-white ">
                                <h4>Registerd Garage &nbsp<b>8</b></h4>
                                <p>2023</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <div class="card shadow mb-5 bg-body rounded ">
                            <div class="card-body bg-primary text-white ">
                                <h4>Registerd CO &nbsp &nbsp &nbsp &nbsp<b>5</b></h4>
                                <p>2023</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-3">
                        <div class="card  shadow mb-5 bg-body rounded ">
                            <div class="card-body bg-primary text-white ">
                                <h4>Suspend Garage &nbsp &nbsp<b>1</b></h4>
                                <p>2023</p>
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
                                <form class="d-flex" action="d-dashboard.php" method="POST">
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
                                                    <td><?php echo $row['reportNo']; ?></br><a class="link-primary" href="d-report-iview.php" target="_blank">View</a> | <a class="link-primary" href="d-report-idown.php" target="_blank">Download</a></td>
                                                    <td><?php echo $row['certificateNo']; ?></br><a class="link-primary" href="d-report-fview.php" target="_blank">View</a> | <a class="link-primary" href="d-report-fdown.php" target="_blank">Download</a></td>
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
                    <div class="card h-60 shadow mb-5 bg-body rounded">
                        <div class="card-body">  
                        <a class="btn btn-outline-primary d-grid" href="d-garagemgt.php" role="button"> Garage Management</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="card h-60 shadow mb-5 bg-body rounded">
                        <div class="card-body">
                        <a class="btn btn-outline-primary d-grid" href="d-paymentmgt.php" role="button">Payment Managemet</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="card h-60 shadow mb-5 bg-body rounded">
                        <div class="card-body">
                        <a class="btn btn-outline-primary d-grid" href="d-reportmgt.php" role="button">Report Management</a>
                        </div>
                    </div>
                </div>  
                <div class="col-12 col-md-2">
                    <div class="card h-60 shadow mb-5 bg-body rounded">
                        <div class="card-body">  
                        <a class="btn btn-outline-primary d-grid" href="d-feedbackmgt.php" role="button"> Feedback Management</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="card h-60 shadow mb-5 bg-body rounded">
                        <div class="card-body">
                        <a class="btn btn-outline-primary d-grid" href="d-newsmgt.php" role="button">News Managemet</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="card h-60 shadow mb-5 bg-body rounded">
                        <div class="card-body">
                        <a class="btn btn-outline-primary d-grid" href="d-faqmgt.php" role="button">FAQ Management</a>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
</section>
    
<?php                 
include_once "../include/footer.php";                 
?>
