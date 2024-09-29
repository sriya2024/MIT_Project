<?php   
//garage registration certificate              
include_once "../include/headerdmt.php";      

if (isset($_GET["garageId"])){
    $garageId = $_GET["garageId"];
  
} else {
    echo "garageId value not found.";
}


$sqlinfo="SELECT * FROM garage as g, garage_owner as gow
    WHERE g.garageId=gow.garageId
    AND g.garageId= '$garageId'";
	
	$resultinfo=mysqli_query($conn,$sqlinfo);

	if (!$resultinfo) {
		die("Error: " . mysqli_error($conn));
	}
	
	$rowinfo=mysqli_fetch_array($resultinfo);
?>

<section id="container">
    <div class="container py-5">
        <div class="container">
            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4">
                <div class="col-12">
                    <div class="card shadow mb-5 bg-body rounded">
                    <?php if (isset($_GET["id"])){?>

                        <p class="p-2 text-center alert alert-info">
                        <span class="text-secondary"> <?php echo $_GET["id"];?> </span>
                        </p> 
                        <?php  } ?>

                        <div class="text-left p-5" style="background-color: #e3f2fd">
                        
                        <form method="POST" action="d-add-guser-process.php">    
                        <h5 class="card-title pt-3">Garage Details</h5>
                        <div class="col-12 col-md-4">
                            <button class="btn btn-outline-primary btn-sm right" type="submit"  name="add_user" value="add" >Add User Account</button>
                        </div>
                        <hr>
                            <div class="mb-3">
                                 <div class="row py-1">
                                    <div class="col-sm-4">Garage ID:</div>
                                    <div class="col-sm-8"><?php echo $rowinfo['garageId']; ?></div>
                                    <input type="hidden" name="garage_id" value="<?php echo $rowinfo['garageId'];?>">
                                </div>   
                                <div class="row py-1">
                                    <div class="col-sm-4">Garage Name:</div>
                                    <div class="col-sm-8"><?php echo $rowinfo['garageName']; ?></div>
                                </div>  
                                <div class="row py-1">
                                    <div class="col-sm-4">Garage Address:</div>
                                    <div class="col-sm-8"><?php echo $rowinfo['gAddress']; ?></div>
                                </div>  
                                <div class="row py-1">
                                    <div class="col-sm-4">Garage Tel. No:</div>
                                    <div class="col-sm-8"><?php echo $rowinfo['gPno']; ?></div>
                                </div>
                                 
                                <div class="row py-1">
                                    <div class="col-sm-4">Email:</div>
                                    <div class="col-sm-8"><?php echo $rowinfo['gEmail']; ?></div>
                                    <input type="hidden" name="garage_email" value="<?php echo $rowinfo['gEmail'];?>">
                                </div>
                                 
                                <div class="row py-1">
                                    <div class="col-sm-4">District:</div>
                                    <div class="col-sm-8"><?php echo $rowinfo['gDistrict']; ?></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-sm-4">City:</div>
                                    <div class="col-sm-8"><?php echo $rowinfo['gCity']; ?></div>
                                </div>
                                <div class="row py-1">
                                    <div class="col-sm-4">Registred Year:</div>
                                    <div class="col-sm-8"><?php echo $rowinfo['regYear']; ?></div>
                                </div>

                                <h5 class="card-title pt-3">Garage Owner Details</h5><hr>
                                <div class="row py-1">
                                    <div class="col-sm-4">Owner ID:</div>
                                    <div class="col-sm-8"><?php echo $rowinfo['ownerId']; ?></div>
                                    <input type="hidden" name="owner_id" value="<?php echo $rowinfo['ownerId'];?>">
                                </div>
                                <div class="row py-1">
                                    <div class="col-sm-4">Owner Name:</div>
                                    <div class="col-sm-8"><?php echo $rowinfo['ownerFname']; ?> &nbsp <?php echo $rowinfo['ownerLname']; ?></div>
                                    <input type="hidden" name="owner_fname" value="<?php echo $rowinfo['ownerFname'];?>">
                                </div>
                                <div class="row py-1">
                                    <div class="col-sm-4">Owner NIC:</div>
                                    <div class="col-sm-8"><?php echo $rowinfo['ownerNic']; ?></div>
                                    <input type="hidden" name="owner_nic" value="<?php echo $rowinfo['ownerNic'];?>">
                                    
                                </div>
                                <div class="row py-1">
                                    <div class="col-sm-4">Owner Tel. No:</div>
                                    <div class="col-sm-8"><?php echo $rowinfo['ownerPno']; ?></div>
                                </div>
                            </form>

                                <h5 class="card-title pt-5">Certifying Officer(s) Details</h5><hr>
                                <?php
                                  $sql = "SELECT * FROM certifying_officer as co, garage as g
                                  WHERE co.garageId=g.garageId
                                  AND g.garageId='$garageId'";
                               
                                
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
                                                <th>Email</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <?php  while($rowco = mysqli_fetch_assoc($resultco)){ ?>
                                        <tbody>  
                                        <form method="POST" action="d-add-guser-process.php">       
                                            <tr> 
                                                <td><?php echo $rowco['cofficerId']; ?>
                                                <input type="hidden" name="officer_id" value="<?php echo $rowco['cofficerId'];?>"></td> 

                                                <td><?php echo $rowco['cofficerFname']?> <?php echo $rowco['cofficerLname'] ?>
                                                <input type="hidden" name="officer_fname" value="<?php echo $rowco['cofficerFname'];?>"></td>

                                                <td><?php echo $rowco['cofficerNic']; ?>
                                                <input type="hidden" name="officer_nic" value="<?php echo $rowco['cofficerNic'];?>"></td>

                                                <td><?php echo $rowco['cofficerPno']; ?></td>
                                                <td><?php echo $rowco['cofficeremail']; ?>
                                                <input type="hidden" name="officer_email" value="<?php echo $rowco['cofficeremail'];?>"></td>
                                                <input type="hidden" name="garageId" value="<?php echo $garageId;?>"></td>
                                      
                                                <td> <button class="btn btn-outline-primary btn-sm right" type="submit"  name="add_user" value="add"  href=d-add-guser-proces.php>Add User Account</button></td>
                                                
                                            </tr>
                                       
                                            <?php }
                                        
                                        } ?>
                                         </form>
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




  




