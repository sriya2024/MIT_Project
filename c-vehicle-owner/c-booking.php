<?php                 
include_once "../include/headervehiowner.php";      

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["vehiId"])) {
        $vehiId = $_POST["vehiId"];
        $garageId = $_POST["garageId"];
        
    echo $vehiId;
    }else {
        echo "value not found.";
}
}


if (isset($_GET["garageId"])){
    $garageId = $_GET["garageId"];
      } 

if (isset($_GET["vehiId"])){
    $vehiId = $_GET["vehiId"];
     } 
?>
<!-- cusdashboard -->  
<section id="dashboard">
    <div class="container contanier-fluid py-5">
        <a class="d-grid py-4" href="c-dashboard.php" role="button">Back</a>
        <h3>Make A Reservation</h3>
        <p>Online reservation system has been created for your convenience. Now make reservations for your vehicle inspection.</p>

        <div class="row justify-content-md-center px-4 py-2">
            <div class="text-center">
                <div class="card shadow-lg mb-5 bg-body rounded">
                    <div class="card-body p-4">
                    <h5>Garage Details</h5><hr>
                    <?php $sql = "SELECT * FROM garage WHERE garageId='$garageId'";

                        $result1 = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result1) > 0) {
                            while ($row = mysqli_fetch_assoc($result1)) { ?>

                        <div class="container">
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                                <div class="col"><b>Grage Name:</b> </br> <?php echo $row['garageName']?></div>
                                <div class="col"><b>Address:</b> </br> <?php echo $row['gAddress']?></div>
                                <div class="col"><b>Contact No:</b>  </br> <?php echo $row['gPno'] ?></div>
                                <div class="col"><b>Email:</b> </br> <?php echo $row['gEmail']?></div>
                            </div>
                        </div>
    
                    <?php   }
                    } ?> 
                    </div>
                </div>   
            </div> 
        </div>   
        
        
    <!--Select date and time -->  
        <div class="row justify-content-md-center px-4 py-2">
          
            <div class="">
                <div class="card shadow-lg mb-5 bg-body rounded">
                    <div class="text-left p-4" style="background-color: #e3f2fd"><h5>Select date and Time slot</h5> <hr>
                        <div class="container">
                        <form action="c-booking-process.php" method="POST">
                            <div class="row justify-content-md-center">
                                <div class="col-md-auto">
                                     <label class="form-label" for="date" >Date:</label>
                                </div>
                                <!-- date-->  

                                <div class="col col-lg-4">
                                    <input class="form-control me-2" type="date" id="date" name="date" required min="<?php echo date('Y-m-d'); ?>">
                                </div>
                                    <div class="col-md-auto">
                                     <label class="form-label" for="time">Time Slot:</label>
                                </div>

                               
                                <div class="col col-lg-4">
                                    <select  class="form-select me-2" id="time" name="time" type="time" required>
                                        <option>8:00 AM - 8:30 AM</option>
                                        <option>8:30 AM - 9:00 AM</option>
                                        <option>9:00 AM - 9:30 AM</option>
                                        <option>9:30 AM - 10:00 AM</option>
                                        <option>10:00 AM - 10:30 AM</option>
                                        <option>10:30 AM - 11:00 AM</option>
                                        <option>11:00 AM - 11:30 AM</option>
                                        <option>11:30 AM - 12:00 PM</option>
                                        <option>1:00 PM - 1:30 PM</option>
                                        <option>1:30 PM - 2:00 PM</option>
                                        <option>2:00 PM - 2:30 PM</option>
                                        <option>2:30 PM - 3:00 PM</option>
                                        <option>3:00 PM - 3:30 PM</option>                            
                                    </select>
                                </div>
                                <div class="col-md-auto">
                                    <input type="hidden" name="vehiId" value="<?php echo $vehiId; ?>">
                                    <input type="hidden" name="garageId" id="gid" value="<?php echo $garageId; ?>">
                                    <button class="btn btn-outline-primary" type="submit">Booking</button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                     <!--succsess message--> 
    
                     <div class="card-body text-center" >
                        <p class="p-2 text-center">
                        <?php if (isset($_GET["id"])){?>
                        <span class="text-secondary"> <?php echo $_GET["id"];?> <a href="c-status.php">Click here</a></span>
                      
                        <?php  } ?>
                        </p> 

                    </div>           
                </div>   
            </div> 
        </div>   
    </div>
</section>
<script>
//remove get string show in  URL 
   var newURL = location.href.split("?")[0];
    window.history.pushState('object', document.title, newURL);
</script>

<?php                 
include_once "../include/footer.php";                 
?>




