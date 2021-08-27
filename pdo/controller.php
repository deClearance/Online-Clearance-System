<?php

$host= "localhost";
$user= "root";
$password = "";

$dbname = "clearance";

$dsn = 'mysql:host='.$host.';dbname='.$dbname;


$pdo = new PDO($dsn, $user, $password);

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

function cList($office = '')
{
    global $pdo;
    $sql = "SELECT * FROM `clearance_list` where office = :office && `approved` = 0 ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['office' => $office]);
    $result = $stmt->fetchAll();
    return $result;
}

function userList($owner=''){
    global $pdo;
    $sql = "SELECT * FROM `users` where id = :owner";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['owner' => $owner]);
    $result = $stmt->fetch();
    return $result;
}

function getAllMaterials($_mGET){
    global $pdo;
    $id = $_mGET['id'];
    $sql = "SELECT * FROM material where id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $id]);
    $result = $stmt->fetch();
    return $result;
}


function feedbacks($office_id){
    global $pdo;
    $sql = "SELECT * FROM `feedbacks` where to_office = :my_of ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['my_of'=>$office_id]);
    $result = $stmt->fetchAll();
    return $result;
}


function findUser($user_id){
    global $pdo;
    $sql = "SELECT * FROM `users` where id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id'=>$user_id]);
    $result = $stmt->fetch();
    return $result;
}




//  TODO

function approvedClearance($office, $approve){
    global $pdo;
    $sql = "SELECT * FROM `clearance_list` where office = :office && approved = :approve ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['office' => $office, 'approve' => $approve]);
    $result = $stmt->fetchAll();
    return $result;
}




// function validate($data){
// 	$data = trim($data);
// 	$data = stripslashes($data);
// 	$data = htmlspecialchars($data);
// 	return $data;
// }






//  TODO
function updateMaterial($_mPOST){
    global $pdo;
    $name = $_mPOST['name'];
    $quantity = $_mPOST['quantity'];
    $desc = $_mPOST['desc'];
    $id = $_mPOST['id'];

    if (empty($quantity) || empty($name) || empty($id) || empty($desc)) {
        header("Location:../pages/updateMaterial.php?message=Please Fill Empty Fields First Please!&id=$id");
    } else {
        $sql = "UPDATE `material` SET name = :name, available_quantity = :quantity, 
        description = :desc WHERE `material`.`id` = :id ";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['name' => $name, 'quantity' => $quantity, 'desc' => $desc, 'id' => $id]);
        $result = $stmt->fetch();
        if ($result) {
            header("Location:../pages/materials.php?message=Material Successfully Updated!");
        } else {
            header("Location:../pages/updateMaterial.php?message=Unable To Update Material!");
        }
    }
}



?>