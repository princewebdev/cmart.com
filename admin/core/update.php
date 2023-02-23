<?php

$db = mysqli_connect('localhost','root','mysql','cmart');

if($db){
    //echo "Database connection established";
}else{
    die('Database connection error'.mysqli_error($db));
}


// Update Category
if(isset($_POST['catUpdate'])){
    $catName =  $_POST['catName'];
    $isParent =  $_POST['isParent'];
    $c_status =  $_POST['c_status'];
    $editId =  $_POST['editId'];

    $catImageName = $_FILES['catImage']['name'];

    if(!empty($catImageName)){
        $catImageName =  $_FILES['catImage'] ['name'];
        $catImage   =   $_FILES['catImage'] ['tmp_name'];

        $exExtn  =   explode('.',$catImageName);
        $extn = strtolower(end($exExtn));
        $extnArray   =  array('jpg','jpeg','png','webp');

        if(in_array($extn,$extnArray) === true){
            $imgRand = rand().$catImageName;
            move_uploaded_file($catImage,'../assets/img/product/category/'.$imgRand);

            $catUpdateSql = "UPDATE mart_category SET c_name ='$catName', c_image ='$imgRand', is_parent ='$isParent', c_status ='$c_status' WHERE  ID = '$editId' ";
            $catUpdateRes = mysqli_query($db,$catUpdateSql);
            if($catUpdateRes){
                header('location: ../category.php');
                exit();
            }else{
                die('Category update erorr'.mysqli_error($db));
            }
        }else{
            echo 'Plese upload an image file';
        }
        
    }else{
        $catUpdateSql = "UPDATE mart_category SET c_name ='$catName', is_parent ='$isParent', c_status ='$c_status' WHERE  ID = '$editId' ";
        $catUpdateRes = mysqli_query($db,$catUpdateSql);
        if($catUpdateRes){
            header('location: ../category.php');
            exit();
        }else{
            die('Category update erorr'.mysqli_error($db));
        }
    }
    

}