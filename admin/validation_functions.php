<?php

function validating_phone_no($phone)
{
    return preg_match('/^\d{10}$/', $phone);
}
function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
function validatePassword($password)
{
    return preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[!@#$%^&*()\-_=+{};:,<.>]).{8,}$/", $password);
}
