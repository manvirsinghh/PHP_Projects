<?php

function validatePhoneNumber($phone){
    $phone=trim($phone);

    if(empty($phone)){
        return "Phone number is required";
    }
    if(!preg_match("/^[0-9]{10}$/", $phone)){
        return "Invalid phone number. It should be exactly 10 digits.";

    }
    return ""; //no error
}

?>