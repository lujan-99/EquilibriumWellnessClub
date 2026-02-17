<?php 
$con=mysqli_connect("localhost","root","","gymdb", 3306);
if(mysqli_connect_errno()){
    die("Se produjo un error ".mysqli_connect_error());
}
?>