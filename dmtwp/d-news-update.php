<?php                 
include_once "../include/headerdmt.php";      

if (isset($_GET["newsId"])){
    $newsId = $_GET["newsId"];
  
} else {
    echo "newsId value not found.";
}

$sqlinfo="SELECT * FROM news 
    WHERE newsId = '$newsId'";
	
	$resultinfo=mysqli_query($conn,$sqlinfo);

	if (!$resultinfo) {
		die("Error: " . mysqli_error($conn));
	}
	
	$rowinfo=mysqli_fetch_array($resultinfo);
?>
<!-- dashboard -->  
<section id="dashboard">
    <div class="container py-5">
        <a class="d-grid pt-4" href="d-newsmgt.php" role="button">Back</a>
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
                                    <h3>Update News</h3>
                                </div>
                            </div>
                            <form action="d-update-news-process.php" method="GET">
                        <div class="card-body">
                                <div class="row py-3">  
                                    <div class="col-sm-2" class="text-center"></span></div>
                                    <div class="col-sm-2" class="text-center">News Id</span></div>
                                    <div class="col-sm-8"><input class="form-control me-2" type="text" id="news_id" name="news_id" value ="<?php echo $rowinfo['newsId']; ?>" required></div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-sm-2" class="text-center"></span></div>
                                    <div class="col-sm-2" class="text-center">News Titel</span></div>
                                    <div class="col-sm-8"><input class="form-control me-2" type="text" id="news_title" name="news_title" value="<?php echo $rowinfo['newsTitle']; ?>" required></div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-sm-2" class="text-center"></span></div>
                                    <div class="col-sm-2" class="text-center">News Description</span></div>
                                    <div class="col-sm-8"><textarea class="form-control" id="news_des" name="news_des" rows="3"> <?php echo $rowinfo['newsDescription']; ?></textarea> </div>
                                </div>
                                <div class="row py-3">
                                    <div class="col-sm-2" class="text-center"></span></div>
                                    <div class="col-sm-2" class="text-center"></span></div>
                                    <div class="col-sm-8">        
                                        <button class="btn btn-outline-primary" type="submit" onclick="confirmUpdate(<?php echo $news_id; ?>)">Update</button>
                                    </div>
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
</section>
<?php                 
include_once "../include/footer.php";                 
?>


<script>
  /*  function confirmUpdate(news_id) {
        var result = confirm("Do you want to Update?");

        if (result) {
            
            window.location.href = "d-update-news-process.php?newsId=" + news_id;
        } else {
            
        }
    } */
</script>