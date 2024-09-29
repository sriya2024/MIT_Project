<?php                 
include_once "../include/headerdmt.php";      
?>  
<!-- dashboard -->  
<section id="dashboard">
    <div class="container py-5">
        <a class="d-grid pt-4" href="d-reportmgt.php" role="button">Back</a>
        <h3 class="text-right mt-2 pt-4">DMTWP</h3>
        <p class="text-right">Reports are downloaded in PDF format and editable Excel File Format </p>

     
        <p class="p-2 text-center">
        <?php if (isset($_GET["id"])){?>
        <span class="text-secondary"> <?php echo $_GET["id"];?> </span>
        <?php  } ?>
               
        <div class="container">
            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4">
                <div class="col-12">
                    <div class="card shadow mb-5 bg-body rounded">
                        <div class="text-left p-5" style="background-color: #e3f2fd">
                        <h5 class="card-title">Report Generate - Garage details</h5><hr>
                         
                            <div class="mb-3">
                                <form  action="g-reportfitness-process.php" method="GET">
                                <div class="d-flex">
                                <label class="me-3" for="start_date">Start Date:</label>
                                <input class="form-control me-3 " type="date" name="start_date" id="start_date" value="<?= $startDate ?>">
                                <label class="me-3" for="end_date">End Date:</label>
                                <input class="form-control " type="date" name="end_date" id="end_date" value="<?= $endDate ?>">
                                </div>
                                <div class="py-4">
                                    <label for="category">District:</label>
                                    <select class="form-select me-3 p-2" name="category" id="category">
                                        <option value="all">All</option>
                                        <option value="collombo">Collombo</option>
                                        <option value="gampaha">Gampaha</option>
                                        <option value="kaluthara">Kaluthara</option>
                                    </select>
                                </div>
                                <div class="py-2">
                                    <label for="category">Category:</label>
                                    <select class="form-select me-3 p-2" name="category" id="category">
                                        <option value="all">All</option>
                                        <option value="pending">Active</option>
                                        <option value="confirm">Suspend</option>
                                    </select>
                                </div>    

                                <div class="d-flex pt-1">   
                                    <button class="btn btn-outline-primary me-3" type="submit" name="action"  value="generate_excel">Generate Excel</button>
                                    <button class="btn btn-outline-primary" type="submit" name="action" value="generate_pdf">Generate Pdf</button>
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



<?php                 
include_once "../include/footer.php";                 
?>

