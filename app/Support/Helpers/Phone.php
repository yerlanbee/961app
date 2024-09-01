<?php

namespace App\Support\Helpers;

class Phone
{
    /**
     * @param $phone
     * @return string
     */
    public static function normalize($phone): string
    {
        $phone = ($phone[0] == '+') ? substr($phone, 1, strlen($phone)) : $phone;
        $phone = ($phone[0] == '8') ? '7' . substr($phone, 1, strlen($phone)) : $phone;
        $phone = (strlen($phone) <= 10) ? '7' . $phone : $phone;

        return preg_replace('/[^0-9]/', '', $phone);
    }

    /**
     * @param string $phone
     * @return string
     */
    public static function phoneFormat(string $phone): string
    {
        if (strlen($phone) == 11)
        {
            return "+7(" . substr($phone, 1, 3) . ")" . substr($phone, 4, 3) . " " . substr($phone, 7, 2) . " " . substr($phone, 9);
        } else {
            return $phone;
        }
    }
}
