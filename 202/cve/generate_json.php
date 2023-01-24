<?php

if (empty($argv[2])) {
    exit('The path is not set');
}

if (empty($argv[3])) {
    exit('Output path is not set');
}

$path = $argv[2];
$outputDir = $argv[3];

if (!is_dir($path)) {
    exit('Path is not found');
}

if (!is_dir($outputDir)) {
    exit('Output dir is not found');
}

$data = getAllJsons($path);
$pathToDir = $outputDir . '/cve.json';

if (MD5areDifferent($data, $pathToDir) == false) {
    exit('No changes in the file');
}

saveJson($data, $outputDir);

exit('New CVE json has been generated');

function MD5areDifferent($data, $pathToDir)
{
    $jsonBefore = file_get_contents($pathToDir);
    $jsonBeforeMd5 = md5($jsonBefore);

    $jsonAfter = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    $jsonAfterMd5 = md5($jsonAfter);

    if ($jsonBeforeMd5 != $jsonAfterMd5) {
        return true;
    }

    return false;
}

function getAllJsons($path)
{
    $data = [];

    $it = new RecursiveDirectoryIterator($path);
    foreach (new RecursiveIteratorIterator($it) as $file) {
        if (is_dir($file)) {
            continue;
        }
        $content = json_decode(file_get_contents($file), true);
        if (!empty($content)) {
            $data[] = $content;
        }
    }

    return $data;
}

function saveJson($data, $outputDir)
{
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    
    return file_put_contents($outputDir . 'cve.json', $json);
}