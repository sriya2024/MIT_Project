<?php                 
include_once "../include/headerdmt.php";      
?>
<!-- dashboard -->  
<section id="dashboard">
    <div class="container py-5">
        <a class="d-grid pt-4" href="d-dashboard.php" role="button">Back</a>
        <h3 class="text-right mt-2 pt-4">DMTWP</h3>
        <p class="text-right">Report Generate</p>

     
        <p class="p-2 text-center">
        <?php if (isset($_GET["id"])){?>
        <span class="text-secondary"> <?php echo $_GET["id"];?> </span>
        <?php  } ?>
               
        <div class="container">
            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4">
            <div class="col-12 col-md-2">
                    <div class="card h-80 shadow mb-5 bg-body rounded">
                        <div class="card-body">  
                        <a class="btn btn-outline-primary d-grid py-5" href="d-reportgarage.php" role="button">Garage Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-2">
                    <div class="card h-80 shadow mb-5 bg-body rounded">
                        <div class="card-body">  
                        <a class="btn btn-outline-primary d-grid py-5" href="d-reportbooking.php" role="button">Bookings</a>
                        </div>
                    </div>
                </div>



                <div class="col-12 col-md-2">
                    <div class="card h-80 shadow mb-5 bg-body rounded">
                        <div class="card-body">
                        <a class="btn btn-outline-primary d-grid py-5" href="d-reportfitness.php" role="button">Fitness Certificates</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="card h-80 shadow mb-5 bg-body rounded">
                        <div class="card-body">  
                        <a class="btn btn-outline-primary d-grid py-5" href="d-reportinspection.php" role="button">Vehicle Inspection </a>
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

