<?php
//session_start();
require_once("include/dbconnection.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="bootstrap-icons-1.10.5/font/bootstrap-icons.css">
    <link href="style.css" rel="stylesheet">
    <title>WCVFEIS</title>
  </head>

  <body>
    <header>
        
         <!-- nav bar -->  
         <nav class="navbar navbar-expand-lg navbar-light bg-primary px-4 border-bottom fixed-top" >
            <div class="container-fluid container container-sm container-md container-lg container-xl container-xxl">
                <a class="navbar-brand fs-4 fw-bold text-white" href="index.php">WCVFEIS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-6 text-center">
                        <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="news.php">News</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="faq.php">  | &nbsp FAQ</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="#">  | &nbsp Feedback</a>
                        </li>
                       
                    </ul>
                </div>
      
            </div>
        </nav>
   </header>
<!-- nav bar -->  

<!-- feedback -->  
<section id="feedback">
<div class="container container-md py-5">
            <?php 
             $sqlsearch = "SELECT * FROM feedback";
             
             $resultsearch = mysqli_query($conn, $sqlsearch);

             if (!$resultsearch) {
                 die("Error: " . mysqli_error($conn));
             }
             if (mysqli_num_rows($resultsearch) > 0){      
            ?>

            
            <div class="row justify-content-md-centerrow-cols-1 row-cols-md-2 g-4 pt-5 pb-3 ">
                <div class="col-sm-6 p-5" style="background-color: #e3f2fd">
                <h3>Your Feedback Is Important For Us..</h3>
                <div class="card-body">
                                <div class="row py-3">
                                    
                                    <div class="col-sm-2" class="text-center">Name</span></div>
                                    <div class="col-sm-8"><input class="form-control me-2" type="text" id="faq_question" name="faq_question" required></div>
                                </div>
                                <div class="row py-3">
                                   
                                    <div class="col-sm-2" class="text-center">Feedback</span></div>
                                    <div class="col-sm-8"><textarea class="form-control" id="faq_answer" name="faq_answer" ></textarea> </div>
                                </div>
                                <div class="row py-3">
                                   
                                    <div class="col-sm-2" class="text-center"></span></div>
                                    <div class="col-sm-8">        
                                        <button class="btn btn-outline-primary" type="submit">Save</button>
                                        <button class="btn btn-outline-primary" input type="reset" value="Reset">Clear</button>
                                    </div>
                                </div>    
                        </div>
                </div>
                <div class="col-sm-6 ">
                <?php while($rowsearch = mysqli_fetch_assoc($resultsearch)){?>
                
                    <div class="card border-info mb-3">
                        <div class="card-header ">  <p><b><?php echo $rowsearch['feedbackBy']; ?></b></P>
                        </div>
                        <div class="card-body">
                             <p class="card-text"><?php echo $rowsearch['description']; ?> <br> <?php echo $rowsearch['fdate']; ?></p>
                        
                         </div>
                        </div>
                   
                    <?php } ?>
                </div>
    </section>
    <?php } else { 

             echo "No records found";
             } 
                                    
            mysqli_close($conn);
            ?>
    </div> 
    

    <!-- footer --> 
    <footer id="footerbg" class="container-fluid bg-primary text-white p-2 text-center fs-6">
        Developed by Thilini Radhika
    </footer>
    

    <!-- JavaScript -->
    <script src="bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js" ></script>

    <script>
//remove get string show in  URL 
   var newURL = location.href.split(".")[0];
   window.history.pushState('object', document.title, newURL);
</script>


  </body>
</html>