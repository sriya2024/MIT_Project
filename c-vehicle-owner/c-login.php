<?php     
//still didnt log to the sys use header.php instad of headervehiowner.php       
include_once "../include/header.php";   
?>

<!-- nav bar -->  
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-primary px-4 border-bottom fixed-top border-bottom border-5 border-info" >
      <div class="container-fluid container container-sm container-md container-lg container-xl container-xxl">
        <a class="navbar-brand fs-4 fw-bold text-white" href="../">WCVFEIS</a> 
      </div>
    </nav>
</header>
<!-- nav bar -->  

<!-- Login -->  
<section id="logindash">
  <div class="container container-md pt-5">
    <h1 class="text-center my-4 pt-2 pb-2">Commercial Vehicle Owner</h1>
    
   
    <?php if (isset($_GET["id"])){?>
      <p class="p-2 text-center alert alert-info">
      <span class="text-secondary"> <?php echo $_GET["id"];?> </span>
      </p> 
    <?php } ?>
  
    <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4">
      <div class="col-sm-12 col-md-4 col-lg-4 col-12 text-right">
        <div class="shadow mb-5 bg-body rounded">
            <h3 class="p-4 text-center">login</h3>   
            <form class="border-round p-4 bgcolor-s" action = "c-include/c-login-inc.php" method = "POST">
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control rounded-pill" id="email" name="email">
              </div>      
              <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control rounded-pill" name="password" id="password">
              </div>
              <div class="d-grid py-4">
                <button type="submit" name="submit" class="btn btn-outline-primary rounded-pill ">Login</button>
              </div>
            </form>   
            <p class="text-center pb-5 c-para">Don't have an account? <a href="c-signup.php" role="button">Sign Up </a></p>   
        </div>
      </div> 
    </div>  

  </div>
</section>
    
<?php                 
include_once "../include/footer.php";                 
?>


