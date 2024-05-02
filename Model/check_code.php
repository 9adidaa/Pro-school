<?php

$code = $_POST['code'];
$digit = $_POST['digit'];
$id = $_POST['id'];

if($code != $digit)
{
    header('Location: ../View/recover.php?failed=4'); 
}else{
    header('Location: ../View/new_password.php?i='.$id.''); 
}
