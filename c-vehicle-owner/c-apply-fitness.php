<?php                 
include_once "../include/headervehiowner.php";       
?>

<!-- cusdashboard -->  
<section id="dashboard">
    <div class="container contanier-fluid py-5">
        <a class="d-grid py-4" href="c-dashboard.php" role="button">Back</a>
        <h3>Apply for vehicle fitness e-Certification</h3>
        <div class="row justify-content-md-center px-5 py-5">
          
            <div class="bg-body rounded">
                <div class="card shadow-lg mb-5 ">
                    <div class="text-left p-4" style="background-color: #e3f2fd"><h5>Search your vehicle</h5>
                        <p>You can search either Vehicle Number or Engine No. Vehicle Number should insert on ABXXXX format.</p> <hr>
                        <div class="container-fluid" >
                            <form class="d-flex" action="c-apply-fitness.php" method="POST">
                            <input class="form-control me-2" type="text" placeholder="Vehicle Number" aria-label="Search" id="vehiNo" name="vehiNo">
                            <input class="form-control me-2" type="text" placeholder="Engine Number" aria-label="Search" id="engiNo" name="engiNo">
                            <input type="hidden" name="vehiId" value="<?php echo $vehiId; ?>">
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                            </form>
                        </div>
                    </div>   
                    <div class="card-body text-center" >
                        <?php
                        // Search
                        if (isset($_POST["vehiNo"]) && isset($_POST["engiNo"])) {
                          //fiter user input
                            $vehiNo = filter_var($_POST["vehiNo"], FILTER_SANITIZE_STRING);
                            $engiNo = filter_var($_POST["engiNo"], FILTER_SANITIZE_STRING);
    
                          //filter data from db
                            $vehiNo = mysqli_real_escape_string($conn, $vehiNo);
                            $engiNo = mysqli_real_escape_string($conn, $engiNo);

                            // check if vehicle licence is valid
                            $sql = "SELECT DISTINCT * 
                                    FROM vehicle as v, vehi_owner as vo, vehi_revenue_licence as vl 
                                    WHERE v.vehiOwnerId=vo.vehiOwnerId
                                    AND v.vehiId=vl.vehiId 
                                    AND vo.vehiOwnerNic='$nic'
                                    AND (v.vehiNo='$vehiNo' OR v.vehiEngineNo='$engiNo')";

                            $result = mysqli_query($conn, $sql); 

                                if (mysqli_num_rows($result) > 0) { ?>
                                <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Vehicle No</th>
                                        <th>Vehicle Class</th>
                                        <th>Engine Number</th>
                                        <th>Action</th> 
                                    </tr>
                                </thead>
                                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                <tbody>   
                                    <tr>
                                        <td><?php echo $row['vehiNo']; ?></td>
                                        <td><?php echo $row['vehiClass']; ?></td>
                                        <td><?php echo $row['vehiEngineNo']; ?></td>
                                        <td>
                                        <?php 
                                            //  if 9 months 
                                            $licenceValidFrom = strtotime($row['LicenceValidFrom']);
                                            $nineMonths = strtotime("+9 months", $licenceValidFrom);
                                            
                                            //  if 12 
                                            $licenceValidTo = strtotime("+12 months", $licenceValidFrom);
                                            
                                            //  today
                                            $today = strtotime(date("Y-m-d"));
                                            $vehiId =$row['vehiId']; 
                                                
                                            if ($today > $nineMonths && $today <= $licenceValidTo) {
                                                // after 9 months and before 12 months -valid
                                                // echo '<p class="text-success">Valid</p>';
                                                        
                                                //check stsus for e-certificae
                                                $sqlfitness = "SELECT DISTINCT *
                                                FROM vehicle as v, vehi_owner as vo, vehi_revenue_licence as vl, issued_certificate as ic 
                                                WHERE v.vehiOwnerId=vo.vehiOwnerId AND v.vehiId=vl.vehiId AND vo.vehiOwnerNic='$nic' AND ic.vehiId='$vehiId'";

                                                $resultfitness = mysqli_query($conn, $sqlfitness);

                                                
                                                if (mysqli_num_rows($resultfitness) > 0) {
                                                    // records exist
                                                    echo '<p class="text-primary"><i> Already applied for Fitness e-Certificate or issued. </i> </p>';
                                                } else {
                                                    //  enable
                                                    echo '<form action="c-apply.php" method="post">';
                                                    echo '<input type="hidden" name="vehiId" value="' . $row['vehiId'] . '">';
                                                    echo '<input class="btn btn-outline-primary rounded-pill" type="submit" value="Apply for Fitness e-Certificate">';
                                                    echo '</form>';
                                                }
                                            } else {
                                                // After 12 months - invalid
                                                // echo '<p class="text-danger"> Invalid</p>';
                                                            
                                                $sqlfitness = "SELECT DISTINCT *
                                                FROM vehicle as v, vehi_owner as vo, vehi_revenue_licence as vl, issued_certificate as ic 
                                                WHERE v.vehiOwnerId=vo.vehiOwnerId AND v.vehiId=vl.vehiId AND vo.vehiOwnerNic='$nic' AND ic.vehiId='$vehiId'";

                                                $resultfitness = mysqli_query($conn, $sqlfitness);

                                                
                                                if (mysqli_num_rows($resultfitness) > 0) {
                                                    
                                                    echo '<p class="text-primary"><i> Already applied for Fitness e-Certificate or issued.</i> </p>';
                                                } else {
                                                    
                                                    echo '<form action="c-apply.php" method="post">';
                                                    echo '<input type="hidden" name="vehiId" value="' . $row['vehiId'] . '">';
                                                    echo '<input class="btn btn-outline-primary rounded-pill" type="submit" value="Apply for Fitness e-Certificate">';
                                                    echo '</form>';
                                                }
                                            }
                                        ?>
                                        </td>   
                                    </tr>
                                <?php } ?>
                                </tbody>
                                </table>
                        <?php } else { ?>
                            <p>No Vehicle details registered under your NIC. Please contact Department of Mortor Traffic. </p>
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
