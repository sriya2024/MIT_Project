<?php                 
include_once "../include/headervehiowner.php";  
    if (isset($_POST["vehiId"])) {
        $vehiId = $_POST["vehiId"];
  
    }else {
        echo "value not found.";
    }

?>
<!-- cusdashboard -->  
<section id="dashboard">
    <div class="container contanier-fluid py-5">
        <a class="d-grid py-4" href="c-apply-fitness.php" role="button">Back</a>
        <h3>Apply for vehicle fitness e-Certification</h3>

        <div class="row justify-content-md-center px-4 py-2">
            <div class="text-center">
                <div class="card shadow-lg mb-5 bg-body rounded">
                    <div class="card-body p-4">
                        <h5>Vehicle Details</h5><hr>
                        <?php 
                        $sql = "SELECT DISTINCT * 
                                FROM vehicle as v, vehi_owner as vo, vehi_revenue_licence as vl 
                                WHERE v.vehiOwnerId=vo.vehiOwnerId AND v.vehiId=vl.vehiId AND vo.vehiOwnerNic='$nic' AND  v.vehiId='$vehiId'";

                        $result1 = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($result1) > 0) {
                            while ($row = mysqli_fetch_assoc($result1)) { ?>
                            <div class="container">
                                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                                    <div class="col"><b>Vehicle No:</b> </br> <?php echo $row['vehiNo']?></div>
                                    <div class="col"><b>Vehicle Class:</b> </br> <?php echo $row['vehiClass']?></div>
                                    <div class="col"><b>Engine No:</b>  </br> <?php echo $row['vehiEngineNo'] ?></div>
                                </div>
                            </div>
                        <?php
                            }
                        } ?>      
                    </div>
                </div>   
            </div> 
        </div>   
        <!-- search -->  
        <div class="row justify-content-md-center px-4 py-2">
            <div class=" bg-body rounded">
                <div class="card shadow-lg mb-5">
                    <div class="text-left p-4" style="background-color: #e3f2fd"><h5>Find the nearest fitness garage</h5> <hr>
                        <div class="container-fluid" >
                        <form action="c-apply.php" method="POST">
                            <div class="row justify-content-md-center">
                                <div class="col col-lg-5">
                                    <select class="form-select me-2" id="district" name="district" required>
                                        <option value="">Select a District</option>
                                        <?php
                                        //district
                                        $sqllocation = "SELECT DISTINCT gDistrict FROM garage";
                                        $resultlocation = mysqli_query($conn, $sqllocation);
                                        while ($rowlocation = mysqli_fetch_assoc($resultlocation)) {
                                            echo "<option value='" . $rowlocation['gDistrict'] . "'>" . $rowlocation['gDistrict'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col col-lg-5">
                                    <select class="form-select me-2" id="city" name="city" required>
                                        <option value="">Select a City</option>
                                        <?php
                                        //city
                                        $sqllocation = "SELECT DISTINCT gCity FROM garage";
                                        $resultlocation = mysqli_query($conn, $sqllocation);
                                        while ($rowlocation = mysqli_fetch_assoc($resultlocation)) {
                                            echo "<option value='" . $rowlocation['gCity'] . "'>" . $rowlocation['gCity'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col col-lg-2">
                                    <input type="hidden" name="vehiId" value="<?php echo $vehiId; ?>">
                                    <button class="btn btn-outline-primary" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>   
        
                <div class="card-body text-center" >
                    <?php
                   
                    if (isset($_POST["district"]) && isset($_POST["city"])) {
               
                    $district = filter_var($_POST["district"], FILTER_SANITIZE_STRING);
                    $city = filter_var($_POST["city"], FILTER_SANITIZE_STRING);

                
                    if (empty($district) || empty($city)) {
                        die("Invalid input.");
                    }

                  
                    $district = mysqli_real_escape_string($conn, $district);
                    $city = mysqli_real_escape_string($conn, $city);

            
                    $sql = "SELECT * FROM garage WHERE gDistrict = '$district' AND gCity = '$city' AND 	gStatus='Active'";
                    $result = mysqli_query($conn, $sql);

            
                    if (mysqli_num_rows($result) > 0) {
                        ?>

                        <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Garage Name</th>
                                <th>Location</th>
                                <th>Contact No</th>
                                <th>District</th>
                                <th>City</th>
                                <th></th>
                            </tr>
                        </thead>
                        
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {
                       
                        echo "<tr>";
                        echo "<td>" . $row['garageName'] . "</td>";
                        echo "<td>" . $row['gAddress'] . "</td>";
                        echo "<td>" . $row['gPno'] . "</td>";
                        echo "<td>" . $row['gDistrict'] . "</td>";
                        echo "<td>" . $row['gCity'] . "</td>";
                        echo ' <td> <form action="c-booking.php" method="post">';
                        echo '<input type="hidden" name="vehiId" value="' .$vehiId. '">';
                        echo '<input type="hidden" name="garageId" value="' .$row['garageId']. '">';
                        echo '<input class="btn btn-outline-primary rounded-pill" type="submit" value="Booking Now">';
                        echo '</form> </td>';
                        echo "</tr>";
                        }
                        ?>
                        </table>
                        <?php
                    } else {
                        echo "No garages found matching the search criteria.";
                    }


                    mysqli_close($conn);
                    }?>     
                    </div>
                </div>   
            </div> 
        </div>   
    </div>
</section>
    








<?php                 
include_once "../include/footer.php";                 
?>
