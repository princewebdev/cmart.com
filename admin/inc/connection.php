<?php
$db = mysqli_connect('localhost','root','mysql','cmart');

if($db){
    //echo "Database connection established";
}else{
    die('Database connection error'.mysqli_error($db));
}