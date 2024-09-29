<?php                 
include_once "../include/headervehiowner.php";                                  
?>
<!-- cusdashboard -->  
<section id="dashboard">
    <div class="container contanier-fluid py-5">
        <a class="d-grid py-5 mt-4" href="c-dashboard.php" role="button">Back</a>
        <h3>Download vehicle fitness e-Certificate</h3>
        <div class="row justify-content-md-center px-4 py-4">
            <div class="bg-body rounded">
                <div class="card shadow-lg mb-5 ">
                    <div class="text-left p-4" style="background-color: #e3f2fd">
                        <p>You can search either Vehicle Number or Engine No. Vehicle Number should insert on ABXXXX format.</p> <hr>
                        <div class="container-fluid" >
                            <form class="d-flex" action="c-download.php" method="POST">
                            <input class="form-control me-2" type="text" placeholder="Vehicle Number" aria-label="Search" id="vehiNo" name="vehiNo" required>
                            <input class="form-control me-2" type="text" placeholder="Engine Number" aria-label="Search" id="engiNo" name="engiNo">
                            <input type="hidden" name="vehiId" value="<?php echo $vehiId; ?>">
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

                        $sql = "SELECT DISTINCT * 
                                FROM vehicle as v, issued_certificate as ic, vehi_owner as vo,fitness_certificate as fc, inspection_report as ir
                                WHERE v.vehiId=ic.vehiId 
                                AND ic.inspectionId = ir.inspectionId
                                AND ic.fitnessId=fc.fitnessId
                                AND vo.vehiOwnerNic='$nic' 
                                AND (v.vehiNo='$vehiNo' OR v.vehiEngineNo='$engiNo') 
                                AND ic.inspectionId!='0' AND ic.fitnessId!='0'";

                        $result = mysqli_query($conn, $sql); 

                            if (mysqli_num_rows($result) > 0) { ?>
                            <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Vehicle No</th>
                                    <th>Engine Number</th>
                                    <th>Inspection Report No</th>
                                    <th>e-fitness Certificate No</th> 
                                </tr>
                            </thead>
                            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tbody>   
                                    <tr>
                                        <td><?php echo $row['vehiNo']; ?></td>
                                        <td><?php echo $row['vehiEngineNo']; ?></td>
                                        <td><?php echo $row['reportNo']; ?></br><a class="link-primary" href="c-report-iview.php" target="_blank">View</a> | <a href="c-report-idown.php" target="_blank">Download</a></td>
                                        <td><?php echo $row['certificateNo']; ?></br><a class="link-primary" href="c-report-fview.php" target="_blank">View</a> | <a href="c-report-fdown.php" target="_blank">Download</a></td>
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
    </div>
</section>
    
<?php                 
include_once "../include/footer.php";                 
?>
