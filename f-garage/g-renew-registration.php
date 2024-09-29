<?php                 
include_once "../include/headergarage.php";    
// check if the already renew requested
 $sqlrenew = "SELECT * FROM garage_renew as gr, garage as g
            WHERE gr.garageId=g.garageId
            AND g.garageId='$garageid'";
$resultrenew = mysqli_query($conn, $sqlrenew);
    
if (mysqli_num_rows($resultrenew) > 0) { ?>

<section id="container">
    <div class="container py-5">
        <a class="d-grid pt-4" href="g-dashboard.php" role="button">Back</a>
        <h3 class="text-right mt-2 pt-4">Renew Registration</h3>
     
        <?php if (isset($_GET["id"])){?>
            <p class="p-2 text-center alert alert-info">
            <span class="text-secondary"> <?php echo $_GET["id"];?> </span>
            </p> 
            <?php  } ?>
               
        <div class="container">
            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4">
                <div class="col-12">
                    <div class="card shadow mb-5 bg-body rounded">
                        <div class="text-left p-5" style="background-color: #e3f2fd">
                        <h5 class="card-title">Renew Request Status</h5><hr>

                        <?php
                      
                            $resultalready = mysqli_query($conn, $sqlrenew); ?>

                            <div class="table-responsive">
                                        <table class="table table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th>Renew Id</th>
                                                <th>Garage Id</th>
                                                <th>Request year</th>
                                                <th>Renew Status</th>
                                                <th>Payment Status</th>
                                                <th>Request By</th>
                                                <th>Request Date</th>
                                            </tr>
                                        </thead>
                                        <?php  while($rowalrady = mysqli_fetch_assoc($resultalready)){ ?>
                                        <tbody>   
                                            <tr> 
                                                <td><?php echo $rowalrady['renewId']; ?></td>
                                                <td><?php echo $rowalrady['garageId']?></td>
                                                <td><?php echo $rowalrady['requestYear']; ?></td>
                                                <td><?php echo $rowalrady['rStatus']; ?></td>
                                                <td><?php echo $rowalrady['pStatus']; ?>
                                                <?php
                                           
                                           //payment
                                          
                                           $rStatus=$rowalrady['rStatus']; 
                                           $renewId=$rowalrady['renewId']; 
                                           $pStatus=$rowalrady['pStatus']; 
                                           ?>
                                               <form method="POST" action="g-payrenew-process.php">
                                               <input type="hidden" name="renewId" value="<?php echo $renewId; ?>">
                            

                                               <?php if ($rStatus == 'Accepted' && $pStatus == 'Pending'): ?>
                                                   <button class="btn btn btn-primary btn-sm" type="submit"> Pay </button>
                                               <?php else: ?>  
                                                   
                                               <?php endif; ?>
                                               </form>

                                                </td>
                                                <td><?php echo $rowalrady['requstedBy']; ?></td>
                                                <td><?php echo $rowalrady['requestedDate']; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        </table>
                             </div>  
                        </div>
                     </div> 
                </div>    
            </div>
        </div>
    </div>

    
</section>
            
<?php } else { ?>
<!-- if not still renew request send, display renew form -->  
<section id="container">
    <div class="container py-5">
        <a class="d-grid pt-4" href="g-dashboard.php" role="button">Back</a>
        <h3 class="text-right mt-2 pt-4">Renew Registration</h3>
      
     
        <?php if (isset($_GET["id"])){?>
            <p class="p-2 text-center alert alert-info">
            <span class="text-secondary"> <?php echo $_GET["id"];?> </span>
            </p> 
            <?php  } ?>
               
        <div class="container">
            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4">
                <div class="col-12">
                    <div class="card shadow mb-5 bg-body rounded">
                        <div class="text-left p-5" style="background-color: #e3f2fd">
                        <h5 class="card-title">Garage Details</h5><hr>
                         
                            <div class="mb-3">
                            
                               
                                 <div class="row py-1">
                                    <div class="col-sm-4">Garage ID:</div>
                                    <div class="col-sm-8"><?php echo $garageid; ?></div>
                                </div>   
                                <div class="row py-1">
                                    <div class="col-sm-4">Garage Name:</div>
                                    <div class="col-sm-8"><?php echo $garagename; ?></div>
                                </div>  
                                <div class="row py-1">
                                    <div class="col-sm-4">Garage Address:</div>
                                    <div class="col-sm-8"><?php echo $garageaddress; ?></div>
                                </div>  
                                <div class="row py-1">
                                    <div class="col-sm-4">Garage Tel. No:</div>
                                    <div class="col-sm-8"><?php echo $garagepno; ?></div>
                                </div>
                                 
                                <div class="row py-1">
                                    <div class="col-sm-4">Email:</div>
                                    <div class="col-sm-8"><?php echo $garageemail; ?></div>
                                </div>
                                 
                                <div class="row py-1">
                                    <div class="col-sm-4">District:</div>
                                    <div class="col-sm-8"><?php echo $garagedistrict; ?></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-sm-4">City:</div>
                                    <div class="col-sm-8"><?php echo $garagecity; ?></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-sm-4">Registred Year:</div>
                                    <div class="col-sm-8"><?php echo $garageregyear; ?></div>
                                </div>

                                <h5 class="card-title pt-3">Garage Owner Details</h5><hr>
                                <div class="row py-1">
                                    <div class="col-sm-4">Owner ID:</div>
                                    <div class="col-sm-8"><?php echo $ownerid; ?></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-sm-4">Owner Name:</div>
                                    <div class="col-sm-8"><?php echo $ownerfname; ?> &nbsp <?php echo $ownerlname;?></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-sm-4">Owner NIC:</div>
                                    <div class="col-sm-8"><?php echo $ownernic; ?></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-sm-4">Owner Tel. No:</div>
                                    <div class="col-sm-8"><?php echo $ownerpno; ?></div>
                                </div>

                                <h5 class="card-title pt-5">Certifying Officer(s) Details</h5><hr>
                                <?php
                                  $sql = "SELECT * FROM certifying_officer as co, garage as g
                                  WHERE co.garageId=g.garageId
                                  AND g.garageId='$garageid'";
                               
                               
                                 $resultco = mysqli_query($conn, $sql);

                                 //error handelling
                                 if (!$resultco) {
                                     die("Error: " . mysqli_error($conn));
                                 }
                                 if (mysqli_num_rows($resultco) > 0){
                                 ?>

                                <div class="table-responsive">
                                        <table class="table table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th>Certifying Officer Id</th>
                                                <th>Name</th>
                                                <th>NIC</th>
                                                <th>Tel. No</th>
                                            </tr>
                                        </thead>
                                        <?php  while($rowco = mysqli_fetch_assoc($resultco)){ ?>
                                        <tbody>   
                                            <tr> 
                                                <td><?php echo $rowco['cofficerId']; ?></td>
                                                <td><?php echo $rowco['cofficerFname']?> <?php echo $rowco['cofficerLname'] ?></td>
                                                <td><?php echo $rowco['cofficerNic']; ?></td>
                                                <td><?php echo $rowco['cofficerPno']; ?></td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        </table>

                                <form  action="g-renew-process.php" method="POST">
                                <div class="py-4">
                                    <label for="year">Request year:</label>
                                    <select class="form-select me-3 p-2" name="request_year" id="year">
                                        <option value="2024">2024</option>
                                        <option value="2025">2025</option>
                                        <option value="2026">2026</option>
                                        <option value="2027">2027</option>
                                        <option value="2028">2028</option>
                                    </select>
                                    <input type="hidden" name="garageId" value="<?php echo $garageid; ?>">
                                    
                                </div>
                                <?php } else { 
                                       
                                         echo "No records found matching the search criteria.";
                                    } ?>
                                <div class="d-flex pt-1">   
                                    <p ><i>* If there are any changes in the details please contact DMTWP</i></p>
                                </div>
                                <div class="d-flex pt-1">   
                                    <button class="btn btn-outline-primary me-3" type="submit" name="action"  value="generate_excel">Apply</button>
                                </div>
                                </form>
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

