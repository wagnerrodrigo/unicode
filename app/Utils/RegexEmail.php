<?php

namespace App\Utils;

class RegexEmail
{
    public static function regexEmail($email)
    {
        $regex = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-zA-Z]{2,4}$/';
        if (preg_match($regex, $email)) {
            return true;
        } else {
            return false;
        }
    }
}

/*function isEmailValido($email){
    $conta = "/[a-zA-Z0-9\._-]+@";
    $domino = "[a-zA-Z0-9\._-]+.";
    $extensao = "([a-zA-Z]{2,4})$/";
    $pattern = $conta.$domino.$extensao;

    if (preg_match($pattern, $email))
        return true;
    else
        return false;
}*/
