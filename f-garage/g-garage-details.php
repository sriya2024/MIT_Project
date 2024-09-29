<?php    
//garge registraion certificate             
include_once "../include/headergarage.php";   
?>

<section id="container">
    <div class="container py-5">
        <a class="d-grid p-4" href="g-dashboard.php" role="button">Back</a>
       
        <div class="container">
            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4">
                <div class="col-12">
                    <div class="card shadow mb-5 bg-body rounded">
                        
                        <div class="text-left p-5" style="background-color: #e3f2fd">
                        <h3 class="text-right mt-2 pt-3">Certificate of registration as a garage in the Western Province suitable for issuing fitness certificates for the year &nbsp<?php echo $garageregyear; ?></h3>
                        <h5 class="card-title pt-3">Garage Details</h5><hr>
                         
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
                                <?php 
                                //garageid taken from session
                                $sqlinfo="SELECT * FROM garage as g, garage_owner as gow
                                WHERE g.garageId=gow.garageId
                                AND g.garageId= '$garageid'";
                                
                                $resultinfo=mysqli_query($conn,$sqlinfo);
                            
                                if (!$resultinfo) {
                                    die("Error: " . mysqli_error($conn));
                                }
                                
                                $rowinfo=mysqli_fetch_array($resultinfo);
                                
                                ?>
                              
                                <h5 class="card-title pt-3">Garage Owner Details</h5><hr>
                                <div class="row py-1">
                                    <div class="col-sm-4">Owner ID:</div>
                                    <div class="col-sm-8"><?php echo $rowinfo['ownerId']; ?></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-sm-4">Owner Name:</div>
                                    <div class="col-sm-8"><?php echo $rowinfo['ownerFname']; ?> &nbsp <?php echo $rowinfo['ownerLname']; ?></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-sm-4">Owner NIC:</div>
                                    <div class="col-sm-8"><?php echo $rowinfo['ownerNic']; ?></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-sm-4">Owner Tel. No:</div>
                                    <div class="col-sm-8"><?php echo $rowinfo['ownerPno']; ?></div>
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
                                            <?php }} ?>
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




  




<?php                 
include_once "../include/footer.php";                 
?>
