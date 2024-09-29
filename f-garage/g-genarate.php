<?php                 
include_once "../include/headergarage.php";   

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["genarate"])) {
        $vehiNo = $_POST["vehiNo"];
        $cus_email = $_POST["cusEmail"];
        $cus_fname = $_POST["cusFname"];  
        //echo $cus_email;
        //echo $cus_fname;
     
    }else {
        echo "value not found.";
}
}



$sqlinfo = "SELECT * FROM  vehicle as v, booking as b, vehi_revenue_licence as vr
WHERE b.garageId=$garageid 
AND b.vehiId=v.vehiId 
AND b.vehiId=vr.vehiId 
AND v.vehiNo='$vehiNo' ";

$resultinfo=mysqli_query($conn,$sqlinfo);


//error handelling
if (!$resultinfo) {
    die("Error: " . mysqli_error($conn));
}

$rowinfo=mysqli_fetch_array($resultinfo);

//set session variable
$vehiId=$_SESSION['vid']=$rowinfo['vehiId']; 
$vehiNo=$_SESSION['vno']=$rowinfo['vehiNo']; 
$vehiClass=$_SESSION['vclass']=$rowinfo['vehiClass']; 
$vehiFuelType=$_SESSION['vfule']=$rowinfo['vehiFuelType']; 
$vehiGrossWeight=$_SESSION['vweight']=$rowinfo['vehiGrossWeight']; 
$vehiChasisNo=$_SESSION['vchasis']=$rowinfo['vehiChasisNo']; 
$vehiEngineNo=$_SESSION['vengi']=$rowinfo['vehiEngineNo']; 
$vehiOwnerId=$_SESSION['vowner']=$rowinfo['vehiOwnerId']; 
$validUntill=$_SESSION['lvaliddate']=$rowinfo['LicenceValidTo']; 
$bookingId=$_SESSION['bookingId']=$rowinfo['bookingId']; 

?>

<!-- dashboard -->  
<section id="dashboard">
    <div class="container py-5">
        <a class="d-grid pt-5" href="g-dashboard.php" role="button">Back</a>
        <h3 class="text-right mt-2 pt-4"><?php echo $garagename?></h3>
        <p class="text-right">Generate Inspection Report & Fitness Certification</p>
        <div class="container">
            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4 pt-2">
                <div class="col-12">
                    <div class="card shadow bg-body roundedr">
                    <form action="g-genarate-process.php" method="POST">
                        <div class="card-body">
                            <div class="container">
                                <input type="hidden" name="cusFname" value="<?php echo $cus_fname; ?>">
                                <input type="hidden" name="cusEmail" value="<?php echo $cus_email; ?>">
                                <input type="hidden" name="vehiNo" value="<?php echo $vehiNo; ?>">

                                <div class="row p-4" style="background-color: #e3f2fd">
                                    <div class="col-sm-9"><h5 class="text-right">Report of examination</h5></div>
                                    <div class="col-sm-3"><span class="form-control me-2" type="text" id="reportno" name="reportno" >Report Number </span></div>
                                </div>
                                <hr>
                                <div class="row py-3">
                                    <div class="col-sm-4">1.Vehicle No<span class="form-control me-2" style="background-color: #e3f2fd" type="text"  id="vehiNo" name="vehiNo" required><?php echo $vehiNo?></span></div>
                                    <div class="col-sm-4">2.Engine No<span class="form-control me-2" style="background-color: #e3f2fd" type="text"  id="engiNo" name="engiNo" required> <?php echo $vehiEngineNo?></span></div>
                                    <div class="col-sm-4">3.Engine Make<input class="form-control me-2" type="text"  id="engiMake" name="engiMake" required> </div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-sm-4">4.Chassis No<span class="form-control me-2" style="background-color: #e3f2fd" type="text"  id="vehiChasisNo" name="vehiChasisNo" required><?php echo $vehiChasisNo?></span></div>
                                    <div class="col-sm-4">5.Wheel Base<input class="form-control me-2" type="text" placeholder="cm" id="wheelbase" name="wheelbase" required> </div>
                                    <div class="col-sm-4">6.Engine 
                                        <select  class="form-select me-2 form-control" id="engincon" name="engincon" required>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-sm-4">7.Clutch 
                                        <select  class="form-select me-2 form-control" id="clutchcon" name="clutchcon" required>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">8.Gear Box
                                        <select  class="form-select me-2 form-control" id="gearboxcon" name="gearboxcon" required>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">9.Transmission 
                                        <select  class="form-select me-2 form-control" id="transmissioncon" name="transmissioncon" required>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-sm-4">10.Back Axel 
                                        <select  class="form-select me-2 form-control" id="backaxelcon" name="backaxelcon" required>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">11.Front Axel 
                                        <select  class="form-select me-2 form-control" id="frontaxelcon" name="frontaxelcon" required>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">12.Wheels and Tyres 
                                        <select  class="form-select me-2 form-control" id="wheelcon" name="wheelcon" required>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-sm-4">13.Springs 
                                         <select  class="form-select me-2 form-control" id="springcon" name="springcon" required>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">14.Chassis
                                         <select  class="form-select me-2 form-control" id="chassiscon" name="chassiscon" required>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">15.Steering
                                        <select  class="form-select me-2 form-control" id="steeringcon" name="steeringcon" required>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-sm-4">16.Brakes
                                        <select  class="form-select me-2 form-control" id="brakescon" name="brakescon" required>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">17.Fuel System
                                        <select  class="form-select me-2 form-control" id="fuelcon" name="fuelcon" required>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                     </div>
                                    <div class="col-sm-4">18.Exhaust System
                                        <select  class="form-select me-2 form-control" id="exhaustcon" name="exhaustcon" required>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-sm-4">19.Electrical Equipment 
                                        <select  class="form-select me-2 form-control" id="electricalcon" name="electricalcon" required>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">20.Other Eauipment
                                        <select  class="form-select me-2 form-control" id="othercon" name="othercon" required>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">21.Body
                                        <select  class="form-select me-2 form-control" id="bodycon" name="bodycon" required>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-sm-2">22.Pay Load <br/>(Lorry)<input class="form-control me-2" type="text" placeholder="kg" id="payload" name="payload" required></div>
                                    <div class="col-sm-2">23.Pay Load Condition
                                        <select  class="form-select me-2 form-control" id="payloadcon" name="payloadcon" required>
                                            <option value="Excellent">Not relevent</option>
                                            <option value="Excellent">Excellent</option>
                                            <option value="Good">Good</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Bad">Bad</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-8">24.Observations (If reject)<textarea class="form-control me-2" type="text" id="observation" name="observation" required  rows="2"></textarea> </div>
                                </div>
                                
                                <hr>



                                <div class="row p-4" style="background-color: #e3f2fd">
                                    <div class="col-sm-9"><h5 class="text-right">Certificate of Fitness</h5></div>
                                    <div class="col-sm-3"><span class="form-control me-2" type="text" id="certificcateNo" name="certificcateNo">Certificate Number</span> </div>
                                </div>
                                <hr>
                                <div class="row py-3">
                                    <div class="col-sm-6">Description of Vehicle
                                        <select  class="form-select me-2 form-control" id="descriptionvehi" name="descriptionvehi" required>
                                            <option value="Omnibus">Omnibus</option>
                                            <option value="Privat Coach">Privat Coach</option>
                                            <option value="Lorry">Lorry</option>
                                            <option value="Hearse">Hearse</option>
                                            <option value="Ambulance">Ambulance</option>
                                            <option value="Hiring Car<">Hiring Car</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6">Make of Vehicle<input class="form-control me-2" type="text" id="make" name="make" required> </div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-sm-4">Tyre size- Front<input class="form-control me-2" type="text" id="fronttyre" name="fronttyre" required> </div>
                                    <div class="col-sm-4">Rear<input class="form-control me-2" type="text" id="rear" name="rear" required> </div>
                                    <div class="col-sm-4">Tyre requirement
                                        <select  class="form-select me-2 form-control" id="tyerRequir" name="tyerRequir" required>
                                            <option value="Dual">Dual</option>
                                            <option value="Single">Single</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-sm-6">Number of Axles<input class="form-control me-2" type="text" id="noaxles" name="noaxles" required> </div>
                                    <div class="col-sm-6">Type of Body
                                        <select  class="form-select me-2 form-control" id="bodytype" name="bodytype" required>
                                            <option value="Closed">Closed</option>
                                            <option value="Opened">Opened</option>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button class="btn btn-outline-primary px-5" type="submit">Save</button>
                                </div>
                            </div>  
                          
                            </form>     
                                 
                                  
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
    



<?php                 
include_once "../include/footer.php";                 
?>
