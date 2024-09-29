<?php                 
include_once "../include/headerdmt.php";      
?>

<!-- dashboard -->  
<section id="dashboard">
    <div class="container py-5">
        <a class="d-grid pt-4" href="d-faqmgt.php" role="button">Back</a>
        <h3 class="text-right mt-2 pt-4">FAQ Manage</h3>
        
        <?php if (isset($_GET["id"])){?>
            <p class="p-2 text-center alert alert-info">
            <span class="text-secondary"> <?php echo $_GET["id"];?> </span>
            </p> 
            <?php  } ?>

        <div class="container">
            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4 pt-2">
                <div class="col-12">
                    <div class="card shadow bg-body rounded">
                        <div class="text-left p-4" style="background-color: #e3f2fd">
                                <div class="row">
                                    <h3>Add FAQ</h3>
                                </div>
                            </div>
                            <form action="d-add-faq-process.php" method="POST">
                        <div class="card-body">
                                <div class="row py-3">
                                    <div class="col-sm-2" class="text-center"></span></div>
                                    <div class="col-sm-2" class="text-center">Question</span></div>
                                    <div class="col-sm-8"><input class="form-control me-2" type="text" id="faq_question" name="faq_question" required></div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-sm-2" class="text-center"></span></div>
                                    <div class="col-sm-2" class="text-center">Answer</span></div>
                                    <div class="col-sm-8"><textarea class="form-control" id="faq_answer" name="faq_answer" ></textarea> </div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-sm-2" class="text-center"></span></div>
                                    <div class="col-sm-2" class="text-center"></span></div>
                                    <div class="col-sm-8">        
                                        <button class="btn btn-outline-primary" type="submit">Save</button>
                                        <button class="btn btn-outline-primary" input type="reset" value="Reset">Clear</button>
                                    </div>
                                </div>    
                             </div>
                        </form>  
                    </div>
                </div>
            </div>    
        </div>
    </div>
</section>

<?php
mysqli_close($conn);
?>
    
<?php                 
include_once "../include/footer.php";                 
?>

