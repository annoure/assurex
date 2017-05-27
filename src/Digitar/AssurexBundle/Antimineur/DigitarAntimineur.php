<?php
/**
 * Created by PhpStorm.
 * User: gh
 * Date: 26-05-17
 * Time: 23:36
 */
// src/Digitar/AssurexBundle/Antimineur/DigitarAntimineur.php

namespace Digitar\AssurexBundle\Antimineur;

class DigitarAntimineur
{
    // validate birthday
    function isMineur($birthday, $age = 18)
    {
        // $birthday can be UNIX_TIMESTAMP or just a string-date.
        if(is_string($birthday)) {
            $birthday = strtotime($birthday);
        }

        // check
        // 31536000 is the number of seconds in a 365 days year.
        if(time() - $birthday < $age * 31536000)  {
            return false;
        }

        return true;
    }
}