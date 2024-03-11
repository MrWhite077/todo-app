<?php
include("./connect.php");

if (isset($_GET['id'])) {
    // print_r($_GET);
    $id =$_GET['id'];
    // echo $id
    $sql="DELETE FROM `todo_list` WHERE id = $id";
    $conn->query($sql);

    header('Location: index.php');
}