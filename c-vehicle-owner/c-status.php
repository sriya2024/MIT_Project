<?php                 
include_once "../include/headervehiowner.php";      
?>

<!-- status -->  
<section id="dashboard">
    <div class="container contanier-fluid py-5">
        <a class="d-grid py-4" href="c-dashboard.php" role="button">Back</a>
        <h3>Vehicle Fitness e-certificate issuing status</h3>
        
        <div>
            <p class=" text-center">
            <?php if (isset($_GET["id"])){?>
            <span class="text-secondary"> <?php echo $_GET["id"];?></span>
            <?php  } ?>
            </p> 
        </div>

        <div class="row justify-content-md-center px-4 py-5">
            <div class="bg-body rounded">
                <div class="card shadow-lg mb-5 py-4 ">
                    <div class="container">
                    <?php 
                    $sql = "SELECT * FROM booking as b, customer as c, vehicle as v, garage as g, issued_certificate as ic
                            WHERE b.cusId=c.cusId 
                            AND v.vehiId=b.vehiId 
                            AND g.garageId=b.garageId 
                            AND b.bookingId=ic.bookingId 
                            AND c.cusNic='$nic'";
                    $result = mysqli_query($conn, $sql); ?> 

                    <?php if (mysqli_num_rows($result) > 0) { ?>
                    <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th>Vehicle Number</th>
                            <th>Booking Date</th>
                            <th>Booking Time</th>
                            <th>Garage Name</th>
                            <th>Booking Status</th>
                            <th>Payment Status</th>
                            <th>Inspection Certificate Status</th>
                            <th>Fitness Certificate Status</th>
                        </tr>
                    </thead>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tbody>   
                        <tr>
                            <td><?php echo $row['vehiNo']; ?></td>
                            <td><?php echo $row['bookingDate']; ?></td>
                            <td><?php echo $row['timeSlot']; ?></td>
                            <td><?php echo $row['garageName']; ?></td>
                            <td><?php echo $row['bStatus']; 
                                // booking Cancel
                                $bookingStatus = $row['bStatus'];
                                $bookingid=$row['bookingId'];
                                $pStatus= $row['pStatus']; 
                                $iStatus= $row['iStatus'];
                                $fStatus= $row['fStatus'];
                                $vehiNo=$row['vehiNo']; 
                                $vehiId=$row['vehiId']; 
                                
                                if ($iStatus !== 'Complete' && $fStatus !== 'Complete'): ?>
                                    <a class="btn btn-danger btn-sm" onclick="confirmCancel(<?php echo $bookingid; ?>)">Cancel</a>
                                <?php endif; ?>
                                        
                            </td>
                            <td><?php echo $row['pStatus'];
                                //payment
                                $vehiInspection=$row['vehiInspection'];
                                $bookingStatus = $row['bStatus'];
                                $bookingid=$row['bookingId'];
                                $pStatus= $row['pStatus']; 
                                $iStatus= $row['iStatus'];
                                $fStatus= $row['fStatus'];
                                $vehiNo=$row['vehiNo']; 
                                $vehiId=$row['vehiId']; 
                                ?>
                                    <form method="POST" action="c-payment.php">
                                    <input type="hidden" name="bookingid" value="<?php echo $bookingid; ?>">
                                    <input type="hidden" name="vehiid" value="<?php echo $vehiId; ?>">

                                    <?php if ($bookingStatus == 'Confirm' && $pStatus == 'Pending' && $vehiInspection == 'Pass'): ?>
                                        <button class="btn btn btn-primary btn-sm" type="submit"> Pay </button>
                                    <?php else: ?>  
                                        
                                    <?php endif; ?>
                                    </form>
                            </td>
                            <td><?php echo $row['iStatus']; ?></td>
                            <td><?php echo $row['fStatus']; ?></td>    
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                    <?php } else { ?>
                    <p>No record found </p>
                    <?php } 
                    mysqli_close($conn);
                    ?>
                </div> 
            </div> 
        </div>   
    </div>
</section>
    
<?php                 
include_once "../include/footer.php";                 
?>

<script>
function confirmCancel(bookingId) {
    var result = confirm("Do you want to delete the Booking? Any payment you made will not be refunded");

    if (result) {
        
        window.location.href = "c-cancelb-process.php?bookingId=" + bookingId;
    } else {
        
    }
}
</script>