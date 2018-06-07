<?php
function p($var)
{
    echo '<pre>';
    print_r($var);
    echo '<pre>';
}
function dd($var)
{
    echo '<pre>';
    var_dump($var);
    echo '<pre>';
    die;
}