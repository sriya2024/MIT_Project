<?php                 
include_once "../include/headervehiowner.php";  
?>
<!-- cusdashboard -->  
<section id="dashboard">
<div class="container contanier-fluid py-5">
    <a class="d-grid py-4" href="c-dashboard.php" role="button">Back</a>
    <h3>Validity of vehicle revenue licence</h3>

    <div class="row justify-content-md-center px-4 py-2">
        <div class="text-center">
            <div class="card shadow-lg mb-5 bg-body rounded">
                <div class="card-body p-4">
                <h5>Vehicle Owner Details</h5><hr>
                <?php   $sql = "SELECT DISTINCT * 
                                FROM vehicle as v, vehi_owner as vo, vehi_revenue_licence as vl 
                                WHERE v.vehiOwnerId=vo.vehiOwnerId AND v.vehiId=vl.vehiId AND vo.vehiOwnerNic='$nic'";

                        $result1 = mysqli_query($conn, $sql);
                        //to avoid display name again
                        $printedNames = array(); 

                        if (mysqli_num_rows($result1) > 0) {
                            while ($row = mysqli_fetch_assoc($result1)) {
                                $ownerName = $row['vehiOwnerFname'];
                                if (!in_array($ownerName, $printedNames)) {//if the name not already display
                                ?>
                                <div class="container">
                                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                                        <div class="col"><b>Owner Name:</b> </br> <?php echo $row['vehiOwnerFname'] ."&nbsp" .$row['vehiOwnerLname']?></div>
                                        <div class="col"><b>Owner NIC:</b> </br> <?php echo $row['vehiOwnerNic']?></div>
                                        <div class="col"><b>Owner Address:</b>  </br> <?php echo $row['vehiOwnerAddress'] ?></div>
                                    </div>
                                </div>
                                <?php
                                    // add the name to the printedNames array 
                                    $printedNames[] = $ownerName;
                                }
                            }
                        }
                    ?>      
                </div>
            </div>   
        </div> 
    </div>   
        
    <div class="row justify-content-md-center px-4 py-2">
        <div class="text-center">
            <div class="card shadow-lg mb-5 bg-body rounded">
                <div class="card-body"> 
                <?php $result = mysqli_query($conn, $sql); ?> 

                <?php if (mysqli_num_rows($result) > 0) { ?>
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Vehicle No</th>
                            <th>Vehicle Class</th>
                            <th>licence Valid From</th>
                            <th>licence Valid To</th>
                            <th>licence Status</th>
                        </tr>
                    </thead>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tbody>   
                        <tr>
                            <td><?php echo $row['vehiNo']; ?></td>
                            <td><?php echo $row['vehiClass']; ?></td>
                            <td><?php echo $row['LicenceValidFrom']; ?></td>
                            <td><?php echo $row['LicenceValidTo']; ?></td>
                            <td>
                                <?php 
                                //  if 9 months have passed 
                                $licenceValidFrom = strtotime($row['LicenceValidFrom']);
                                $nineMonths = strtotime("+9 months", $licenceValidFrom);
                                
                                // if 12 months have passed 
                                $licenceValidTo = strtotime("+12 months", $licenceValidFrom);
                                
                                // today
                                $today = strtotime(date("Y-m-d"));
                                $vehiId =$row['vehiId']; 
                                //echo $vehiId;

                                if ($today >= $licenceValidFrom && $today <= $nineMonths) {
                                
                                // Within 9 months -  valid
                                    echo '<p class="text-success"> Valid</p>';

                                } elseif ($today > $nineMonths && $today <= $licenceValidTo) {
                                // after 9 months and before 12 months - valid
                                    echo '<p class="text-success">Valid</p>';


                                        //check stsus for e-certificae
                                        $sqlfitness = "SELECT DISTINCT *
                                        FROM vehicle as v, vehi_owner as vo, vehi_revenue_licence as vl, issued_certificate as ic 
                                        WHERE v.vehiOwnerId=vo.vehiOwnerId AND v.vehiId=vl.vehiId AND vo.vehiOwnerNic='$nic' AND ic.vehiId='$vehiId'";

                                        $resultfitness = mysqli_query($conn, $sqlfitness);

                                        if (mysqli_num_rows($resultfitness) > 0) {
                                            // disable 
                                            echo '<p class="text-primary"><i> Already applied for Fitness e-Certificate</i> </p>';
                                        } else {
                                            // enable button
                                            echo '<form action="c-apply.php" method="post">';
                                            echo '<input type="hidden" name="vehiId" value="' . $row['vehiId'] . '">';
                                            echo '<input class="btn btn-outline-primary rounded-pill" type="submit" value="Apply for Fitness e-Certificate">';
                                            echo '</form>';
                                        }
                                } else {
                                // after 12 months - invalid
                                    echo '<p class="text-danger"> Invalid</p>';
                                      
                                        $sqlfitness = "SELECT DISTINCT *
                                        FROM vehicle as v, vehi_owner as vo, vehi_revenue_licence as vl, issued_certificate as ic 
                                        WHERE v.vehiOwnerId=vo.vehiOwnerId AND v.vehiId=vl.vehiId AND vo.vehiOwnerNic='$nic' AND ic.vehiId='$vehiId'";

                                        $resultfitness = mysqli_query($conn, $sqlfitness);

                                        if (mysqli_num_rows($resultfitness) > 0) {
                                            
                                            echo '<p class="text-primary"><i> Already applied for Fitness e-Certificate</i> </p>';
                                        } else {
                                           
                                            echo '<form action="c-apply.php" method="post">';
                                            echo '<input type="hidden" name="vehiId" value="' . $row['vehiId'] . '">';
                                            echo '<input class="btn btn-outline-primary rounded-pill" type="submit" value="Apply for Fitness e-Certificate">';
                                            echo '</form>';
                                        }
                                }?>
                            </td>   
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                <?php } else { ?>
                    <p>No Vehicle details registered under your NIC. Please contact Department of Mortor Traffic. </p>
                <?php } 
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
