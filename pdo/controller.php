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


?>