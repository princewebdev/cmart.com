<?php
include '../../inc/connection.php';

$ajaxValue = intval($_GET['q']);

$radCatSql = "SELECT * FROM mart_category WHERE is_parent = '$ajaxValue' ";
$readCatResult = mysqli_query($db, $radCatSql);

?>
<div class="form-control w-50">
<?php
while($row = mysqli_fetch_assoc($readCatResult)){
    $cat_id     =   $row['ID'];
    $c_name     =   $row['c_name'];
    $c_image    =   $row['c_image'];
    $is_parent  =   $row['is_parent'];
    $c_status   =   $row['c_status'];
  
    ?>
      <input type="checkbox" value="<?php echo $cat_id ?>" >
      <label > <?php echo $c_name;?></label>
      <hr>
    <?php
  }
?>
</div>