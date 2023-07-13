<?php
    $profile = date('dmyhis').'-'.$_FILES['profile']['name'];
    $path    = 'image/'.$profile;
    move_uploaded_file($_FILES['profile']['tmp_name'],$path);
    echo $profile;
?>