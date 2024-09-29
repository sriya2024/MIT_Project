<?php                 
include_once "../include/headerdmt.php";      

//Commissioner*******************************************************************************
if($_SESSION['stfRole']=='Commissioner'){

?>
<!-- dashboard -->  
<section id="dashboard">
    <div class="container py-5">
        <a class="d-grid pt-4" href="d-dashboard.php" role="button">Back</a>
        <h3 class="text-right mt-2 pt-4">News Manage</h3>
        
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
                                    <div class="col-12 col-md-4">
                                    <a class="btn btn-primary btn-sm right" href=d-news-add.php>Add News</a>
                                    </div>
                                    <div class="col-12 col-md-8">
                                   
                                        <form class="d-flex" action="d-newsmgt.php" method="GET">
                                        <input class="form-control me-2" type="text" placeholder="Search.." aria-label="Search" id="search" name="search">
                                        <button class="btn btn-outline-primary" type="submit">Search</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        <div class="card-body">
                                    <?php 
                                    // default values
                                    $search = $_GET['search'] ?? '';
                                    
                                    if (!empty($search)) {
                                        
                                        $sqlsearch = "SELECT * FROM news
                                        WHERE (newsDate LIKE '%$search%' OR newsTitle LIKE '%$search%' OR newsDescription LIKE '%$search%')
                                       ";
                                        
                                    } else {
                                        
                                        $sqlsearch = "SELECT * FROM news
                                       ";
                                    }
                                
                                    $resultsearch = mysqli_query($conn, $sqlsearch);

                                    //error handelling
                                    if (!$resultsearch) {
                                        die("Error: " . mysqli_error($conn));
                                    }
                                    if (mysqli_num_rows($resultsearch) > 0){
                                    ?> 
                                    
                                
                                    <table class="table table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>News Id</th>
                                            <th>News Title</th>
                                            <th>Description</th>
                                            <th>Add By</th>
                                            <th>Date</th>
                                            <th colspan="2">Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <?php  while($rowsearch = mysqli_fetch_assoc($resultsearch)){ ?>
                                    <tbody>   
                                        <tr> 
                                            <td><?php echo $rowsearch['newsId']; ?></td>
                                            <td><?php echo $rowsearch['newsTitle']; ?></td>
                                            <td><?php echo $rowsearch['newsDescription']; ?></td>
                                            <td><?php echo $rowsearch['addBy']; ?></td>  
                                            <td><?php echo $rowsearch['newsDate']; ?></td>  
                                            <?php $newsId=$rowsearch['newsId']; ?>

                                              
                                            <td><a class="btn btn-primary btn-sm" href=d-news-update.php?newsId=<?php echo $newsId;?>>Update</a></td>
                                            <td><a class="btn btn-danger btn-sm" onclick="confirmCancel(<?php echo $newsId; ?>)">Delete</a></td>  
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                    </table>
                                    <?php } else { 
                                      
                                         echo "No records found matching the search criteria.";
                                    } ?>
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
 <?php          } ?>



<?php 
//Subject Officer*******************************************************************************
if($_SESSION['stfRole']=='Subject Officer'){

    ?>
    <!-- dashboard -->  
    <section id="dashboard">
        <div class="container py-5">
            <a class="d-grid pt-4" href="d-dashboard.php" role="button">Back</a>
            <h3 class="text-right mt-2 pt-4">Feedback Manage</h3>
            
            <?php if (isset($_GET["id"])){?>
                <p class="p-2 text-center alert alert-info">
                <span class="text-secondary"> <?php echo $_GET["id"];?> </span>
                </p> 
                <?php  } ?>
                
            <div class="container">
                <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4 pt-2">
                    <div class="col-12">
                        <div class="card shadow bg-body rounded text-center">
                            <div class="text-left p-4" style="background-color: #e3f2fd">
                                    <div class="row">
                                        <div class="col-12 col-md-4">
                                            
                                        </div>
                                        <div class="col-12 col-md-8">
                                            <form class="d-flex" action="d-feedbackmgt.php" method="GET">
                                            <input class="form-control me-2" type="text" placeholder="Search.." aria-label="Search" id="search" name="search">
                                            <button class="btn btn-outline-primary" type="submit">Search</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <div class="card-body">
                                        <?php 
                                        // default values
                                         $search = $_GET['search'] ?? '';
                                    
                                    if (!empty($search)) {
                                        
                                        $sqlsearch = "SELECT * FROM news
                                        WHERE (newsDate LIKE '%$search%' OR newsTitle LIKE '%$search%' OR newsDescription LIKE '%$search%')
                                       ";
                                        
                                    } else {
                                        
                                        $sqlsearch = "SELECT * FROM news
                                       ";
                                    }
                                    
                                      
                                        $resultsearch = mysqli_query($conn, $sqlsearch);
    
                                        //error handelling
                                        if (!$resultsearch) {
                                            die("Error: " . mysqli_error($conn));
                                        }
                                        if (mysqli_num_rows($resultsearch) > 0){
                                        ?> 
                                        
                                    
                                        <table class="table table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th>Feedback Id</th>
                                                <th>Description</th>
                                                <th>Feedback By</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <?php  while($rowsearch = mysqli_fetch_assoc($resultsearch)){ ?>
                                        <tbody>   
                                            <tr> 
                                                <td><?php echo $rowsearch['feedbackId']; ?></td>
                                                <td><?php echo $rowsearch['description']; ?></td>
                                                <td><?php echo $rowsearch['feedbackBy']; ?></td>
                                                <td><?php echo $rowsearch['fdate']; ?></td>  
                                                <?php $feedbackId=$rowsearch['feedbackId']; ?>
                                                <td>Delete</a></td>     
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                        </table>
                                        <?php } else { 
                                           
                                             echo "No records found matching the search criteria.";
                                        } ?>
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
     <?php          } ?>
    
    
<?php                 
include_once "../include/footer.php";                 
?>

<script>
function confirmCancel(newsId) {
    var result = confirm("Do you want to delete?");

    if (result) {
        
        window.location.href = "d-delete-process.php?newsId=" + newsId;
    } else {
       
    }
}
</script>
