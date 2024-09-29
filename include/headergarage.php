<?php
require_once("../include/sessionmanagementgarage.php");
require_once("../include/dbconnection.php");

if (isset($_SESSION['unic'])) {
    $usernic = $_SESSION['unic']; 
} else {
    echo "NIC value not found.";
}
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
 
 <!-- ****************************** garage owner******************************* -->  
 <?php      

       
 if($_SESSION['roleId']==1){
        

       $roleid=$_SESSION['roleId'];
       $sql="SELECT * FROM garage_user as gu, garage_owner as gw, garage as g
       WHERE gu.userNic=$usernic AND gu.userNic=gw.ownerNic AND gu.garageId=g.garageId";
       $result = mysqli_query($conn, $sql);
       $count=mysqli_num_rows($result); 
         if($count!=0){
            
            $sqlinfo="SELECT * FROM garage_user as gu, garage_owner as gw, garage as g, garage_role as gr
            WHERE gu.userNic=$usernic AND gu.userNic=gw.ownerNic AND gu.garageId=g.garageId AND $roleid=gr.roleId";
        
            $resultinfo=mysqli_query($conn,$sqlinfo);
            $rowinfo=mysqli_fetch_array($resultinfo);
        
    //set session variable
            $userid=$_SESSION['uid']=$rowinfo['userId']; 
            $usernic=$_SESSION['unic']=$rowinfo['userNic']; 	
            $ownerid=$_SESSION['oid']=$rowinfo['ownerId']; 
            $ownerfname=$_SESSION['ofname']=$rowinfo['ownerFname']; 
            $ownerlname=$_SESSION['olname']=$rowinfo['ownerLname']; 
            $ownernic=$_SESSION['onic']=$rowinfo['ownerNic']; 
            $ownerpno=$_SESSION['opno']=$rowinfo['ownerPno']; 
            $garagename=$_SESSION['gname']=$rowinfo['garageName'];   
            $rolename=$_SESSION['rname']=$rowinfo['roleName'];   
            $garageid=$_SESSION['gid']=$rowinfo['garageId']; 
            $garageaddress=$_SESSION['gaddress']=$rowinfo['gAddress']; 
            $garagepno=$_SESSION['gPno']=$rowinfo['gPno']; 
            $garagedistrict=$_SESSION['gDistrict']=$rowinfo['gDistrict']; 
            $garagecity=$_SESSION['gCity']=$rowinfo['gCity']; 
            $garageemail=$_SESSION['gEmail']=$rowinfo['gEmail']; 
            $garageregyear=$_SESSION['regYear']=$rowinfo['regYear']; 
        } else{
        $msg=("Invalid login");
	    header("Location:../g-login.php?id=$msg");
	    exit();

        }
 
       ?> 
    <header>
         <!-- nav bar -->  
        <nav class="navbar navbar-expand-lg navbar-light bg-primary px-4 border-bottom fixed-top border-bottom border-5 border-warning" >
            <div class="container-fluid container container-sm container-md container-lg container-xl container-xxl">
                <a class="navbar-brand fs-4 fw-bold text-white" href="../index.php">WCVFEIS</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-6 text-center">
                        <a class="nav-link active fw-bold text-white" aria-current="page" href="#"><?php echo $ownerfname." ".$ownerlname; ?> &nbsp |</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active fw-bold text-white" aria-current="page" href="#"><?php echo $rolename?> </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="../logout.php"> | &nbsp logout</a>
                        </li>
                    </ul>
                </div>
               
            </div>
        </nav>
   </header>
  <?php  } ?>
<!-- ****************************** Cerifying pfficer******************************* -->  
  <?php 
        if($_SESSION['roleId']==2){

       $roleid=$_SESSION['roleId'];
       $sql="SELECT * FROM garage_user as gu, certifying_officer as co, garage as g
       WHERE gu.userNic=$usernic AND gu.userNic=co.cofficerNic AND gu.garageId=g.garageId";
       $result = mysqli_query($conn, $sql);
       $count=mysqli_num_rows($result); 
         if($count!=0){
            
            $sqlinfo="SELECT * FROM garage_user as gu, certifying_officer as co, garage as g, garage_role as gr
            WHERE gu.userNic=$usernic AND gu.userNic=co.cofficerNic AND gu.garageId=g.garageId AND $roleid=gr.roleId";
        
            $resultinfo=mysqli_query($conn,$sqlinfo);
            $rowinfo=mysqli_fetch_array($resultinfo);
        
    //set session variable	
            $userid=$_SESSION['uid']=$rowinfo['userId']; 
            $usernic=$_SESSION['unic']=$rowinfo['userNic']; 
            $cofficerid=$_SESSION['coid']=$rowinfo['cofficerId']; 
            $cofficerfname=$_SESSION['cfname']=$rowinfo['cofficerFname']; 
            $cofficerlname=$_SESSION['clname']=$rowinfo['cofficerLname']; 
            $cofficernic=$_SESSION['cnic']=$rowinfo['cofficerNic']; 
            $cofficerpno=$_SESSION['cpno']=$rowinfo['cofficerPno']; 
            $garagename=$_SESSION['gname']=$rowinfo['garageName'];   
            $rolename=$_SESSION['rname']=$rowinfo['roleName']; 
            $garageid=$_SESSION['gid']=$rowinfo['garageId'];  
            $garageaddress=$_SESSION['gaddress']=$rowinfo['gAddress']; 
            $garagepno=$_SESSION['gPno']=$rowinfo['gPno']; 
            $garagedistrict=$_SESSION['gDistrict']=$rowinfo['gDistrict']; 
            $garagecity=$_SESSION['gCity']=$rowinfo['gCity']; 
            $garageemail=$_SESSION['gEmail']=$rowinfo['gEmail']; 
            $garageregyear=$_SESSION['regYear']=$rowinfo['regYear']; 
         
        } else{
        $msg=("Invalid login");
	    header("Location:../g-login.php?id=$msg");
	    exit();

        }
       ?> 
    <header>
         <!-- nav bar -->  
        <nav class="navbar navbar-expand-lg navbar-light bg-primary px-4 border-bottom fixed-top border-bottom border-5 border-warning" >
        <div class="container-fluid container container-sm container-md container-lg container-xl container-xxl">
            <a class="navbar-brand fs-4 fw-bold text-white" href="../index.php">WCVFEIS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fs-6 text-center">
                        <li class="nav-item">
                        <a class="nav-link active fw-bold text-white" aria-current="page" href="#"><?php echo $cofficerfname." ".$cofficerlname; ?> &nbsp | </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active fw-bold text-white" aria-current="page" href="#"><?php echo $rolename?> </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="../logout.php"> | &nbsp logout</a>
                        </li>
                    </ul>
                
                </div>
            </div>
        </nav>
   </header>
   <?php } ?>