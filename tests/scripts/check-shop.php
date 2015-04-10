#!/usr/bin/php

<?php
/*
 * This script tests pages in a single loaded shop
 */

define('ERROR_LOG_FILENAME', '/logs/errors.log');

define('BASE_URL', 'http://shop');


$checks = array(

    'Shopware4' => array(
        BASE_URL => array(
            'title' => '<title>Shopware 4 Demo</title>',
            'string1' => 'title="Partnerprogramm"',
            'footer' => 'Realisiert mit  <a href="http://www.shopware.de" target="_blank" title="Shopware">Shopware</a>',
        ),
        BASE_URL . '/ticket/index/sFid/9' => array(
            'title' => '<title>Defektes Produkt | Shopware 4 Demo</title>',
            'label1' => '<label for="system">Mit welchem Betriebssystem arbeiten Sie?:</label>',
        ),
        BASE_URL . '/note' => array(
            'title' => '<title>Merkzettel | Shopware 4 Demo</title>',
            'heading' => '<title>Merkzettel | Shopware 4 Demo</title>',
        ),
        BASE_URL . '/backend' => array(
            'title' => '<title>Shopware 4 - Backend',
            'js' => "Ext.define('Shopware.app.Application'",
        ),
    ),

    'Shopware4DemoData' => array(
        BASE_URL => array(
            'title' => '<title>Shopware 4 Demo</title>',
            'hotline' => '<span class="head">Service Hotline</span>',
            'footer' => 'Realisiert mit  <a href="http://www.shopware.de" target="_blank" title="Shopware">Shopware</a>',
            'text1' => 'Sonnenschutz - so gehören Sie zur...',
        ),
        BASE_URL . '/ticket/index/sFid/9' => array(
            'title' => '<title>Defektes Produkt | Shopware 4 Demo</title>',
            'label' => '<label for="system">Mit welchem Betriebssystem arbeiten Sie?:</label>',
        ),
        BASE_URL . '/note' => array(
            'title' => '<title>Merkzettel | Shopware 4 Demo</title>',
            'heading' => '<title>Merkzettel | Shopware 4 Demo</title>',
        ),
        BASE_URL . '/backend' => array(
            'title' => '<title>Shopware 4 - Backend',
            'js' => "Ext.define('Shopware.app.Application'",
        ),
        BASE_URL . '/beispiele/' => array(
            'title' => '<title>Beispiele | Shopware 4 Demo</title>',
            'link' => 'Weitere Artikel in dieser Kategorie',
            'heading' => '<h3>Konfiguratorartikel</h3>',
        ),
        BASE_URL . '/freizeitwelten/vintage/137/fahrerbrille-chronos' => array(
            'title' => '<title>Fahrerbrille Chronos | Vintage | Freizeitwelten | Shopware 4 Demo</title>',
            'button' => 'name="In den Warenkorb" value="In den Warenkorb"',
            'heading' => '<h2>Produktinformationen "Fahrerbrille Chronos"</h2>',
        ),
        BASE_URL . '/media/image/beach1503f8532d4648.jpg' => 'image',
        BASE_URL . '/media/image/beach2503f8535275aa.jpg' => 'image',
        BASE_URL . '/media/image/beach_teaser5038874e87338.jpg' => 'image',
    ),


    'dev-shop' => array(
        BASE_URL => array(
            'title' => '<title>Shopware 4 Demo</title>',
            'string1' => 'title="Partnerprogramm"',
        ),
        BASE_URL . '/ticket/index/sFid/9' => array(
            'title' => '<title>Defektes Produkt | Shopware 4 Demo</title>',
            'label1' => '<label for="system">Mit welchem Betriebssystem arbeiten Sie?:</label>',
        ),
        BASE_URL . '/backend' => array(
            'title' => '<title>Shopware 4 - Backend',
            'js' => "Ext.define('Shopware.app.Application'",
        ),
        BASE_URL . '/media/image/beach1503f8532d4648.jpg' => 'image',
        BASE_URL . '/media/image/beach2503f8535275aa.jpg' => 'image',
        BASE_URL . '/media/image/beach_teaser5038874e87338.jpg' => 'image',
    ),


    'Shopware5' => array()
);


function logError($line)
{
    $file = fopen(ERROR_LOG_FILENAME, 'a');

    $str = '[' . date('Y-m-d H:i:s') . '] ';
    $str .= $line;
    $str .= " \n";

    fwrite($file, $str);
    fclose($file);
}


function doChecks($checks)
{
    foreach ($checks as $url => $strings) {
        if ($strings == 'image') {
            $res = getimagesize($url);
            if ($res === false) {
                throw new Exception("Image '$url' not found in the shop");
            }
        } else {
            // array of strings
            $html = file_get_contents($url);
            foreach ($strings as $key => $string) {
                if (mb_strpos($html, $string, null, 'UTF-8') === false) {
                    throw new Exception("The string tagged '$key' not found in the html content of $url");
                }
            }
        }
    }
    // todo: login with curl in the backend
    // http://shop/backend/Login/login postdata: locale=2&password=demo-shop&username=demo-shop
}


// execution

try {

    $shopVersion = $argv[1];

    if ($shopVersion == 'dev') {
        $key = 'dev-shop';
    } else {
        $hasDemoData = (strpos($shopVersion, '.d') !== false);
        $key = $hasDemoData ? 'Shopware4DemoData' : 'Shopware4';
    }

    doChecks($checks[$key]);

} catch (Exception $ex) {
    echo "Exception occurred in Shopware $shopVersion: {$ex->getMessage()}\n";
    logError("Shopware $shopVersion: " . $ex->getMessage());
}

