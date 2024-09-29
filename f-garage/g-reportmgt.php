<?php                 
include_once "../include/headergarage.php";      


?>
  
<!-- dashboard -->  
<section id="dashboard">
    <div class="container py-5">
        <a class="d-grid pt-5" href="g-dashboard.php" role="button">Back</a>
        <h3 class="text-right mt-2 pt-4"><?php echo $garagename?></h3>
        <p class="text-right">Report Generate</p>

     
        <p class="p-2 text-center">
        <?php if (isset($_GET["id"])){?>
        <span class="text-secondary"> <?php echo $_GET["id"];?> </span>
        <?php  } ?>
               
        <div class="container">
            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4">
                <div class="col-12 col-md-3">
                    <div class="card h-80 shadow mb-5 bg-body rounded">
                        <div class="card-body">  
                        <a class="btn btn-outline-primary d-grid py-5" href="g-reportbooking.php" role="button">Booking</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="card h-80 shadow mb-5 bg-body rounded">
                        <div class="card-body">
                        <a class="btn btn-outline-primary d-grid py-5" href="g-reportpayment.php" role="button">Payment</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="card h-80 shadow mb-5 bg-body rounded">
                        <div class="card-body">
                        <a class="btn btn-outline-primary d-grid py-5" href="g-reportfitness.php" role="button">Fitness e-Certificate</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="card h-80 shadow mb-5 bg-body rounded">
                        <div class="card-body">  
                        <a class="btn btn-outline-primary d-grid py-5" href="g-reportinspection.php" role="button">Vehicle Inspection </a>
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

