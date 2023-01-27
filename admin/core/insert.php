<?php

$db = mysqli_connect('localhost','root','mysql','cmart');

if($db){
    //echo "Database connection established";
}else{
    die('Database connection error'.mysqli_error($db));
}

// add category 
if(isset($_POST['catSubmit'])){
    $catName    =   $_POST['catName'];
    $isParent   =   $_POST['isParent'];
    // $catImgName =   $_FILES['catImg'] ['name'];
    // $catImg =   $_FILES['catImg'] ['tmp_name'];

    // $expExtn    =   explode('.',$catImgName);
    // $extn   =   strtolower(end($expExtn));
    // $extnArray = array('jpg','jpeg','png','webp');

    // if(!empty($catImgName)){
    //     if(in_array($extn,$extnArray) == true){

    //     }else{
    //         echo "please upload jpg, jpeg, png and webp image";
    //     }
    // }else{

    // }
   
    

    if(!empty($catName)){
        $catInsert = "INSERT INTO mart_category (c_name,is_parent,c_status) VALUES ('$catName','$isParent',1)";
        $catRes = mysqli_query($db,$catInsert);
        if($catRes){
            header('location: ../category.php');
        }else{
            die('category add error'.mysqli_error($db));
        }
    }else{
        echo '<span class="text-danger"> Category name is required </span>';
        header('location: ../admin/category.php');
    }

}