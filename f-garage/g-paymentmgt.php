<?php                 
include_once "../include/headergarage.php";    



//garage user table has usernic. it can use identify login person details
//garage owner*******************************************************************************
if($_SESSION['roleId']==1){

?>
 
<!-- dashboard -->  
<section id="dashboard">
    <div class="container mt-2 py-4">
        <a class="d-grid pt-4 "  href="g-dashboard.php" role="button">Back</a>
        <h3 class="text-right mt-2 pt-4"><?php echo $garagename?></h3>
        <p class="text-right">Payments</p>
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
                                    // default values
                                    $search = $_GET['search'] ?? '';

                                    if (!empty($search)) {
                                       
                                        $sqlsearch = "SELECT * FROM booking as b, payment as p, customer as c, vehicle as v
                                        WHERE b.vehiId=v.vehiId
                                        AND b.bookingId = p.bookingId
                                        AND b.cusId=c.cusId
                                        AND b.garageId='$garageid'
                                        AND (vehiNo LIKE '%$search%'OR pDate LIKE '%$search%' OR pDate LIKE '%$search%'OR cusFname LIKE '%$search%' OR cusLname LIKE '%$search%')
                                        ";
                                    } else {
                                       
                                        $sqlsearch = "SELECT * FROM booking as b, payment as p, customer as c, vehicle as v
                                        WHERE b.vehiId=v.vehiId
                                        AND b.bookingId = p.bookingId
                                        AND b.cusId=c.cusId
                                        AND b.garageId='$garageid'
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
                                                <th>Booking Id</th>
                                                <th>Vehicle Number</th>
                                                <th>Booking Date</th>
                                                <th>Booking Time</th>
                                                <th>Customer Name</th>
                                                <th>Amount</th>
                                                <th>Pay Type</th>
                                                <th>Pay Date</th>
                                                <th>Approved By</th>
                                               
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
                                                <td><?php echo $rowsearch['amount']; ?> </td>
                                                <td><?php echo $rowsearch['payType']; ?></td>
                                                <td><?php echo $rowsearch['pDate'];?></td>
                                                <td><?php echo $rowsearch['aprovedBy']; ?></td>
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
//certifying officer***********************************************************
 if($_SESSION['roleId']==2){

?>
 
<!-- dashboard -->  
<section id="dashboard">
    <div class="container py-4">
        <a class="d-grid pt-4" href="g-dashboard.php" role="button">Back</a>
        <h3 class="text-right mt-2 pt-4"><?php echo $garagename?></h3>
        <p class="text-right">Payments</p>

     
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
                                        <form class="d-flex" action="g-paymentmgt.php" method="GET">
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
                                       
                                        $sqlsearch = "SELECT * FROM booking as b, payment as p, customer as c, vehicle as v
                                        WHERE b.vehiId=v.vehiId
                                        AND b.bookingId = p.bookingId
                                        AND b.cusId=c.cusId
                                        AND b.garageId='$garageid'
                                        AND (vehiNo LIKE '%$search%'OR pDate LIKE '%$search%' OR pDate LIKE '%$search%'OR cusFname LIKE '%$search%' OR cusLname LIKE '%$search%')
                                        ";
                                    } else {
                                       
                                        $sqlsearch = "SELECT * FROM booking as b, payment as p, customer as c, vehicle as v
                                        WHERE b.vehiId=v.vehiId
                                        AND b.bookingId = p.bookingId
                                        AND b.cusId=c.cusId
                                        AND b.garageId='$garageid'
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
                                                <th>Booking Id</th>
                                                <th>Vehicle Number</th>
                                                <th>Booking Date</th>
                                                <th>Booking Time</th>
                                                <th>Customer Name</th>
                                                <th>Amount</th>
                                                <th>Pay Type</th>
                                                <th>Pay Date</th>
                                                <th>Approved By</th>
                                               
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
                                                <td><?php echo $rowsearch['amount']; ?> </td>
                                                <td><?php echo $rowsearch['payType']; ?></td>
                                                <td><?php echo $rowsearch['pDate'];?></td>
                                                <td><?php echo $rowsearch['aprovedBy']; ?></td>
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



