<?php                 
include_once "../include/headergarage.php";      

//garage user table has usernic. it can use identify login person details
//garage owner*******************************************************************************
if($_SESSION['roleId']==1){

?>
 
<!-- dashboard -->  
<section id="dashboard">
    <div class="container py-4">
        <a class="d-grid pt-4" href="g-dashboard.php" role="button">Back</a>
        <h3 class="text-right mt-2 pt-4"><?php echo $garagename?></h3>
        <p class="text-right">Bookings</p>
        <div class="container">
            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4 pt-2">
                <div class="col-12">
                    <div class="card shadow bg-body rounded text-center">
                        <div class="text-left p-4" style="background-color: #e3f2fd">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <form class="d-flex" action="g-bookingmgt.php" method="GET">
                                        <input class="form-control me-2" type="text" placeholder="Search.." aria-label="Search" id="search" name="search">
                                        <button class="btn btn-outline-primary" type="submit">Search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <div class="card-body">
                                    <?php 
                                   


                                    // check get valu and assing default values
                                    //?? null coalescing operator 
                                    $search = $_GET['search'] ?? '';

                                    // if a search 
                                    if (!empty($search)) {
                                       
                                        $sqlsearch = "SELECT * FROM booking as b, customer as c, vehicle as v, garage as g, issued_certificate as ic 
                                        WHERE v.vehiId=b.vehiId
                                        AND c.cusId=b.cusId
                                        AND g.garageId=b.garageId
                                        AND b.bookingId=ic.bookingId
                                        AND b.garageId='$garageid'
                                        AND (vehiNo LIKE '%$search%' OR bookingDate LIKE '%$search%' OR bStatus LIKE '%$search%'OR cusFname LIKE '%$search%' OR cusLname LIKE '%$search%')";
                                    } else {
                                        // no search , all records
                                        $sqlsearch = "SELECT * FROM booking as b, customer as c, vehicle as v, garage as g, issued_certificate as ic 
                                        WHERE v.vehiId=b.vehiId
                                        AND c.cusId=b.cusId
                                        AND g.garageId=b.garageId
                                        AND b.bookingId=ic.bookingId
                                        AND b.garageId='$garageid'";
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
                                            <th>Booking Id</th>
                                            <th>Vehicle Number</th>
                                            <th>Booking Date</th>
                                            <th>Booking Time</th>
                                            <th>Customer Name</th>
                                            <th>Booking Status</th>
                                            <th>Payment Status</th>
                                            <th>Inspection Certificate Status</th>
                                            <th>Fitness Certificate Status</th>
                                            <th>Action</th>
                                            <th></th>
                                           
                                        </tr>
                                    </thead>
                                    <?php  while($rowsearch = mysqli_fetch_assoc($resultsearch)){ ?>
                                    <tbody>   
                                        <tr> 
                                            <td><?php echo $rowsearch['bookingId']; ?></td>
                                            <td><?php echo $rowsearch['vehiNo']; ?></td>
                                            <td><?php echo $rowsearch['bookingDate']; ?></td>
                                            <td><?php echo $rowsearch['timeSlot']; ?></td>
                                            <td><?php echo $rowsearch['cusFname']?> <?php echo $rowsearch['cusLname'] ?></td>
                                            <td>
                                            <?php
                                            // booking status into $row['bStatus']
                                            $bookingStatus = $rowsearch['bStatus'];
                                            $bookingid=$rowsearch['bookingId'];
                                            $pStatus= $rowsearch['pStatus']; 
                                            $iStatus= $rowsearch['iStatus'];
                                            $fStatus= $rowsearch['fStatus'];
                                            $vehiNo=$rowsearch['vehiNo']; 
                                            ?>
                                                <form method="POST" action="g-update-bstatus.php">
                                                <input type="hidden" name="booking_id" value="<?php echo $bookingid; ?>">
                                                <input type="hidden" name="update" value="<?php echo $bookingStatus; ?>">

                                                <?php if ($fStatus == 'Pending' && $bookingStatus == 'Confirm'): ?>
                                                    <button class="btn btn-primary btn-sm disabled" type="submit"> <?php echo $bookingStatus; ?></button>
                                                <?php elseif ($pStatus == 'Pending'&& $bookingStatus == 'Confirm'): ?>  
                                                    <button class="btn btn-primary btn-sm disabled" type="submit"> <?php echo $bookingStatus; ?></button>
                                                <?php elseif ($bookingStatus == 'Complete'|| $bookingStatus == 'Cancel'): ?>  
                                                    <button class="btn btn-primary btn-sm disabled" type="submit"> <?php echo $bookingStatus; ?></button>
                                                <?php else: ?>  
                                                    <button class="btn btn-primary btn-sm disabled " type="submit"> <?php echo $bookingStatus; ?></button>
                                                <?php endif; ?>
                                                </form>
                                            </td>
                                            
                                            <td><?php echo $rowsearch['pStatus']; ?> </td>
                                            <td><?php echo $rowsearch['iStatus'];?></td>
                                            <td><?php echo $rowsearch['fStatus']; ?></td>
                                            

                                            <?php
                                            // booking status into $row['bStatus']
                                            $bookingStatus = $rowsearch['bStatus'];
                                             $bookingId= $rowsearch['bookingId'];
                                            ?>

                                            <!-- Cancel Button -->
                                            <?php if ($fStatus == 'Complete'||$fStatus == 'Pending'): ?>
                                                <td><a class="btn btn-danger btn-sm disabled" href="gb-cancel.php" target="_blank">Cancel</a></td>
                                            <?php elseif($bookingStatus == 'Pending'|| $bookingStatus == 'Confirm'): ?>
                                                <td><button class='btn-danger btn-sm disabled' onclick='cancelBooking(<?php echo $bookingId;?>)'>Cancel</button></td>  
                                            <?php else: ?>
                                                <td><a class="btn btn-danger btn-sm disabled" href="gb-cancel.php" target="_blank">Cancel</a></td>
                                            <?php endif; ?>

                                            <!-- Pay Button -->
                                            <?php if ($bookingStatus == 'Pending'|| $pStatus == 'Complete'): ?>
                                                <td><a class="btn btn-primary btn-sm disabled" href="g-pay.php" target="_blank" >Pay</a> </td>
                                            <?php elseif ($bookingStatus == 'Confirm'): ?>
                                                <td><a class="btn btn-primary btn-sm disabled" href="g-pay.php" target="_blank" >Pay</a> </td>
                                            <?php else: ?>
                                                <td><a class="btn btn-primary btn-sm disabled" href="g-pay.php" target="_blank" >Pay</a> </td>
                                            <?php endif; ?>

                                            
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
//certifying officer***********************************************************
 if($_SESSION['roleId']==2){

?>
 
<!-- dashboard -->  
<section id="dashboard">
    <div class="container py-4">
        <a class="d-grid pt-5" href="g-dashboard.php" role="button">Back</a>
        <h3 class="text-right mt-2 pt-4"><?php echo $garagename?></h3>
        <p class="text-right">Bookings</p>

     
        <p class="p-2 text-center">
        <?php if (isset($_GET["id"])){?>
        <span class="text-secondary"> <?php echo $_GET["id"];?> </span>
        <?php  } ?>
               
        <div class="container">
            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4 pt-2">
                <div class="col-12">
                    <div class="card shadow bg-body rounded text-center">
                        <div class="text-left p-4" style="background-color: #e3f2fd">
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        
                                    </div>
                                    <div class="col-12 col-md-8">
                                        <form class="d-flex" action="g-bookingmgt.php" method="GET">
                                        <input class="form-control me-2" type="text" placeholder="Search.." aria-label="Search" id="search" name="search">
                                        <button class="btn btn-outline-primary" type="submit">Search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <div class="card-body">
                                    <?php 


                                    // check get valu and assing default values
                                    //?? null coalescing operator 
                                    $search = $_GET['search'] ?? '';

                                    // if a search 
                                    if (!empty($search)) {
                                       
                                        $sqlsearch = "SELECT * FROM booking as b, customer as c, vehicle as v, garage as g, issued_certificate as ic 
                                        WHERE v.vehiId=b.vehiId
                                        AND c.cusId=b.cusId
                                        AND g.garageId=b.garageId
                                        AND b.bookingId=ic.bookingId
                                        AND b.garageId='$garageid'
                                        AND (vehiNo LIKE '%$search%' OR bookingDate LIKE '%$search%' OR bStatus LIKE '%$search%'OR cusFname LIKE '%$search%' OR cusLname LIKE '%$search%')";
                                    } else {
                                        // no search , all records
                                        $sqlsearch = "SELECT * FROM booking as b, customer as c, vehicle as v, garage as g, issued_certificate as ic 
                                        WHERE v.vehiId=b.vehiId
                                        AND c.cusId=b.cusId
                                        AND g.garageId=b.garageId
                                        AND b.bookingId=ic.bookingId
                                        AND b.garageId='$garageid'";
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
                                                <th>Booking Id</th>
                                                <th>Vehicle Number</th>
                                                <th>Booking Date</th>
                                                <th>Booking Time</th>
                                                <th>Customer Name</th>
                                                <th>Booking Status</th>
                                                <th>Payment Status</th>
                                                <th>Vehicle Ispection</th>
                                                <th>Inspection Certificate Status</th>
                                                <th>Fitness Certificate Status</th>
                                                <th></th>
                                                <th>Action</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <?php  while($rowsearch = mysqli_fetch_assoc($resultsearch)){ ?>
                                        <tbody>   
                                            <tr> 
                                                <td><?php echo $rowsearch['bookingId']; ?></td>
                                                <td><?php echo $rowsearch['vehiNo']; ?></td>
                                                <td><?php echo $rowsearch['bookingDate']; ?></td>
                                                <td><?php echo $rowsearch['timeSlot']; ?></td>
                                                <td><?php echo $rowsearch['cusFname']?> <?php echo $rowsearch['cusLname'] ?></td>

                                                <td><?php echo $rowsearch['bStatus']; ?> 
                                                <?php
                                                // booking status into $row['bStatus']
                                                $bookingStatus = $rowsearch['bStatus'];
                                                $bookingid=$rowsearch['bookingId'];
                                                $pStatus= $rowsearch['pStatus']; 
                                                $iStatus= $rowsearch['iStatus'];
                                                $cusFname= $rowsearch['cusFname'];
                                                $cusEmail= $rowsearch['cusEmail'];
                                                $fStatus= $rowsearch['fStatus'];
                                                $vehiNo=$rowsearch['vehiNo']; 
                                                $vehiid=$rowsearch['vehiId']; 
                                                $bdate=$rowsearch['bookingDate']; 
                                                $btime=$rowsearch['timeSlot']; 
                                                ?>
                                                    <form method="POST" action="g-update-bstatus.php">
                                                    <input type="hidden" name="booking_id" value="<?php echo $bookingid; ?>">
                                                    <input type="hidden" name="update" value="<?php echo $bookingStatus; ?>">
                                                    <input type="hidden" name="cusFname" value="<?php echo $cusFname; ?>">
                                                    <input type="hidden" name="cusEmail" value="<?php echo $cusEmail; ?>">
                                                    <input type="hidden" name="bdate" value="<?php echo $bdate; ?>">
                                                    <input type="hidden" name="btime" value="<?php echo $btime; ?>">

                                                    <?php if ($fStatus == 'Pending' && $bookingStatus == 'Confirm'): ?>
                                                        <button class="btn btn-primary btn-sm disabled" type="submit"> <?php echo $bookingStatus; ?></button>
                                                    <?php elseif ($pStatus == 'Pending' && $bookingStatus == 'Confirm'): ?>  
                                                        <button class="btn btn-primary btn-sm disabled" type="submit"> <?php echo $bookingStatus; ?></button>
                                                    <?php elseif ($bookingStatus == 'Complete'|| $bookingStatus == 'Cancel'): ?>  
                                                        <button class="btn btn-primary btn-sm disabled" type="submit"> <?php echo $bookingStatus; ?></button>
                                                    <?php else: ?>  
                                                        <button class="btn btn-primary btn-sm" type="submit"> <?php echo $bookingStatus; ?></button>
                                                    <?php endif; ?>
                                                    </form>
                                                </td>
                                                
                                                <td><?php echo $rowsearch['pStatus']; ?></td>
                                                <!-- Pass/reject inspection Button -->
                                                <td><?php echo $rowsearch['vehiInspection']; ?> 
                                                <?php
                                                $vehiInspection=$rowsearch['vehiInspection'];
                                                $bookingStatus = $rowsearch['bStatus'];
                                                $cusFname= $rowsearch['cusFname'];
                                                $cusEmail= $rowsearch['cusEmail'];
                                                $cusId=$rowsearch['cusId'];?>

                                                <?php if ($bookingStatus == 'Pending'): ?>
                                                    <button class="btn btn-success btn-sm disabled" >P</button>
                                                    <button class="btn btn-danger btn-sm disabled" >R</button>
                                                        
                                                <?php else: ?>
                                                    <form method="POST" action="g-update-vehi-inspec.php">
                                                        <input type="hidden" name="booking_id" value="<?php echo $bookingid; ?>">
                                                        <input type="hidden" name="inspspec_status" value="<?php echo $vehiInspection; ?>">
                                                        <input type="hidden" name="cusFname" value="<?php echo $cusFname; ?>">
                                                        <input type="hidden" name="cusEmail" value="<?php echo $cusEmail; ?>">
                                                            <?php if ($vehiInspection == 'Pending'): ?>
                                                                <button class="btn btn-success btn-sm" type="submit"  name="new_status" value="Pass" >P</button>
                                                                <button class="btn btn-danger btn-sm" type="submit"  name="new_status" value="Reject" >R</button>
                                                            <?php elseif ($vehiInspection == 'Reject'): ?>  
                                                                <button class="btn btn-success btn-sm" type="submit"  name="new_status" value="Pass" >P</button>
                                                                <button class="btn btn-danger btn-sm disabled" >R</button>
                                                            <?php else: ?>
                                                            
                                                            <?php endif; ?>
                                                    </form>
                                                <?php endif; ?>
                                            
                                            </td>
                                                <td><?php echo $rowsearch['iStatus'];?></td>
                                                <td><?php echo $rowsearch['fStatus']; ?></td>
                                    

                                                <?php
                                                // booking status into $row['bStatus']
                                                $bookingStatus = $rowsearch['bStatus'];
                                                ?>

                                                <!-- Cancel Button -->
                                                <?php if ($fStatus == 'Complete'): ?>
                                                    <td><a class="btn btn-danger btn-sm disabled" href="gb-cancel.php" target="_blank">Cancel</a></td>
                                                <?php elseif($bookingStatus == 'Pending'|| $bookingStatus == 'Confirm'): ?>
                                                <td><a class="btn btn-danger btn-sm" onclick="confirmCancel(<?php echo $bookingid; ?>)">Cancel</a></td>
                                                <?php else: ?>
                                                    <td><a class="btn btn-danger btn-sm disabled" href="gb-cancel.php" target="_blank">Cancel</a></td>
                                                <?php endif; ?>

                                                <!-- Pay Button -->
                                              

                                                <form method="POST" action="g-payment-process.php">
                                                    <input type="hidden" name="bookingid" value="<?php echo $bookingid; ?>">
                                                    <input type="hidden" name="cusId" value="<?php echo $cusId; ?>">
                                                    <input type="hidden" name="cusFname" value="<?php echo $cusFname; ?>">
                                                    <input type="hidden" name="cusEmail" value="<?php echo $cusEmail; ?>">
                                                    <input type="hidden" name="vehiid" value="<?php echo $vehiid; ?>">

                                                <?php if ($pStatus == 'Complete'): ?>
                                                    <td><button class="btn btn-primary btn-sm disabled" type="submit"  name="new_status" value="Confirm">Pay</button></td>
                                                <?php elseif ($bookingStatus == 'Confirm' || $vehiInspection='Pass'): ?>
                                                    <td><button class="btn btn-primary btn-sm" type="submit"  name="new_status" value="Complete">Pay</button></td>
                                                <?php else: ?>
                                                    <td><button class="btn btn-primary btn-sm disabled" type="submit"  name="new_status" value="Confirm">Pay</button></td>
                                                <?php endif; ?>
                                                </form>

                                                <!-- Generate Button -->
                                                <?php 
                                                $cusFname= $rowsearch['cusFname'];
                                                $cusEmail= $rowsearch['cusEmail'];
                                                $vehiNo=$rowsearch['vehiNo'];  ?>
                                                <form method="POST" action="g-genarate.php">
                                                <input type="hidden" name="cusFname" value="<?php echo $cusFname; ?>">
                                                <input type="hidden" name="cusEmail" value="<?php echo $cusEmail; ?>">
                                                <input type="hidden" name="vehiNo" value="<?php echo $vehiNo; ?>">

                                                <?php if ($bookingStatus == 'Pending' || $fStatus == 'Complete' || $bookingStatus == 'Cancel'|| $vehiInspection == 'Pending'|| $vehiInspection == 'Reject'|| $pStatus == 'Pending'): ?>
                                                    <td><button class="btn btn-success btn-sm disabled"  target="_blank">Genarate</button></td>
                                                <?php else: ?>
                                                    <td><button class="btn btn-success btn-sm" type="submit" name="genarate" value="genarate"  >Genarate</button></td>
                                                <?php endif; ?>
                                                </form>
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
 <?php  } ?>


<?php                 
include_once "../include/footer.php";                 
?>

<script>
function confirmCancel(bookingId) {
    var result = confirm("Do you want to cancel the Booking?");

    if (result) {
        // If the user clicks "OK" in the popup, proceed with the cancellation
        window.location.href = "g-cancelb-process.php?bookingId=" + bookingId;
    } else {
        // If the user clicks "Cancel" in the popup, do nothing
    }
}
</script>

