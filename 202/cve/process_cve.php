<?php

if (empty($argv[2])) {
    exit('The path is not set');
}

if (empty($argv[3])) {
    exit('The cve dir is not set');
}

$fileName = $argv[2];
$cvePath = $argv[3];

if (findFile($fileName, $cvePath)) {
    exit('Cve already added');
}

$fileData = getFileData($fileName);

if (isPrestashopCoreCve($fileData)) {
    @copy($fileName, $cvePath . 'core/' . basename($fileName));
} else {
    @copy($fileName, $cvePath . 'modules/' . basename($fileName));
}

exit('SUCCESS');

function isPrestashopCoreCve($data)
{
    if (empty($data['affects']['vendor']['vendor_data'][0]['product']['product_data'][0]['product_name'])
        || empty($data['affects']['vendor']['vendor_data'][0]['vendor_name'])) {
        exit('It is an old cve, cannot get data');
    }

    if (strtolower($data['affects']['vendor']['vendor_data'][0]['product']['product_data'][0]['product_name']) == 'prestashop'
        && strtolower($data['affects']['vendor']['vendor_data'][0]['vendor_name']) == 'prestashop') {
        return true;
    }

    return false;
}

function getFileData($fileName)
{
    if (!file_exists($fileName)) {
        exit('File name is not valid');
    }

    $file = file_get_contents($fileName);

    return json_decode($file, true);
}

function findFile($fileName, $cvePath)
{
    $it = new RecursiveDirectoryIterator($cvePath);
    foreach (new RecursiveIteratorIterator($it) as $file) {
        if (basename($fileName) == basename($file)) {
            return true;
        }
    }

    return false;
}

