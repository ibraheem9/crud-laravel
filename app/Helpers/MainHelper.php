<?php

/**
 * Format a date to 'd M, Y H:i:s' format.
 */
function dateFormat($date)
{
    if ($date) {
        $dateTime = new DateTime($date);
        return $dateTime->format('d M, Y H:i:s');
    }
    return '---';
}

/**
 * Format a date to 'd M, Y' format (date only, no time).
 */
function dateText($date)
{
    if ($date) {
        $dateTime = new DateTime($date);
        return $dateTime->format('d M, Y');
    }
    return '---';
}

/**
 * Format a time string to 'H:i' format.
 */
function timeFormat($date)
{
    if ($date) {
        $time = DateTime::createFromFormat('H:i:s', $date);
        return $time->format('H:i');
    }
    return '---';
}

/**
 * Convert snake_case to PascalCase.
 */
function snakToPascal($value)
{
    return str_replace(" ", "", ucwords(str_replace("_", " ", $value)));
}

/**
 * Check if a string ends with a given substring.
 */
function isEndsWith($string, $endString)
{
    $len = strlen($endString);
    if ($len == 0) {
        return true;
    }
    return (substr($string, -$len) === $endString);
}

/**
 * Format a number to 2 decimal places.
 */
function numberFormat($n)
{
    return round($n, 2);
}

/**
 * Cut a string to a specified length and add ".." if truncated.
 */
function cutString($string, $length)
{
    if (strlen($string) > $length) {
        $string = substr($string, 0, $length - 2) . "..";
    }
    return $string;
}

/**
 * Convert a key from snake_case to Title Case.
 */
function convertKey($key)
{
    $key = str_replace('_', ' ', $key);
    $key = ucwords($key);
    return $key;
}

/**
 * Generate a random hash ID.
 */
function generateHashID($minLength = 10, $maxLength = 10)
{
    $randomValue = bin2hex(random_bytes(16));
    $timestamp = time();
    $rawHash = $randomValue . $timestamp;
    $hash = substr(hash('sha256', $rawHash), 0, $maxLength);
    if (strlen($hash) < $minLength) {
        $hash = str_pad($hash, $minLength, '0');
    }
    return $hash;
}
