<?php
include "config.php";
$model = new model();
$id = $_REQUEST['id'];

$delete = $model->delete($id);

if($delete){
    echo "<script> alert('Delete successful'); </script>";
    echo "<script> window.location.href = 'index.php'; </script>";
}


?>