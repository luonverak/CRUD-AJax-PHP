<?php
    include('connection_db.php');
    $id = $_POST['remove_id'];
    $sql = "DELETE FROM `employee` WHERE id='$id'";
    $rs  = $con->query($sql);
    echo 'ok';
?>