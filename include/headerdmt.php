<?php 
//require_once("../include/session.php");
require_once("../include/sessionmanagementdmt.php");
require_once("../include/dbconnection.php");
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="../bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap icon -->
    <link rel="stylesheet" href="../bootstrap-icons-1.10.5/font/bootstrap-icons.css">
    <!-- Customize css -->
    <link href="../style.css" rel="stylesheet">

    <title>WCVFEIS</title>
  </head>
  <body>
<?php 
  //get NIC value from the session variable
if (isset($_SESSION['stfNic'])) {
    $nic = $_SESSION['stfNic'];
} else {
    echo "NIC value not found.";
    exit; 
}

if ($nic=="admin"){
?>
 <header>
         <!-- nav bar -->  
        <nav class="navbar navbar-expand-lg navbar-light bg-primary px-4 border-bottom fixed-top border-bottom border-5 border-success" >
            <div class="container-fluid container container-sm container-md container-lg container-xl container-xxl">
                <a class="navbar-brand fs-4 fw-bold text-white" href="../index.php">WCVFEIS</a>
            
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-6 text-center">
                        
                        <li class="nav-item">
                        <a class="nav-link active fw-bold text-white" aria-current="page" href="#"><?php echo $_SESSION['stfRole']?> </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="../logout.php"> | &nbsp logout</a>
                        </li>
                    </ul>
                </div>
      
            </div>
        </nav>
   </header>

<?php
}else{ ?>

    <header>
    <!-- nav bar -->  
   <nav class="navbar navbar-expand-lg navbar-light bg-primary px-4 border-bottom fixed-top border-bottom border-5 border-success" >
       <div class="container-fluid container container-sm container-md container-lg container-xl container-xxl">
           <a class="navbar-brand fs-4 fw-bold text-white" href="../index.php">WCVFEIS</a>
       
           <div class="collapse navbar-collapse" id="navbarSupportedContent">
               <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-6 text-center">
                   <a class="nav-link active fw-bold text-white" aria-current="page" href="#"><?php echo $_SESSION['stfFname']." ".$_SESSION['stflLname']; ?> &nbsp |</a>
                   </li>
                   <li class="nav-item">
                   <a class="nav-link active fw-bold text-white" aria-current="page" href="#"><?php echo $_SESSION['stfRole']?> </a>
                   </li>
                   <li class="nav-item">
                   <a class="nav-link active text-white" aria-current="page" href="../logout.php"> | &nbsp logout</a>
                   </li>
               </ul>
           </div>
 
       </div>
   </nav>
</header>
<!-- nav bar -->  


<?php
}
?>

    