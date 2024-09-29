<?php
//session_start();
?>

<!doctype html>
<html lang="en">
<head>
<!-- meta tags -->
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
    <!-- nav bar -->  
    <header>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary px-4 border-bottom fixed-top" >
        <div class="container-fluid container container-sm container-md container-lg container-xl container-xxl">
            <a class="navbar-brand fs-4 fw-bold text-white" href="#">WCVFEIS</a>
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
                        <a class="nav-link active text-white" aria-current="page" href="feedback.php">  | &nbsp Feedback</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    </header>
    <!-- end nav bar -->  

    <!-- index body -->  
    <section id="indexbody">
        <div class="container container-md py-5">
            <div class="text-center my-5 pt-2">
                <h1>Commercial Vehicle Fitness e-certificate Issuing System</h1>

                <!-- page nofification format --> 
                <?php if (isset($_GET["id"])){?>
                    <p class="p-2 text-center alert alert-info">
                    <span class="text-secondary"> <?php echo $_GET["id"];?> </span>
                    </p> 
                <?php } ?>
            </div>


            <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4">
                <div class="col-sm-12 col-md-4 col-lg-3 col-12 text-center">
                    <div class="card h-100 shadow-lg mb-5 bg-body rounded">
                        <img src="img/login1.jpg" class="card-img-top img-fluid cardimg" alt="dmtwp-image">
                        <div class="card-body">
                            <h5 class="card-title py-2">Department of Motor Traffic Western Province   </h5>
                            <p class="card-text py-1 c-para"> (DMTWP)</p>   
                        </div> 
                        <div class="card-body border-bottom border-5 border-success">
                            <a class="btn btn-outline-primary rounded-pill d-grid" href="dmtwp/dmtwp-login.php" role="button">Click here</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-3 col-12 text-center">
                    <div class="card h-100 shadow-lg mb-5 bg-body rounded">
                        <img src="img/login2.jpg" class="card-img-top img-fluid cardimg" alt="garage-image">
                        <div class="card-body">
                            <h5 class="card-title py-2">Vehicle Fitness Garage</h5>
                            <p class="card-text  c-para">Vehicle Fitness Garage owner and Vehicle Certifying Officer can log in to the system.</p>
                        </div> 
                        <div class="card-body border-bottom border-5 border-warning">   
                            <a class="btn btn-outline-primary rounded-pill d-grid" href="f-garage/g-login.php" role="button">Click here</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-3 col-12 text-center ">
                    <div class="card h-100 shadow-lg  mb-5 bg-body rounded">
                        <img src="img/login3.jpg" class="card-img-top img-fluid cardimg" alt="vehicle-image">
                        <div class="card-body">
                            <h5 class="card-title py-2">Commercial Vehicle fitness e-Certificate</h5>
                            <p class="card-text c-para">Commercial Vehicle owners can get your vehicle fitness certification here..</p>
                        </div> 
                        <div class="card-body border-bottom border-5 border-info">
                            <a class="btn btn-outline-primary rounded-pill d-grid" href="c-vehicle-owner/c-login.php" role="button">Click here</a>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </section>
</body>

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

</html>