<?php

function cleanString($string)
{
    return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}

function randomText($length = 10)
{
    return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
}

function get_dir_size($dir)
{
    $size = 0;

    foreach (glob(rtrim($dir, '/') . '/*', GLOB_NOSORT) as $each) {
        $size += is_file($each) ? filesize($each) : get_dir_size($each);
    }

    return $size;
}

function HumanSize($bytes)
{
    $type = ['b', 'Kb', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
    $index = 0;
    while ($bytes >= 1024) {
        $bytes /= 1024;
        $index++;
    }
    $bytes = round($bytes, 2);

    return '' . $bytes . ' ' . $type[$index];
}

function formatDuration($minutes)
{
    $hours = floor($minutes / 60);
    $remainder = $minutes % 60;

    if ($hours > 0 && $remainder > 0) {
        return "$hours hr y $remainder min";
    } elseif ($hours > 0) {
        return "$hours hr";
    } else {
        return "$remainder min";
    }
}


function round_up ($value, $places=0) {
    if ($places < 0) { $places = 0; }
    $mult = pow(10, $places);
    return ceil($value * $mult) / $mult;
}