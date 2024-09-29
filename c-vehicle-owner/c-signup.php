<?php                 
include_once "../include/header.php";     
?>

<header>
      <!-- nav bar -->  
    <nav class="navbar navbar-expand-lg navbar-light bg-primary px-4 border-bottom fixed-top border-bottom border-5 border-info" >
      <div class="container-fluid container container-sm container-md container-lg container-xl container-xxl">
        <a class="navbar-brand fs-4 fw-bold text-white" href="../index.php">WCVFEIS</a>
      </div>
    </nav>
</header>
<!-- nav bar -->  

<!-- Login -->  
<section id="logindash">
  <div class="container container-md py-5">
    <h1 class="text-center my-4 pt-4 pb-2">Commercial Vehicle Owner</h1>
    
    <?php if (isset($_GET["id"])){?>
      <p class="p-2 text-center alert alert-info">
      <span class="text-secondary"> <?php echo $_GET["id"];?> </span>
      </p> 
      <?php  } ?>
  
    <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4">
      <div class="col-sm-12 col-md-4 col-lg-4 col-12 text-right">
        <div class="shadow mb-5 bg-body rounded">
          <h3 class="p-4 text-center">Sign Up</h3> 
        
            <form class=" border-round p-4 bgcolor-s" action = "c-include/c-signup-inc.php" method = "POST">
              <div class="mb-3">
                <label for="firstName" class="form-label">First Name</label>
                <input type="text" class="form-control rounded-pill" id="fname" name="fname"  placeholder="Ex:Thilini" required>
              </div>      
              <div class="mb-3">
                <label for="lastName" class="form-label">Last Name</label>
                <input type="text" class="form-control rounded-pill" id="lname" name="lname" placeholder="Ex:Hemasiri" required>
              </div> 
              <div class="mb-3">
                <label for="nic" class="form-label">NIC</label>
                <input type="text" class="form-control rounded-pill" id="nic" name="nic" placeholder="Type number without 'V' or 'X'" required>
              </div>
              <div class="mb-3">
                <label for="phoneNo" class="form-label">Phone No</label>
                <input type="text" class="form-control rounded-pill" id="pno" name="pno" placeholder="Ex:0776855441" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control rounded-pill" id="email" name="email" required placeholder="Ex:thilini@gmail.com">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
              </div> 
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control rounded-pill" id="password" name="password" placeholder="Use Strong Password" required>
                <div id="passHelp" class="form-text">Should be at least 8 characters in length.</div>
              </div>
              <div class="d-grid py-4">
                <button type="submit" name="submit" class="btn btn-outline-primary rounded-pill ">Sign Up</button>
              </div>
            </form> 
          <p class="text-center pb-5 c-para">Do you have an account? <a href="c-login.php" role="button">Login</a></p>   
      </div>
    </div>   
  </div>
</section>
    
<?php                 
include_once "../include/footer.php";                 
?>


