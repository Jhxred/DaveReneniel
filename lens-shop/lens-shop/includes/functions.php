<?php
// helper functions for the shop

function get_products() {
    $file = __DIR__ . '/../data/products.json';
    $json = file_get_contents($file);
    return json_decode($json, true);
}

function save_products($products) {
    $file = __DIR__ . '/../data/products.json';
    // @ because this fails on Vercel (read-only filesystem)
    return @file_put_contents($file, json_encode($products, JSON_PRETTY_PRINT));
}

function money($n) {
    return '$' . number_format($n, 2);
}
