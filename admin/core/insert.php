<?php

$db = mysqli_connect('localhost','root','mysql','cmart');

if($db){
    //echo "Database connection established";
}else{
    die('Database connection error'.mysqli_error($db));
}

// function start 
// image or not img check 
 function isImg($img){
    global $db;
    $exExtn =   explode('.',$img);
    $extn = strtolower(end($exExtn));
    $extnArray = array('jpg','jpeg','png');
    
    if(in_array($extn,$extnArray) === true){
        return true;
    }else{
        return false;
    }
 }

 // delete from db 
 function deleteDbVal($table,$dbId,$delId,$redirect){
    global $db;
      
    $deleteBrandRes  = mysqli_query($db,"DELETE FROM $table WHERE $dbId = '$delId' ");
    if($deleteBrandRes){
      header('location: '.$redirect);
    }else{
      die('delete error'.mysqli_error($db));
    }
 }

 //delete file 
 function deleteFile($fileName,$table,$dbId,$fileId,$location){
    global $db;
    $readImgRes = mysqli_query($db,"SELECT $fileName FROM $table WHERE $dbId = '$fileId' ");
    $row = mysqli_fetch_assoc($readImgRes);
    $brandName  =   $row[$fileName];
    unlink($location.$brandName);
 }

// function end 

// add category 
if(isset($_POST['catSubmit'])){
    $catName        =   $_POST['catName'];
    $isParent       =   $_POST['isParent'];
    $catImageName   =   $_FILES['catImage']['name'];
    $catImageFile   =   $_FILES['catImage']['tmp_name'];

    $ext = explode('.',$catImageName);
    $extn = strtolower(end($ext));
    $extArray = array('jpg','png','jpeg');
    
    if(!empty($catImageName)){
        if(in_array($extn,$extArray) === true){
                $updateName =  rand().$catImageName;
                move_uploaded_file($catImageFile,'../assets/img/product/category/'.$updateName);

                $catAddSql = "INSERT INTO mart_category (c_name,c_image,is_parent,c_status) VALUE ('$catName','$updateName','$isParent',1)";
                $catAddRes = mysqli_query($db,$catAddSql);
                if($catAddRes){
                    header('location: ../category.php');
                    exit();
                }else{
                    die('Category add erorr'.mysqli_error($db));
                }
        }else{
            echo 'Please upload an image file' ;
        }
        
    }else{
        if(!empty($catName)){
            $catAddSql = "INSERT INTO mart_category (c_name,is_parent,c_status) VALUE ('$catName','$isParent',1)";
            $catAddRes = mysqli_query($db,$catAddSql);
            if($catAddRes){
                header('location: ../category.php');
                exit();
            }else{
                die('Category add erorr'.$db);
            }
        
        }else{
            echo '<span> Category Name is Required? <a href="../category.php"> Go back privious page </a> </span>';
           
        }
    }   
}

// Insert brand 

if(isset($_POST['addBrand'])){
    $bName    =   $_POST['bName'];
    $bLogoName    =   $_FILES['bLogo'] ['name'];
    $bLogo    =   $_FILES['bLogo'] ['tmp_name'];

    if(!empty($bLogoName)){
        $isImgFunc  = isImg($bLogoName);

        if($isImgFunc){
            $updateName = rand().$bLogoName;
            move_uploaded_file($bLogo,'../assets/img/product/brand/'.$updateName);

        }else{
            echo 'not an image';
        }
    }else{
        $updateName = 0;
    }

    $brandRes = mysqli_query($db, "INSERT INTO mart_brand (b_name,b_logo,b_status) VALUES ('$bName','$updateName',1)");
    if($brandRes){
        header('location: ../brand.php');
    }else{
        die('category add error'.mysqli_error($db));
    }
}

