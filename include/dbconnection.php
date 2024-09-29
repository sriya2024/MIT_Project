<?php
$conn=mysqli_connect("localhost","root","","wcvfeis");

if (!$conn){
    die("connection failed : " . mysqli_connect_error());
}