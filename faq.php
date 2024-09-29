<?php

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
                        <a class="nav-link active text-white" aria-current="page" href="#">  | &nbsp FAQ</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="feedback.php">  | &nbsp Feedback</a>
                        </li>
                       
                    </ul>
                </div>
      
            </div>
        </nav>
   </header>
<!-- nav bar -->  

<!-- faq -->  
<section id="faq">
        <div class="container container-md py-5">
            <div class="text-center my-5 pt-4">
                <h1>Commercial Vehicle Fitness e-certificate Issuing System</h1>
                
                <p class="p-2 text-center">
                <?php if (isset($_GET["id"])){?>
                <span class="text-secondary"> <?php echo $_GET["id"];?> </span>
                <?php  } ?>
                </p> 
            </div>
            <?php 
             $sqlsearch = "SELECT * FROM faq";
             $resultsearch = mysqli_query($conn, $sqlsearch);

            
             if (!$resultsearch) {
                 die("Error: " . mysqli_error($conn));
             }
             if (mysqli_num_rows($resultsearch) > 0){      
            ?>
          
            <div class="row justify-content-md-center row-cols-1 g-4">
            <h3>FAQ</h3>
            <?php while($rowsearch = mysqli_fetch_assoc($resultsearch)){?>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed btn btn-outline-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            <p><b><?php echo $rowsearch['faqQues']; ?></b></P>
                        </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body"><p><?php echo $rowsearch['faqAns']; ?></p>
                        </div>
                     
                        </div>
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
    <script src="jscript.js" ></script>

    <script>
    //remove get string show in  URL 
    var newURL = location.href.split(".")[0];
    window.history.pushState('object', document.title, newURL);
</script>


  </body>
</html>