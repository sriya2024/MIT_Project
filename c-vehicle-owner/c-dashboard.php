<?php                 
include_once "../include/headervehiowner.php";      
?>
<!-- cusdashboard -->  
<section id="dashboard">
<div class="container contanier-fluid py-5">
    <h3 class="text-right my-2 py-4"><?php echo $_SESSION['fname']?> (Commercial Vehicle Owner),</h3>
    <!-- message -->     
    <div>
        <p class=" text-center">
        <?php if (isset($_GET["id"])){?>
        <span class="text-secondary"> <?php echo $_GET["id"];?></span>
        <?php  } ?>
        </p> 
    </div>
    
    <p>Here are displayed Vehicle details registered under your NIC. You can check the validity of your vehicle revenue licence and now you can apply for <b>vehicle fitness e- Certification </b> here. This service is applicable to Commercial Vehicles only. </P>
    <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4 px-4 py-5">
        <div class="col-sm-12 col-md-4 col-lg-3 col-12 text-center">
            <div class="card h-100 shadow-lg mb-4 bg-body rounded">

                <div class="card-body">
                    <h5 class="card-title py-4">Check the validity of vehicle revenue licence </h5>
                    <a class="btn btn-outline-primary rounded-pill d-grid" href="c-licence-status.php" role="button">Check</a>
                </div>
                
            </div>
        </div>

        <div class="col-sm-12 col-md-4 col-lg-3 col-12 text-center">
            <div class="card h-100 shadow-lg mb-5 bg-body rounded">
            
                <div class="card-body">
                    <h5 class="card-title py-4">Apply for vehicle fitness e-Certification </h5>
                    <a class="btn btn-outline-primary rounded-pill d-grid" href="c-apply-fitness.php" role="button">Apply</a>
                </div>

            </div>
        </div>

        
        <div class="col-sm-12 col-md-4 col-lg-3 col-12 text-center ">
            <div class="card h-100 shadow-lg  mb-5 bg-body rounded">
                
                <div class="card-body">
                    <h5 class="card-title py-4">Check e-certificate issuing status </h5>
                    <a class="btn btn-outline-primary rounded-pill d-grid" href="c-status.php" role="button">Check</a>
                </div>
                
            </div>
        </div>
            

        <div class="col-sm-12 col-md-4 col-lg-3 col-12 text-center ">
            <div class="card h-100 shadow-lg  mb-5 bg-body rounded">
                
                <div class="card-body">
                    <h5 class="card-title py-4">Download vehicle fitness e-Certificate </h5>
                    <a class="btn btn-outline-primary rounded-pill d-grid" href="c-download.php" role="button">Download</a>
                </div>
                
            </div>
        </div>
    </div> 
</div>
</section>


<?php                 
include_once "../include/footer.php";                 
?>
