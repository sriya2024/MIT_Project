<?php                 
include_once "../include/headervehiowner.php";      
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["vehiid"])) {
        $vehiid = $_POST["vehiid"];
        $bookingid = $_POST["bookingid"];
    }else {
        echo "value not found.";
    }
}
?>
<section id="cusdashboard">
    <div class="container contanier-fluid py-5">
        <a class="d-grid py-4" href="c-dashboard.php" role="button">Back</a>
        <h3  class="py-4">Payment</h3>
        <p>Fitness Certificate issue fee is <b>Rs. 1000 </b>. You can pay at either the Garage premises or online here. </P>
        <div class="row justify-content-md-center px-4 py-4">
            <div class="container">
                <div class="shadow-lg mb-5 bg-body rounded">
                    <div class="text-left p-4" style="background-color: #e3f2fd">
                        <h5>Pay by Credit Card</h5>
                    </div>  

                    <div class="card-body" >
                        <div class="container-fluid" >
                            <div class="row py-3">
                                <div class="col-sm-8 card p-5">
                                    <div class="mb-3">
                                        <h5>Payment Amount - Rs. 1000</h5>
                                        <hr/>
                                    </div>
                                    
                                <form action="c-payment-process.php" method="POST" id="payform">
                                    <div>
                                     <p id="error-msg" style="color: red;"></p>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cardholdername" class="form-label">Card Type</label></br>
                                        <input type="radio" id="paymaster" name="pay" value="master">
                                            <img src="../img/master.png" class="img-fluid payimg"  alt="pay-image">
                                        <input type="radio" id="payvisa" name="pay" value="visa">
                                            <img src="../img/visa.png" class="img-fluid payimg"  alt="pay-image"></button>
                                    </div>
                                    <div class="mb-3">
                                        <label for="cardholdername" class="form-label">Cardholder Name</label>
                                        <input type="text" class="form-control" id="holdername" required>
                                    </div>
                                   
                                    <div class="mb-3">
                                        <label for="card-no" class="form-label">Card Number</label>
                                        <input type="text" class="form-control" id="cardno" required>
                                    </div>

                                    <div class="mb-3 row">
                                        <div class="col-sm-6">
                                            <label for="expairdate" class="form-label">Expairy Date</label>
                                            <input type="text" class="form-control" id="expairdate" placeholder="--/--" required>  
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="ccv" class="form-label">CCV</label>
                                            <input type="password" class="form-control" id="cvv" required>  
                                        </div>
                                    </div>
                                    <input type="hidden" name="vehiid" value="<?php echo $vehiid; ?>">
                                    <input type="hidden" name="bookingid" value="<?php echo $bookingid; ?>">
                                    <button class="btn btn-outline-primary" type="submit">Make Payment</button>
                                </form>
                                </div>  
                                <div class="col-sm-4">
                                    <p>* Condition applied</p>
                                </div> 
                            </div>
                        </div>   
                    </div>
                </div>   
            </div> 
        </div>   
    </div>
</section>
</script><?php                 
include_once "../include/footer.php";                 
?>
