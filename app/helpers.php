<?php

if (!function_exists('calculateCryptoAmount')) {
    function calculateCryptoAmount($value, $price): float
    {
        return ($value / $price);
    }
}

if (!function_exists('handleSale')) {
    function handleSale($asset, $amount)
    {

    }
}

if (!function_exists('handleAllSales')) {
    function handleAllSales()
    {

    }
}


