<?php                 
include_once "../include/header.php";                 
?>

  <body>
    <header>
         <!-- nav bar -->  
        <nav class="navbar navbar-expand-lg navbar-light bg-primary px-4 border-bottom fixed-top border-bottom border-5 border-success" >
          <div class="container-fluid container container-sm container-md container-lg container-xl container-xxl">
            <a class="navbar-brand fs-4 fw-bold text-white" href="../index.php">WCVFEIS</a>
          </div>
        </nav>
   </header>
<!-- nav bar -->  

<!-- Login -->  
<section id="logindash">
        <div class="container container-md py-5">
          <h1 class="text-center my-4 py-4">Department of Morter Traffic - Western Province</h1>
          <p class="p-2 text-center">
          <?php if (isset($_GET["id"])){?>
          <span class="text-secondary"> <?php echo $_GET["id"];?> </span>
          <?php  } ?>
          </p> 
         
          <div class="row justify-content-md-center row-cols-1 row-cols-md-2 g-4">
            <div class="col-sm-12 col-md-4 col-lg-4 col-12 text-right">
              <div class="shadow mb-5 bg-body rounded">
                <h3 class="p-4 text-center">login</h3>   
                <form class="border-round p-4 bgcolor-s" action = "d-include/d-login-inc.php" method = "POST">
                  <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" class="form-control rounded-pill" id="email" name="email">
                    </div>      
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" class="form-control rounded-pill" name="password" id="password">
                    </div>
                    <div class="mb-3">
                      <label for="exampleInputPassword1" class="form-label">Role</label>
                        <select  class="form-select me-2 form-control rounded-pill" id="role" name="role" required>
                            <option value="Subject Officer">Subject Officer</option>
                            <option value="Commissioner">Commissioner</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div class="d-grid py-4">
                      <button type="submit" name="submit" class="btn btn-outline-primary rounded-pill ">Login</button>
                    </div>
                  </form>           
            </div>
          </div>   
        </div>
     </section>
    
<?php                 
include_once "../include/footer.php";                 
?>