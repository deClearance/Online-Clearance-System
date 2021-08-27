<?php 

include_once './../pdo/controller.php';
// update Material

if (isset($_POST['update_material'])) {

    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $desc = $_POST['desc'];
    $id = $_POST['id'];

    if (empty($quantity) || empty($name) || empty($id) || empty($desc)) {
        header("Location:../pages/updateMaterial.php?message=Please Fill Empty Fields First Please!&id=$id");
    } else {
        $sql = "UPDATE `material` SET `name` = '$name', `available_quantity` = '$quantity', 
        `description` = '$desc' WHERE 
        `material`.`id` = $id ";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header("Location:../pages/materials.php?message=Material Successfully Updated!");
        } else {
            header("Location:../pages/updateMaterial.php?message=Unable To Update Material!");
        }
    }
}


if(isset($_GET['id'])){
    $result = getAllMaterials($_GET);
    if(count($result) > 0){
        $row = $result;
    }
}



?>