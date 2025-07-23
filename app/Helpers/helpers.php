<?php // app/Helpers/helpers.php

if (!function_exists('formatPhoneNumber')) {
    function formatPhoneNumber($phone_number) {
        if (!$phone_number) return '-';

        $digits = preg_replace('/\D/', '', $phone_number);
        if (str_starts_with($digits, '62')) {
            $digits = '0' . substr($digits, 2);
        }

        $part1 = substr($digits, 0, 3);
        $part2 = substr($digits, 3, 4);
        $part3 = substr($digits, 7);

        return trim(implode('-', array_filter([$part1, $part2, $part3])));
    }
}
