<?php                 
include_once "../include/headerdmt.php";      
?>
     
 
<?php 
//admin*******************************************************************************
if($_SESSION['stfRole']=='admin'){

?>
<!-- dashboard -->  
<section id="dashboard">
    <div class="container py-5">
        <a class="d-grid pt-4" href="d-dashboard.php" role="button">Back</a>
        <h3 class="text-right mt-2 pt-4">Garage Manage</h3>

        <div class="container">
            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4 pt-2">
                <div class="col-12">
                    <div class="card shadow bg-body rounded">
                        <div class="text-left p-4" style="background-color: #e3f2fd">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                    <a class="btn btn-outline-primary btn-sm right" href=d-renewmgt.php>Renew request</a>
                                    </div>
                                  
                                    <div class="col-12 col-md-8">
                                        <form class="d-flex" action="d-garagemgt.php" method="GET">
                                        <input class="form-control me-2" type="text" placeholder="Search.." aria-label="Search" id="search" name="search">
                                        <button class="btn btn-outline-primary" type="submit">Search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <div class="card-body">
                                    <?php 
                                    // default values
                                    $search = $_GET['search'] ?? '';
                                    
                                    if (!empty($search)) {
                                        
                                        $sqlsearch = "SELECT * FROM garage as g, garage_owner as gow
                                        WHERE g.garageId=gow.garageId
                                      
                                        AND (garageName LIKE '%$search%' OR gDistrict LIKE '%$search%' OR gCity LIKE '%$search%' OR regYear LIKE '%$search%' OR gStatus LIKE '%$search%')
                                        ";
                                        
                                    } else {
                                       
                                        $sqlsearch = "SELECT * FROM garage as g, garage_owner as gow
                                        WHERE g.garageId=gow.garageId
                                      
                                        ";
                                    }
                                
                                    $resultsearch = mysqli_query($conn, $sqlsearch);

                                    //error handelling
                                    if (!$resultsearch) {
                                        die("Error: " . mysqli_error($conn));
                                    }
                                    if (mysqli_num_rows($resultsearch) > 0){
                                    ?> 
                                    
                                    <div class="table-responsive">
                                    <table class="table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>Garage Id</th>
                                            <th>Garage Name</th>
                                            <th>Garage Address</th>
                                            <th>Garage Pno</th>
                                            <th>Garage email</th>
                                            <th>District</th>
                                            <th>City</th>
                                            <th>Registred Year</th>
                                            <th>Registred By</th>
                                            <th>Registred Date</th>
                                            <th>Operational Status</th>
                                            <th>Owner Id</th>
                                            <th>Owner Name</th>
                                            <th>Owner NIC</th>
                                            <th>Owner Pno</th>
                                            <th></th>
                                           
                                           
                                        </tr>
                                    </thead>
                                    <?php  while($rowsearch = mysqli_fetch_assoc($resultsearch)){ ?>
                                    <tbody>   
                                        <tr> 
                                            <td><?php echo $rowsearch['garageId']; ?></td>
                                           
                                            <td><?php echo $rowsearch['garageName']; ?></td>
                                            <td><?php echo $rowsearch['gAddress']; ?></td>
                                            <td><?php echo $rowsearch['gPno']; ?></td>
                                            <td><?php echo $rowsearch['gEmail']; ?></td>
                                            <td><?php echo $rowsearch['gDistrict']; ?>
                                            <td><?php echo $rowsearch['gCity'];?> 
                                            <td><?php echo $rowsearch['regYear']; ?> </td>
                                            <td><?php echo $rowsearch['registredBy'];?></td>
                                            <td><?php echo $rowsearch['registredDate'];?></td>
                                            <td><?php echo $rowsearch['gStatus'];?>
                                            <?php $gStstus=$rowsearch['gStatus'];
                                                $gEmail= $rowsearch['gEmail'];
                                                $gName= $rowsearch['garageName'];
                                                $garageId=$rowsearch['garageId'];?>
                                             
                                        
                                            <form method="POST" action="d-update-gststus.php">
                                                    <input type="hidden" name="garage_id" value="<?php echo $garageId; ?>">
                                                    <input type="hidden" name="garage_stasus" value="<?php echo $gStstus; ?>">
                                                    <input type="hidden" name="garage_name" value="<?php echo $gName; ?>">
                                                    <input type="hidden" name="garage_email" value="<?php echo $gEmail; ?>">
                                                        <?php if ($gStstus == 'Active'): ?>
                                                            <button class="btn btn-success btn-sm disabled" type="submit"  name="new_status" value="Active" >A</button>
                                                            <button class="btn btn-danger btn-sm" type="submit"  name="new_status" value="Suspend" >S</button>
                                                        <?php elseif ($gStstus == 'Suspend'): ?>  
                                                            <button class="btn btn-success btn-sm" type="submit"  name="new_status" value="Active" >A</button>
                                                            <button class="btn btn-danger btn-sm disabled" >S</button>
                                                        <?php else: ?>
                                                            
                                                        <?php endif; ?>
                                                </form>
                                        
                                        
                                        
                                            </td>
                                            <td><?php echo $rowsearch['ownerId'];?></td>
                                            <td><?php echo $rowsearch['ownerFname'];?> &nbsp <?php echo $rowsearch['ownerLname'];?></td>
                                            <td><?php echo $rowsearch['ownerNic'];?></td>
                                            <td><?php echo $rowsearch['ownerPno'];?></td>
                                            <td> <?php $garageId= $rowsearch['garageId'];?>
                                                <a href="d-co-details.php?garageId=<?php echo $garageId; ?>" target="_blank">More Details</a></td>
                                              
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    </table>
                                    </div>
                                    <?php } else { 
                                        
                                         echo "No records found matching the search criteria.";
                                    } ?>
                                    <?php
                                    mysqli_close($conn);
                                    ?>
                            
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>

</section>
 <?php          } ?>



<?php 
//Commissioner*******************************************************************************
if($_SESSION['stfRole']=='Commissioner'){

?>
<!-- dashboard -->  
<section id="dashboard">
    <div class="container py-5">
        <a class="d-grid pt-4" href="d-dashboard.php" role="button">Back</a>
        <h3 class="text-right mt-2 pt-4">Garage Manage</h3>

        <div class="container">
            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4 pt-2">
                <div class="col-12">
                    <div class="card shadow bg-body rounded">
                        <div class="text-left p-4" style="background-color: #e3f2fd">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                    <a class="btn btn-outline-primary btn-sm right" href=d-renewmgt.php>Renew request</a>
                                    </div>
                                  
                                    <div class="col-12 col-md-8">
                                        <form class="d-flex" action="d-garagemgt.php" method="GET">
                                        <input class="form-control me-2" type="text" placeholder="Search.." aria-label="Search" id="search" name="search">
                                        <button class="btn btn-outline-primary" type="submit">Search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <div class="card-body">
                                    <?php 
                                     // default values
                                     $search = $_GET['search'] ?? '';
                                    
                                     if (!empty($search)) {
                                         
                                         $sqlsearch = "SELECT * FROM garage as g, garage_owner as gow
                                         WHERE g.garageId=gow.garageId
                                       
                                         AND (garageName LIKE '%$search%' OR gDistrict LIKE '%$search%' OR gCity LIKE '%$search%' OR regYear LIKE '%$search%' OR gStatus LIKE '%$search%')
                                         ";
                                         
                                     } else {
                                        
                                         $sqlsearch = "SELECT * FROM garage as g, garage_owner as gow
                                         WHERE g.garageId=gow.garageId
                                       
                                         ";
                                     }
                                
                                   
                                    $resultsearch = mysqli_query($conn, $sqlsearch);

                                    //error handelling
                                    if (!$resultsearch) {
                                        die("Error: " . mysqli_error($conn));
                                    }
                                    if (mysqli_num_rows($resultsearch) > 0){
                                    ?> 
                                    
                                    <div class="table-responsive">
                                    <table class="table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>Garage Id</th>
                                            <th>Garage Name</th>
                                            <th>Garage Address</th>
                                            <th>Garage Pno</th>
                                            <th>Garage email</th>
                                            <th>District</th>
                                            <th>City</th>
                                            <th>Registred Year</th>
                                            <th>Registred By</th>
                                            <th>Registred Date</th>
                                            <th>Operational Status</th>
                                            <th></th>
                                           
                                           
                                        </tr>
                                    </thead>
                                    <?php  while($rowsearch = mysqli_fetch_assoc($resultsearch)){ ?>
                                    <tbody>   
                                        <tr> 
                                            <td><?php echo $rowsearch['garageId']; ?></td>
                                           
                                            <td><?php echo $rowsearch['garageName']; ?></td>
                                            <td><?php echo $rowsearch['gAddress']; ?></td>
                                            <td><?php echo $rowsearch['gPno']; ?></td>
                                            <td><?php echo $rowsearch['gEmail']; ?></td>
                                            <td><?php echo $rowsearch['gDistrict']; ?>
                                            <td><?php echo $rowsearch['gCity'];?> 
                                            <td><?php echo $rowsearch['regYear']; ?> </td>
                                            <td><?php echo $rowsearch['registredBy'];?></td>
                                            <td><?php echo $rowsearch['registredDate'];?></td>
                                            <td><?php echo $rowsearch['gStatus'];?>
                                            <?php $gStstus=$rowsearch['gStatus'];
                                                $gEmail= $rowsearch['gEmail'];
                                                $gName= $rowsearch['garageName'];
                                                $garageId=$rowsearch['garageId'];?>
                                             
                                        
                                            <form method="POST" action="d-update-gststus.php">
                                                    <input type="hidden" name="garage_id" value="<?php echo $garageId; ?>">
                                                    <input type="hidden" name="garage_stasus" value="<?php echo $gStstus; ?>">
                                                    <input type="hidden" name="garage_name" value="<?php echo $gName; ?>">
                                                    <input type="hidden" name="garage_email" value="<?php echo $gEmail; ?>">
                                                        <?php if ($gStstus == 'Active'): ?>
                                                            <button class="btn btn-success btn-sm disabled" type="submit"  name="new_status" value="Active" >A</button>
                                                            <button class="btn btn-danger btn-sm" type="submit"  name="new_status" value="Suspend" >S</button>
                                                        <?php elseif ($gStstus == 'Suspend'): ?>  
                                                            <button class="btn btn-success btn-sm" type="submit"  name="new_status" value="Active" >A</button>
                                                            <button class="btn btn-danger btn-sm disabled" >S</button>
                                                        <?php else: ?>
                                                            
                                                        <?php endif; ?>
                                                </form>
                                        
                                        
                                        
                                        
                                        
                                    
                                            </td>
                                            <td> <?php $garageId= $rowsearch['garageId'];?>
                                                <a href="d-co-details.php?garageId=<?php echo $garageId; ?>" target="_blank">View</a></td>
                                              
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    </table>
                                    </div>
                                    <?php } else { 
                                       
                                         echo "No records found matching the search criteria.";
                                    } ?>
                                    <?php
                                    mysqli_close($conn);
                                    ?>
                            
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>

</section>
 <?php          } ?>



<?php 
//Subject Officer*******************************************************************************
if($_SESSION['stfRole']=='Subject Officer'){

?>
<!-- dashboard -->  
<section id="dashboard">
    <div class="container py-5">
        <a class="d-grid pt-4" href="d-dashboard.php" role="button">Back</a>
        <h3 class="text-right mt-2 pt-4">Renew Request Manage</h3>

        <div class="container">
            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4 pt-2">
                <div class="col-12">
                    <div class="card shadow bg-body rounded text-center">
                        <div class="text-left p-4" style="background-color: #e3f2fd">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <form class="d-flex" action="d-renewmgt.php" method="GET">
                                        <input class="form-control me-2" type="text" placeholder="Search.." aria-label="Search" id="search" name="search">
                                        <button class="btn btn-outline-primary" type="submit">Search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <div class="card-body">
                                    <?php 
                                    // default values
                                    $search = $_GET['search'] ?? '';
                                    
                                    if (!empty($search)) {
                                        
                                        $sqlsearch = "SELECT * FROM garage as g, garage_owner as gow
                                        WHERE g.garageId=gow.garageId
                                      
                                        AND (garageName LIKE '%$search%' OR gDistrict LIKE '%$search%' OR gCity LIKE '%$search%' OR regYear LIKE '%$search%' OR gStatus LIKE '%$search%')
                                        ";
                                        
                                    } else {
                                       
                                        $sqlsearch = "SELECT * FROM garage as g, garage_owner as gow
                                        WHERE g.garageId=gow.garageId
                                      
                                        ";
                                    }
                                
                                   
                                    $resultsearch = mysqli_query($conn, $sqlsearch);

                                    //error handelling
                                    if (!$resultsearch) {
                                        die("Error: " . mysqli_error($conn));
                                    }
                                    if (mysqli_num_rows($resultsearch) > 0){
                                    ?> 
                                    
                                
                                    <table class="table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>Renew Id</th>
                                            <th>Garage Id</th>
                                            <th>Garage Name</th>
                                            <th>Requested Year</th>
                                            <th>Request Status</th>
                                            <th>Payment Status</th>
                                            <th>Requested By</th>
                                            <th>Requested Date</th>
                                            <th></th>
                                           
                                           
                                        </tr>
                                    </thead>
                                    <?php  while($rowsearch = mysqli_fetch_assoc($resultsearch)){ ?>
                                    <tbody>   
                                        <tr> 
                                            <td><?php echo $rowsearch['renewId']; ?></td>
                                            <td><?php echo $rowsearch['garageId']; ?></td>
                                            <td><?php echo $rowsearch['garageName']; ?></td>
                                            <td><?php echo $rowsearch['requestYear']; ?></td>
                                            <td><?php echo $rowsearch['rStatus']; ?>
                                            <?php
                                            // request status
                                            $renewId = $rowsearch['renewId'];
                                            $rStatus = $rowsearch['rStatus']; 
                                            $pStatus = $rowsearch['pStatus'];
                                            $garageId = $rowsearch['garageId'];
                                            $requestYear = $rowsearch['requestYear'];
                                           
                                            ?>
                                            <form method="POST" action="d-update-rstatus.php">
                                                <input type="hidden" name="request_id" value="<?php echo $renewId; ?>">
                                                <input type="hidden" name="update" value="<?php echo $rStatus; ?>">
                                                <input type="hidden" name="garage_id" value="<?php echo $garageId; ?>">
                                                <input type="hidden" name="request_year" value="<?php echo $requestYear; ?>">

                                                <?php if ($rStatus == 'Accepted' && $pStatus == 'Pending'): ?>
                                                    <button class="btn btn-primary btn-sm disabled" type="submit"> <?php echo $rStatus; ?></button>
                                                <?php elseif ($pStatus == 'Complete' && $rStatus == 'Complete'): ?>  
                                                    <button class="btn btn-primary btn-sm disabled" type="submit"> <?php echo $rStatus; ?></button>
                                               
                                                <?php else: ?>  
                                                    <button class="btn btn-primary btn-sm" type="submit"> <?php echo $rStatus; ?></button>
                                                <?php endif; ?>
                                                </form>
                                        
                                        
                                        
                                        
                                        
                                        
                                            </td>
                                            <td><?php echo $rowsearch['pStatus'];?> 
                                            <td><?php echo $rowsearch['requstedBy']; ?> </td>
                                            <td><?php echo $rowsearch['requestedDate'];?></td>
                                            <td><a href="gb-cancel.php" target="_blank">View Request</a></td>
                                              
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    </table>
                                    <?php } else { 
                                        
                                         echo "No records found matching the search criteria.";
                                    } ?>
                                    <?php
                                    mysqli_close($conn);
                                    ?>
                            
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </div>

</section>
 <?php          } ?>




<?php                 
include_once "../include/footer.php";                 
?>
